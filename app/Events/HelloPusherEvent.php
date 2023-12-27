<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class HelloPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $id;

    public function __construct(Request $request)
    {
        $this->message  = $request->contents;
        $this->id = $request->id;
    }

    public function broadcastOn()
    {
        return ['development'];
    }
}
