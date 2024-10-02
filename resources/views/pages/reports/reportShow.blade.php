@extends('layouts.master')
@section('content')




    <div class="row no-gutter box w-auto ">
        <div class="col">
            <div class="box-header">
                <h3> Add Report</h3>
            </div>
            <div class="box-body">
                <form action="{{route('report.store')}}" method="post">
                    @csrf
                    <input type=hidden name="post_id" value="{{$post_id}}">
                    <input  type="text" name="note">
                    <br><br>
                    <button class="btn btn-sm rounded "  type="submit" >Report</button>
                </form>

            </div>
        </div>

    </div>
@endsection
