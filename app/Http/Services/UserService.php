<?php
namespace App\Http\Services;
use App\Models\Post;
use App\Models\User;

class UserService{



public function show($id){
    //posts of user
    $user = User::with(['posts' => function ($query) {
        $query->withCount([
            'postUpVotes',
            'postDownVotes',
        ])->with(['comments.user','authedRating','comments.authedRating','comments'=>function($q){return$q->withcount('commentUpVotes','commentDownVotes');}]);
    },

        //followings of user
        'following'=>function($query){return $query->take(5);},
         'followers',
        'groups',
        'posts.tags',

        //posts upvotes of user and no comments

        'postsUpVotes' => function($q) use ($id) {
            $q->whereDoesntHave('comments', function($query) use ($id) {
                $query->where('user_id', $id)->withcount('commentUpVotes','commentDownVotes');
            })->with(['comments.user','authedRating','comments.authedRating','comments'=>function($q){$q->withcount('commentUpVotes','commentDownVotes');}])
                ->withcount('postUpVotes','postDownVotes');},


        //posts downvote for user and no comment
        'postsDownVotes' => function($q) use ($id) {
            $q->whereDoesntHave('comments', function($query) use ($id) {
                $query->where('user_id',$id);
            })->with(['comments.user','authedRating',
                'comments.authedRating','comments'=>function($q){$q->withcount('commentUpVotes','commentDownVotes');}])
                ->withcount('postUpVotes','postDownVotes');}

    ])
        ->withCount('followers')
        ->withCount('following')
        ->withCount('posts')
        ->find($id);

return $user;
}
public function commentedPosts($id){

    //postscommented by user
    $commentedposts=Post::whereHas('comments',function($q)use($id){ $q->where('user_id',$id);})->withcount('postUpVotes','postDownVotes')->
    with(['comments'=>function($q)use($id){ $q->where('user_id',$id)->withcount('commentUpVotes','commentDownVotes');},'comments.authedRating','authedRating','tags'])->get();
    return $commentedposts;
}


    public function follow($following_id){
        $follower_user = auth()->user();
        if ($follower_user->id != $following_id) {
            try {
                $follower_user->following()->syncWithoutDetaching($following_id);
            }
            catch (\Exception $e) {
                // يمكنك تسجيل الخطأ هنا
                throw new \Exception('Failed to follow user.');
            }
            return $following=User::find($following_id);
    }



}
    public function unfollow($following_id){
        $follower_user = auth()->user();
        if($follower_user->id != $following_id) {
            try {
                $follower_user->following()->detach($following_id);
            }
            catch (\Exception $e) {
                // يمكنك تسجيل الخطأ هنا
                throw new \Exception('Failed to unfollow user.');
            }
            return $following=User::find($following_id);
        }


    }


    public function userFollowing($id){
        $user = User::with('following')->find($id);
        return $user;
    }
    public function userFollower($id){
        $user = User::with('followers')->find($id);
        return $user;
    }





}
