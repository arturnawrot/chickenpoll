<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Visitor;

class Vote implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $options;
    public $visitor;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->options = $data['options'];
        $this->visitor = Visitor::Where('ip', $data['ip'])->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('poll.'.$this->options[0]->poll->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $options = [];
        foreach($this->options as $option)
        {
            $options[] = [
                'id' => $option->id,
                'responses' => $option->responsesCount,
                'percentage' => $option->percentage,
            ];
        }

        return [
            'options' => $options,
            'visitor' => [
                'country' => $this->visitor->country,
                'country_code' => $this->visitor->country_code,
                'city' => $this->visitor->city,
                'created_at' => $this->visitor->created_at->toString()
            ]
        ];
    }
}
