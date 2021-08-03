<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class UserLikesDislikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pokemon_name',
        'is_liked',
        'is_disliked'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
