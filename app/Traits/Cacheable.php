<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait Cacheable
{
    protected function remember($key, $minutes, $callback)
    {
        // Используем serialize только для простых данных
        return Cache::remember($key, $minutes, function () use ($callback) {
            $data = $callback();
            // Преобразуем модели в массивы, чтобы избежать проблем с unserialize
            if ($data instanceof \Illuminate\Database\Eloquent\Collection) {
                return $data->toArray();
            }
            if ($data instanceof \Illuminate\Database\Eloquent\Model) {
                return $data->toArray();
            }
            return $data;
        });
    }
    
    protected function rememberModel($key, $minutes, $callback)
    {
        $data = Cache::remember($key, $minutes, function () use ($callback) {
            return $callback();
        });
        
        // Восстанавливаем модели из массивов
        if (is_array($data) && isset($data['id'])) {
            return $data;
        }
        
        return $data;
    }
    
    protected function forget($key)
    {
        Cache::forget($key);
    }
    
    protected function clearMenuCache()
    {
        Cache::forget('menu_main');
        Cache::forget('menu_wine');
        Cache::forget('menu_bar');
    }
    
    protected function clearHomeCache()
    {
        Cache::forget('home_about');
        Cache::forget('home_staff');
        Cache::forget('home_reviews');
    }
    
    protected function clearEventsCache()
    {
        Cache::forget('events_upcoming');
        Cache::forget('events_past');
    }
    
    protected function clearContactsCache()
    {
        Cache::forget('contacts_info');
        Cache::forget('social_links');
    }
}