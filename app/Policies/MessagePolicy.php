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
        return $user->chat_rooms()->where(['chat_room_id' => $chatroom->id])->exists();
    }
    public function create(User $user): bool
    {
        return $user->hasRole('team_lead');
    }
}
