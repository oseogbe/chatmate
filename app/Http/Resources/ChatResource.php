<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    protected $user_id;

    public function __construct($resource, int $user_id)
    {
        parent::__construct($resource);
        $this->user_id = $user_id;
    }

    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id == $this->user1 ? $this->user2 : $this->user1);

        return [
            'id' => $this->id,
            'contact' => [
                'name' => $user->name,
                'username' => $user->username,
                'profile_pic' => $user->profile_pic,
                'bio' => $user->bio,
            ],
            // 'messages' => MessageResource::collection($this->messages)
        ];
    }
}
