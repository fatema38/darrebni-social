@extends('layouts.master')
<head>
    <style>

        .form-container{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; /* إضافة مسافة داخلية للفورم */
        }
        .form-container form {
            background-color: silver; /* لون الخلفية للفورم */
            padding: 30px; /* مسافة داخلية للفورم */
            border-radius: 10px; /* زوايا دائرية للفورم */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل للفورم */
            width: 100%; /* عرض كامل للحاوية */
            max-width: 400px; /* أقصى عرض للفورم */
            display: flex;
            flex-direction: column; /* ترتيب العناصر عمودياً */
            gap: 15px; /* المسافة بين العناصر */
        }
        .form-container form div {
            width: 100%; /* عرض كامل لكل عنصر داخل الفورم */
        }

        label {
            color: white; /* لون النص */
            margin-bottom: 10px; /* مسافة أسفل الـ label */
            display: block; /* جعل label ككتلة لسهولة التحكم في المسافات */
        }

        input[type="email"],
        input[type="text"],
        input[type="url"],
        input[type="password"],
        input[type="file"] {
            width: 100%; /* عرض كامل لحقول الإدخال */
            padding: 10px; /* مسافة داخلية لحقول الإدخال */
            border-radius: 5px; /* زوايا دائرية لحقول الإدخال */
            border: none; /* إزالة الحدود */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* ظل لحقول الإدخال */
            margin-top: 5px; /* مسافة أعلى الـ input */
            margin-bottom: 10px; /* مسافة أعلى الـ input */
        }

        button {
            background-color: silver;
            padding: 10px 15px; /* مسافة داخلية للزر */
            border: none; /* إزالة الحدود */
            border-radius: 5px; /* زوايا دائرية للزر */
            cursor: pointer; /* مؤشر اليد عند التمرير فوق الزر */
        }

        button:hover {
            background-color: #ddd; /* تغيير لون الخلفية عند التمرير فوق الزر */
        }
    </style>
</head>
@section('content')

    <div class="form-container">
        <form method="POST" action="{{ route('group.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- حقل الاسم -->
            <div>
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name', $group->name) }}" required>

                @error('name')
                <span>{{ $message }}</span>
                @enderror
            </div>


            <div>
                <label for="description">{{ __('Description') }}</label>
                <input id="description" type="text" name="description" value="{{ old('description', $group->description) }}" required>
                @error('description')
                <span>{{ $message }}</span>
                @enderror
            </div>





            <!-- حقل رفع الصورة الشخصية الجديدة -->
            <div>
                <label for="group_picture">{{ __('Update Group Picture') }}</label>
                <br><br>
                <input id="group_picture" type="file" name="group_picture" accept="image/*">
                @error('group_picture')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" name="group_id" value="{{$group->id}}">

            <!-- زر التحديث -->
            <div>
                <button type="submit">
                    {{ __('Update Group') }}
                </button>
            </div>
        </form>
    </div>

@endsection
