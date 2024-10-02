@extends('layouts.master')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- تضمين CSS الخاص بـ select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.0.3/dist/select2-bootstrap4.min.css" rel="stylesheet" />

        <!-- تضمين مكتبة jQuery (إذا لم تكن مضمنة بالفعل) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- تضمين JS الخاص بـ select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
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
        .profile-picture {
            width: 100px;  /* تحديد العرض الثابت */
            height: 100px; /* تحديد الارتفاع الثابت */
            object-fit: cover; /* يجعل الصورة تغطي الأبعاد المحددة بدون تشوه */
        }
        .box {
            position: relative; /* لضبط عناصر الطفل باستخدام position:absolute */
        }

        .btn-prev,
        .btn-next {
            position: absolute; /* لجعل الأزرار في مكان محدد داخل الصندوق */
            top: 85%; /* لضبط الأزرار في منتصف الصندوق */
            transform: translateY(-50%); /* لجعل الأزرار في منتصف الارتفاع بدقة */
        }

        .btn-prev {
            left: 10px; /* وضع زر السهم السابق على الجهة اليسرى للصندوق */
        }

        .btn-next {
            right: 10px; /* وضع زر السهم التالي على الجهة اليمنى للصندوق */
        }
        @keyframes fadeInUpZoom {
            0% {
                opacity: 0;
                transform: translateY(50px) scale(0.8); /* يبدأ بحجم أصغر ويتحرك من الأسفل */
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1); /* يعود للحجم الطبيعي ويصل إلى موقعه */
            }
        }

        .image-animation {
            animation: fadeInUpZoom 2s ease-in-out; /* إضافة تأثير التحرك والتكبير */
        }

        .animated-images div {
            margin-bottom: 20px; /* إضافة مسافة بين الصور */
        }
        .popup-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* خلفية نصف شفافة */
            display: none; /* إخفاء النافذة في البداية */
            justify-content: center;
            align-items: center;
            z-index: 9999; /* يجب أن تكون فوق جميع العناصر الأخرى */
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .popup-content h2 {
            margin-bottom: 15px;
        }

        .popup-content a {
            color: blue;
            text-decoration: none;
        }

        .popup-content a:hover {
            text-decoration: underline;
        }

        .popup-content button {
            background-color: #6f2877;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-content button:hover {
            background-color: #5e1f66;
        }


    </style>
