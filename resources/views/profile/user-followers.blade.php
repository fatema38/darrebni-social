@extends('layouts.master')
@section('content')
    <div class="col-md w-lg w-auto-sm light lt b-l">
        <div class="p-a b-b">
            <a href class="clear">
			    <span class="pull-left">
			      <img src="../{{$user->profile_picture}}" alt="..." class="w-40 r">
			    </span>
                <span class="clear hidden-folded p-x">
			      <span class="block _500">{{$user->name}}</span>
			      <small class="block text-muted"><i class="fa fa-circle text-success m-r-sm"></i>online</small>
			    </span>
            </a>
        </div>
        <div class="list-group no-radius no-borders light lt">
            @foreach($user->followers as $follower)
            <a  href="{{route('profile',$follower->id)}}"data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">
                <img src="../{{$follower->profile_picture}}" class="w-24 m-r-sm img-circle">
                <span>{{$follower->name}}</span>
            </a>
            @endforeach
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a3.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Mason Yarnell</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a4.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Mike Mcalidek</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a5.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Cris Labiso</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a6.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Daniel Sandvid</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a7.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Helder Oliveira</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a8.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Jeff Broderik</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a9.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Daniel Sandvid</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a0.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Helder Oliveira</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <img src="../assets/images/a2.jpg" class="w-24 m-r-sm img-circle">--}}
{{--                <span>Jeff Broderik</span>--}}
{{--            </a>--}}
{{--            <div class="p-x-md m-t p-v-xs">Online members</div>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <i class="fa fa-circle text-success text-xs m-r-xs"></i>--}}
{{--                <span>Mason Yarnell</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <i class="fa fa-circle text-success text-xs m-r-xs"></i>--}}
{{--                <span>Mike Mcalidek</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <i class="fa fa-circle text-success text-xs m-r-xs"></i>--}}
{{--                <span>Cris Labiso</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <i class="fa fa-circle text-success text-xs m-r-xs"></i>--}}
{{--                <span>Jonathan Morina</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <i class="fa fa-circle text-success text-xs m-r-xs"></i>--}}
{{--                <span>Daniel Sandvid</span>--}}
{{--            </a>--}}
{{--            <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">--}}
{{--                <i class="fa fa-circle text-success text-xs m-r-xs"></i>--}}
{{--                <span>Helder Oliveira</span>--}}
{{--            </a>--}}
        </div>
    </div>
    </div>
@endsection
