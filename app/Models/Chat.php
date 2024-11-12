<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',  // ID van de user
        'friend_id',  // ID van de vriend
        'message',    // Bericht
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}