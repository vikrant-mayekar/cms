<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'login')->name('login');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/content', 'content')->name('content');
Route::view('/categories', 'categories')->name('categories');