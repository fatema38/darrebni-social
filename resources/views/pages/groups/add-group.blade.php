@extends('layouts.master')

<head>
    <style>
        .container {
            display: flex;
            flex-direction: row; /* تغيير الاتجاه إلى صف */
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            background-color: #f3f3f3;
        }

        .image-container {
            margin-right: 20px; /* إضافة مسافة بين الصورة والفورم */
            margin-bottom: 55px;
        }

        .form-container {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-container label {

            margin-bottom: 5px;
        }

        .form-container input[type="text"],
        .form-container select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .form-container input[type="file"] {
             margin-bottom: 15px;
            margin-top: 15px;
        }

        .form-container button {
            background-color: silver;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color:  #6f2877;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* تغيير الاتجاه إلى عمود للأجهزة الصغيرة */
                padding: 10px;
            }

            .image-container {
                margin-bottom: 20px; /* إضافة مسافة بين الصورة والفورم عند الاتجاه العمودي */
            }

            .form-container {
                max-width: 100%;
            }
        }
    </style>
</head>

@section('content')
    <div class="container">
        <!-- قسم الصورة -->
        <div class="image-container">
            <img src="images/R1.gif" alt="صورة" style=" max-width: 100%; height: auto; border-radius: 10px;">
        </div>

        <!-- قسم الفورم -->
        <div class="form-container">
            <form action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="group_name">Group Name</label>
                <input type="text" id="group_name" name="group_name">

                <label for="description">Description</label>
                <input type="text" id="description" name="description">

                <label for="image">Group Image</label>
                <input type="file" id="image" name="image">

                @if(auth()->user()->role->name == "admin" || auth()->user()->role->name == "superAdmin")
                    <div>
                        <label for="owner_id">Choose Owner</label>
                        <select id="owner_id" name="owner_id">
                            @foreach($coaches as $coach)
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <button class="btn btn-sm rounded success" type="submit">Add</button>
            </form>
        </div>
    </div>
@endsection
