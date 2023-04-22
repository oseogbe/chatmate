<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chatmate', function($user) {
    return true;
});

Broadcast::channel('chatmate.chats.{chat_id}', function($user, $chat_id) {
    return in_array((int) $chat_id, $user->chats()->pluck('id')->toArray());
});
