@extends('layouts.master')
@section('content')

    <style>
        .btn-container {
            display: flex;
            gap: 10px; /* مسافة بين الروابط */
            padding: 10px;
        }
    </style>
{{--    <div class="row row-col no-gutter b-t warn">--}}
{{--        <div class="col-xs-4 b-r">--}}
{{--            <a class="p-y block text-center" ui-toggle-class>--}}
{{--                <strong class="block">{{$users->count()}}</strong>--}}
{{--                <span class="block">Users</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 b-r">--}}
{{--            <a class="p-y block text-center" ui-toggle-class>--}}
{{--                <strong class="block">{{$admins->count()}}</strong>--}}
{{--                <span class="block">Admins</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4">--}}
{{--            <a class="p-y block text-center" ui-toggle-class>--}}
{{--                <strong class="block">{{$coaches->count()}}</strong>--}}
{{--                <span class="block">Coaches</span>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--    <div class="row row-col no-gutter b-t warn">--}}
{{--        <div class="col-xs-4 b-r">--}}
{{--            <a class="p-y block text-center" ui-toggle-class>--}}
{{--                <strong class="block">{{$trainees->count()}}</strong>--}}
{{--                <span class="block">Trainees</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 b-r">--}}
{{--            <a class="p-y block text-center" ui-toggle-class>--}}
{{--                <strong class="block">{{$posts->count()}}</strong>--}}
{{--                <span class="block">Posts</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4">--}}
{{--            <a class="p-y block text-center" ui-toggle-class>--}}
{{--                <strong class="block">{{$groups->count()}}</strong>--}}
{{--                <span class="block">Groups</span>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--    --}}
{{--        <div class="col-sm-6 col-md-4 col-lg-3">--}}
    <div class="box p-a ml-5">
        <div class="pull-right ml-5">
            <span class="w-40 accent text-center rounded ml-4">
              <i class="material-icons">people</i>
            </span>
        </div>
        <div class="clear ml-3">
            <h4 class="m-0 text-md"><a href>{{$allusers->count()}}<span class="text-sm"> Users</span></a></h4>
            <small class="text-muted">{{$admins->count()}} admins.</small>
        </div>
    </div>
{{--        </div>--}}

            <div class="box-color p-a primary ml-3">
                <div class="pull-right m-l">
            <span class="w-40 accent text-center rounded">
              <i class="material-icons">people</i>
            </span>
                </div>
                <div class="clear">
                    <h4 class="m-0 text-md"><a href> {{$coaches->count()}}<span class="text-sm"> Coaches</span></a></h4>
                    <small class="text-muted">{{$coaches_admins->count()}} Admins of group </small>
                </div>
            </div>

{{--        <div class="col-sm-6 col-md-4 col-lg-3">--}}
            <div class="box p-a ml-3">
                <div class="pull-right ml-5">
            <span class="w-40 accent text-center rounded">
              <i class="material-icons">people</i>
            </span>
                </div>
                <div class="clear">
                    <h4 class="m-0 text-md"><a href>{{$trainees->count()}}<span class="text-sm"> Trainees</span></a></h4>
                    <small class="text-muted">{{$actives->count()}} activities post.</small>
                </div>
            </div>
{{--        </div>--}}
{{--        <div class="col-sm-6 col-md-4 col-lg-3">--}}
            <div class="box-color p-a accent ml-3">
                <div class="pull-right ml-5 ">
            <span class="w-40 dker  rounded ml-3">
              <i class="material-icons">comment</i>
            </span>
                </div>
                <div class="clear">
                    <h4 class="m-0 text-md"><a href>{{$posts->count()}}<span class="text-sm"> Posts</span></a></h4>
                    <small class="text-muted">{{$comments->count()}} Comments.</small>
                </div>
            </div>
{{--        </div>--}}

    <div class="container w-300">
    <div class="col-md light lt b-l">
        <div class="p-a b-b">
            <a href class="clear">

                <span class="clear hidden-folded p-x">
			      <span class="block _500">{{"All Users"}}</span>
			    </span>
            </a>
        </div>
        <div class="list-group no-radius no-borders light lt">
            @foreach($users as $user)
                <div class="box-body " style="border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
">
                <a  href="{{route('profile',$user->id)}}"data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-x-md text-ellipsis">
                    <img src="../{{$user->profile_picture}}" class="w-24 m-r-sm img-circle">
                    <span>{{$user->name}}</span>
                    @if($user->role->name == "admin")
                        <span class="label label-sm red  pull-up m-l-sm  ">{{"admin"}}</span>

                        <div class="btn-container">
                            <a class="btn-btn bg-danger " style="color:white;padding: 5px" href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are you sure you want to remove this user?')">
                                Delete
                            </a>

                            <a class="btn-btn " style="background-color: silver; color:white; padding:5px" href="{{route('user.revokeAdmin',$user->id)}}" onclick="return confirm('Are you sure you want to revoke admin to this user?')">
                                Revoke Admin
                            </a>
                        </div>



                    @else
                        <div class="btn-container">
                    <a class="btn-btn bg-danger" style="color:white;padding: 5px" href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are you sure you want to remove this user?')">
                        Delete
                    </a>

                            <a class="btn-btn "style="background-color: silver; color:white; padding:5px" href="{{route('user.makeAdmin',$user->id)}}" onclick="return confirm('Are you sure you want to make admin to this user?')">
                                Make Admin
                            </a>
                        </div>
                    @endif
                </a>
                </div>
            @endforeach

        </div>
    </div>
        <div class="box-footer">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>
@endsection
