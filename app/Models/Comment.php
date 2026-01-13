<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    'user_id',
    'recipe_id',
    'comment', // Pastikan kolom ini ada di fillable
    'rating',
    'is_visible',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}