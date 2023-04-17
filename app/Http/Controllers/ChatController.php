<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\ChatInvitation;
use App\Models\Message;
use App\Models\User;
use App\Notifications\ChatInvitationAccepted;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('chats');;
    }

    public function acceptInvitation(Request $request, $token)
    {
        $invitation = ChatInvitation::findOr($token, function() {
            abort(to_route('welcome'));
        });

        if($invitation->status == ChatInvitation::Accepted) {
            return redirect()->route('chats');
        }

        if (!auth()->check()) {
            session()->put('invitation_token', $token);
            return redirect()->route('register');
        }

        // Create the chat between the two users
        match(tap($invitation)->update(['status' => ChatInvitation::Accepted])->invite_type) {
            'chat' => User::find($invitation->inviter)->myChats()->create(['user2' => auth()->id()]),
            'chatroom' => null,
            default => null,
        };

        // send chat invitation accepted notification
        $invitation->from->notify(new ChatInvitationAccepted($invitation));

        // return chats view
        return redirect()->route('chats');
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
