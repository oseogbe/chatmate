<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function inviteToChat(Request $request)
    {
        $request->validate([
            'email'       => ['required', 'email:rfc,dns'],
            'invite_type' => ['required', 'string', 'in:chat,chatroom'],
        ],[
            'email.email' => "Please enter a valid email address",
        ]);

        auth()->user()->invitations()->create([
            'invitee' => $request->email,
            'invite_type' => $request->invite_type
        ]);

        return response()->json([
            'message' => 'Chat invitation sent!'
        ]);
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = auth()->user();

        $message = $user->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageSentEvent($user, $message))->toOthers();

        return response(['status' => 'Message Sent!']);
    }
}
