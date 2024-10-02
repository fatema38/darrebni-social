<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllPostsResource;
use App\Http\Resources\FollowingResource;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    protected $userService;
    public function __construct(UserService  $userService)
    {
        $this->userService = $userService;
    }


    public function show($id){
   $user=$this->userService->show($id);
   $commentedposts=$this->userService->commentedPosts($id);

if(!$user)
    return $this->SendErrorResponse('user not found');
if(!$commentedposts)
    return $this->SendErrorResponse('no comments of user');
return $this->SendSuccessResponse(['user'=>UserResource::make($user),'commentedposts'=>AllPostsResource::collection($commentedposts)],'user info');

}

    public function follow($following_id){
       $following= $this->userService->follow($following_id);
        return $this->SendSuccessResponse(['following'=>FollowingResource::make($following)],'You following this user now');
    }

    public function unfollow($following_id){
      $following= $this->userService->unfollow($following_id);

        return $this->SendSuccessResponse(['following'=>FollowingResource::make($following)],'You  don,t following this user now');


    }

    public function userFollowing($id){
        $user = $this->userService->userFollowing($id);
        $following=$user->following;
        return  $this->SendSuccessResponse(['user'=>FollowingResource::make($user),'following'=>FollowingResource::collection($following)],' user and his followings ') ;
    }

}
