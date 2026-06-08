<?php
// app/Http/Controllers/FeedbackController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function send(Request $request)
    {
        // Валидация полей формы обратной связи
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
            'message' => 'required|string|min:10|max:5000',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('contacts')
                ->withErrors($validator)
                ->withInput();
        }
        
        // Здесь можно отправить email или сохранить в БД
        // Mail::to('admin@restaurant.com')->send(new FeedbackMail($request->all()));
        
        // Временное сохранение в сессию (или можно создать модель Feedback)
        return redirect()->route('contacts')
            ->with('feedback_success', 'Спасибо! Ваше сообщение отправлено.')
            ->withInput();
    }
}