<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HandsetViewedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public array $handSetIds;
    public string $version;

    /**
     * Create a new event instance.
     */
    public function __construct(public $handsets, $version = 'v1')
    {
        $this->version = $version;
        $this->handSetIds = $handsets->pluck('id')->toArray();
    }
}
