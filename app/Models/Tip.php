<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $table = 'tips';
    protected $fillable = [
        'title',
        'image',
        'content',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}