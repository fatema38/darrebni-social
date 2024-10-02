<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomNotificationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//
//    Route::get('/profile/{id}',[ProfileController::class,'show'])->name('profile')->middleware('auth');
//    Route::get('/follow/{id}',[ProfileController::class,'follow'])->name('follow');
//    Route::get('/unfollow/{id}',[ProfileController::class,'unfollow'])->name('unfollow');
//    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//   // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//   // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
Route::get('posts',  [PostController::class,'index'])->name('posts');
Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile/{id}', 'show')->name('profile');
        Route::get('/follow/{id}', 'follow')->name('follow');
        Route::get('/unfollow/{id}', 'unfollow')->name('unfollow');
        Route::get('user-following/{id}', 'userFollowing')->name('user.following');
        Route::get('user-follower/{id}', 'userFollower')->name('user.followers');
        Route::get('all-users', 'allUsers')->name('users.all');
        Route::get('delete-user/{id}', 'deleteUser')->name('user.delete');
        Route::get('revoke-admin/{id}', 'revokeUserAdmin')->name('user.revokeAdmin');
        Route::get('make-admin/{id}', 'makeUserAdmin')->name('user.makeAdmin');
        Route::get('coaches-and-trainees', 'coachesAndTrainees')->name('coaches-and-trainees');

        Route::get('revoke-coach/{id}', 'revokeUserCoach')->name('user.revokeCoach');
        Route::get('make-coach/{id}', 'makeUserCoach')->name('user.makeCoach');
        Route::view('create-user','pages.users.create-user')->name('create-user');
      Route::view('update-profile-picture','pages.users.update-profile-picture')->name('update-profile-picture');
      Route::put('/profile',  'update')->name('profile.update');

        Route::get('/delete-picture',  'deletePicture')->name('delete-picture');



    });
    Route::controller(PostController::class)->group(function () {


        Route::get('create-post',  'create');
        Route::get('show-post/{id}',  'show')->name('posts.show');
        Route::post('store-post',  'store')->name('posts.store');
        Route::get('remove-post/{id}',  'remove')->name('post.remove');
        Route::put('/posts/{id}',  'update')->name('post.update');
        Route::get('post-up-vote/{id}',  'upVote')->name('posts.upVote');
        Route::get('post-down-vote/{id}',  'downVote')->name('posts.downVote');
        Route::get('post-search',  'SearchByTag')->name('posts.search');
    });
    Route::controller(CommentController::class)->group(function () {
    Route::post('comments/store',  'store')->name('comments.store');
    Route::get('remove-comment/{id}',  'remove')->name('comment.remove');
    Route::get('comment-up-vote/{id}', 'upVote' )->name('comments.upVote');
    Route::get('comment-down-vote/{id}',  'downVote')->name('comments.downVote');
        Route::put('/comment/{id}',  'update')->name('comment.update');
    });
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/store-tag/{name}', [TagController::class, 'store'])->name('tag.store');
    Route::get('repeat-tags',[TagController::class,'repeat'])->name('posts.repeat')->middleware('role:admin');


    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('reports',[ReportController::class,'index'])->name('reports')->middleware('role:admin,superAdmin');
    Route::get('reject/{id}',[ReportController::class,'reject'])->name('reject');
    Route::get('approve/{id}',[ReportController::class,'approve'])->name('approve');
    Route::get('report-show/{id}',[ReportController::class,'reportShow'])->name('report.show');

    Route::post('/group-store', [GroupController::class, 'store'])->name('group.store');
    Route::get('/user-register{id}', [GroupController::class, 'registerUser'])->name('user.register');
    // Route::get('show.coaches','pages.groups.add-group')->middleware('role:coach,admin,superAdmin');
     Route::get('groups', [GroupController::class, 'index'])->name('groups');
     Route::get('show-group{id}', [GroupController::class, 'show'])->name('group.show');
     Route::get('delete-group{id}', [GroupController::class, 'deleteGroup'])->name('group.delete');
     Route::get('members{id}', [GroupController::class, 'getMembers'])->name('group.members');
     Route::delete('/groups/{group}/users/{user}', [GroupController::class, 'deleteMember'])->name('member.delete');
    Route::post('/groups/{group}/users/{user}/make-admin', [GroupController::class, 'makeUserAdmin'])
        ->name('groups.makeUserAdmin');

    Route::get('edit-group/{id}', [GroupController::class,'edit'])->name('edit-group');
    Route::put('/group-update',  [GroupController::class,'update'])->name('group.update');

    Route::post('/groups/{group}/users/{user}/revoke-admin', [GroupController::class, 'revokeUserAdmin'])
        ->name('groups.revokeUserAdmin');

    Route::get('post-search-group/{group_id}',  [GroupController::class, 'searchByTag'])->name('posts.search.group');
    Route::get('reports-group/{group_id}',  [GroupController::class, 'reportsGroup'])->name('reports.group');
    Route::get('pending-posts-group/{group_id}',  [GroupController::class, 'pendingPostsGroup'])->name('pending.posts.group');
    Route::get('reject-post/{id}',[GroupController::class,'rejectPost'])->name('reject.post');
    Route::get('approve-post/{id}',[GroupController::class,'approvePost'])->name('approve.post');
    Route::get('show-followers/{user_id}/{group_id}',[GroupController::class,'showFollowers'])->name('show.followers');
    Route::post('register-followers/{group_id}',[GroupController::class,'registerFollowers'])->name('register.followers');
    Route::get('add-group',[GroupController::class,'addGroup'])->name('add.group')->middleware('role:coach,admin,superAdmin');;
    Route::post('register-coaches/{group_id}',[GroupController::class,'registerCoaches'])->name('register.coaches');

});



require __DIR__.'/auth.php';










