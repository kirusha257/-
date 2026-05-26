<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuImage extends Model
{
    protected $fillable = ['category', 'image_url', 'sort_order'];
    
    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        return asset($value);
    }
}