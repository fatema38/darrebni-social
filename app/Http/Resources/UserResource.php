<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'followers_count'=>$this->followers_count,
            'following_count'=>$this->following_count,
            'posts_count'=>$this->posts_count,
            'facebook'=>$this->facebook,
            'linkedin'=>$this->linkedin,
            'twitter'=>$this->twitter,
            'gmail'=>$this->gmail,
            'posts'=>AllPostsResource::collection($this->whenLoaded('posts')),
            'following'=>FollowingResource::collection($this->whenLoaded('following')),
            'postsUpVotes'=>AllPostsResource::collection($this->whenLoaded('posts_up_votes')),
            'PostsDownVotes'=>AllPostsResource::collection($this->whenLoaded('posts_down_votes')),

        ];
    }
}
