@extends('layouts.master')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .vote-buttons-container {
            position: absolute; /* لتحديد موقعها بشكل مطلق */
            bottom: 32px; /* مسافة من الأسفل */
            left: 10px; /* مسافة من اليسار */

        }

        .post-vote-buttons-container {
            position: absolute; /* لتحديد موقعها بشكل مطلق */
            bottom: 5px; /* مسافة من الأسفل */
            right: 10px; /* مسافة من اليسار */

        }

    </style>
</head>
@section('content')

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
        <div class="app-header white box-shadow">
            <div class="navbar navbar-toggleable-sm flex-row align-items-center">
                <!-- Open side - Naviation on mobile -->
                <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
                    <i class="material-icons">&#xe5d2;</i>
                </a>
                <!-- / -->

                <!-- Page title - Bind to $state's title -->
                <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>

                <!-- navbar collapse -->
                <div class="collapse navbar-collapse" id="collapse">
                    <!-- link and dropdown -->
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href data-toggle="dropdown">
                                <i class="fa fa-fw fa-plus text-muted"></i>
                                <span>New</span>
                            </a>
                            <div ui-include="'../views/blocks/dropdown.new.html'"></div>
                        </li>
                    </ul>

                    <div ui-include="'../views/blocks/navbar.form.html'"></div>
                    <!-- / -->
                </div>
                <!-- / navbar collapse -->

                <!-- navbar right -->
                <ul class="nav navbar-nav ml-auto flex-row">
                    <li class="nav-item dropdown pos-stc-xs">
                        <a class="nav-link mr-2" href data-toggle="dropdown">
                            <i class="material-icons">&#xe7f5;</i>
                            <span class="label label-sm up warn">3</span>
                        </a>
                        <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
                    </li>
                    <li class="nav-item dropdown">

                        <div ui-include="'../views/blocks/dropdown.user.html'"></div>
                    </li>
                    <li class="nav-item hidden-md-up">
                        <a class="nav-link pl-2" data-toggle="collapse" data-target="#collapse">
                            <i class="material-icons">&#xe5d4;</i>
                        </a>
                    </li>
                </ul>
                <!-- / navbar right -->
            </div>
        </div>
        <div class="app-footer">
            <div class="p-2 text-xs">
                <div class="pull-right text-muted py-1">
                    &copy; Copyright <strong>Flatkit</strong> <span class="hidden-xs-down">- Built with Love v1.1.3</span>
                    <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
                </div>
                <div class="nav">
                    <a class="nav-link" href="../">About</a>
                    <a class="nav-link" href="http://themeforest.net/user/flatfull/portfolio?ref=flatfull">Get it</a>
                </div>
            </div>
        </div>
        <div ui-view class="app-body" id="view">

            <!-- ############ PAGE START-->

            <div class="item">
                <div class="item-bg">
                    <img src="../{{$user->profile_picture}}" class="blur opacity-3">
                </div>

                <div class="p-a-md">

                    <div class="row m-t">

                        <div class="col-sm-7">

                            @if(auth()->user()->id == $user->id && auth()->user()->profile_picture != 'images/default/profile_picture.jpg')
                                <div class="col-sm-5">
                                    <a  class="btn btn-icon"href="{{route('delete-picture')}}"><button class="btn btn-sm " >x</button></a>
                                </div>
                            @endif
                            <a href="" class="pull-left m-r-md">

            <span class="avatar w-96">
                 <img src="../{{$user->profile_picture}}">

              <i class="on b-white"></i>
            </span></a>


                            <div class="clear m-b">
                                <h3 class="m-0 m-b-xs">{{$user->name}}</h3>
                                <p class="text-muted"><span class="m-r">{{$user->email}} </span> <small><i class="fa fa-map-marker m-r-xs"></i>London, UK</small></p>
                                <div class="block clearfix m-b">
                                    <a href="{{$user->facebook}}" class="btn btn-icon btn-social rounded white btn-sm">
                                        <i class="fa fa-facebook"></i>
                                        <i class="fa fa-facebook indigo"></i>
                                    </a>
                                    <a href="{{$user->twitter}}" class="btn btn-icon btn-social rounded white btn-sm">
                                        <i class="fa fa-twitter"></i>
                                        <i class="fa fa-twitter light-blue"></i>
                                    </a>
                                    <a href="{{$user->gmail}}" class="btn btn-icon btn-social rounded white btn-sm">
                                        <i class="fa fa-google-plus"></i>
                                        <i class="fa fa-google-plus red"></i>
                                    </a>
                                    <a href="{{$user->linkedin}}" class="btn btn-icon btn-social rounded white btn-sm">
                                        <i class="fa fa-linkedin"></i>
                                        <i class="fa fa-linkedin cyan-600"></i>
                                    </a>
                                </div>
                                  @if($user->id !=auth()->id())
                                @if(auth()->user()->following()->where('following_id', $user->id)->exists())
                                <a href="{{route('unfollow',$user->id)}}" class="btn btn-sm danger btn-rounded m-b">UnFollow</a>
                                @else
                                <a href="{{route('follow',$user->id)}}" class="btn btn-sm warn btn-rounded m-b">Follow</a>
                                @endif
                                @endif
                                @if($user->id == auth()->id())
                                    <a href="/chatify" class="btn btn-sm  btn-rounded m-b" style="background-color: silver;color:white">Chating</a>
                                @endif

                            </div>

                        </div>
                         @if(auth()->user()->id == $user->id)
                        <div class="col-sm-5">
                            <a href="{{route('update-profile-picture')}}"><button class="btn btn-sm white" >Edit</button></a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="dker p-x">
                <div class="row">
                    <div class="col-sm-6 push-sm-6">
                        <div class="p-y text-center text-sm-right">
                            <a href  class="inline p-x text-center">
                                <span class="h4 block m-0">{{$user->followers_count}}</span>
                                <small class="text-xs text-muted">Followers</small>
                            </a>
                            <a href class="inline p-x b-l b-r text-center">
                                <span class="h4 block m-0">{{$user->following_count}}</span>
                                <small class="text-xs text-muted">Following</small>
                            </a>
                            <a href class="inline p-x text-center">
                                <span class="h4 block m-0">{{$user->posts_count}}</span>
                                <small class="text-xs text-muted">Activities</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 pull-sm-6">
                        <div class="p-y-md clearfix nav-active-primary">
                            <ul class="nav nav-pills nav-sm">
                                <li class="nav-item active">
                                    <a class="nav-link" href data-toggle="tab" data-target="#tab_1">Activities</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href data-toggle="tab" data-target="#tab_2">Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href data-toggle="tab" data-target="#tab_3">UpVotes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href data-toggle="tab" data-target="#tab_4">DownVotes</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href data-toggle="tab" data-target="#tab_4">Profile</a>--}}
{{--                                </li>--}}

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="padding">
                <div class="row">
                    <div class="col-sm-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane p-v-sm active" id="tab_1" style="width: 600px; margin-left: 50px">
                                <div class="streamline b-l m-b m-l">
                                    @foreach($user->posts as $post)
                                        <div class="box-body " style="border: 1px solid #ddd ; /* إضافة حدود خفيفة حول كل منشور */
    border-radius: 5px; /* زوايا دائرية للصندوق */
    padding: 15px; /* حشوة داخلية للصندوق */
    margin-bottom: 20px; /* مسافة أسفل كل صندوق للفصل بين المنشورات */
    background-color: #ffffff; /* تعيين لون الخلفية للصندوق */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف للصندوق */
     /* لجعل الصندوق المرجع بالنسبة لعناصره المطلقة */
    min-height: 250 px; /* تحديد ارتفاع أدنى للصندوق */


