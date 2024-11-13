<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ProfileDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/contact-us', function () {
    return view('contact-us');
});

Route::get('/home', function () {
    return view('home');
});

// routes/web.php

Route::get('/messages', function () {
    return view('messages');
})->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profiel', function () {
    return view('profiel');
})->middleware(['auth', 'verified'])->name(name: 'dashboard');

//zorgt voor de display van profiel data
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profiel', [ProfileDataController::class, 'show'])->name('profiel');
return view ('profiel');
});

// zorgt voor het editen updaten en vernietigen van het profiel
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// zorgt voor het verwerken van friend requests
Route::middleware('auth')->group(function () {
    Route::post('/friends/send-request/{friendId}', [FriendsController::class, 'sendRequest'])->name('friends.sendRequest');
    Route::post('/friends/accept-request/{friendId}', [FriendsController::class, 'acceptRequest'])->name('friends.acceptRequest');
    Route::post('/friends/decline-request/{friendId}', [FriendsController::class, 'declineRequest'])->name('friends.declineRequest');
    Route::post('/friends/remove/{friendId}', [FriendsController::class, 'removeFriend'])->name('friends.remove');
    

    Route::get('/friends/list', [FriendsController::class, 'listFriends'])->name('friends.listFriends');
    Route::get('/friends/pending', [FriendsController::class, 'listPendingRequests'])->name('friends.pending');
    Route::get('/friends', [FriendsController::class, 'Userlist'])->name('friends.list');
});
// zorgt voor het maken van een post
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');
Route::get('/home', [PostController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/messages', [ChatController::class, 'Friendslist'])->name('messages');
    Route::middleware('auth')->post('/sendMessage', [ChatController::class, 'messages.sendMessage']);
    Route::get('/chat-history/{friendId}', [ChatController::class, 'ChatHistory'])->name('messages.chatHistory');

});
require __DIR__.'/auth.php';
