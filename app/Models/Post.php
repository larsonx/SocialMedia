<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Velden die mass-assignment toestaan
    protected $fillable = [
        'content',  // De inhoud van de post
        'user_id',  // ID van de gebruiker die de post maakt
        'image',    // Het pad van de afbeelding
    ];

    // Relatie naar de gebruiker die de post heeft gemaakt
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

