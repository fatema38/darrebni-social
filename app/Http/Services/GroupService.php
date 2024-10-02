<?php
namespace App\Http\Services;
use App\Http\Resources\AllPostsResource;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupService{


    public function index(){
        $groups= Group::all();
        return $groups;
    }
    public function show($id){
        $group=Group::with(['posts'=>function($q){
            $q->withCount([
                'usersRatings as upVotes' => function ($q) {
                    return  $q->where('type', 'upVote');
                }

            ])
                ->withCount([
                    'usersRatings as downVotes' => function ($q) {
                        return $q->where('type', 'downVote');
                    }])->where('pendingPost',false);}



            ,'posts.authedRating','users', 'posts.user', 'posts.tags', 'posts.comments.authedRating', 'posts.comments' => function ($q) {
                return $q->withcount('commentUpVotes', 'commentDownVotes');
            }])->withCount(['users','posts','admins'])


            ->find($id);
        return $group;


    }
    public function store($validated)
    {
        // معالجة رفع الصورة إذا كانت موجودة وصحيحة

        if (isset($validated['image']) && $validated['image'] instanceof \Illuminate\Http\UploadedFile && $validated['image']->isValid()) {
            // الحصول على الملف
            $file = $validated['image'];

            // إنشاء اسم فريد للصورة
            $filename = time() . '_' . $file->getClientOriginalName();

            // تحديد المسار لحفظ الصورة
            $filePath = 'images/groups_images/' . $filename;

            // تخزين الصورة في المجلد المحدد في public
            $file->move(public_path('images/groups_images'), $filename);

            // إضافة مسار الصورة إلى البيانات المعتمدة
            $validated['image_path'] = $filePath;
        }
        else {
            // تعيين صورة افتراضية إذا لم يتم رفع صورة
            $validated['image_path'] = 'images/groups_images_default/default.png'; // تأكد من وجود الصورة الافتراضية في هذا المسار
        }

        // إنشاء الكروب
        $group = Group::create([
            'name' => $validated['group_name'],
            'description' => $validated['description'],
            'owner_id' => $validated['owner_id'] ?? auth()->id(),
            'image_path' => $validated['image_path'] // تعيين مسار الصورة (المرفوعة أو الافتراضية)
        ]);

        // إرفاق المستخدم صاحب الكروب مع تعيينه كأدمن
        $group->users()->attach([$group->owner_id => ['is_admin' => true]]);

        return $group;
    }



    public function registerUser($group_id){
        $user=auth()->user();
        $user->groups()->SyncWithoutDetaching([$group_id=>['is_admin'=>false]
        ]);
        return 'done';
    }
    public function deleteGroup($id){
        $group=Group::with('posts')->find($id);
        if($group->posts) {
            foreach ($group->posts as $post) {
                $post->comments()->delete();
                $post->usersRatings()->delete();
                $post->delete();
            }
        }

        // حذف المجموعة نفسها
        $group->delete();
        return 'done';
    }
}
