<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Vergeet niet je Post model te importeren
use Illuminate\Support\Facades\Auth; // Import Auth voor het ophalen van de user ID
use Illuminate\Support\Facades\Storage; // Import Storage voor het uploaden van bestanden

class PostController extends Controller
{
    public function index()
    {
        // Haal alle posts op, gesorteerd op de nieuwste
        $posts = Post::orderBy('created_at', 'desc')->get();
    
        // Stuur de posts naar de view
        return view('home', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        // Validatie van het request
        $request->validate([
            'content' => 'required|string|max:280', // Hier heb ik max:280 gezet zoals je vroeg
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verwerk de afbeelding, als die aanwezig is
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public'); // Opslaan in de 'public' map
        }

        // Maak de post aan en koppel de afbeelding
        Post::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(), // Haalt het ID op van de ingelogde gebruiker
            'image' => $imagePath, // Sla het pad van de afbeelding op
        ]);

        return redirect()->back()->with('status', 'Post created successfully!');
    }
}
