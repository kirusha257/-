<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use App\Models\Staff;
use App\Models\Review;
use App\Models\MenuImage;
use App\Models\Event;
use App\Models\Contact;
use App\Models\SocialLink;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Notifications\NewBookingNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Admin;
use Illuminate\Support\Facades\Cache;
use App\Models\Gallery;
use App\Models\BestDish;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBookingMail;

class MainController extends Controller
{
    public function index()
{
    $about = Cache::remember('home_about', 60, function () {
        $data = AboutInfo::first();
        return $data ? $data->toArray() : null;
    });

    $staff = Cache::remember('home_staff', 60, function () {
        return Staff::orderBy('sort_order')->get()->toArray();
    });

    $reviews = Cache::remember('home_reviews', 60, function () {
        return Review::where('is_approved', true)
            ->latest()
            ->take(6)
            ->get()
            ->toArray();
    });

    $contact = Contact::first();

    $about = $about ? (object) $about : null;

    $staff = collect($staff)->map(function ($item) {
        return (object) $item;
    });

    $reviews = collect($reviews)->map(function ($item) {
        return (object) $item;
    });

    $gallery = $this->getGallery();

    return view('home', compact(
        'about',
        'gallery',
        'staff',
        'reviews',
        'contact'
    ));
}
    
    public function menu()
    {
        $bestDishes = BestDish::orderBy('sort_order')->get();
        $menuImages = MenuImage::orderBy('sort_order')->get();
        
        return view('menu', compact('bestDishes', 'menuImages'));
    }
    
    public function events()
    {
        $upcomingEvents = Cache::remember('events_upcoming', 60, function () {
            return Event::where('type', 'upcoming')->orderBy('date', 'asc')->get()->toArray();
        });
        
        $pastEvents = Cache::remember('events_past', 60, function () {
            return Event::where('type', 'past')->orderBy('date', 'desc')->get()->toArray();
        });
        
        $upcomingEvents = collect($upcomingEvents)->map(function($item) { return (object) $item; });
        $pastEvents = collect($pastEvents)->map(function($item) { return (object) $item; });
        
        return view('events', compact('upcomingEvents', 'pastEvents'));
    }
    
    public function booking()
    {
        return view('booking');
    }
    
    public function storeBooking(Request $request)
    {
        // Валидация
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'guests_count' => 'required|integer|min:1|max:20',
            'privacy_consent' => 'accepted',
        ]);

        // Создание брони
        $booking = Booking::create([
            'guest_name' => $request->guest_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date' => $request->date,
            'time' => $request->time,
            'guests_count' => $request->guests_count,
            'status' => 'new',
        ]);

        // ↓↓↓ СЮДА ВСТАВЬТЕ ВАШУ ПОЧТУ ↓↓↓
        $adminEmail = 'pomerantseva.kira@bk.ru';  // <--- Поменяйте на свою
        
        // Отправка письма
        Mail::to($adminEmail)->send(new NewBookingMail($booking));

        return redirect()->route('booking')->with('success', 'Ваша заявка отправлена! Мы свяжемся с вами для подтверждения.');
    }
    
    public function contacts()
    {
        $contacts = Cache::remember('contacts_info', 60, function () {
            $data = Contact::first();
            return $data ? $data->toArray() : null;
        });
        
        $socials = Cache::remember('social_links', 60, function () {
            return SocialLink::all()->toArray();
        });
        
        $contacts = $contacts ? (object) $contacts : null;
        $socials = collect($socials)->map(function($item) { return (object) $item; });
        
        return view('contacts', compact('contacts', 'socials'));
    }
    
    public function sendFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Review::create([
            'author' => $request->name,
            'text' => $request->message,
            'rating' => $request->rating ?? 5,
            'is_approved' => false,
        ]);

        // Очищаем кэш отзывов, чтобы новый отзыв появился после модерации
        Cache::forget('home_reviews');

        return redirect()->route('contacts')->with('feedback_success', 'Спасибо за ваш отзыв! Он будет опубликован после проверки администратором.');
    }

    public function getGallery()
    {
        $gallery = Cache::remember('gallery_photos', 60, function () {
            return Gallery::orderBy('sort_order')->get()->toArray();
        });
        
        return collect($gallery)->map(function($item) { return (object) $item; });
    }
}