<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // Обработка ошибки 404
        }
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Валидация входных данных
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Создание нового пользователя
         User::create($validated);

        return redirect()->route('home')->with('success', 'User created successfully.');
    }
}