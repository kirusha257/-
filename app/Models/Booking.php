<?php
// app/Models/Booking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'guest_name',
        'guest_name_en',
        'phone',
        'email',
        'date',
        'time',
        'guests_count',
        'status',
        'internal_comment',
        'internal_comment_en',
        'table_number'
    ];
    
    // Аксессоры для локализации
    public function getLocalizedGuestNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->guest_name_en) {
            return $this->guest_name_en;
        }
        return $this->guest_name;
    }
    
    public function getLocalizedInternalCommentAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->internal_comment_en) {
            return $this->internal_comment_en;
        }
        return $this->internal_comment;
    }
    
    // Статусы на разных языках
    public static function getStatuses()
    {
        $locale = app()->getLocale();
        
        $statuses = [
            'new' => ['ru' => 'Новая', 'en' => 'New'],
            'confirmed' => ['ru' => 'Подтверждена', 'en' => 'Confirmed'],
            'guest_on_place' => ['ru' => 'Гость на месте', 'en' => 'Guest on place'],
            'completed' => ['ru' => 'Выполнена', 'en' => 'Completed'],
            'cancelled' => ['ru' => 'Отменена', 'en' => 'Cancelled'],
        ];
        
        if ($locale === 'en') {
            return array_column($statuses, 'en');
        }
        return array_column($statuses, 'ru');
    }
    
    public function getLocalizedStatusAttribute()
    {
        $locale = app()->getLocale();
        
        $statuses = [
            'new' => ['ru' => 'Новая', 'en' => 'New'],
            'confirmed' => ['ru' => 'Подтверждена', 'en' => 'Confirmed'],
            'guest_on_place' => ['ru' => 'Гость на месте', 'en' => 'Guest on place'],
            'completed' => ['ru' => 'Выполнена', 'en' => 'Completed'],
            'cancelled' => ['ru' => 'Отменена', 'en' => 'Cancelled'],
        ];
        
        return $statuses[$this->status][$locale] ?? $this->status;
    }
}