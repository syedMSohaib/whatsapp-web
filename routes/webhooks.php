<?php

/*
|--------------------------------------------------------------------------
| Webhooks Routes
|--------------------------------------------------------------------------
|
| Here is where you can register webhooks routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Webhooks\MessageBirdController;
use Illuminate\Support\Facades\Route;

Route::post('message-bird', [MessageBirdController::class])->name('message-bird');
