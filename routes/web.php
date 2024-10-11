<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ProfileDataController;
use Illuminate\Support\Facades\Route;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profiel', function () {
    return view('profiel');
})->middleware(['auth', 'verified'])->name(name: 'dashboard');

Route::get('/friends', function () {
    return view('friends');
})->middleware(['auth', 'verified'])->name(name: 'dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profiel', [ProfileDataController::class, 'show'])->name('profiel');
return view ('profiel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/friends/send-request/{friendId}', [FriendsController::class, 'sendRequest']);
    Route::post('/friends/accept-request/{friendId}', [FriendsController::class, 'acceptRequest']);
    Route::post('/friends/decline-request/{friendId}', [FriendsController::class, 'declineRequest']);
    Route::post('/friends/remove/{friendId}', [FriendsController::class, 'removeFriend']);
    Route::get('/friends', [FriendsController::class, 'listFriends']);
    Route::get('/friends/pending', [FriendsController::class, 'listPendingRequests']);
});


require __DIR__.'/auth.php';
