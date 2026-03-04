<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Правильно для простых текстовых ответов
Route::get('/hello-inline', function () {
    return 'Hello, Laravel!';
});

// ✅ Правильно для контроллера, возвращающего view
Route::get('/hello', [HelloController::class, 'index']);


