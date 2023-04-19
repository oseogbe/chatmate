<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2');
    }
}
