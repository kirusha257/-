<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'date', 'start_time', 'short_description', 'photo_url', 'type', 'full_description'];
    
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
}