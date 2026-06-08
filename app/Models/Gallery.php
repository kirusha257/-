<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = [
        'image_url', 'title', 'description', 'title_en', 'description_en', 'sort_order'
    ];
    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        return asset($value);
    }

    public function getLocalizedTitleAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->title_en) {
            return $this->title_en;
        }
        return $this->title;
    }
    
    public function getLocalizedDescriptionAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->description_en) {
            return $this->description_en;
        }
        return $this->description;
    }
}