<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('chat.{friendId}', function (User $user, $friendId) {
    return $user->id === (int) $friendId || $user->friends()->where('friend_id', $friendId)->exists();
});
Broadcast::channel('chat.{friend_id}', function ($user, $friend_id) {
    return $user->id === $friend_id || $user->id === $friend_id;
});