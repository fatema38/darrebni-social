<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'max:10', 'min:9'],
            'role_id' => ['sometimes', 'required', 'integer', 'exists:roles,id'],
            'facebook' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'gmail' => ['nullable', 'email'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // التأكد من نوع الامتداد
        ]);

        // تحديد role_id بناءً على حالة تسجيل الدخول
        $role_id = Auth::check() ? $request->role_id : 4;

        // التعامل مع رفع الصورة
        if ($request->hasFile('profile_picture')) {
            // تحديد المسار داخل مجلد public/images
            $destinationPath = 'images/profile_pictures';

            // توليد اسم فريد للصورة
            $profilePictureName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();

            // تخزين الصورة في المسار المحدد
            $request->file('profile_picture')->move(public_path($destinationPath), $profilePictureName);

            // تخزين المسار الكامل للصورة في قاعدة البيانات
            $profile_picture_path = $destinationPath . '/' . $profilePictureName;
        }

        else {
            // إذا لم يتم رفع صورة، يتم تعيين الصورة الافتراضية
            $profile_picture_path = 'images/default/profile_picture.jpg';
        }

        // إنشاء المستخدم الجديد
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role_id' => $role_id,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'gmail' => $request->gmail,
            'profile_picture' => $profile_picture_path,
        ]);

        event(new Registered($user));



        // تعيين رسالة تنبيه للجلسة
        session()->flash('success', 'Register successfully');

        return redirect()->back();
    }

}
