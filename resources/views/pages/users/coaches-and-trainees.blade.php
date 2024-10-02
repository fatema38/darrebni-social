@extends('layouts.master')
@section('content')

    <style>
        .btn-container {
            display: flex;
            gap: 10px; /* مسافة بين الروابط */
        }
    </style>
    <div class="col-md w-lg w-auto-sm light lt b-l">
        <div class="p-a b-b">
            <a href class="clear">

                <span class="clear hidden-folded p-x">
			      <span class="block _500">{{"Coaches And Trainees"}}</span>
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
                    @if($user->role->name == "coach")
                        <span class="label label-sm warn  pull-up m-l-sm  ">{{"coach"}}</span>

                        <div class="btn-container">
                            <a class="btn-btn bg-danger" style="color:white;padding: 5px" href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are you sure you want to remove this user?')">
                                Delete
                            </a>

                            <a class="btn-btn "style="background-color: silver; color:white; padding:5px" href="{{route('user.revokeCoach',$user->id)}}" onclick="return confirm('Are you sure you want to revoke coach to this user?')">
                                Revoke coach
                            </a>
                        </div>



                    @else
                        <div class="btn-container">
                            <a class="btn-btn bg-danger"style="color:white;padding: 5px" href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are you sure you want to remove this user?')">
                                Delete
                            </a>

                            <a class="btn-btn "style="background-color: silver; color:white; padding:5px" href="{{route('user.makeCoach',$user->id)}}" onclick="return confirm('Are you sure you want to make coach to this user?')">
                                Make Coach
                            </a>
                        </div>
                    @endif
                </a>
                </div>
            @endforeach

        </div>
    </div>
    </div>
@endsection
