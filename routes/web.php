<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('upload_audio', [App\Http\Controllers\HomeController::class, 'uploadAudio'])->name('upload_audio');
