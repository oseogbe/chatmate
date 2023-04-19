<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/users', [UserController::class, 'viewUsers']);

Route::get('/chats', [ChatController::class, 'index'])->name('chats');
Route::get('/chat/{token}/accept', [ChatController::class, 'acceptInvitation'])->withoutMiddleware(['auth'])->name('accept.invitation');

Route::get('/messages', [ChatControllerAPI::class, 'fetchMessages']);
Route::post('/chats/{chat_id}/message', [ChatControllerAPI::class, 'sendMessage']);
Route::post('/invite-to-chat', [ChatControllerAPI::class, 'inviteToChat']);
