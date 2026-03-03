<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', function () {
    return view('welcome');
});

// Маршрут для интерактивного API тестера
Route::get('/test', function () {
    return view('test');
});

// Простой маршрут, возвращающий строку
Route::get('/hello-inline', function () {
    return 'Hello, Laravel!';
});

// Маршрут на контроллер
Route::get('/hello', [HelloController::class, 'index']);
