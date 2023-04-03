<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatInvitation extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected $table = 'chat_invitation';

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = generateRandomString();
        });
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'inviter');
    }
}
