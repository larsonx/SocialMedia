<?php

namespace App\Http\Controllers;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
class ChatController extends Controller {
    
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'friend_id' => $request->friend_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
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
    
}