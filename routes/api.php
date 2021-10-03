<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->post('/subscribe_user', [App\Http\Controllers\HomeController::class, 'subscribe_user']);
Route::middleware('auth:api')->post('/submit_post', [App\Http\Controllers\HomeController::class, 'submit_post'])->name('submit_post');
