<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    // View friends
    public function Userlist(){
        $users = User::all();
        return view('friends', compact('users'));
    }
    
    public function listFriends()
    {
        $friends = Auth::user()->friends()->where('pivot.accepted', true)->get(); // Get only accepted friends
        return view('friends', compact('friends'));
    }
    

    // View pending requests
    public function listPendingRequests()
    {
        $pendingRequests = Auth::User()->friends()->where('pivot.accepted', false)->get(); // Get only pending requests

        return view('friends', compact('pendingRequests'));
    }

    // Send friend request
    public function sendRequest($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);
    
        // Check if the request already exists
        if (!$user->friends->where('friend_id', $friendId)->exists()) {
            $user->friends->attach($friend, ['accepted' => false]);
        }
    
        return back();
    }
    
      
    // Accept friend request
    public function acceptRequest($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);

        $user->friends->updateExistingPivot($friend, ['accepted' => true]);

        return back();
    }
     
    // Decline friend request
    public function declineRequest($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);

        $user->friends()->detach($friend);

        return back();
    }
    
    // Remove friend
    public function removeFriend($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);

        $user->friends()->detach($friend);
        $friend->friends()->detach($user);

        return back();
    }
    
}
