<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use App\Models\Gallery;
use App\Models\Staff;
use App\Models\Review;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $about = AboutInfo::first();
        $gallery = Gallery::all();
        $staff = Staff::all();
        $reviews = Review::all();

        // Получаем единственную запись контактов
        $contact = Contact::first();

        return view('home', compact(
            'about',
            'gallery',
            'staff',
            'reviews',
            'contact'
        ));
    }
}