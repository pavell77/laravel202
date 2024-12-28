<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello, World!'; // Простое текстовое сообщение
});

Route::get('/users/{id}', function ($id) {
    return 'User ID: ' . $id; // Параметр в маршруте
});