<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServerSentTelegramRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public $request;
    public $method;

    public function __construct(string $method, array $request)
    {
        $this->request = $request;
        $this->method = $method;
    }

    public function broadcastOn()
    {
        return new Channel('my-channel');
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        return [
            'method' => $this->method,
            'request' => $this->request,
        ];
    }
}
