<?php

namespace App\Observers;

use App\Mail\ChatInvitationMail;
use App\Models\ChatInvitation;
use Illuminate\Support\Facades\Mail;

class ChatInvitationObserver
{
    /**
     * Handle the ChatInvitation "created" event.
     */
    public function created(ChatInvitation $chatInvitation): void
    {
        Mail::to($chatInvitation->invitee)->send(new ChatInvitationMail(
            $chatInvitation->from->name,
            $chatInvitation->id
        ));
    }

    /**
     * Handle the ChatInvitation "updated" event.
     */
    public function updated(ChatInvitation $chatInvitation): void
    {
        //
    }

    /**
     * Handle the ChatInvitation "deleted" event.
     */
    public function deleted(ChatInvitation $chatInvitation): void
    {
        //
    }

    /**
     * Handle the ChatInvitation "restored" event.
     */
    public function restored(ChatInvitation $chatInvitation): void
    {
        //
    }

    /**
     * Handle the ChatInvitation "force deleted" event.
     */
    public function forceDeleted(ChatInvitation $chatInvitation): void
    {
        //
    }
}
