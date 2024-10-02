@extends('layouts.master')
@section('content')
    <div class="container-lg padding">
<form action="{{route('register.followers',$group->id)}}" method="post">
    @csrf
    <h4>{{"Join Users To Group $group->name"}}</h4>
    <br>
    @foreach($followers as $follower)
        <div class="box-body " style="border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
">
            <img src="{{asset($follower->profile_picture)}}" class="w-24 m-r-sm img-circle">
        <lable>{{$follower->name}}</lable>
        <input type="checkbox" name="users[]" value="{{$follower->id}}">

        </div>
    @endforeach
    <br><br>
    <button  class="btn-btn-sm" style=" background-color: silver ; color:white" type=submit">Join</button>
    <br>
    <a   class="btn-btn-primary" href="{{route('group.show',$group->id)}}">back to group</a>
</form>
    </div>
@endsection
