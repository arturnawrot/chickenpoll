<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Option;

class Vote implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $option;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('poll.'.$this->option->poll->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->option->id,
            'votes' => $this->option->votes,
            'percentage' => $this->option->percentage
        ];
    }
}
