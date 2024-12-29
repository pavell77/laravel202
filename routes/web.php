<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


#Route::get('/', [HomeController::class, 'index'])->name('home'); // Маршрут к методу index контроллера HomeController, с именем 'home'

#Route::get('/hello', function () {
#    return 'Hello, World!'; // Простое текстовое сообщение
#});

#Route::get('/users/{id}', function ($id) {
#    return 'User ID: ' . $id; // Параметр в маршруте
#});