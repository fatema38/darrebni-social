<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Services\GroupService;
use App\Models\Group;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    Protected $groupService;
    public function __construct(GroupService $groupService){
        $this->groupService=$groupService;
    }
    public function index(){
        $groups= $this->groupService->index();
        return view('pages.groups.groups',compact('groups'));
    }

public function show($id){
     $group=$this->groupService->show($id);
    $posts=$group->posts;
       return view ('pages.groups.show-group',compact('group','posts'));

}

    public function store(StoreGroupRequest $request)
    {    $validated=$request->validated();

     if(auth()->user()->role->name =="admin"|| auth()->user()->role->name =="superAdmin")
         $validated['owner_id']=$request->owner_id;
      $group = $this->groupService->store($validated);
       if($group)
         return redirect()->back()->with('success','Group is stored');
       else
           return redirect()->back()->with('failed','Group is not stored');
    }
    public function update(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],

            'group_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);


      $group=Group::find($request->group_id);
        // تحقق مما إذا كان هناك صورة جديدة قد تم تحميلها
        if ($request->hasFile('group_picture')) {
            // تحقق مما إذا كان للمستخدم صورة موجودة مسبقًا في public/images/profile_pictures
            if ($group->image_path && strpos($group->image_path, 'images/groups_images/') === 0) {
                // احذف الصورة القديمة
                $oldImagePath = public_path($group->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // الحصول على الملف المرفوع
            $file = $request->file('group_picture');

            // إنشاء اسم فريد للصورة مع الاحتفاظ بالامتداد
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // حفظ الصورة في المسار المطلوب داخل مجلد public/images/profile_pictures
            $file->move(public_path('images/groups_images'), $filename);

            // تحديث مسار الصورة في قاعدة البيانات
            $group->image_path = 'images/groups_images/' . $filename;
        }

        // تحديث باقي بيانات المستخدم
        $group->name = $request->name;
        $group->description = $request->description;



        // حفظ التحديثات في قاعدة البيانات
        $group->save();

        return redirect()->route('group.show', $group->id);
    }
    public function edit($id){
        $group = Group::find($id);
        return view('pages.groups.update-group-picture',compact('group'));
    }

    public function registerUser($group_id){
        $this->groupService->registerUser($group_id);
        return redirect()->back();
    }
    public function deleteGroup($id){
        $this->groupService->deleteGroup($id);

        return redirect()->back();
    }
    public function getMembers($id){
        $group=Group::with('users')->find($id);
        return view('pages.groups.members',compact('group'));
    }
    public function deleteMember(Group $group, User $user){

        $group->users()->detach($user);
        return redirect()->back();
    }
    public function makeUserAdmin(Group $group, User $user){
        $group->users()->updateExistingPivot($user->id, ['is_admin' => true]);
   return redirect()->back();
    }

    public function revokeUserAdmin(Group $group, User $user){
        $group->users()->updateExistingPivot($user->id, ['is_admin' => false]);
        return redirect()->back();

}

    public function searchByTag(Request $request, $groupId)
    {   $group_id=$groupId;
       $group=Group::with('users')->withCount('users','admins','posts')->find($groupId);
        $searchTerm = $request->input('tags1');

        if (empty($searchTerm)) {
            return view('Pages.groups.show-group', ['posts' => collect(),'group'=>$group]);
        }

        $posts = Post::query()
            ->whereHas('group',function($q)use($group_id){
                $q->where('group_id',$group_id);
            })
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

        return view('Pages.groups.show-group', compact('posts','group'));

    }
public function reportsGroup($group_id){
    $reports=Report::WhereHas('post', function ($query) use ($group_id) {
        $query->where('group_id', $group_id);
    })->get();

    return view('pages.groups.reports',compact('reports'));
}
public function pendingPostsGroup($group_id){
       $group=Group::with(['posts'=>function($q)use($group_id){
        return  $q->where('group_id',$group_id)->where('pendingPost',true);

    }])



    ->find($group_id);

return view('pages.groups.pending-posts',compact('group'));

}
public function rejectPost($id){
        $post=Post::find($id);
        $post->delete();
        return redirect()->back();

}

    public function approvePost($id){
        $post=Post::find($id);

        $post->update(['pendingPost'=>false]);
        return redirect()->back();

    }
    public function showFollowers($user_id,$group_id){
       $user=User::with('followers')->find($user_id);
       $followers= $user->followers;
       $group=Group::find($group_id);
       return view('pages.groups.show-followers',compact('followers','group'));
    }
    public function registerFollowers(Request $request,$group_id){
        $validatedData = $request->validate([
            'users' => 'required|array',  // تأكد من أن 'users' هي مصفوفة
            'users.*' => 'exists:users,id' // تأكد من أن كل عنصر في 'users' هو معرّف مستخدم صالح
        ]);

        $users = $validatedData['users'];

        // إيجاد المجموعة بالمعرف
        $group = Group::findOrFail($group_id);

        // ربط المستخدمين بالمجموعة باستخدام syncWithoutDetaching
        $group->users()->syncWithoutDetaching(array_fill_keys($users, ['is_admin' => false]));

        // إعادة التوجيه إلى صفحة المجموعة بعد إتمام العملية
        return redirect()->route('group.show', $group_id);

    }
    public function addGroup(){

        $coaches=User::where('role_id',3)->get();

        return view('pages.groups.add-group',compact('coaches'));

    }


}



