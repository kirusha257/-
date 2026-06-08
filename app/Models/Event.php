<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    'title',
    'title_en',

    'date',

    'short_description',
    'short_description_en',

    'photo_url',

    'type',

    'full_description',
    'full_description_en',
];
    
    public function getPhotoUrlAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        if (filter_var($value, FILTER_VALIDATE_URL) && strpos($value, 'placehold') !== false) {
            return $value;
        }
        
        return asset($value);
    }
    
    public function getFormattedTimeAttribute()
    {
        return $this->start_time ? date('H:i', strtotime($this->start_time)) : null;
    }

    public function getLocalizedTitleAttribute()
{
    if (
        app()->getLocale() === 'en' &&
        !empty($this->title_en)
    ) {
        return $this->title_en;
    }

    return $this->title;
}

public function getLocalizedShortDescriptionAttribute()
{
    if (
        app()->getLocale() === 'en' &&
        !empty($this->short_description_en)
    ) {
        return $this->short_description_en;
    }

    return $this->short_description;
}

public function getLocalizedFullDescriptionAttribute()
{
    if (
        app()->getLocale() === 'en' &&
        !empty($this->full_description_en)
    ) {
        return $this->full_description_en;
    }

    return $this->full_description;
}
}