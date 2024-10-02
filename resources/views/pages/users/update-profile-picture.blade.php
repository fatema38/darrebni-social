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
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- حقل الاسم -->
        <div>
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
            @error('name')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل البريد الإلكتروني -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            @error('email')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل كلمة المرور -->
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password">
            @error('password')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل تأكيد كلمة المرور -->
        <div>
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
            @error('password_confirmation')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل رقم الهاتف -->
        <div>
            <label for="phone_number">{{ __('Phone Number') }}</label>
            <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" required>
            @error('phone_number')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل رابط فيسبوك -->
        <div>
            <label for="facebook">{{ __('Facebook') }}</label>
            <input id="facebook" type="url" name="facebook" value="{{ old('facebook', auth()->user()->facebook) }}">
            @error('facebook')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل رابط لينكدإن -->
        <div>
            <label for="linkedin">{{ __('LinkedIn') }}</label>
            <input id="linkedin" type="url" name="linkedin" value="{{ old('linkedin', auth()->user()->linkedin) }}">
            @error('linkedin')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل رابط تويتر -->
        <div>
            <label for="twitter">{{ __('Twitter') }}</label>
            <input id="twitter" type="url" name="twitter" value="{{ old('twitter', auth()->user()->twitter) }}">
            @error('twitter')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل جيميل -->
        <div>
            <label for="gmail">{{ __('Gmail') }}</label>
            <input id="gmail" type="email" name="gmail" value="{{ old('gmail', auth()->user()->gmail) }}">
            @error('gmail')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- حقل رفع الصورة الشخصية الجديدة -->
        <div>
            <label for="profile_picture">{{ __('Update Profile Picture') }}</label>
            <br><br>
            <input id="profile_picture" type="file" name="profile_picture" accept="image/*">
            @error('profile_picture')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- زر التحديث -->
        <div>
            <button type="submit">
                {{ __('Update Profile') }}
            </button>
        </div>
    </form>
        </div>

@endsection
