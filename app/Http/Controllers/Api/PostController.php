<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\StorePostRequsest;

use App\Http\Resources\AllPostsResource;
use App\Http\Resources\UserResource;
use App\Http\Services\PostService;

use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index()
    {
        $posts = $this->postService->getPosts();
        $data['posts']=AllPostsResource::collection($posts);
        $data['myData']=UserResource::make(auth()->user());
        return $this->SendSuccessResponse($data,'All Posts');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequsest $request)
    {
        $validated=$request->validated();
        $post=$this->postService->StorePost($validated);
        if($post)
            return $this->SendSuccessResponse(['post'=>AllPostsResource::make($post)],'post is stored');
        else{
            return $this->SendErrorResponse('fail in store');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $post= $this->postService->showPost($id);

        if(!$post)
            return $this->SendErrorResponse('post not found');


        return $this->SendSuccessResponse(['post'=>AllPostsResource::make($post)],'post details');

    }

    public function upVote($id)
    {
        $this->postService->upVotePost($id);
        return $this->SendSuccessResponse('success', 'Post upvoted successfully.');
    }
    public function downVote($id)
    {
        $this->postService->downVotePost($id);
        return $this->SendSuccessResponse('success', 'Post downvoted successfully.');
    }

    public function remove($id)
    {
        $this->postService->removePost($id);
        return $this->SendSuccessResponse('success', 'Post removed successfully.');
    }
    public function SearchByTag(Request $request)
    {
        $searchTerm = $request->input('tags1');
        $posts = $this->postService->searchByTag($searchTerm);

        return $this->SendSuccessResponse(['posts'=>AllPostsResource::collection($posts)],'posts of this tags');
    }


}
