<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class MessagePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, ChatRoom $chatroom)
    {

        $chatroomUser = $user->chat_rooms;
        foreach($chatroomUser as $chat)
        {
            if($chat->id == $chatroom->id) return true;
        }
        return false;
        
    }
}
