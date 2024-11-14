<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('chat.{friendId}', function (User $user, $friendId) {
    return $user->friends()->where('friend_id', $friendId)->exists();
});