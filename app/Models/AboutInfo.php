<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutInfo extends Model
{
    protected $fillable = ['content', 'content_en'];

    public function getLocalizedContentAttribute()
{
    return app()->getLocale() === 'en' && !empty($this->content_en)
        ? $this->content_en
        : $this->content;
}

}