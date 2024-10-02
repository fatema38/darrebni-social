<!doctype html>
<html lang="en">
<head>
    <style>
        body {
            margin: 0; /* إزالة المسافات الافتراضية من جميع الأطراف */
            font-family: Arial, sans-serif; /* تعيين خط افتراضي */
        }

        .container {
            display: flex; /* استخدام Flexbox */
            height: 100vh; /* جعل الارتفاع يساوي ارتفاع نافذة العرض */
            background-image: url('images/bg.jpg');
        }
        .image-container {
            flex: 1; /* لتغطية النصف الأيسر من العرض */
            background: url('images/logo.jpg') no-repeat center center; /* استخدام الصورة كخلفية */
            background-size: cover; /* توسيع الصورة لتغطية الخلفية بالكامل */
            height: 40%; /* ضمان أن ارتفاع الحاوية يكون 100% */
            width: 40%; /* ضمان أن عرض الحاوية يكون 100% */
            margin-top: 150px;
        }



        .form-container {
            flex: 1; /* لتغطية النصف الأيمن من العرض */
            display: flex;
            justify-content: center;
            align-items: center; /* تغيير align-items إلى center لمحاذاة العناصر بالوسط */
            padding: 0; /* إزالة المسافة الداخلية */
            box-sizing: border-box; /* تضمين الحواف في الحسابات */
            margin-top: 350px;


        }

        .form-wrapper {
            background-color: #6f2877; /* لون الخلفية للفورم */
            padding: 50px; /* مسافة داخلية للفورم */
            border-radius: 10px; /* زوايا دائرية للفورم */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل للفورم */
            width: 50%; /* عرض كامل للحاوية */
            max-width: 500px; /* أقصى عرض للفورم */
            display: flex;
            flex-direction: column; /* ترتيب العناصر عمودياً */
            gap: 15px; /* المسافة بين العناصر */
            margin-top: 50px /* إزالة المسافة العلوية للفورم */
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

        .link-container {
            display: flex;
            justify-content: space-between; /* توزيع الروابط بالتساوي */
            margin-top: 15px; /* مسافة أعلى العنصر */
        }

        .link-container a {
            font-size: 14px; /* حجم الخط */
            color: #e0e0e0; /* لون النص */
            text-decoration: none; /* إزالة الخط السفلي */
        }

        .link-container a:hover {
            text-decoration: underline; /* إضافة الخط السفلي عند التمرير فوق الرابط */
        }

        .alert {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .alert-danger {
            background-color: #f2dede;
            color: #a94442;
        }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="image-container">
        <!-- الصورة كخلفية للجزء الأيسر -->
    </div>
    <div class="form-container">
        <div class="form-wrapper">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

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
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone number -->
                <div>
                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                    <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <!-- Social Media Links -->
                <div>
                    <x-input-label for="facebook" :value="__('Facebook Profile')" />
                    <x-text-input id="facebook" class="block mt-1 w-full" type="url" name="facebook" :value="old('facebook')" />
                    <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="linkedin" :value="__('LinkedIn Profile')" />
                    <x-text-input id="linkedin" class="block mt-1 w-full" type="url" name="linkedin" :value="old('linkedin')" />
                    <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="twitter" :value="__('Twitter Profile')" />
                    <x-text-input id="twitter" class="block mt-1 w-full" type="url" name="twitter" :value="old('twitter')" />
                    <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="gmail" :value="__('Gmail')" />
                    <x-text-input id="gmail" class="block mt-1 w-full" type="email" name="gmail" :value="old('gmail')" />
                    <x-input-error :messages="$errors->get('gmail')" class="mt-2" />
                </div>

                <!-- Profile Picture -->
                <div>
                    <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                    <input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" accept="image/*" />
                    <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="link-container">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
