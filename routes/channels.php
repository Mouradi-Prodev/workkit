<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{chat_room_id}', function (User $user, int $chat_room_id) {
     if ($user->canJoinRoom($chat_room_id)) {
        return ['id' => $user->id, 'name' => $user->name];
     }
});
Broadcast::channel('channel_for_everyone', function ($user) {
    return true;
});
