<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChatRoomRequest;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createChatRoom(CreateChatRoomRequest $request)
    {
        $validated = $request->validated();

        $chatRoom = auth()->user()->chatRooms()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return response([
            'chat_room' => $chatRoom
        ]);
    }

    public function selectUsersToJoinChatRoom($chatRoom, array $users)
    {
        $chatRoom = ChatRoom::findOrFail($chatRoom);


    }
}
