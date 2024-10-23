<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/messages', function () {
    return view('messages');
});

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

// Zorgt ervoor dat de posts kunnen worden aangemaakt en verwijderd
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');
Route::get('/home', [PostController::class, 'index'])->name('home');


require __DIR__.'/auth.php';
