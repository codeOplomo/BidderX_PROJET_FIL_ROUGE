<?php

namespace App\Listeners;

use App\Events\UserPresenceChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPresenceChangedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserPresenceChanged $event)
    {
        // Broadcast the user presence change to the presence channel
        broadcast(new UserPresenceChanged($event->userId, $event->isOnline))->toOthers();
    }
}
