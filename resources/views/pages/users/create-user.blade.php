@extends('layouts.master')

<head>
    <style>
        body {
             /* إزالة المسافات الافتراضية من جميع الأطراف */
            font-family: Arial, sans-serif; /* تعيين خط افتراضي */
        }
        .container {
            display: flex; /* استخدام Flexbox */
            flex-direction: row; /* تحديد الاتجاه الأفقي */
            padding: 0; /* إزالة المسافة الداخلية العامة */
            box-sizing: border-box; /* تضمين الحواف في الحسابات */
            background-color: #f3f3f3; /* لون خلفية خفيف */

        }
        .form-container {
            width: 50%; /* تحديد عرض كل قسم ليأخذ نصف العرض */
            display: flex;
            justify-content: center; /* توسيط المحتوى أفقياً */
             /* توسيط المحتوى عمودياً */
            padding: 20px; /* إضافة مسافة داخلية للمحتوى */
            box-sizing: border-box; /* تضمين الحواف في الحسابات */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل للفورم */
        }
        .image-container{
          width:50%;
            padding: 20px;
        }
        .image-container img {

            width: 100%; /* جعل الصورة تأخذ عرض العنصر الحاوي بالكامل */
            height: 75%; /* جعل الصورة تأخذ ارتفاع العنصر الحاوي بالكامل */
            object-fit: cover; /* ملء العنصر دون تغيير النسبة الأصلية */

        }
        .form-container {

            padding: 30px; /* مسافة داخلية للفورم */
            border-radius: 10px; /* زوايا دائرية للفورم */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل للفورم */
            max-width: 500px; /* أقصى عرض للفورم */
            display: flex;
            flex-direction: column; /* ترتيب العناصر عمودياً */
            gap: 15px; /* المسافة بين العناصر */
            color: white; /* لون النص في الفورم */
        }
        .form-input {
            width: 100%; /* عرض كامل لحقول الإدخال */
            padding: 10px; /* مسافة داخلية لحقول الإدخال */
            border-radius: 5px; /* زوايا دائرية لحقول الإدخال */
            border: none; /* إزالة الحدود */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* ظل لحقول الإدخال */
            margin-top: 5px; /* مسافة أعلى الـ input */
        }
        label {
            color:  #6f2877; /* لون النص */
            margin-bottom: 5px; /* مسافة أسفل الـ label */
            display: block; /* جعل label ككتلة لسهولة التحكم في المسافات */
        }
        select {
            width: 100%; /* عرض كامل لعناصر الـ select */
            padding: 10px; /* مسافة داخلية لعناصر الـ select */
            border-radius: 5px; /* زوايا دائرية لعناصر الـ select */
            border: none; /* إزالة الحدود */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* ظل لعناصر الـ select */
            margin-top: 5px; /* مسافة أعلى الـ select */
        }
        button {
            background-color: silver;
            padding: 10px 15px; /* مسافة داخلية للزر */
            border: none; /* إزالة الحدود */
            border-radius: 5px; /* زوايا دائرية للزر */
            cursor: pointer; /* مؤشر اليد عند التمرير فوق الزر */
        }
        button:hover {
            background-color:  #6f2877; /* تغيير لون الخلفية عند التمرير فوق الزر */
        }
        .alert {
            padding: 10px; /* مسافة داخلية للرسائل */
            border-radius: 5px; /* زوايا دائرية للرسائل */
            margin-bottom: 20px; /* مسافة أسفل الرسائل */
            width: 100%; /* عرض كامل للرسائل */
        }
        .alert-success {
            background-color: #d4edda; /* خلفية للرسائل الناجحة */
            color: #155724; /* لون النص للرسائل الناجحة */
        }
        .alert-danger {
            background-color: #f8d7da; /* خلفية للرسائل الخاطئة */
            color: #721c24; /* لون النص للرسائل الخاطئة */
        }
    </style>
</head>

@section('content')
    <div class="container" style="width: 800px" >
        <!-- قسم الصورة -->
        <div class="image-container" style="height: 600px ;margin-top: 20px">
            <img src="images/darrebni2.png" alt="Description of Image" >
        </div>

        <!-- قسم الفورم -->
        <div class="form-container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div style="max-width: 100px;max-height: 100px;">
                <img src="images/logo.jpg" width="100%" height="auto">
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Display All Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone number -->
                <div class="mt-4">
                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                    <x-text-input id="phone_number" class="form-input" type="text" name="phone_number" :value="old('phone_number')" required />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <!-- Social Media Links -->
                <div class="mt-4">
                    <x-input-label for="facebook" :value="__('Facebook Profile')" />
                    <x-text-input id="facebook" class="form-input" type="url" name="facebook" :value="old('facebook')" />
                    <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="linkedin" :value="__('LinkedIn Profile')" />
                    <x-text-input id="linkedin" class="form-input" type="url" name="linkedin" :value="old('linkedin')" />
                    <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="twitter" :value="__('Twitter Profile')" />
                    <x-text-input id="twitter" class="form-input" type="url" name="twitter" :value="old('twitter')" />
                    <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="gmail" :value="__('Gmail')" />
                    <x-text-input id="gmail" class="form-input" type="email" name="gmail" :value="old('gmail')" />
                    <x-input-error :messages="$errors->get('gmail')" class="mt-2" />
                </div>

                <!-- Profile Picture -->
                <div class="mt-4">
                    <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                    <input id="profile_picture" class="form-input" type="file" name="profile_picture" accept="image/*" />
                    <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                @if(auth()->user() && auth()->user()->role->name == "admin")
                    <!-- Role Selection for Admin -->
                    <div class="mt-4">
                        <x-input-label for="role_id" :value="__('Role')" />
                        <select id="role_id" name="role_id" class="form-input">
                            <option value="" disabled selected>Select a role</option>
                            <option value="3">Coach</option>
                            <option value="4">Trainee</option>
                        </select>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>
                @endif

                @if(auth()->user() && auth()->user()->role->name == "superAdmin")
                    <!-- Role Selection for SuperAdmin -->
                    <div class="mt-4">
                        <x-input-label for="role_id" :value="__('Role')" />
                        <select id="role_id" name="role_id" class="form-input">
                            <option value="" disabled selected>Select a role</option>
                            <option value="2">Admin</option>
                            <option value="3">Coach</option>
                            <option value="4">Trainee</option>
                        </select>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
