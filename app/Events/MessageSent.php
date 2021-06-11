<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class MessageSent
 *
 * @package App\Events
 */
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sendername;

    public $conversation;

    public $message;

    public $payload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct ($conversation, $message, $payload = [], $fromme = false) {
        $this->sendername = 'matt';
        $this->conversation = $conversation;
        $this->message = $message;
        $payload['fromme'] = $fromme;
        $this->payload = $payload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn () {
        return new PrivateChannel('conversation');
    }

}
