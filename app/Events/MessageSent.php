<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->friend_id);
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'user' => $this->message->user->name, // Send the name of the sender
            'user_id' => $this->message->user_id,  // Send the user ID of the sender
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}