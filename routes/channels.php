<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\ChatChannel;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat.{friendId}', ChatChannel::class);

