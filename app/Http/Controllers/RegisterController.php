<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Отображаем форму регистрации
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' проверяет совпадение с полем password_confirmation
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Возвращаем ошибку валидации
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Хешируем пароль перед сохранением (хотя в модели уже указан cast 'hashed', это для совместимости со старыми версиями)
        ]);

        auth()->login($user); // Автоматически авторизуем пользователя после регистрации

        return redirect()->route('home'); // Редирект на главную страницу
    }
}