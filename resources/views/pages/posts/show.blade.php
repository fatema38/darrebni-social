@extends('layouts.master')
<head>
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
    <div class="col-lg">

        <div class="box" style="width: 600px; margin-left: 50px">
            <div class="box-header">
                <h3>Post </h3>
            </div>
            <div class="box-body">
                <div class="streamline b-l m-l-md">
                    <div class="box-body " style="border: 1px solid #ddd; /* إضافة حدود خفيفة حول كل منشور */
    border-radius: 5px; /* زوايا دائرية للصندوق */
    padding: 15px; /* حشوة داخلية للصندوق */
    margin-bottom: 20px; /* مسافة أسفل كل صندوق للفصل بين المنشورات */
    background-color: #ffffff; /* تعيين لون الخلفية للصندوق */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف للصندوق */
     /* لجعل الصندوق المرجع بالنسبة لعناصره المطلقة */
    min-height: 250px; /* تحديد ارتفاع أدنى للصندوق */

">
                        <div class="sl-item">
                            @if(auth()->id() == $post->user->id)
                                <a href="{{route('post.remove',$post->id)}}" class="btn btn-icon white pull-right ml-3">
                                    <i class="fa fa-remove"></i>
                                </a>
                            @endif
                            @if($post->user->profile_picture != null)
                                <div class="sl-left">
                                    <img src="{{asset($post->user->profile_picture)}}" class="img-circle">
                                </div>
                            @endif

                            <div class="sl-content">
                                @if(auth()->user() !=null)
                                    @if(auth()->user()->role->name != "admin" && auth()->user()->role->name != "superAdmin" && auth()->user()->id != $post->user->id)

                                        <a class="text-danger" data-bs-toggle="modal" data-bs-target="#myModal" data-post_id={{$post->id}}>Report</a>
                                    @endif
                                @endif
                                <div class="sl-author font-weight-bold size-6">
                                    <a style="color: #6f2877" href="{{route('profile',$post->user->id)}}">{{$post->user->name}}</a>
                                </div>
                                <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                                <div class="sl-author text-center font-weight-bold h4">
                                    <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                                    <div>
                                        @foreach($post->allTags() as $tag)
                                            <span class=" text-sm ">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <p>{{$post->content}}</p>
                                </div>
                                    @if($post->image)
                                        <div class="d-flex justify-content-center align-items-center" style="max-width: 450px ;max-height: 400px ;margin-top: 50px; margin-bottom:40px " >
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
                                            <button type="submit" class="btn pull-right "style="background-color: silver;color: white">Comment</button>
                                            {{--                <ul class="nav nav-pills nav-sm">--}}
                                            {{--                    <li class="nav-item"><a class="nav-link" href><i class="fa fa-camera text-muted"></i></a></li>--}}
                                            {{--                </ul>--}}
                                        </div>
                                    </form>

                                </div>
                                @if($post->comments != null)
                                    @foreach($post->comments as $comment)
                                        <div class="box-body" >
                                            <div class="sl-item" style="min-height: 150px">
                                                @if(auth()->user() != null)
                                                    @if(auth()->user()->id == $comment->user->id)
                                                        <a href="{{route('comment.remove',$comment->id)}}" class="btn btn-icon white pull-right ml-3">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                                @if($comment->user->profile_picture != null)
                                                    <div class="sl-left">
                                                        <img src={{asset($comment->user->profile_picture)}} class="img-circle">
                                                    </div>
                                                @endif
                                                <div class="sl-content">
                                                    <div class="sl-date text-muted">{{$comment->created_at->diffForHumans()}}</div>
                                                    <div class="sl-author font-weight-bold size-6">
                                                        <a href="{{route('profile',$comment->user->id)}}">{{$comment->user->name}}</a>
                                                    </div>
                                                    <p>{{$comment->content}}.</p>

                                                </div>
                                                <div class="vote-buttons-container">
                                                    <a href="{{route('comments.upVote', $comment->id)}}" class="btn btn-icon  white  ml-3">

                                                        <i class="@if($comment->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                    <a href="{{route('comments.downVote', $comment->id)}}" class="btn btn-icon  white ">

                                                        <i class="@if($comment->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="post-vote-buttons-container" >

                                <a href="{{route('posts.upVote', $post->id)}}" class="btn btn-icon  white ">
                                    <i class="@if($post->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                </a>
                                <a href="{{route('posts.downVote', $post->id)}}" class="btn btn-icon  white ">
                                    <i class="@if($post->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                </a>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="sl-item">--}}
                    {{--                        <div class="sl-left">--}}
                    {{--                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                    {{--                        </div>--}}
                    {{--                        <div class="sl-content">--}}
                    {{--                            <div class="sl-date text-muted">8:30</div>--}}
                    {{--                            <div class="sl-author">--}}
                    {{--                                <a href>Moke</a>--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <p>Just followed <a href class="text-info">Jacob</a> and she followed you too.</p>--}}
                    {{--                                <p>--}}
                    {{--		                      <span class="inline p-a-xs b-a dark-white">--}}
                    {{--		                        <img src="../assets/images/b2.jpg" class="img-responsive">--}}
                    {{--		                      </span>--}}
                    {{--                                </p>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="sl-item">--}}
                    {{--                        <div class="sl-left">--}}
                    {{--                            <img src="../assets/images/a3.jpg" class="img-circle">--}}
                    {{--                        </div>--}}
                    {{--                        <div class="sl-content">--}}
                    {{--                            <div class="sl-date text-muted">Sat, 5 Mar</div>--}}
                    {{--                            <div class="sl-author">--}}
                    {{--                                <a href>Moke</a>--}}
                    {{--                            </div>--}}
                    {{--                            <blockquote>--}}
                    {{--                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante soe aiea ose dos soois.</p>--}}
                    {{--                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>--}}
                    {{--                            </blockquote>--}}


                    {{--                            <div class="sl-item">--}}
                    {{--                                <div class="sl-left">--}}
                    {{--                                    <img src="../assets/images/a2.jpg" class="img-circle">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="sl-content">--}}
                    {{--                                    <div class="sl-date text-muted">Sun, 11 Feb</div>--}}
                    {{--                                    <p><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="sl-item">--}}
                    {{--                                <div class="sl-left">--}}
                    {{--                                    <img src="../assets/images/a5.jpg" class="img-circle">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="sl-content">--}}
                    {{--                                    <div class="sl-date text-muted">Thu, 17 Jan</div>--}}
                    {{--                                    <p>Follow up to close deal</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
            <hr>


    </div>
@endsection
