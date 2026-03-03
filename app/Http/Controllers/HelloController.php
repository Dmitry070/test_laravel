<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        // передаём данные в шаблон
        return view('hello', ['name' => 'Dmitry']);
    }
}
