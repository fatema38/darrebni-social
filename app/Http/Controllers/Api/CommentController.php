<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\AllPostComments;
use App\Http\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    protected $commentService;
    public function __construct(CommentService  $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreCommentRequest $request)
    {

        $validated=$request->validated();
        $comment= $this->commentService->store($validated);
        if($comment)
            return $this->SendSuccessResponse(['comment'=>AllPostComments::make($comment)],'Comment stored successfully');
        else{

            return $this->SendErrorResponse( 'Failed to store comment.');
        }

    }
    public function remove($id){

      if($this->commentService->remove($id))
        return $this->SendSuccessResponse('removed','comment remove successfully');
       else
           return $this->SendErrorResponse('comment remove failed');
    }





    public function upVote($id)
    {
      if($this->commentService->upVote($id))
        return $this->SendSuccessResponse('upVote','comment upVote successfully');
      else
          return $this->SendErrorResponse('comment upvote failed');
    }

    public function downVote($id)
    {
        if($this->commentService->downVote($id))
           return $this->SendSuccessResponse('downVote','comment downVote successfully');
        else
            return $this->SendErrorResponse('comment downVote failed');

    }
}
