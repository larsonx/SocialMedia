<?php

namespace App\Http\Controllers;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;
class ChatController extends Controller {
    
    public function Userlist(){
        $users = User::all();
        return view('messages', compact('users'));
    }
    public function Friendslist()
    {
        // Get only accepted friends
        $friends = Auth::user()->friends()->wherePivot('accepted', true)->get();
        return view('messages', compact('friends'));
    }
    
    public function sendMessage(Request $request)
    {
        $message = new Chat();
        $message->user_id = Auth::id();
        $message->friend_id = $request->friend_id; // Ensure friend_id is passed in the request
        $message->message = $request->message;
        $message->save();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent successfully']);
    }
    public function ChatHistory($friend_id)
    {
        $user_id = Auth::id();
        $collection = Chat::where(function ($q) use ($user_id, $friend_id) {
            $q->where('from_user', $friend_id)
                ->where('to_user', $user_id);
        })->orWhere(function ($q) use ($friend_id, $user_id) {
            $q->where('from_user', $user_id)
                ->where('to_user', $friend_id);
        })->get();
    
        return response()->json($collection);
    }
}