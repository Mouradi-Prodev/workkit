<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getFullName(): string
    {
        return $this->name . ' '.$this->last_name;
    }
    public function getRole():string
    {
        $role = $this->roles[0]->name;
        if($role == 'admin') return 'Admin';
        else if($role == 'team_lead') return 'Team Leader';
        else if($role == 'user') return 'Member';
        return null;
    }


    public function chat_rooms(): BelongsToMany
    {
        return $this->belongsToMany(ChatRoom::class)->withTimestamps();
    }

    public function messages():HasMany
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }

    public function canJoinRoom($chat_room_id)
    {
        // Logic to determine if the user can join the chat room
        // For example, you might check if the user is a member of the chat room
        return $this->chat_rooms()->where('chat_room_id', $chat_room_id)->exists();
    }
}
