<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestDish extends Model
{
    protected $fillable = ['title', 'image_url', 'description', 'price', 'sort_order', 'title_en', 'description_en'];
    
    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        return asset($value);
    }

    public function getLocalizedTitleAttribute()
{
    return app()->getLocale() === 'en' && !empty($this->title_en)
        ? $this->title_en
        : $this->title;
}

public function getLocalizedDescriptionAttribute()
{
    return app()->getLocale() === 'en' && !empty($this->description_en)
        ? $this->description_en
        : $this->description;
}
}