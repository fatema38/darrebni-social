<?php

namespace App\Http\Services;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentService{
    public function store($validated)
    {

        $validated['user_id'] = auth()->id();
      $comment=  Comment::create($validated);
      return $comment;

    }
    public function remove($id){

        $comment = Comment::with('usersRatings')->find($id);
        if($comment->usersRatings){
            $comment->usersRatings()->detach();
        }
        $comment->delete();
        return 'done';
    }

    public function upVote($id)
    {
        $comment =Comment::with('authedRating')->find($id);

        $ratings = $comment->authedRating;

        if ($ratings) {
            if ($ratings->pivot->type == 'downVote') {
                $comment->usersRatings()->updateExistingPivot(auth()->id() , ['type' => 'upVote']);

            } else {
                $comment->usersRatings()->detach(auth()->id());

            }
        } else {
            $comment->usersRatings()->attach(auth()->id(), ['type' => 'upVote']);
        }
return 'done';

    }

    public function downVote($id)
    {
        $comment = Comment::with('authedRating')->find($id);
        $ratings = $comment->authedRating;

        if ($ratings) {
            if ($ratings->pivot->type == 'upVote')
                $comment->usersRatings()->syncWithoutDetaching([auth()->id()=>['type' => 'downVote']]);


            else $comment->usersRatings()->detach(auth()->id());

        } else {
            $comment->usersRatings()->attach([auth()->id()=> ['type' => 'downVote']]);
        }

   return 'done';
    }




}
