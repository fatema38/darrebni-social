@extends('layouts.master')
<head>
    <style>



        /* تنسيق الـ box */
        .box1 {
            background-color: #f3f3f3; /* لون الخلفية الرمادي */
            padding: 20px;
            border: 10px; /* حواف منحنية */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل خفيف */
            margin: 100px 100px; /* مسافة من الأعلى والأسفل */
            width: 50%;

        }

        /* تنسيق عناصر القائمة */
        .list-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd; /* خط سفلي */
        }

        /* تنسيق الـ avatar */
        .avatar {
            background-color: #6f2877; /* اللون البنفسجي */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            margin-right: 15px; /* مسافة من اليمين */

        }

        /* تنسيق النصوص الصغيرة */
        .text-muted {
            color: #888; /* اللون الرمادي للنصوص الصغيرة */
        }

        /* تنسيق الأزرار */
        .btn.success {
            background-color: silver; /* اللون البنفسجي */
            color: white;
            margin-left: 5px;
        }

        .btn.danger {
            background-color: #d9534f; /* لون أحمر للأزرار الخطيرة */
            color: white;
            margin-left: 5px;
        }

        .btn:hover {
            opacity: 0.8; /* تأثير بسيط عند التمرير */

        }
    </style>
</head>
@section('content')

    <div class="box1">
        <ul class="list inset m-0">
            @foreach($groups as $group)
                <li class="list-item">
                    <a href="" class="pull-left m-r-md">

            <span class="avatar w-90">
                 <img src="{{asset($group->image_path)}}">

              <i class="on b-white"></i>
            </span></a>

                    <div class="list-body">
                        <div>
                            <a href="{{route('group.show',$group->id)}}">{{$group->name}}</a>

                            @if(!auth()->user()->isMemberOfGroup($group->id))
                                <a href="{{route('user.register',$group->id)}}" class="btn btn-sm rounded success pull-right">Register</a>
                            @endif
                            <a href="{{route('group.show',$group->id)}}" class="btn btn-sm rounded success pull-right">Show Group</a>
                            @if(auth()->user()->isAdminOfGroup($group->id) )
                                <a href="{{route('group.delete',$group->id)}}" class="btn btn-sm rounded danger pull-right">Delete Group</a>
                            @endif
                        </div>
                        <small class="text-muted text-ellipsis">{{$group->description}}</small>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
