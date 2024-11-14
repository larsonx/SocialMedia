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
    
}