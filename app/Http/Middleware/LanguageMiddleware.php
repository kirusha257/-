<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем язык в сессии
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            $locale = 'ru'; // язык по умолчанию
        }
        
        // Доступные языки
        if (in_array($locale, ['ru', 'en'])) {
            App::setLocale($locale);
        }
        
        return $next($request);
    }
}