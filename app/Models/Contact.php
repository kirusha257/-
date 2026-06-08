<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address', 'phone', 'email', 'work_hours', 'map_coordinates',
        'address_en', 'work_hours_en'
    ];
    
    public function getLocalizedAddressAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->address_en) {
            return $this->address_en;
        }
        return $this->address;
    }
    
    public function getLocalizedWorkHoursAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->work_hours_en) {
            return $this->work_hours_en;
        }
        return $this->work_hours;
    }
}
