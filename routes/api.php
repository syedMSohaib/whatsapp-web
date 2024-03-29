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
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\Webhooks\MessageBirdController;
use Illuminate\Support\Facades\Route;

Route::prefix('conversations')->name('conversations.')->group(function () {

    Route::get('all', [ConversationController::class, 'getConversations'])->name('getConversations');

    Route::prefix('{conversation}')->group(function () {

        Route::get('messages', [MessageController::class, 'get'])->name('get');

        Route::post('messages', [MessageController::class, 'send'])->name('send');
    });
});



Route::post('incomming-wb/message-bird', [
    MessageBirdController::class, 'index'])->name('webhooks.message-bird');
