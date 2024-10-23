<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    // View Users
    public function Userlist(){
        $users = User::all();
        return view('friends', compact('users'));
    }
    //View friends
    public function listFriends()
    {
        $friends = Auth::user()->friends()->where('pivot.accepted', true)->get(); // Get only accepted friends
        return view('friends', compact('friends'));
    }
    

    // View pending requests
    public function listPendingRequests()
    {
        // Fetch friend requests the current user has received but are not yet accepted
        $pendingRequests = Auth::user()->friendsFrom()->where('friends.accepted', false)->get();

// Make sure you're getting the user's ID correctly
        return view('pendingRequests', compact('pendingRequests'));

    }
    

    // Send friend request
    public function sendRequest($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);
    
        // Check if the request already exists
        if (!$user->friends()->where('friend_id', $friendId)->exists()) {
            $user->friends()->attach($friend, ['accepted' => false]);
        }
    
        return back();
    }
    
      
    // Accept friend request
    public function acceptRequest($friendId)
{
    $user = Auth::user();
    
    // Check if a pending request exists from this friend
    $request = $user->friendsFrom()->where('user_id', $friendId)->where('accepted', false)->first();

    if ($request) {
        // Update the accepted status to true
        $user->friends()->updateExistingPivot($friendId, ['accepted' => true]);
        // Also update the reverse relationship
        $friend = User::find($friendId);
        $friend->friends()->updateExistingPivot($user->id, ['accepted' => true]);
        
        return back()->with('status', 'Friend request accepted!');
    }

    return back()->with('error', 'No pending friend request found.');
}

public function declineRequest($friendId)
{
    $user = Auth::user();

    // Check if a pending request exists from this friend
    $request = $user->friendsFrom()->where('user_id', $friendId)->where('accepted', false)->first();

    if ($request) {
        // Detach the friend request
        $user->friendsFrom()->detach($friendId);
        return back()->with('status', 'Friend request declined!');
    }

    return back()->with('error', 'No pending friend request found.');
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
