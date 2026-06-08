<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name', 'position', 'name_en', 'position_en',
        'photo_url', 'sort_order'
    ];
    
    // Аксессор для получения полного URL фото
    public function getPhotoUrlAttribute($value)
    {
        if (!$value) {
            return asset('images/default-avatar.png');
        }
        
        if (filter_var($value, FILTER_VALIDATE_URL) && strpos($value, 'placehold') !== false) {
            return $value;
        }
        
        return asset($value);
    }

    // Аксессоры для локализации
    public function getLocalizedNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->name_en) {
            return $this->name_en;
        }
        return $this->name;
    }
    
    public function getLocalizedPositionAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->position_en) {
            return $this->position_en;
        }
        return $this->position;
    }
}