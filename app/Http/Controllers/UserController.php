<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService  $userService)
    {
        $this->userService = $userService;
    }

    public function show($id){
      $user= $this->userService->show($id);
      $commentedposts=$this->userService->commentedPosts($id);
        return view('profile.profile',compact('user','commentedposts'));
    }
    public function follow($following_id){

      $following= $this->userService->follow($following_id);

        if($following) {
            return redirect()->back()->with('success', 'follow  successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to  follow.');
        }
    }


    public function unfollow($following_id){
       $following= $this->userService->unfollow($following_id);

        if($following) {
            return redirect()->back()->with('success', 'unfollow  successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to  unfollow.');
        }
    }




    public function userFollowing($id){
        $user = $this->userService->userFollowing($id);
        return view('profile.user-followings',compact('user'));
    }
    public function userFollower($id){
        $user = $this->userService->userFollower($id);
        return view('profile.user-followers',compact('user'));
    }
    public function allUsers(){
        $users=User::where('role_id','!=',1)->paginate(5);
        $admins=User::where('role_id',2)->get();
        $coaches=User::where('role_id',3)->get();
        $coaches_admins=User::wherehas('groups',function($q){return $q->where('is_admin',true);})->get();
        $trainees=User::where('role_id',4)->get();
        $actives=User::has('posts')->where('role_id',4)->get();
      $allusers=User::where('role_id','!=',1)->get();
        $posts=Post::get();
        $comments=Comment::get();
        $groups=Group::get();
        return view('pages.users.allusers',compact('users','allusers','admins','coaches','trainees','posts','groups','actives','coaches_admins','comments'));
    }
    public function deleteUser($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function revokeUserAdmin($id){
        $user=User::find($id);
        $user->update(['role_id'=>4]);

        return redirect()->back();
    }

    public function makeUserAdmin($id){
        $user=User::find($id);
        $user->update(['role_id'=>2]);

        return redirect()->back();
    }
    public function coachesAndTrainees(){
        $users = User::whereIn('role_id', [3, 4])->get();
        return view('pages.users.coaches-and-trainees',compact('users'));

    }


    public function revokeUserCoach($id){
        $user=User::find($id);
        $user->update(['role_id'=>4]);

        return redirect()->back();
    }

    public function makeUserCoach($id){
        $user=User::find($id);
        $user->update(['role_id'=>3]);

        return redirect()->back();
    }
    public function update(Request $request)
{
    // التحقق من صحة البيانات
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        'password' => ['nullable', 'confirmed'],
        'phone_number' => ['required', 'string', 'max:10', 'min:9'],
        'facebook' => ['nullable', 'url'],
        'linkedin' => ['nullable', 'url'],
        'twitter' => ['nullable', 'url'],
        'gmail' => ['nullable', 'email'],
        'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    ]);

    $user = auth()->user();

    // تحقق مما إذا كان هناك صورة جديدة قد تم تحميلها
    if ($request->hasFile('profile_picture')) {
        // تحقق مما إذا كان للمستخدم صورة موجودة مسبقًا في public/images/profile_pictures
        if ($user->profile_picture && strpos($user->profile_picture, 'images/profile_pictures/') === 0) {
            // احذف الصورة القديمة
            $oldImagePath = public_path($user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // الحصول على الملف المرفوع
        $file = $request->file('profile_picture');

        // إنشاء اسم فريد للصورة مع الاحتفاظ بالامتداد
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // حفظ الصورة في المسار المطلوب داخل مجلد public/images/profile_pictures
        $file->move(public_path('images/profile_pictures'), $filename);

        // تحديث مسار الصورة في قاعدة البيانات
        $user->profile_picture = 'images/profile_pictures/' . $filename;
    }

    // تحديث باقي بيانات المستخدم
    $user->name = $request->name;
    $user->email = $request->email;

    // تحقق إذا تم تقديم كلمة مرور جديدة
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->phone_number = $request->phone_number;
    $user->facebook = $request->facebook;
    $user->linkedin = $request->linkedin;
    $user->twitter = $request->twitter;
    $user->gmail = $request->gmail;

    // حفظ التحديثات في قاعدة البيانات
    $user->save();

    return redirect()->route('profile', $user->id);
}


    public function deletePicture()
    {
        $user = auth()->user();

        // تحقق مما إذا كانت الصورة الحالية ليست الصورة الافتراضية
        if ($user->profile_picture && strpos($user->profile_picture, 'images/default/profile_picture.jpg') === false) {
            // احذف الصورة الحالية من المجلد
            $oldImagePath = public_path($user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // استبدل الصورة الحالية بالصورة الافتراضية
            $user->profile_picture = 'images/default/profile_picture.jpg';
            $user->save();
        }

        // إعادة التوجيه إلى الصفحة السابقة أو صفحة الملف الشخصي
        return redirect()->route('profile', $user->id)->with('success', 'Profile picture reset to default successfully.');
    }



}
