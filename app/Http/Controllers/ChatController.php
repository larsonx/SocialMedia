<?php
// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller {
    public function sendMessage(Request $request) {
        $chat = Chat::create([
            'user_id' => auth()->id(),
            'friend_id' => $request->friend_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($chat))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}