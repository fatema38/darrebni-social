<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::get('posts',[\App\Http\Controllers\Api\PostController::class,'index'])->middleware('auth:sanctum');
Route::get('post/{id}',[\App\Http\Controllers\Api\PostController::class,'show']);
Route::post('store-post',[\App\Http\Controllers\Api\PostController::class,'store'])->middleware('auth:sanctum');
Route::get('post-up-vote/{id}',  [\App\Http\Controllers\Api\PostController::class,'upVote'])->middleware('auth:sanctum');
Route::get('post-down-vote/{id}', [\App\Http\Controllers\Api\PostController::class, 'downVote'])->middleware('auth:sanctum');
Route::get('remove-post/{id}',  [\App\Http\Controllers\Api\PostController::class,'remove'])->middleware('auth:sanctum');
Route::get('post-search',  [\App\Http\Controllers\Api\PostController::class,'SearchByTag'])->middleware('auth:sanctum');


Route::get('show/{id}',[\App\Http\Controllers\Api\UserController::class,'show'])->middleware('auth:sanctum');
Route::get('follow/{id}',[\App\Http\Controllers\Api\UserController::class,'follow'])->middleware('auth:sanctum');
Route::get('unfollow/{id}',[\App\Http\Controllers\Api\UserController::class,'unfollow'])->middleware('auth:sanctum');
Route::get('userFollowing/{id}',[\App\Http\Controllers\Api\UserController::class,'userFollowing'])->middleware('auth:sanctum');
Route::get('groups',[\App\Http\Controllers\Api\GroupController::class,'index'])->middleware('auth:sanctum');
Route::get('showGroup/{id}',[\App\Http\Controllers\Api\GroupController::class,'show'])->middleware('auth:sanctum');
Route::get('registerGroup/{id}',[\App\Http\Controllers\Api\GroupController::class,'registerUser'])->middleware('auth:sanctum');
Route::get('getMembers/{id}',[\App\Http\Controllers\Api\GroupController::class,'getMembers'])->middleware('auth:sanctum');
Route::get('searchPostsByTag/{id}',[\App\Http\Controllers\Api\GroupController::class,'searchByTag'])->middleware('auth:sanctum');
Route::post('store-group',[\App\Http\Controllers\Api\GroupController::class,'store'])->middleware('auth:sanctum');
Route::get('delete-group/{id}',[\App\Http\Controllers\Api\GroupController::class,'deleteGroup'])->middleware('auth:sanctum');

Route::controller(\App\Http\Controllers\Api\CommentController::class)->group(function () {
    Route::post('comments/store',  'store')->middleware('auth:sanctum');
    Route::get('remove-comment/{id}',  'remove')->middleware('auth:sanctum');
    Route::get('comment-up-vote/{id}', 'upVote' )->middleware('auth:sanctum');
    Route::get('comment-down-vote/{id}',  'downVote')->middleware('auth:sanctum');
});

Route::get('/tags', [\App\Http\Controllers\Api\TagController::class, 'index'])->middleware('auth:sanctum');

Route::post('/report', [\App\Http\Controllers\Api\ReportController::class, 'store'])->middleware('auth:sanctum');

