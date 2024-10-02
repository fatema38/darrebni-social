@extends('layouts.master')
@section('content')
    <h4>Duplicate Tags</h4>
    <div class="container padding">
    <ul>

        @foreach ($duplicateTags as $tag => $count)

            <div class="box-body " style="border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
">


                <li class="padding" >{{ $tag }} ({{ $count }})  <a href="{{route('tag.store',$tag)}}" class="btn-md" style=" background-color: silver ; color:white; margin-left: 40px">Add To Main Tags</a></li>
            </div>
        @endforeach
    </ul>
    </div>

@endsection
