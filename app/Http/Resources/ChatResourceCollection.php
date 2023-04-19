<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatResourceCollection extends ResourceCollection
{
    protected $user_id;

    public function __construct($resource, $user_id)
    {
        parent::__construct($resource);
        $this->user_id = $user_id;
    }

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($chat) {
                return new ChatResource($chat, $this->user_id);
            })
        ];
    }
}
