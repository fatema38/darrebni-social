<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Services\CommentService;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
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
        return redirect()->back()->with('success','Comment stored successfully');
       else{

           return redirect()->back()->with('error', 'Failed to store comment.');
       }

    }
    public function update(Request $request,$id){

        $comment = Comment::find($id);

        // التحقق من صحة البيانات المدخلة
        $validated= $request->validate([

            'content' => 'required|string',

        ]);
       $comment->content = $validated['content'];
       $comment->save();
       return redirect()->back();
    }
    public function remove($id){

       $this->commentService->remove($id);
        return redirect()->back();
    }





    public function upVote($id)
    {
        $this->commentService->upVote($id);

        return redirect()->back();
    }

    public function downVote($id)
    {
        $this->commentService->downVote($id);
        return redirect()->back();

    }

}
