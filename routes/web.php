<?php

use Illuminate\Support\Facades\Route;

#Route::get('/', function () {
#    return view('welcome');
#});

Route::get('/', [HomeController::class, 'index'])->name('home'); // Маршрут к методу index контроллера HomeController, с именем 'home'

Route::get('/hello', function () {
    return 'Hello, World!'; // Простое текстовое сообщение
});

Route::get('/users/{id}', function ($id) {
    return 'User ID: ' . $id; // Параметр в маршруте
});