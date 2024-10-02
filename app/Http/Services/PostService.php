<?php

namespace App\Http\Services;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService{

    public function getPosts(){


        $user = Auth::user();
        $posts = Post::with([
            'comments' => function ($query) {
                $query->withCount(['commentUpVotes' , 'commentDownVotes'])

                    ->take(3);
            },

            'authedRating', // علاقة تقييم المستخدم للمشاركة
            'user', // معلومات المستخدم الذي كتب المشاركة
            'tags', // الوسوم المرتبطة بالمشاركة
            'comments.authedRating' // علاقة تقييم المستخدم للتعليقات
        ])
            ->withCount([
                'usersRatings as upVotes' => function ($q) {
                    return $q->where('type', 'upVote');
                }

            ])
            ->withCount([
                'usersRatings as downVotes' => function ($q) {
                    return $q->where('type', 'downVote');
                }])
            ->whereDoesntHave('group')
            ->get();
        return $posts;
    }
    public function showPost($id){


        $post = Post::with(['user', 'usersRatings' => function ($query) {
            return $query->where('user_id', auth()->id());
        }])->find($id);

        //return $post ;
        return $post;

    }
public function comments($id){

    $comments = Comment::with('user')->where('post_id', $id)->get();
    return $comments;
}
    public function StorePost($validated)
    {
        $tags = $validated['tags2']??[];
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

        // التحقق من وجود صورة وتحميلها إذا كانت موجودة
        if (isset($validated['image']) && $validated['image'] instanceof \Illuminate\Http\UploadedFile && $validated['image']->isValid()) {
            // الحصول على الملف
            $file = $validated['image'];

            // إنشاء اسم فريد للصورة
            $filename = time() . '_' . $file->getClientOriginalName();

            // تحديد المسار لحفظ الصورة
            $filePath = 'images/posts/' . $filename;

            // تخزين الصورة في المجلد المحدد في public
            $file->move(public_path('images/posts'), $filename);

            // إضافة مسار الصورة إلى البيانات المعتمدة
            $validated['image'] = $filePath;
        }

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'tags' => $newTags??[],
            'group_id' => $validated['group_id'] ?? null,
            'image' => $validated['image']?? null, // إضافة مسار الصورة
        ]);

        if ($post->group_id) {
            if (auth()->user()->isAdminOfGroup($post->group_id)) {
                $post->update(['pendingPost' => false]);
            }
        }

        if (!empty($existingTagIds)) {
            $post->tags()->attach($existingTagIds);
        }

        return $post;
    }

    public function upVotePost($id){

        $post = Post::with('authedRating')->find($id);

        $ratings = $post->authedRating;

        if ($ratings) {
            if ($ratings->pivot->type == 'downVote') {

                // $user->postsRatings()->syncWithoutDetaching([$id=>['type'=>'upVote']]);
                $post->usersRatings()->updateExistingPivot(auth()->id(), ['type' => 'upVote']);
                //  $post->usersRatings()->syncWithoutDetaching([auth()->id() => ['type' => 'upVote']]);
                // $post->authedRatings()->syncWithoutDetaching([auth()->id()=>['type'=>'upVote']]);
            } else {
                $post->usersRatings()->detach(auth()->id());
                // $user->postsRatings()->detach($id);
            }
        } else {
            $post->usersRatings()->attach(auth()->id(), ['type' => 'upVote']);

            // $user->postsRatings()->syncWithoutDetaching([$id => ['type' => 'upVote']]);
        }


    }
    public function downVotePost($id){

        $post = Post::with('authedRating')->find($id);
        $ratings = $post->authedRating;

        if ($ratings) {
            if ($ratings->pivot->type == 'upVote')
                $post->usersRatings()->syncWithoutDetaching([auth()->id() => ['type' => 'downVote']]);


            else $post->usersRatings()->detach(auth()->id());

        } else {
            $post->usersRatings()->attach([auth()->id() => ['type' => 'downVote']]);
        }

    }

    public function removePost($id){

        $post = Post::with('comments', 'usersRatings')->find($id);
        if ($post->comments)
            $post->comments()->delete();

        if ($post->usersRatings)
            $post->usersRatings()->detach();
        $post->delete();
    }

    public function searchByTag($searchTerm){

        if (empty($searchTerm)) {
            return view('Pages.posts.index', ['posts' => collect()]);
        }

        $posts = Post::query()
            ->where(function ($query) use ($searchTerm) {
                foreach ($searchTerm as $search) {
                    if(is_numeric($search)) {

                        $query->orWhereHas('tags', function ($query) use ($search) {
                            $query->where('tag_id', $search);

                        });

                    }

                    $query->orWhereRaw('JSON_CONTAINS(tags, \'["' . $search . '"]\')');
                }

            })
            ->with(['authedRating','comments'=>function($q){return $q->withCount(['commentUpVotes','commentDownVotes']);}])
            ->withCount([
                'usersRatings as upVotes' => function ($q) {
                    $q->where('type', 'upVote');
                },
                'usersRatings as downVotes' => function ($q) {
                    $q->where('type', 'downVote');
                }
            ])

            ->get();

        // إزالة التكرارات
        $posts = $posts->unique();

        return $posts;
    }
}
