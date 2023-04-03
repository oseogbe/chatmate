<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email' => ['required', 'email:rfc,dns']
        ],[
            'email.email' => "Please enter a valid email address",
        ]);

        return $request->email;
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->message
        ]);
        broadcast(new MessageSentEvent($user, $message))->toOthers();
        return response(['status' => 'Message Sent!']);
    }
}
