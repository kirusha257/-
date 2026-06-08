<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['author', 'text', 'rating', 'is_approved', 'text_en', 'author_en'];

    public function getLocalizedTextAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->text_en) {
            return $this->text_en;
        }
        return $this->text;
    }
}