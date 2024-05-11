<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;


    public function chat_room():BelongsTo
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
