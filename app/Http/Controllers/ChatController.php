<?php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function Userlist()
    {
        $users = User::all();
        return view('messages', compact('users'));
    }

    public function Friendslist()
    {
        $friends = Auth::user()->friends()->wherePivot('accepted', true)->get();
        return view('messages', compact('friends'));
    }

    public function fetchMessages(User $friend)
    {
        $messages = Message::where(function($query) use ($friend) {
            $query->where('user_id', Auth::id())
                  ->orWhere('friend_id', Auth::id());
        })->where(function($query) use ($friend) {
            $query->where('user_id', $friend->id)
                  ->orWhere('friend_id', $friend->id);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->friend_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'message' => $message->message,
            'user' => $message->user->name,
            'user_id' => $message->user_id,
            'created_at' => $message->created_at->toDateTimeString(),
        ]);
    }
}