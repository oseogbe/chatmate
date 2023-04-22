<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Http\Resources\ChatResourceCollection;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\ChatInvitation;
use App\Models\Message;
use App\Notifications\ChatInvitationAccepted;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $chats = (new ChatResourceCollection(auth()->user()->chats, auth()->id()))->jsonSerialize();
        return view('chats', compact('chats'));
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
            'chat' => $invitation->from->myChats()->create(['user2' => auth()->id()]),
            'chatroom' => null,
            default => null,
        };

        // send chat invitation accepted notification
        $invitation->from->notify(new ChatInvitationAccepted($invitation));

        // return chats view
        return redirect()->route('chats');
    }

    public function fetchMessages($chat_id)
    {
        $messages = Message::whereHasMorph(
            'messageable',
            [Chat::class],
            function(Builder $query) use ($chat_id) {
                $query->where('id', $chat_id);
            }
        )->get();

        return MessageResource::collection($messages);
    }

    public function sendMessage(Request $request, $chat_id)
    {
        $chat = Chat::find($chat_id);

        $chat->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        // broadcast(new MessageSentEvent($chat_id, $request->message))->toOthers();

        event(new MessageSentEvent($chat_id, $request->message));

        return response()->json([
            'status' => 'Message Sent!'
        ]);
    }

}
