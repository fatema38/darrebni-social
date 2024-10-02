<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePostRequsest;
use App\Http\Services\PostService;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getPosts(); // جلب المنشورات

        // التحقق من وجود مستخدم مسجل وتعريف المتغير $followers
        $unfollowedUsers = null;
        if(auth()->check()) {
            $unfollowedUsers=$this->UnFollowedUsers();
        }

        return view('pages.posts.index', compact('posts', 'unfollowedUsers'));
    }
    public function UnFollowedUsers(){
        $user=auth()->user();

        $followingIds = $user->following()->pluck('following_id');

        $followingIds->push($user->id);

        $unfollowedUsers = User::whereNotIn('id', $followingIds)->take(30)->paginate(3);

        return $unfollowedUsers;
    }

    public function show($id)
    {
       $post= $this->postService->showPost($id);
       $comments=$this->postService->comments($id);

        return view('pages.posts.show', compact('post', 'comments'));
    }



    public function store(StorePostRequsest $request)
    {
        $validated = $request->validated();
        $post = $this->postService->StorePost($validated);

        if($post) {
            return redirect()->back()->with('success', 'Post stored successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to store post.');
        }
    }


    public function upVote($id)
    {
        $this->postService->upVotePost($id);
        return redirect()->back()->with('success', 'Post upvoted successfully.');
    }


    public function downVote($id)
    {
        $this->postService->downVotePost($id);
        return redirect()->back()->with('success', 'Post downvoted successfully.');
    }
    public function remove($id)
    {
        $this->postService->removePost($id);
        return redirect()->back()->with('success', 'Post removed successfully.');
    }
    public function update(Request $request, $id)
    { $post = Post::find($id);
        // التحقق من صحة البيانات المدخلة
       $validated= $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags3' => 'array|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // تحديث بيانات البوست
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $tags = $validated['tags3']??null;
        $existingTagIds = [];
        $newTags = [];

        if (!empty($tags)) {
            foreach ($tags as $tag) {
                if (is_numeric($tag)) {
                    $existingTagIds[] = $tag;
                } else {
                    $newTags[] = $tag;
                }
            }
        }
        $post->tags =$newTags;

        if (!empty($existingTagIds)) {
            $post->tags()->sync($existingTagIds);
        }
        // إذا تم تقديم صورة جديدة
        if ($request->hasFile('image')) {
            $file = $validated['image'];

            // إنشاء اسم فريد للصورة
            $filename = time() . '_' . $file->getClientOriginalName();

            // تحديد المسار لحفظ الصورة
            $filePath = 'images/posts/' . $filename;

            // تخزين الصورة في المجلد المحدد في public
            $file->move(public_path('images/posts'), $filename);

            // إضافة مسار الصورة إلى البيانات المعتمدة
          //  $validated['image'] = $filePath;
            $post->image = $filePath;
        }

        // حفظ البوست
        $post->save();


        return redirect()->back();
    }

    public function SearchByTag(Request $request)
    {
        $searchTerm = $request->input('tags1');
        $posts = $this->postService->searchByTag($searchTerm);
        $unfollowedUsers = null;
        if(auth()->check()) {
            $unfollowedUsers=$this->UnFollowedUsers();
        }

        return view('pages.posts.index', compact('posts', 'unfollowedUsers'));
    }


}
