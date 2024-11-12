<?php

namespace App\Http\Controllers;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

class ChatController extends Controller {
    public function Friendslist()
    {
        // Get only accepted friends
        $friends = Auth::user()->friends()->where('friends.accepted', true)->get();
        return view('messages', compact('friends'));
    } 
    public function sendMessage(Request $request)
    {
        $message = new Chat();
        $message->user_id = Auth::id();
        $message->content = $request->message;
        $message->save();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent successfully']);
    }
}