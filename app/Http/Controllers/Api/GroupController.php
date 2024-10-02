<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Resources\AllPostsResource;
use App\Http\Resources\FollowingResource;
use App\Http\Resources\GroupResource;
use App\Http\Services\GroupService;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    Protected $groupService;
    public function __construct(GroupService $groupService){
        $this->groupService=$groupService;
    }

    public function index(){
        $groups= $this->groupService->index();
   return $this->SendSuccessResponse(['groups'=>GroupResource::collection($groups)],'All Groups');
    }


    public function show($id){
        $group=$this->groupService->show($id);
        $posts=$group->posts;
        return $this->SendSuccessResponse(['group'=>GroupResource::make($group),'posts of group'=>AllPostsResource::collection($posts)],'Group with posts');

    }

    public function store(StoreGroupRequest $request){
        $validated=$request->validated();
        $group = $this->groupService->store($validated);
        if($group)
            return $this->SendSuccessResponse(['group'=>GroupResource::make($group)],'Group is stored ');
         else
             $this->SendErrorResponse('group is not stored');
    }

    public function registerUser($group_id){
        $this->groupService->registerUser($group_id);
        $group = Group::find($group_id);
        return $this->SendSuccessResponse(['group'=>GroupResource::make($group)],'You register to this group');
    }
    public function deleteGroup($id){

        $this->groupService->deleteGroup($id);

            return $this->SendSuccessResponse('deleted',' this group is deleted');
    }
    public function getMembers($id){
        $group = Group::with('users')->find($id);
        $members =$group->users;
        return $this->SendSuccessResponse(['group'=>GroupResource::make($group),'members of group'=>FollowingResource::collection($members)],'Group with Members');
    }


    public function searchByTag(Request $request, $groupId)
    {   $group_id=$groupId;
        $group=Group::with('users')->withCount('users','admins','posts')->find($groupId);
        $searchTerm = $request->input('tags1');

        if (empty($searchTerm)) {
            return $this->SendErrorResponse('no tag selected');
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
            ->with('authedRating')
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

        return $this->SendSuccessResponse(['group'=>GroupResource::make($group),'posts of this tag in group'=>AllPostsResource::collection($posts)],'Group with posts of SearchTag');

    }
}
