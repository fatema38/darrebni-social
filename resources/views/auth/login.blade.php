<!doctype html>
<html lang="en">
<head>
    <style>

        .container {
            background-image: url('images/bg.jpg'); /* استبدل المسار بمسار صورتك */
            display: flex; /* استخدام Flexbox */
            flex-direction: row; /* تحديد الاتجاه الأفقي */
            justify-content: center; /* توسيط المحتوى أفقياً */
            align-items: center; /* توسيط المحتوى عمودياً */
            min-height: 100vh; /* جعل الحد الأدنى للارتفاع هو 100% من ارتفاع العرض */
            padding: 0; /* إضافة مسافة داخلية للمحتوى */
            box-sizing: border-box; /* تضمين الحواف في الحسابات */
            background-color: #f3f3f3; /* لون خلفية خفيف */


        }
        .image-container, .form-container {
            flex: 1; /* تقسيم الحاوية إلى نصفين */
        }
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; /* إضافة مسافة داخلية للصورة */
        }
        .image-container img {
            max-width: 100%; /* ضمان أن الصورة لا تتعدى عرض العنصر الحاوي */
            height: auto; /* الحفاظ على نسبة العرض إلى الارتفاع */
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; /* إضافة مسافة داخلية للفورم */
        }
        .form-container form {
            background-color: #6f2877; /* لون الخلفية للفورم */
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
        }
        input[type="email"],
        input[type="password"] {
            width: 100%; /* عرض كامل لحقول الإدخال */
            padding: 10px; /* مسافة داخلية لحقول الإدخال */
            border-radius: 5px; /* زوايا دائرية لحقول الإدخال */
            border: none; /* إزالة الحدود */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* ظل لحقول الإدخال */
            margin-top: 10px; /* مسافة أعلى الـ input */
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 10px; /* مسافة أعلى العنصر */
        }
        .checkbox-container label {
            margin-left: 10px; /* مسافة يسار العنصر */
            color: #e0e0e0; /* لون النص */
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
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>

</head>
<body>
<div class="container">
    <div class="image-container">
        <img src="images/darrebni.png" alt="Image">
    </div>
    <div class="form-container">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="checkbox-container">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <!-- Links -->
            <div class="link-container">
                <a href="{{ route('register') }}">{{ __('register') }}</a>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
<script>
    window.onload = function() {
        gsap.from(".image-container img", {
            duration: 1.5,
            y: -100,
            ease: "bounce.out",
            opacity: 0,
            delay: 0.5
        });
    };
</script>
</body>
</html>
