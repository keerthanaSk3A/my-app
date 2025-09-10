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
        $message = '[HandsetViewed] Handset ID: '. implode(',', $event->handSetIds) .' | Version: '. $event->version .' | Timestamp: '. now()->toDateTimeString();
        Log::info(
            $message,
        );
    }
}
