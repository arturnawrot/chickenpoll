<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpamDetected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $content;
    private $ip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $content, string $ip)
    {
        $this->content = $content;
        $this->ip = $ip;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function getIp() : string
    {
        return $this->ip;
    }
}
