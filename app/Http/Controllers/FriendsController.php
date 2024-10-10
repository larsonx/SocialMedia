<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    // View friends
    public function index()
    {
  
    }

    // Send a friend request
    public function sendRequest(Request $request, $friendId)
    {
     
    }

    public function acceptRequest($requestId)
    {

    }

    // Remove a friend
    public function removeFriend($friendId)
    {

    }
}
