<?php

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

use App\Http\Controllers\API\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('conversations')->name('conversations.')->group(function () {
    Route::prefix('{conversation}')->group(function () {
        Route::get('messages', [MessageController::class, 'get'])->name('get');

        Route::post('messages', [MessageController::class, 'send'])->name('send');
    });
});



Route::post('webhooks/message-bird', [MessageBirdController::class, 'invoke'])->name('webhooks.message-bird');
