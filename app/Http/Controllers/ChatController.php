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

    public function fetchMessages($friend_id)
{
    $messages = Message::with('user')
        ->where(function($query) use ($friend_id) {
            $query->where('user_id', auth()->id())
                  ->where('friend_id', $friend_id);
        })->orWhere(function($query) use ($friend_id) {
            $query->where('user_id', $friend_id)
                  ->where('friend_id', auth()->id());
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