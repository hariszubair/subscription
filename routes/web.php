<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/subscribe', [App\Http\Controllers\HomeController::class, 'subscribe'])->name('subscribe');
Route::post('/subscribe_user', [App\Http\Controllers\HomeController::class, 'subscribe_user'])->name('subscribe_user');
Route::get('/publish_post', [App\Http\Controllers\HomeController::class, 'publish_post'])->name('publish_post');
Route::post('/submit_post', [App\Http\Controllers\HomeController::class, 'submit_post'])->name('submit_post');
