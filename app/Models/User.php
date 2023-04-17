<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'profile_pic'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function myChats()
    {
        return $this->hasMany(Chat::class, 'user1');
    }

    public function chats($user_id)
    {
        return static::where('user1', $user_id)->orWhere('user2', $user_id);
    }

    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class, 'created_by');
    }

    public static function otherUsers()
    {
        return static::whereNot('id', auth()->id());
    }

    public function invitations()
    {
        return $this->hasMany(ChatInvitation::class, 'inviter');
    }

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? false,
    //         fn ($query, $search) =>
    //             $query->where('name', 'like', '%'.$search.'%')
    //                 ->orWhere('email', 'like', '%'.$search.'%')
    //     );

    //     $query->when($filters['room'] ?? false,
    //         fn ($query, $room) =>
    //             $query->whereHas('chatRooms',
    //                 fn ($query) => $query->where('name', $room)
    //             )
    //     );
    // }

    public function scopeFilter($query)
    {
        $query->when(request('search'), fn ($query) =>
            $query->where('name', 'like', '%'.request('search').'%'))
                    ->orWhere('username', 'like', '%'.request('search').'%')
                    ->orWhere('email', 'like', '%'.request('search').'%')
        ->when(request('sortBy'), fn ($query) =>
                $query->orderBy(request('sortBy'), request('direction', 'asc')));
    }
}
