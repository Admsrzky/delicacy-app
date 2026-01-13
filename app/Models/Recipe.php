<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $casts = [
    'ingredients' => 'array',
    'steps' => 'array',
    ];

    protected $table = 'recipes';
    protected $fillable = [
        'title',
        'difficulty',
        'image',
        'cooking_time',
        'ingredients',
        'steps',
        'is_featured',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Helper untuk menghitung rata-rata rating
    public function averageRating()
    {
        return round($this->comments()->avg('rating'), 1) ?: 0;
    }
}