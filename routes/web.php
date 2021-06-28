<?php

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

use App\Events\MessageSent;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\Webhooks\MessageBirdController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Broadcast::routes(['middleware' => 'auth']);


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

Route::get('listen',function(){

	return view('listenBroadcast');
});

Route::middleware('auth')->prefix('conversations')->name('conversations.')->group(function () {
    Route::get('/', [ConversationController::class, 'index'])->name('index');

    Route::get('{conversation}', [ConversationController::class, 'show'])->name('show');

    Route::get('/{conversation_id}/archive/', [ConversationController::class, 'archiveConversation'])
        ->name('archive-conversation');

    Route::get('/{conversation_id}/unarchive', [ConversationController::class, 'unarchiveConversation'])
        ->name('unarchive-conversation');
});


Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
});

Route::post('chat-api-web-hook', [MessageBirdController::class, 'index'])->name('message-bird');
