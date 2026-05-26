<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestDish extends Model
{
    protected $fillable = ['title', 'image_url', 'description', 'price', 'sort_order'];
    
    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        return asset($value);
    }
}