">
                                        <div class="sl-item">
                                            @if(auth()->id() == $post->user->id)
                                                <div class="dropdown pull-right m-3">
                                                    <button class="btn btn-secondary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteModal">
                                                            <i class=" fa fa-remove"></i> post delete
                                                        </a>
                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editPostModal" data-postid="{{ $post->id }}" data-title="{{ $post->title }}" data-postcontent="{{ $post->content }}">
                                                            <i class="fa fa-edit"></i> post update
                                                        </a>
                                                    </div>
                                                </div>

                                            @endif
                                            @if($post->user->profile_picture != null)
                                                <div class="sl-left" style="padding-left: 20px">
                                                    <img src="../{{$post->user->profile_picture}}" class="img-circle">
                                                </div>
                                            @endif
                                                <div class="post-vote-buttons-container">
                                                    <a href="{{route('posts.upVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_up_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                    <a href="{{route('posts.downVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_down_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                </div>
                                            <div class="sl-content">
                                                <div class="sl-author font-weight-bold size-6">
                                                    <a style="color: #6f2877" href>{{$user->name}}</a>
                                                </div>
                                                <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                                                <div class="sl-author text-center font-weight-bold h3">

                                                    <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                                                    <div>
                                                        @foreach($post->allTags() as $tag)
                                                            <span class=" text-sm text-muted">{{ $tag }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div>
                                                    <p>{{$post->content}}</p>
                                                </div>
                                                @if($post->image)
                                                    <div class="d-flex justify-content-center align-items-center" style="max-width: 450px ;max-height: 400px ;margin-top: 50px; margin-bottom:40px ;margin-left: 30px" >
                                                        <div class="text-center">
                                                            <img  src="{{asset($post->image)}}" width=100% height="auto" >
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="sl-footer mb-5">
                                                    <a href data-toggle="collapse" data-target="#reply-{{$post->id}}">
                                                        <i class="fa fa-fw fa-mail-reply text-muted" ></i> Reply
                                                    </a>
                                                </div>
                                                <div class="box collapse m-0 b-a" id="reply-{{$post->id}}">
                                                    <form action="{{route('comments.store')}}" method="POST">
                                                        @csrf
                                                        <div class="padding">
                                                            <input name="post_id" value="{{$post->id}}" hidden>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Add Comment</label>
                                                                <input type="text" name="content" class="form-control" placeholder="Enter Content">
                                                            </div>
                                                        </div>
                                                        <div class="box-footer clearfix">
                                                            <button type="submit" class="btn btn-info pull-right btn-sm">Comment</button>
                                                            {{--                <ul class="nav nav-pills nav-sm">--}}
                                                            {{--                    <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                                            {{--                </ul>--}}
                                                        </div>
                                                    </form>

                                                </div>
                                                @if($post->comments != null)
                                                    @foreach($post->comments as $comment)
                                                        <div class="box-body " >
                                                        <div class="sl-item"style="min-height: 150px">
                                                            @if(auth()->user()->id == $comment->user->id)
                                                                <div class="dropdown pull-right m-3">
                                                                    <button class="btn btn-secondary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteComment">
                                                                            <i class=" fa fa-remove"></i> comment delete
                                                                        </a>
                                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editCommentModal" data-commentid="{{ $comment->id }}" data-content="{{ $comment->content }}" >
                                                                            <i class="fa fa-edit"></i> comment update
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($comment->user->profile_picture != null)
                                                                <div class="sl-left">
                                                                    <img src="../{{$comment->user->profile_picture}}" class="img-circle">
                                                                </div>
                                                            @endif
                                                            <div class="sl-content">
                                                                <div class="sl-date text-muted">{{$comment->created_at->diffForHumans()}}</div>
                                                                <div class="sl-author font-weight-bold size-6">
                                                                    <p>{{$comment->user->name}}</p>
                                                                </div>
                                                                <p>{{$comment->content}}.</p>
                                                            </div>
                                                                <div class="vote-buttons-container">
                                                                    <a href="{{route('comments.upVote', $comment->id)}}" class="btn btn-icon  white  ml-3">
                                                                        <span class="label label-sm up  pull-right ml-5">{{$comment->comment_up_votes_count}}</span>
                                                                        <i class="@if($comment->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                                    </a>
                                                                    <a href="{{route('comments.downVote', $comment->id)}}" class="btn btn-icon  white ">
                                                                        <span class="label label-sm up  pull-right ml-5">{{$comment->comment_down_votes_count}}</span>
                                                                        <i class="@if($comment->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                                    </a>
                                                                </div>
                                                        </div>


                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                        </div>
                                    @endforeach
{{--                                    --}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a0.jpg" class="img-circle">--}}
{{--                                        </div>--}}

{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a1.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">9:30</div>--}}
{{--                                            <div class="sl-author">--}}
{{--                                                <a href>Mike</a>--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                                <p>Meeting with tech leader</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="sl-footer">--}}
{{--                                                <a href ui-toggle-class class="btn white btn-xs">--}}
{{--                                                    <i class="fa fa-fw fa-star-o text-muted inline"></i>--}}
{{--                                                    <i class="fa fa-fw fa-star text-danger none"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href class="btn white btn-xs" data-toggle="collapse" data-target="#reply-2">--}}
{{--                                                    <i class="fa fa-fw fa-mail-reply text-muted"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="box collapse in m-0" id="reply-2">--}}
{{--                                                <form>--}}
{{--                                                    <textarea class="form-control no-border" rows="3" placeholder="Type something..."></textarea>--}}
{{--                                                </form>--}}
{{--                                                <div class="box-footer clearfix">--}}
{{--                                                    <button class="btn btn-info pull-right btn-sm">Post</button>--}}
{{--                                                    <ul class="nav nav-pills nav-sm">--}}
{{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
{{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-video-camera text-muted"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">8:30</div>--}}
{{--                                            <div class="sl-author">--}}
{{--                                                <a href>Moke</a>--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                                <p>Call to customer <a href class="text-info">Jacob</a> and discuss the detail.</p>--}}
{{--                                                <p>--}}
{{--                      <span class="inline w-lg w-auto-xs p-a-xs b dark-white">--}}
{{--                        <img src="../assets/images/c0.jpg" class="w-full">--}}
{{--                      </span>--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">Wed, 25 Mar</div>--}}
{{--                                            <p>Finished task <a href class="text-info">Testing</a>.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a4.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">Thu, 10 Mar</div>--}}
{{--                                            <p>Trip to the moon</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
{{--                                            <p>Prepare for presentation</p>--}}
{{--                                            <blockquote>--}}
{{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante soe aiea ose dos soois.</p>--}}
{{--                                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>--}}
{{--                                            </blockquote>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
{{--                                            <p><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left">--}}
{{--                                            <img src="../assets/images/a5.jpg" class="img-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="sl-content">--}}
{{--                                            <div class="sl-date text-muted">Thu, 17 Jan</div>--}}
{{--                                            <p>Follow up to close deal</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="tab-pane p-v-sm" id="tab_2" style="width: 600px; margin-left: 50px">
                                <div class="streamline b-l m-b m-l">
                                    @foreach($commentedposts as $post)
                                        <div class="box-body " style="border: 1px solid #ddd; /* إضافة حدود خفيفة حول كل منشور */
    border-radius: 5px; /* زوايا دائرية للصندوق */
    padding: 15px; /* حشوة داخلية للصندوق */
    margin-bottom: 20px; /* مسافة أسفل كل صندوق للفصل بين المنشورات */
    background-color: #ffffff; /* تعيين لون الخلفية للصندوق */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف للصندوق */
     /* لجعل الصندوق المرجع بالنسبة لعناصره المطلقة */
    min-height: 250 px; /* تحديد ارتفاع أدنى للصندوق */


">
                                            <div class="sl-item">
                                                @if(auth()->id() == $post->user->id)
                                                    <div class="dropdown pull-right m-3">
                                                        <button class="btn btn-secondary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteModal">
                                                                <i class=" fa fa-remove"></i> post delete
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editPostModal" data-postid="{{ $post->id }}" data-title="{{ $post->title }}" data-postcontent="{{ $post->content }}">
                                                                <i class="fa fa-edit"></i> post update
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($post->user->profile_picture != null)
                                                    <div class="sl-left" style="padding-left: 20px">
                                                        <img src="../{{$post->user->profile_picture}}" class="img-circle">
                                                    </div>
                                                @endif
                                                <div class="post-vote-buttons-container">
                                                    <a href="{{route('posts.upVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_up_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                    <a href="{{route('posts.downVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_down_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                </div>
                                                <div class="sl-content">
                                                    <div class="sl-author font-weight-bold size-6">
                                                        <a style="color: #6f2877" href>{{$post->user->name}}</a>
                                                    </div>
                                                    <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                                                    <div class="sl-author text-center font-weight-bold h3">
                                                        <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>

                                                        <div>
                                                            @foreach($post->allTags() as $tag)
                                                                <span class=" text-sm text-muted">{{ $tag }}</span>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                    <div>
                                                        <p>{{$post->content}}</p>
                                                    </div>
                                                    @if($post->image)
                                                        <div class="d-flex justify-content-center align-items-center" style="max-width: 450px ;max-height: 400px ;margin-top: 50px; margin-bottom:40px ;margin-left: 30px" >
                                                            <div class="text-center">
                                                                <img  src="{{asset($post->image)}}" width=100% height="auto" >
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="sl-footer mb-5">
                                                        <a href data-toggle="collapse" data-target="#reply-{{$post->id}}">
                                                            <i class="fa fa-fw fa-mail-reply text-muted" ></i> Reply
                                                        </a>
                                                    </div>
                                                    <div class="box collapse m-0 b-a" id="reply-{{$post->id}}">
                                                        <form action="{{route('comments.store')}}" method="POST">
                                                            @csrf
                                                            <div class="padding">
                                                                <input name="post_id" value="{{$post->id}}" hidden>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Add Comment</label>
                                                                    <input type="text" name="content" class="form-control" placeholder="Enter Content">
                                                                </div>
                                                            </div>
                                                            <div class="box-footer clearfix">
                                                                <button type="submit" class="btn btn-info pull-right btn-sm">Comment</button>
                                                                {{--                <ul class="nav nav-pills nav-sm">--}}
                                                                {{--                    <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                                                {{--                </ul>--}}
                                                            </div>
                                                        </form>

                                                    </div>
                                                    @if($post->comments != null)
                                                        @foreach($post->comments as $comment)
                                                            <div class="box-body " >
                                                                <div class="sl-item"style="min-height: 150px">
                                                                    @if(auth()->user()->id == $comment->user->id)
                                                                        <div class="dropdown pull-right m-3">
                                                                            <button class="btn btn-secondary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteComment">
                                                                                    <i class=" fa fa-remove"></i> comment delete
                                                                                </a>
                                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editCommentModal" data-commentid="{{ $comment->id }}" data-content="{{ $comment->content }}" >
                                                                                    <i class="fa fa-edit"></i> comment update
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if($comment->user->profile_picture != null)
                                                                        <div class="sl-left">
                                                                            <img src="../{{$comment->user->profile_picture}}" class="img-circle">
                                                                        </div>
                                                                    @endif
                                                                    <div class="sl-content">
                                                                        <div class="sl-date text-muted">{{$comment->created_at->diffForHumans()}}</div>
                                                                        <div class="sl-author font-weight-bold size-6">
                                                                            <p>{{$comment->user->name}}</p>
                                                                        </div>
                                                                        <p>{{$comment->content}}.</p>
                                                                    </div>
                                                                    <div class="vote-buttons-container">
                                                                        <a href="{{route('comments.upVote', $comment->id)}}" class="btn btn-icon  white  ml-3">
                                                                            <span class="label label-sm up  pull-right ml-5">{{$comment->comment_up_votes_count}}</span>
                                                                            <i class="@if($comment->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                                        </a>
                                                                        <a href="{{route('comments.downVote', $comment->id)}}" class="btn btn-icon  white ">
                                                                            <span class="label label-sm up  pull-right ml-5">{{$comment->comment_down_votes_count}}</span>
                                                                            <i class="@if($comment->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--                                    --}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a0.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}

                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a1.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">9:30</div>--}}
                                    {{--                                            <div class="sl-author">--}}
                                    {{--                                                <a href>Mike</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <p>Meeting with tech leader</p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="sl-footer">--}}
                                    {{--                                                <a href ui-toggle-class class="btn white btn-xs">--}}
                                    {{--                                                    <i class="fa fa-fw fa-star-o text-muted inline"></i>--}}
                                    {{--                                                    <i class="fa fa-fw fa-star text-danger none"></i>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <a href class="btn white btn-xs" data-toggle="collapse" data-target="#reply-2">--}}
                                    {{--                                                    <i class="fa fa-fw fa-mail-reply text-muted"></i>--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="box collapse in m-0" id="reply-2">--}}
                                    {{--                                                <form>--}}
                                    {{--                                                    <textarea class="form-control no-border" rows="3" placeholder="Type something..."></textarea>--}}
                                    {{--                                                </form>--}}
                                    {{--                                                <div class="box-footer clearfix">--}}
                                    {{--                                                    <button class="btn btn-info pull-right btn-sm">Post</button>--}}
                                    {{--                                                    <ul class="nav nav-pills nav-sm">--}}
                                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-video-camera text-muted"></i></a></li>--}}
                                    {{--                                                    </ul>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">8:30</div>--}}
                                    {{--                                            <div class="sl-author">--}}
                                    {{--                                                <a href>Moke</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <p>Call to customer <a href class="text-info">Jacob</a> and discuss the detail.</p>--}}
                                    {{--                                                <p>--}}
                                    {{--                      <span class="inline w-lg w-auto-xs p-a-xs b dark-white">--}}
                                    {{--                        <img src="../assets/images/c0.jpg" class="w-full">--}}
                                    {{--                      </span>--}}
                                    {{--                                                </p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Wed, 25 Mar</div>--}}
                                    {{--                                            <p>Finished task <a href class="text-info">Testing</a>.</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a4.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Thu, 10 Mar</div>--}}
                                    {{--                                            <p>Trip to the moon</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
                                    {{--                                            <p>Prepare for presentation</p>--}}
                                    {{--                                            <blockquote>--}}
                                    {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante soe aiea ose dos soois.</p>--}}
                                    {{--                                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>--}}
                                    {{--                                            </blockquote>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
                                    {{--                                            <p><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a5.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Thu, 17 Jan</div>--}}
                                    {{--                                            <p>Follow up to close deal</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="tab-pane p-v-sm" id="tab_3" style="width: 600px; margin-left: 50px">
                                <div class="streamline b-l m-b m-l">
                                    @foreach($user->postsUpVotes as $post)
                                        <div class="box-body " style="border: 1px solid #ddd; /* إضافة حدود خفيفة حول كل منشور */
    border-radius: 5px; /* زوايا دائرية للصندوق */
    padding: 15px; /* حشوة داخلية للصندوق */
    margin-bottom: 20px; /* مسافة أسفل كل صندوق للفصل بين المنشورات */
    background-color: #ffffff; /* تعيين لون الخلفية للصندوق */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف للصندوق */
     /* لجعل الصندوق المرجع بالنسبة لعناصره المطلقة */
    min-height: 250 px; /* تحديد ارتفاع أدنى للصندوق */


">
                                            <div class="sl-item">
                                                @if(auth()->id() == $post->user->id)
                                                    <div class="dropdown pull-right m-3">
                                                        <button class="btn btn-secondary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteModal">
                                                                <i class=" fa fa-remove"></i> post delete
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editPostModal" data-postid="{{ $post->id }}" data-title="{{ $post->title }}" data-postcontent="{{ $post->content }}">
                                                                <i class="fa fa-edit"></i> post update
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($post->user->profile_picture != null)
                                                    <div class="sl-left" style="padding-left: 20px">
                                                        <img src="../{{$post->user->profile_picture}}" class="img-circle">
                                                    </div>
                                                @endif
                                                <div class="post-vote-buttons-container">
                                                    <a href="{{route('posts.upVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_up_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                    <a href="{{route('posts.downVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_down_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                    </a>

                                                </div>
                                                <div class="sl-content">
                                                    <div class="sl-author font-weight-bold size-6">
                                                        <a style="color: #6f2877" href>{{$post->user->name}}</a>
                                                    </div>
                                                    <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                                                    <div class="sl-author text-center font-weight-bold h3">
                                                        <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                                                        <div>
                                                            @foreach($post->allTags() as $tag)
                                                                <span class=" text-sm text-muted">{{ $tag }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p>{{$post->content}}</p>
                                                    </div>
                                                    @if($post->image)
                                                        <div class="d-flex justify-content-center align-items-center" style="max-width: 450px ;max-height: 400px ;margin-top: 50px; margin-bottom:40px;margin-left: 30px " >
                                                            <div class="text-center">
                                                                <img  src="{{asset($post->image)}}" width=100% height="auto" >
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="sl-footer mb-5">
                                                        <a href data-toggle="collapse" data-target="#reply-{{$post->id}}">
                                                            <i class="fa fa-fw fa-mail-reply text-muted" ></i> Reply
                                                        </a>
                                                    </div>
                                                    <div class="box collapse m-0 b-a" id="reply-{{$post->id}}">
                                                        <form action="{{route('comments.store')}}" method="POST">
                                                            @csrf
                                                            <div class="padding">
                                                                <input name="post_id" value="{{$post->id}}" hidden>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Add Comment</label>
                                                                    <input type="text" name="content" class="form-control" placeholder="Enter Content">
                                                                </div>
                                                            </div>
                                                            <div class="box-footer clearfix">
                                                                <button type="submit" class="btn btn-info pull-right btn-sm">Comment</button>
                                                                {{--                <ul class="nav nav-pills nav-sm">--}}
                                                                {{--                    <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                                                {{--                </ul>--}}
                                                            </div>
                                                        </form>

                                                    </div>
                                                    @if($post->comments != null)
                                                        @foreach($post->comments as $comment)
                                                            <div class="box-body " >
                                                                <div class="sl-item"style="min-height: 150px">
                                                                    @if(auth()->user()->id == $comment->user->id)
                                                                        <a href="{{route('comment.remove',$comment->id)}}" class="btn btn-icon white pull-right ml-3">
                                                                            <i class="fa fa-remove"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if($comment->user->profile_picture != null)
                                                                        <div class="sl-left">
                                                                            <img src="../{{$comment->user->profile_picture}}" class="img-circle">
                                                                        </div>
                                                                    @endif
                                                                    <div class="sl-content">
                                                                        <div class="sl-date text-muted">{{$comment->created_at->diffForHumans()}}</div>
                                                                        <div class="sl-author font-weight-bold size-6">
                                                                            <p>{{$comment->user->name}}</p>
                                                                        </div>
                                                                        <p>{{$comment->content}}.</p>
                                                                    </div>
                                                                    <div class="vote-buttons-container">
                                                                        <a href="{{route('comments.upVote', $comment->id)}}" class="btn btn-icon  white  ml-3">
                                                                            <span class="label label-sm up  pull-right ml-5">{{$comment->comment_up_votes_count}}</span>
                                                                            <i class="@if($comment->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                                        </a>
                                                                        <a href="{{route('comments.downVote', $comment->id)}}" class="btn btn-icon  white ">
                                                                            <span class="label label-sm up  pull-right ml-5">{{$comment->comment_down_votes_count}}</span>
                                                                            <i class="@if($comment->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--                                    --}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a0.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}

                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a1.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">9:30</div>--}}
                                    {{--                                            <div class="sl-author">--}}
                                    {{--                                                <a href>Mike</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <p>Meeting with tech leader</p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="sl-footer">--}}
                                    {{--                                                <a href ui-toggle-class class="btn white btn-xs">--}}
                                    {{--                                                    <i class="fa fa-fw fa-star-o text-muted inline"></i>--}}
                                    {{--                                                    <i class="fa fa-fw fa-star text-danger none"></i>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <a href class="btn white btn-xs" data-toggle="collapse" data-target="#reply-2">--}}
                                    {{--                                                    <i class="fa fa-fw fa-mail-reply text-muted"></i>--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="box collapse in m-0" id="reply-2">--}}
                                    {{--                                                <form>--}}
                                    {{--                                                    <textarea class="form-control no-border" rows="3" placeholder="Type something..."></textarea>--}}
                                    {{--                                                </form>--}}
                                    {{--                                                <div class="box-footer clearfix">--}}
                                    {{--                                                    <button class="btn btn-info pull-right btn-sm">Post</button>--}}
                                    {{--                                                    <ul class="nav nav-pills nav-sm">--}}
                                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-video-camera text-muted"></i></a></li>--}}
                                    {{--                                                    </ul>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">8:30</div>--}}
                                    {{--                                            <div class="sl-author">--}}
                                    {{--                                                <a href>Moke</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <p>Call to customer <a href class="text-info">Jacob</a> and discuss the detail.</p>--}}
                                    {{--                                                <p>--}}
                                    {{--                      <span class="inline w-lg w-auto-xs p-a-xs b dark-white">--}}
                                    {{--                        <img src="../assets/images/c0.jpg" class="w-full">--}}
                                    {{--                      </span>--}}
                                    {{--                                                </p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Wed, 25 Mar</div>--}}
                                    {{--                                            <p>Finished task <a href class="text-info">Testing</a>.</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a4.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Thu, 10 Mar</div>--}}
                                    {{--                                            <p>Trip to the moon</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
                                    {{--                                            <p>Prepare for presentation</p>--}}
                                    {{--                                            <blockquote>--}}
                                    {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante soe aiea ose dos soois.</p>--}}
                                    {{--                                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>--}}
                                    {{--                                            </blockquote>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
                                    {{--                                            <p><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a5.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Thu, 17 Jan</div>--}}
                                    {{--                                            <p>Follow up to close deal</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
{{--                            <div class="tab-pane p-v-sm" id="tab_3">--}}
{{--                                <div ui-include="'../views/blocks/widget.friends.html'"></div>--}}
{{--                            </div>--}}
                            <div class="tab-pane p-v-sm" id="tab_4" style="width: 600px; margin-left: 50px">
                                <div class="streamline b-l m-b m-l">
                                    @foreach($user->postsDownVotes as $post)
                                        <div class="box-body " style="border: 1px solid #ddd; /* إضافة حدود خفيفة حول كل منشور */
    border-radius: 5px; /* زوايا دائرية للصندوق */
    padding: 15px; /* حشوة داخلية للصندوق */
    margin-bottom: 20px; /* مسافة أسفل كل صندوق للفصل بين المنشورات */
    background-color: #ffffff; /* تعيين لون الخلفية للصندوق */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف للصندوق */
     /* لجعل الصندوق المرجع بالنسبة لعناصره المطلقة */
    min-height: 250 px; /* تحديد ارتفاع أدنى للصندوق */


">
                                            <div class="sl-item">
                                                @if(auth()->id() == $post->user->id)
                                                    <div class="dropdown pull-right m-3">
                                                        <button class="btn btn-secondary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteModal">
                                                                <i class=" fa fa-remove"></i> post delete
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editPostModal" data-postid="{{ $post->id }}" data-title="{{ $post->title }}" data-postcontent="{{ $post->content }}">
                                                                <i class="fa fa-edit"></i> post update
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($post->user->profile_picture != null)
                                                    <div class="sl-left" style="padding-left: 20px">
                                                        <img src="../{{$post->user->profile_picture}}" class="img-circle">
                                                    </div>
                                                @endif
                                                <div class="post-vote-buttons-container">
                                                    <a href="{{route('posts.upVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_up_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                    <a href="{{route('posts.downVote', $post->id)}}" class="btn btn-icon  white ">
                                                        <span class="label label-sm up  pull-right ml-5">{{$post->post_down_votes_count}}</span>
                                                        <i class="@if($post->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                </div>
                                                <div class="sl-content">
                                                    <div class="sl-author font-weight-bold size-6">
                                                        <a style="color: #6f2877" href>{{$post->user->name}}</a>
                                                    </div>
                                                    <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                                                    <div class="sl-author text-center font-weight-bold h3">
                                                        <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                                                        <div>
                                                            @foreach($post->allTags() as $tag)
                                                                <span class=" text-sm text-muted">{{ $tag }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p>{{$post->content}}</p>
                                                    </div>
                                                    @if($post->image)
                                                        <div class="d-flex justify-content-center align-items-center" style="max-width: 450px ;max-height: 400px ;margin-top: 50px; margin-bottom:40px ;margin-left: 30px" >
                                                            <div class="text-center">
                                                                <img  src="{{asset($post->image)}}" width=100% height="auto" >
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="sl-footer mb-5">
                                                        <a href data-toggle="collapse" data-target="#reply-{{$post->id}}">
                                                            <i class="fa fa-fw fa-mail-reply text-muted" ></i> Reply
                                                        </a>
                                                    </div>
                                                    <div class="box collapse m-0 b-a" id="reply-{{$post->id}}">
                                                        <form action="{{route('comments.store')}}" method="POST">
                                                            @csrf
                                                            <div class="padding">
                                                                <input name="post_id" value="{{$post->id}}" hidden>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Add Comment</label>
                                                                    <input type="text" name="content" class="form-control" placeholder="Enter Content">
                                                                </div>
                                                            </div>
                                                            <div class="box-footer clearfix">
                                                                <button type="submit" class="btn btn-info pull-right btn-sm">Comment</button>
                                                                {{--                <ul class="nav nav-pills nav-sm">--}}
                                                                {{--                    <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                                                {{--                </ul>--}}
                                                            </div>
                                                        </form>

                                                    </div>
                                                    @if($post->comments != null)
                                                        @foreach($post->comments as $comment)
                                                            <div class="box-body " >
                                                                <div class="sl-item"style="min-height: 150px">
                                                                    @if(auth()->user()->id == $comment->user->id)
                                                                        <a href="{{route('comment.remove',$comment->id)}}" class="btn btn-icon white pull-right ml-3">
                                                                            <i class="fa fa-remove"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if($comment->user->profile_picture != null)
                                                                        <div class="sl-left">
                                                                            <img src="../{{$comment->user->profile_picture}}" class="img-circle">
                                                                        </div>
                                                                    @endif
                                                                    <div class="sl-content">
                                                                        <div class="sl-date text-muted">{{$comment->created_at->diffForHumans()}}</div>
                                                                        <div class="sl-author font-weight-bold size-6">
                                                                            <p>{{$comment->user->name}}</p>
                                                                        </div>
                                                                        <p>{{$comment->content}}.</p>
                                                                    </div>
                                                                    <div class="vote-buttons-container">
                                                                        <a href="{{route('comments.upVote', $comment->id)}}" class="btn btn-icon  white  ml-3">
                                                                            <span class="label label-sm up  pull-right ml-5">{{$comment->comment_up_votes_count}}</span>
                                                                            <i class="@if($comment->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                                        </a>
                                                                        <a href="{{route('comments.downVote', $comment->id)}}" class="btn btn-icon  white ">
                                                                            <span class="label label-sm up  pull-right ml-5">{{$comment->comment_down_votes_count}}</span>
                                                                            <i class="@if($comment->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--                                    --}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a0.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}

                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a1.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">9:30</div>--}}
                                    {{--                                            <div class="sl-author">--}}
                                    {{--                                                <a href>Mike</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <p>Meeting with tech leader</p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="sl-footer">--}}
                                    {{--                                                <a href ui-toggle-class class="btn white btn-xs">--}}
                                    {{--                                                    <i class="fa fa-fw fa-star-o text-muted inline"></i>--}}
                                    {{--                                                    <i class="fa fa-fw fa-star text-danger none"></i>--}}
                                    {{--                                                </a>--}}
                                    {{--                                                <a href class="btn white btn-xs" data-toggle="collapse" data-target="#reply-2">--}}
                                    {{--                                                    <i class="fa fa-fw fa-mail-reply text-muted"></i>--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="box collapse in m-0" id="reply-2">--}}
                                    {{--                                                <form>--}}
                                    {{--                                                    <textarea class="form-control no-border" rows="3" placeholder="Type something..."></textarea>--}}
                                    {{--                                                </form>--}}
                                    {{--                                                <div class="box-footer clearfix">--}}
                                    {{--                                                    <button class="btn btn-info pull-right btn-sm">Post</button>--}}
                                    {{--                                                    <ul class="nav nav-pills nav-sm">--}}
                                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                    {{--                                                        <li class="nav-item"><a class="nav-link" href><i class="fa fa-video-camera text-muted"></i></a></li>--}}
                                    {{--                                                    </ul>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">8:30</div>--}}
                                    {{--                                            <div class="sl-author">--}}
                                    {{--                                                <a href>Moke</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <p>Call to customer <a href class="text-info">Jacob</a> and discuss the detail.</p>--}}
                                    {{--                                                <p>--}}
                                    {{--                      <span class="inline w-lg w-auto-xs p-a-xs b dark-white">--}}
                                    {{--                        <img src="../assets/images/c0.jpg" class="w-full">--}}
                                    {{--                      </span>--}}
                                    {{--                                                </p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Wed, 25 Mar</div>--}}
                                    {{--                                            <p>Finished task <a href class="text-info">Testing</a>.</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a4.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Thu, 10 Mar</div>--}}
                                    {{--                                            <p>Trip to the moon</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
                                    {{--                                            <p>Prepare for presentation</p>--}}
                                    {{--                                            <blockquote>--}}
                                    {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante soe aiea ose dos soois.</p>--}}
                                    {{--                                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>--}}
                                    {{--                                            </blockquote>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
                                    {{--                                            <p><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="sl-item">--}}
                                    {{--                                        <div class="sl-left">--}}
                                    {{--                                            <img src="../assets/images/a5.jpg" class="img-circle">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="sl-content">--}}
                                    {{--                                            <div class="sl-date text-muted">Thu, 17 Jan</div>--}}
                                    {{--                                            <p>Follow up to close deal</p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
{{--                                <div class="row m-b">--}}
{{--                                    <div class="col-xs-6">--}}
{{--                                        <small class="text-muted">Cell Phone</small>--}}
{{--                                        <div class="_500">1243 0303 0333</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-6">--}}
{{--                                        <small class="text-muted">Family Phone</small>--}}
{{--                                        <div class="_500">+32(0) 3003 234 543</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row m-b">--}}
{{--                                    <div class="col-xs-6">--}}
{{--                                        <small class="text-muted">Reporter</small>--}}
{{--                                        <div class="_500">Coch Jose</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-6">--}}
{{--                                        <small class="text-muted">Manager</small>--}}
{{--                                        <div class="_500">James Richo</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <small class="text-muted">Bio</small>--}}
{{--                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue.</div>--}}
{{--                                </div>--}}
                            </div>
{{--                            <div class="tab-pane p-v-sm" id="tab_5">--}}
{{--                                <div class="row m-b">--}}
{{--                                    <ul class="list no-border p-b">--}}
{{--                                        @foreach($user->followers as $follower)--}}
{{--                                            <li class="list-item">--}}
{{--                                                <a herf class="list-left">--}}
{{--                    <span class="w-40 avatar">--}}
{{--                      <img src="../assets/images/a4.jpg" alt="...">--}}
{{--                      <i class="on b-white bottom"></i>--}}
{{--                    </span>--}}
{{--                                                </a>--}}
{{--                                                <div class="list-body">--}}
{{--                                                    <div><a href={{route('profile',$follower->id)}}>{{$follower->name}}</a></div>--}}
{{--                                                    <small class= "text-muted text-ellipsis">Designer, Blogger</small>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <div class="tab-pane p-v-sm" id="tab_6">--}}
{{--                                <div class="row m-b">--}}
{{--                                    <ul class="list no-border p-b">--}}
{{--                                        @foreach($user->following as $following)--}}
{{--                                            <li class="list-item">--}}
{{--                                                <a herf class="list-left">--}}
{{--                    <span class="w-40 avatar">--}}
{{--                      <img src="../assets/images/a4.jpg" alt="...">--}}
{{--                      <i class="on b-white bottom"></i>--}}
{{--                    </span>--}}
{{--                                                </a>--}}
{{--                                                <div class="list-body">--}}
{{--                                                    <div><a href={{route('profile',$following->id)}}>{{$following->name}}</a></div>--}}
{{--                                                    <small class= "text-muted text-ellipsis">Designer, Blogger</small>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}

{{--                            </div>--}}
                        </div>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel"> Post Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want delete post ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <!-- زر التأكيد للحذف -->
                                        <a href="{{ route('post.remove', $post->id) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- الـ Modal لتعديل البوست -->

                        <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="editPostForm" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- استخدام طريقة HTTP PUT لتعديل البوست -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPostModalLabel">Post Update </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="editTitle" style="color: black">Title</label>
                                                <input type="text" name="title" id="editTitle" class="form-control" placeholder="Enter Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="editContent" style="color: black">Content</label>
                                                <input type="text" name="content" id="editPostContent" class="form-control" placeholder="Enter Content">
                                            </div>
                                            <div class="form-group">
                                                <label for="tags3" style="color: black">Tags</label>
                                                <br>
                                                <select class="form-control" id="tags3" name="tags3[]" multiple="multiple">
                                                    <!-- Tags will be fetched via AJAX or server-side code -->
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="btn btn-sm" style="background-color: silver; color: white; margin-right: 10px;">
                                                    <i class="fa fa-image"></i> Add Image
                                                    <input type="file" name="image" id="editImage" style="display: none;">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn" style="background-color: silver ;color:white">Save </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteComment" tabindex="-1" aria-labelledby="deleteCommentLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCommentLabel">Comment Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want delete comment ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <!-- زر التأكيد للحذف -->
                                        <a href="{{ route('comment.remove', $comment->id) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="editCommentForm" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- استخدام طريقة HTTP PUT لتعديل البوست -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCommentModalLabel">Comment Update </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="editContent" style="color: black">Content</label>
                                                <input type="text" name="content" id="editContent" class="form-control" placeholder="Enter Content">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn" style="background-color: silver ;color:white">Save </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-3">
                         <div>
                            <div class="box">
                                <div class="box-header">
                                    <h3>Who to follow</h3>
                                </div>
                                <div class="box-divider m-0"></div>
                                <ul class="list no-border p-b">
                                    @foreach($user->following as $following)
                                    <li class="list-item">
                                        <a herf class="list-left">
                    <span class="w-40 avatar">
                      <img src="../{{$following->profile_picture}}" alt="...">
                      <i class="on b-white bottom"></i>
                    </span>
                                        </a>
                                        <div class="list-body">
                                            <div><a href={{route('profile',$following->id)}}>{{$following->name}}</a></div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                                <div style="margin-left: 70px  ; padding: 10px">
                                <a  href="{{route("user.following",$user->id)}}"class="btn btn-sm white "style="background-color: silver;color:white" >more</a>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-header">
                                    <h3>Followers</h3>
                                </div>
                                <div class="box-divider m-0"></div>
                                <ul class="list no-border p-b">
                                    @foreach($user->followers as $follower)
                                        <li class="list-item">
                                            <a herf class="list-left">
                    <span class="w-40 avatar">
                      <img src="{{asset($follower->profile_picture)}}" alt="...">
                      <i class="on b-white bottom"></i>
                    </span>
                                            </a>
                                            <div class="list-body">
                                                <div><a href={{route('profile',$follower->id)}}>{{$follower->name}}</a></div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                                <div style="margin-left: 70px  ; padding: 10px">
                                <a  href="{{route("user.followers",$user->id)}}"class="btn btn-sm white "style="background-color: silver;color:white" >more</a>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <h3>Groups</h3>
                                </div>
                                <div class="box-divider m-0"></div>
                                <ul class="list no-border p-b">
                                    @foreach($user->groups as $group)
                                        <li class="list-item">
                                            <a href="" class="pull-left m-r-md">

            <span class="avatar w-40">
                 <img src="{{asset($group->image_path)}}">

              <i class="on b-white"></i>
            </span></a>
                                            <div class="list-body">
                                                <div><a href={{route('group.show',$group->id)}}>{{$group->name}}</a></div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>

                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <h2>Latest Tweets</h2>
                                </div>
                                <div class="box-divider m-0"></div>
                                <ul class="list">
                                    <li class="list-item">
                                        <div class="list-body">
                                            <p>Wellcome <a href class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                            <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 2 minuts ago</small>
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="list-body">
                                            <p>Morbi nec <a href class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit amet, consectetur</p>
                                            <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 1 hour ago</small>
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="list-body">
                                            <p><a href class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis</p>
                                            <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 2 hours ago</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                       </div>
                </div>
            </div>

            <!-- ############ PAGE END-->

        </div>
    </div>
    <!-- / -->

    <!-- theme switcher -->
    <div id="switcher">
        <div class="switcher box-color dark-white text-color" id="sw-theme">
            <a href ui-toggle-class="active" target="#sw-theme" class="box-color dark-white text-color sw-btn">
                <i class="fa fa-gear"></i>
            </a>
            <div class="box-header">
                <a href="https://themeforest.net/item/flatkit-app-ui-kit/13231484?ref=flatfull" class="btn btn-xs rounded danger pull-right">BUY</a>
                <h2>Theme Switcher</h2>
            </div>
            <div class="box-divider"></div>
            <div class="box-body">
                <p class="hidden-md-down">
                    <label class="md-check m-y-xs"  data-target="folded">
                        <input type="checkbox">
                        <i class="green"></i>
                        <span class="hidden-folded">Folded Aside</span>
                    </label>
                    <label class="md-check m-y-xs" data-target="boxed">
                        <input type="checkbox">
                        <i class="green"></i>
                        <span class="hidden-folded">Boxed Layout</span>
                    </label>
                    <label class="m-y-xs pointer" ui-fullscreen>
                        <span class="fa fa-expand fa-fw m-r-xs"></span>
                        <span>Fullscreen Mode</span>
                    </label>
                </p>
                <p>Colors:</p>
                <p data-target="themeID">
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'primary', accent:'accent', warn:'warn'}">
                        <input type="radio" name="color" value="1">
                        <i class="primary"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'accent', accent:'cyan', warn:'warn'}">
                        <input type="radio" name="color" value="2">
                        <i class="accent"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warn', accent:'light-blue', warn:'warning'}">
                        <input type="radio" name="color" value="3">
                        <i class="warn"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'success', accent:'teal', warn:'lime'}">
                        <input type="radio" name="color" value="4">
                        <i class="success"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'info', accent:'light-blue', warn:'success'}">
                        <input type="radio" name="color" value="5">
                        <i class="info"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'blue', accent:'indigo', warn:'primary'}">
                        <input type="radio" name="color" value="6">
                        <i class="blue"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warning', accent:'grey-100', warn:'success'}">
                        <input type="radio" name="color" value="7">
                        <i class="warning"></i>
                    </label>
                    <label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'danger', accent:'grey-100', warn:'grey-300'}">
                        <input type="radio" name="color" value="8">
                        <i class="danger"></i>
                    </label>
                </p>
                <p>Themes:</p>
                <div data-target="bg" class="row no-gutter text-u-c text-center _600 clearfix">
                    <label class="p-a col-sm-6 light pointer m-0">
                        <input type="radio" name="theme" value="" hidden>
                        Light
                    </label>
                    <label class="p-a col-sm-6 grey pointer m-0">
                        <input type="radio" name="theme" value="grey" hidden>
                        Grey
                    </label>
                    <label class="p-a col-sm-6 dark pointer m-0">
                        <input type="radio" name="theme" value="dark" hidden>
                        Dark
                    </label>
                    <label class="p-a col-sm-6 black pointer m-0">
                        <input type="radio" name="theme" value="black" hidden>
                        Black
                    </label>
                </div>
            </div>
        </div>

        <div class="switcher box-color black lt" id="sw-demo">
            <a href ui-toggle-class="active" target="#sw-demo" class="box-color black lt text-color sw-btn">
                <i class="fa fa-list text-white"></i>
            </a>
            <div class="box-header">
                <h2>Demos</h2>
            </div>
            <div class="box-divider"></div>
            <div class="box-body">
                <div class="row no-gutter text-u-c text-center _600 clearfix">
                    <a href="dashboard.html"
                       class="p-a col-sm-6 primary">
                        <span class="text-white">Default</span>
                    </a>
                    <a href="dashboard.0.html"
                       class="p-a col-sm-6 success">
                        <span class="text-white">Zero</span>
                    </a>
                    <a href="dashboard.1.html"
                       class="p-a col-sm-6 blue">
                        <span class="text-white">One</span>
                    </a>
                    <a href="dashboard.2.html"
                       class="p-a col-sm-6 warn">
                        <span class="text-white">Two</span>
                    </a>
                    <a href="dashboard.3.html"
                       class="p-a col-sm-6 danger">
                        <span class="text-white">Three</span>
                    </a>
                    <a href="dashboard.4.html"
                       class="p-a col-sm-6 green">
                        <span class="text-white">Four</span>
                    </a>
                    <a href="dashboard.5.html"
                       class="p-a col-sm-6 info">
                        <span class="text-white">Five</span>
                    </a>
                    <div
                        class="p-a col-sm-6 lter">
                        <span class="text">...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / -->

    <!-- ############ LAYOUT END-->

</div>
<!-- build:js script
s/app.html.js -->
<!-- jQuery -->
<script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../libs/jquery/tether/dist/js/tether.min.js"></script>

<!-- core -->
<script src="../libs/jquery/underscore/underscore-min.js"></script>
<script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="../libs/jquery/PACE/pace.min.js"></script>

<script src="scripts/config.lazyload.js"></script>

<script src="scripts/palette.js"></script>
<script src="scripts/ui-load.js"></script>
<script src="scripts/ui-jp.js"></script>
<script src="scripts/ui-include.js"></script>
<script src="scripts/ui-device.js"></script>
<script src="scripts/ui-form.js"></script>
<script src="scripts/ui-nav.js"></script>
<script src="scripts/ui-screenfull.js"></script>
<script src="scripts/ui-scroll-to.js"></script>
<script src="scripts/ui-toggle-class.js"></script>

<script src="scripts/app.js"></script>

<!-- ajax -->
<script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
<script src="scripts/ajax.js"></script>

    <script>
        $(document).ready(function() {
            function initializeSelect2(selector) {
                $(selector).select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    ajax: {
                        url: "{{ route('tags.index') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id ? item.id : item.name // استخدم `id` إن وجد، وإلا استخدم `name`
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            }
            initializeSelect2('#tags1');
            initializeSelect2('#tags2');
            initializeSelect2('#tags3');

        });
    </script>
    <script>
        $(document).ready(function() {
            // عندما يُفتح الـ Modal للتعديل
            $('#editPostModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // الزر الذي يفتح الـ Modal
                var postId = button.data('postid'); // الحصول على post.id من الزر
                var title = button.data('title'); // الحصول على العنوان
                var postcontent = button.data('postcontent'); // الحصول على المحتوى

                // تحديث نموذج الـ Modal مع بيانات البوست
                var actionUrl = "{{ route('post.update', ':id') }}";
                actionUrl = actionUrl.replace(':id', postId);
                $('#editPostForm').attr('action', actionUrl);

                $('#editTitle').val(title);
                $('#editPostContent').val(postcontent);

                // يمكنك أيضًا إضافة أكواد JavaScript أخرى هنا لتعبئة الحقول الأخرى مثل `tags` بناءً على الـ post.id
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // عندما يُفتح الـ Modal للتعديل
            $('#editCommentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // الزر الذي يفتح الـ Modal
                var commentId = button.data('commentid'); // الحصول على comment.id من الزر
                var content = button.data('content'); // الحصول على المحتوى

                // تحديث نموذج الـ Modal مع بيانات التعليق
                var actionUrl = "{{ route('comment.update', ':id') }}";
                actionUrl = actionUrl.replace(':id', commentId);
                $('#editCommentForm').attr('action', actionUrl);

                $('#editContent').val(content);


            });
        });
    </script>
<!-- endbuild -->
@endsection()
