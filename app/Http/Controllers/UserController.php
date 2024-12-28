<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = ['name' => 'John Doe', 'id' => $id]; // Пример данных
        return view('user.profile', ['user' => $user]); // Передача данных в шаблон
    }
}