<?php

namespace App\Http\Controllers;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller {
    public function Friendslist()
    {
        // Get only accepted friends
        $friends = Auth::user()->friends()->where('friends.accepted', true)->get();
        return view('messages', compact('friends'));
    } 
}