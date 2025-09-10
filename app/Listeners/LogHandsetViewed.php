<?php

namespace App\Listeners;

use App\Events\HandsetViewedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogHandsetViewed
{
    /**
     * Handle the event.
     */
    public function handle(HandsetViewedEvent $event): void
    {
        Log::info(
            'Handset viewed event handled.',
            [
                'id' => $event->handSetIds,
                'version' => $event->version,
                'event' => $event
            ]

            // HandsetViewed] Handset ID: 5 | Version: v1 | Timestamp: 2025-08-02 10:22:00
        );
    }
}