</head>
@section('content')
    <div class="col-lg-9">
        @if(auth()->user())
            <div class="box"style="width:600px ;margin-left: 50px">
                <div class="box-header b-b">
                    <h3>People You May Know</h3>
                </div>

                <div class="box-body">
                    <div class="row row-sm">
                        @foreach($unfollowedUsers as $user)
                            <div class="col-sm-4 ">
                                <a href="{{route('profile', $user->id)}}" title="{{$user->name}}">
                                    <img src="{{ asset($user->profile_picture) }}" class="profile-picture rounded-circle mb-2">

                                </a>
                                <div class="mt-2 text-center">
                                    <a style="background-color: silver; color: white"href="{{ route('follow', $user->id) }}" class="btn btn-sm ">Follow</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- إضافة روابط pagination -->
                <div class="box-footer">
                    <!-- زر الصفحة السابقة -->
                    @if ($unfollowedUsers->onFirstPage())
                        <span class="btn btn-default btn-prev disabled">←</span>
                    @else
                        <a href="{{ $unfollowedUsers->previousPageUrl() }}" class="btn btn-default btn-prev">←</a>
                    @endif

                    <!-- زر الصفحة التالية -->
                    @if ($unfollowedUsers->hasMorePages())
                        <a href="{{ $unfollowedUsers->nextPageUrl() }}" class="btn btn-default btn-next">→</a>
                    @else
                        <span class="btn btn-default btn-next disabled">→</span>
                    @endif
                </div>

            </div>



        @endif
        <div class="box "style="width: 600px; margin-left: 50px">
            <div class="box-header">
                <h3>Feeds </h3>
            </div>
            <div class="box-body">
                <div class="streamline b-l m-l-md" >
                    @foreach($posts as $post)
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
                            @if(auth()->user() !=null)
                                @if(auth()->user()->role->name != "admin" && auth()->user()->role->name != "superAdmin" && auth()->user()->id != $post->user->id)

                                    <a class=" text-danger pull-right m-3" data-bs-toggle="modal" data-bs-target="#myModal" data-post_id={{$post->id}}>Report
                                    <i class=" fa fa-bullhorn"></i>
                                    </a>
                                @endif
                            @endif
                        @if($post->user->profile_picture != null)
                        <div class="sl-left"style="padding-left: 20px">
                            <img src="{{$post->user->profile_picture}}" class="img-circle">
                        </div>
                        @endif

                        <div class="sl-content">

                            <div class="sl-author font-weight-bold size-6">
                                <a style="color: #6f2877" href="{{route('profile',$post->user->id)}}">{{$post->user->name}}</a>
                                @if($post->user->role_id == 1 || $post->user->role_id == 2)
                                    <p class="sl-date text-muted" > admin</p>
                                @endif
                            </div>
                            <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                            <div class="sl-author text-center font-weight-bold h5">

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
                                        <button type="submit" class="btn  pull-right btn-sm"style="background-color: silver;color:white">Comment</button>
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
                                @endif
                                @if($comment->user->profile_picture != null)
                                <div class="sl-left">
                                    <img src={{$comment->user->profile_picture}} class="img-circle">
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
                                        <span class="label label-sm up  pull-right ml-5">{{$comment->comment_up_votes_count}}</span>
                                        <i class="@if($comment->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                    </a>
                                    <a href="{{route('comments.downVote', $comment->id)}}" class="btn btn-icon  white ">
                                        <span class="label label-sm up  pull-right ml-5">{{$comment->comment_down_votes_count}}</span>
                                        <i class="@if($comment->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                    </a>
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
                            @endforeach
                            @endif
                        </div>
                            <div class="post-vote-buttons-container" >

                                <a href="{{route('posts.upVote', $post->id)}}" class="btn btn-icon  white ">
                                    <span class="label label-sm up  pull-right ml-5">{{$post->upVotes}}</span>
                                    <i class="@if($post->authedRating?->pivot->type == 'upVote') fa fa-thumbs-up  @else fa fa-thumbs-o-up  @endif" style="color: #6f2877"></i>

                                </a>
                                <a href="{{route('posts.downVote', $post->id)}}" class="btn btn-icon  white ">
                                    <span class="label label-sm up  pull-right ml-5">{{$post->downVotes}}</span>
                                    <i class="@if($post->authedRating?->pivot->type == 'downVote') fa fa-thumbs-down  @else fa fa-thumbs-o-down  @endif" style="color: #6f2877"></i>

                                </a>
                            </div>
                    </div>
                        </div>
                    @endforeach
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

                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" >
                                    <div class="modal-header" >
                                        <h5 class="modal-title" id="myModalLabel">Report Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('report.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" id="post_id" name="post_id" value="">
                                            <input type="text" name="note" class="form-control" placeholder="Enter your note">
                                            <br>
                                            <div class="modal-footer">
                                                <button class="btn btn-custom"style="background-color: silver ; color:white" type="submit">Report</button>
                                                <button type="button"style="background-color: silver ; color:white" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                            </div>
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
                                                <label for="editPostContent" style="color: black">Content</label>
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
                </div>
            </div>
        </div>
    </div>
    <div class=" col-sm " data-layout="column" style="background-color: white">

        @if(auth()->user())
            <div class="padding ">
            <form action="{{ route('posts.search') }}" method="Get" class="d-flex ">
                <button type="submit"  style="background-color: silver ; color:white; margin-right: 0" class="btn btn-sm ">Search</button>
                <select class="form-control  " id="tags1" name="tags1[]" multiple="multiple">
                    <!-- Tags will be fetched via AJAX -->
                </select>

            </form>
            </div>
            <div class="box" style="background-color: white ">
                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="padding">
                        <div class="form-group">
                            <label for="exampleInputEmail1" >Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" >Content</label>
                            <input type="text" name="content" class="form-control" placeholder="Enter Content">
                        </div>
                        <div class="form-group">
                            <label for="tags" >Tags</label>
                            <select class="form-control" id="tags2" name="tags2[]" multiple="multiple">
                                <!-- Tags will be fetched via AJAX -->
                            </select>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <label class="btn btn-sm" style="background-color: silver; color: white; margin-right: 10px;">
                            <i class="fa fa-image"></i> Add Image
                            <input type="file" name="image" id="image" style="display: none;">
                        </label>
                        <button type="submit" style="background-color: silver; color:white" class="btn pull-right btn-sm">
                            <i class="fa fa-paper-plane"></i> Post
                        </button>
                    </div>
                </form>
            </div>



        @else
            <div class="animated-images">
                <div>
                    <img src="images/darrebni.png" class="image-animation" style="max-width: 100%; height: auto; display: block; margin: 0 auto; margin-top: 100px;">
                </div>
                <div>
                    <img src="images/darrebni1.png" class="image-animation" style="max-width: 100%; height: auto; display: block; margin: 0 auto; margin-top: 100px;">
                </div>
                <div>
                    <img src="images/darrebni2.png" class="image-animation" style="max-width: 100%; height: auto; display: block; margin: 0 auto; margin-top: 100px;">
                </div>
                <div>
                    <img src="images/darrebni3.png" class="image-animation" style="max-width: 100%; height: auto; display: block; margin: 0 auto; margin-top: 100px;">
                </div>
            </div>

        @endif


    </div>
    <div id="popup" class="popup-container">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2> Special Announcement!</h2>
            <p> visit Darrebni website  <a href="https://platform.darrebni.net/" target="_blank">from here </a>.</p>
            <button onclick="closePopup()">close</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(selector).select2({
            multiple:true
        });
    </script>


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

@endpush
<script>
    // JavaScript لتحديث قيمة input المخفي عند فتح الـ modal
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = document.getElementById('myModal');

        myModal.addEventListener('show.bs.modal', function (event) {
            // الحصول على العنصر الذي فتح الـ modal
            var link = event.relatedTarget;

            // استخراج post_id من خاصية البيانات
            var postId = link.getAttribute('data-post_id');

            // تحديث input المخفي بالقيمة المستخرجة
            var postInput = document.getElementById('post_id');
            postInput.value = postId;
        });
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

<script>
    // دالة لفتح النافذة المنبثقة
    function openPopup() {
        document.getElementById("popup").style.display = "flex";
    }

    // دالة لإغلاق النافذة المنبثقة
    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    // جعل النافذة تظهر تلقائيًا عند تحميل الصفحة بعد 3 ثوانٍ
    window.onload = function() {
        setTimeout(openPopup, 5000); // بعد 3 ثوانٍ
    };
</script>
