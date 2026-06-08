<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use App\Models\Staff;
use App\Models\Review;
use App\Models\MenuImage;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use App\Traits\UploadsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\Gallery;
use App\Models\BestDish;
use App\Models\Admin;
use App\Services\YandexTranslateService;

class AdminController extends Controller
{
    use UploadsImages;
    
    // Вход в админку (после 5 кликов)
    public function index()
    {
        return view('admin.dashboard');
    }
    
    // ========== Управление главной страницей ==========
    public function editAbout()
    {
        $about = AboutInfo::first();
        return view('admin.about', compact('about'));
    }
    
    public function updateAbout(Request $request)
    {
        $translator = app(YandexTranslateService::class);

        $about = AboutInfo::first();

        if (!$about) {
            $about = new AboutInfo();
        }

        $about->content = $request->content;
        $about->content_en = $translator->translate($request->content);

        $about->save();

        Cache::forget('home_about');

        return redirect()
            ->route('admin.about')
            ->with('success', 'Информация обновлена');
    }
    
    // ========== Управление сотрудниками ==========
    public function listStaff()
    {
        $staff = Staff::orderBy('sort_order')->get();
        return view('admin.staff', compact('staff'));
    }
    
    // В методе storeStaff
public function storeStaff(Request $request)
{
    $translator = app(YandexTranslateService::class);
    
    $request->validate([
        'name' => 'required',
        'position' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);
    
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $this->uploadImage($request->file('photo'), 'staff');
    }
    
    Staff::create([
        'name' => $request->name,
        'name_en' => $translator->translate($request->name),
        'position' => $request->position,
        'position_en' => $translator->translate($request->position),
        'photo_url' => $photoPath,
        'sort_order' => $request->sort_order ?? 0
    ]);
    
    Cache::forget('home_staff');
    
    return redirect()->route('admin.staff')->with('success', 'Сотрудник добавлен');
}

// В методе updateStaff
public function updateStaff(Request $request, $id)
{
    $translator = app(YandexTranslateService::class);
    $staff = Staff::findOrFail($id);
    
    if ($request->hasFile('photo')) {
        $this->deleteImage($staff->photo_url);
        $staff->photo_url = $this->uploadImage($request->file('photo'), 'staff');
    }
    
    $staff->name = $request->name;
    $staff->name_en = $translator->translate($request->name);
    $staff->position = $request->position;
    $staff->position_en = $translator->translate($request->position);
    $staff->sort_order = $request->sort_order ?? 0;
    $staff->save();
    
    Cache::forget('home_staff');
    
    return redirect()->route('admin.staff')->with('success', 'Сотрудник обновлён');
}
    
    public function destroyStaff($id)
    {
        $staff = Staff::findOrFail($id);
        $this->deleteImage($staff->photo_url);
        $staff->delete();
        
        Cache::forget('home_staff');
        
        return redirect()->route('admin.staff')->with('success', 'Сотрудник удалён');
    }
    
    // ========== Управление отзывами ==========
    public function listReviews()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('admin.reviews', compact('reviews'));
    }
    
    // В методе storeReview
public function storeReview(Request $request)
{
    $translator = app(YandexTranslateService::class);
    
    Review::create([
        'author' => $request->author,
        'text' => $request->text,
        'text_en' => $translator->translate($request->text),
        'rating' => $request->rating,
        'is_approved' => $request->has('is_approved')
    ]);
    
    Cache::forget('home_reviews');
    
    return redirect()->route('admin.reviews')->with('success', 'Отзыв добавлен');
}

// В методе updateReview
public function updateReview(Request $request, $id)
{
    $translator = app(YandexTranslateService::class);
    $review = Review::findOrFail($id);
    $review->author = $request->author;
    $review->text = $request->text;
    $review->text_en = $translator->translate($request->text);
    $review->rating = $request->rating;
    $review->is_approved = $request->has('is_approved');
    $review->save();
    
    Cache::forget('home_reviews');
    
    return redirect()->route('admin.reviews')->with('success', 'Отзыв обновлён');
}
    
    public function destroyReview($id)
    {
        Review::findOrFail($id)->delete();
        
        Cache::forget('home_reviews');
        
        return redirect()->route('admin.reviews')->with('success', 'Отзыв удалён');
    }
    
    // ========== Управление меню ==========
    // ========== Управление меню (несколько фото) ==========
public function editMenu()
{
    $mainMenu = MenuImage::where('category', 'main')->orderBy('sort_order')->get();
    $wineMenu = MenuImage::where('category', 'wine')->orderBy('sort_order')->get();
    $barMenu = MenuImage::where('category', 'bar')->orderBy('sort_order')->get();
    
    return view('admin.menu', compact('mainMenu', 'wineMenu', 'barMenu'));
}

public function storeMenuImage(Request $request)
{
    $request->validate([
        'category' => 'required|in:main,wine,bar',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        'sort_order' => 'nullable|integer',
    ]);
    
    $photoPath = $this->uploadImage($request->file('image'), 'menu');
    
    MenuImage::create([
        'category' => $request->category,
        'image_url' => $photoPath,
        'sort_order' => $request->sort_order ?? 0,
    ]);
    
    Cache::forget('menu_main');
    Cache::forget('menu_wine');
    Cache::forget('menu_bar');
    
    return redirect()->route('admin.menu')->with('success', 'Фото добавлено');
}

public function destroyMenuImage($id)
{
    $photo = MenuImage::findOrFail($id);
    $this->deleteImage($photo->image_url);
    $photo->delete();
    
    Cache::forget('menu_main');
    Cache::forget('menu_wine');
    Cache::forget('menu_bar');
    
    return redirect()->route('admin.menu')->with('success', 'Фото удалено');
}
    
    public function updateMenu(Request $request, $category)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);
        
        $menuImage = MenuImage::where('category', $category)->first();
        
        if ($menuImage) {
            $this->deleteImage($menuImage->image_url);
            $menuImage->image_url = $this->uploadImage($request->file('image'), 'menu');
            $menuImage->save();
        } else {
            MenuImage::create([
                'category' => $category,
                'image_url' => $this->uploadImage($request->file('image'), 'menu')
            ]);
        }
        
        // Очищаем кэш меню
        Cache::forget('menu_main');
        Cache::forget('menu_wine');
        Cache::forget('menu_bar');
        
        return redirect()->route('admin.menu')->with('success', 'Изображение обновлено');
    }
    
    // ========== Управление мероприятиями ==========
    public function listEvents()
    {
        $upcoming = Event::where('type', 'upcoming')->orderBy('date')->get();
        $past = Event::where('type', 'past')->orderBy('date', 'desc')->get();
        return view('admin.events', compact('upcoming', 'past'));
    }
    
    public function storeEvent(Request $request)
    {
        
        $translator = app(\App\Services\YandexTranslateService::class);
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $this->uploadImage($request->file('photo'), 'events');
        }
        
$data = [
    'title' => $request->title,
    'title_en' => $translator->translate($request->title),

    'date' => $request->date,
    'start_time' => $request->start_time,

    'short_description' => $request->short_description,
    'short_description_en' => $translator->translate($request->short_description),

    'photo_url' => $photoPath,
    'type' => $request->type,

    'full_description' => $request->full_description,
    'full_description_en' => $translator->translate($request->full_description),
];

Event::create($data);

        
        
        Cache::forget('events_upcoming');
        Cache::forget('events_past');
        
        return redirect()->route('admin.events')->with('success', 'Мероприятие добавлено');
    }

    public function updateEvent(Request $request, $id, YandexTranslateService $translator)
    {
        $event = Event::findOrFail($id);

        if ($request->hasFile('photo')) {
            $this->deleteImage($event->photo_url);
            $event->photo_url = $this->uploadImage($request->file('photo'), 'events');
        }

        // RU
        $event->title = $request->title;
        $event->short_description = $request->short_description;
        $event->full_description = $request->full_description;

        // EN авто перевод
        $event->title_en = $translator->translate($request->title);
        $event->short_description_en = $translator->translate($request->short_description);
        $event->full_description_en = $translator->translate($request->full_description);

        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->type = $request->type;

        $event->save();

        Cache::forget('events_upcoming');
        Cache::forget('events_past');

        return redirect()->route('admin.events')->with('success', 'Мероприятие обновлено');
    }
    
    public function destroyEvent($id)
    {
        $event = Event::findOrFail($id);
        $this->deleteImage($event->photo_url);
        $event->delete();
        
        Cache::forget('events_upcoming');
        Cache::forget('events_past');
        
        return redirect()->route('admin.events')->with('success', 'Мероприятие удалено');
    }
    
    // ========== Управление бронированиями ==========
    public function listBookings(Request $request)
{
    $query = Booking::query();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('date')) {
        $query->where('date', $request->date);
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('guest_name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    $bookings = $query->orderBy('date')->orderBy('time')->get();
    $filters = $request->only(['status', 'date', 'search']);

    return view('admin.bookings', compact('bookings', 'filters'));
}
    
    
    
    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->route('admin.bookings')->with('success', 'Бронь удалена');
    }
    
    // ========== Управление контактами ==========
    public function editContacts()
    {
        $contacts = Contact::first();
        $socials = SocialLink::all();
        $settings = SiteSetting::first();
        
        return view('admin.contacts', compact('contacts', 'socials', 'settings'));
    }
    
    // В методе updateContacts
public function updateContacts(Request $request)
{
    $request->validate([
        'address' => 'nullable|string|max:500',
        'phone' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',
        'work_hours' => 'nullable|string|max:255',
        'map_coordinates' => 'nullable|string|max:255',
    ]);
    $translator = app(YandexTranslateService::class);
    $contacts = Contact::first();
    
    if (!$contacts) {
        $contacts = new Contact();
    }
    
    $contacts->address = $request->address;
    $contacts->address_en = $translator->translate($request->address);
    $contacts->phone = $request->phone;
    $contacts->email = $request->email;
    $contacts->work_hours = $request->work_hours;
    $contacts->work_hours_en = $translator->translate($request->work_hours);
    $contacts->map_coordinates = $request->map_coordinates;
    $contacts->save();
    
    Cache::forget('contacts_info');
    
    return redirect()->route('admin.contacts')->with('success', 'Контакты обновлены');
}
    
    public function updateSocialLinks(Request $request)
{
    $request->validate([
        'telegram' => 'nullable|url|max:255',
        'vk' => 'nullable|url|max:255',
    ]);

    SocialLink::updateOrCreate(
        ['platform' => 'telegram'],
        ['url' => $request->telegram ?? '']
    );

    SocialLink::updateOrCreate(
        ['platform' => 'vk'],
        ['url' => $request->vk ?? '']
    );

    Cache::forget('social_links');

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('admin.contacts')->with('success', 'Соцсети обновлены');
}
    
    public function updateSiteSettings(Request $request)
    {
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }
        
        if ($request->hasFile('logo')) {
            $this->deleteImage($settings->logo_url);
            $settings->logo_url = $this->uploadImage($request->file('logo'), 'settings');
        }
        
        $settings->footer_text = $request->footer_text;
        $settings->save();
        
        return redirect()->route('admin.contacts')->with('success', 'Настройки обновлены');
    }

    public function statistics()
    {
        // Общее количество активных броней (Новые + Подтверждены)
        $totalActiveBookings = Booking::whereIn('status', ['new', 'confirmed'])->count();
        
        // Статистика по статусам (все статусы для графика)
        $statusStats = Booking::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
        
        // Брони по дням (последние 30 дней)
        $bookingsByDay = Booking::select(
            DB::raw('DATE(date) as day'),
            DB::raw('count(*) as count')
        )
        ->where('date', '>=', now()->subDays(30))
        ->groupBy('day')
        ->orderBy('day')
        ->get();
        
        // Популярные часы бронирования (только активные)
        $popularHours = Booking::select(
            DB::raw('EXTRACT(HOUR FROM time) as hour'),
            DB::raw('count(*) as count')
        )
        ->whereIn('status', ['new', 'confirmed'])
        ->groupBy('hour')
        ->orderBy('count', 'desc')
        ->get();
        
        // Среднее количество гостей (только активные)
        $avgGuests = Booking::whereIn('status', ['new', 'confirmed'])->avg('guests_count') ?? 0;
        
        // Самые популярные даты (Новые + Подтверждены + Гость на месте + Выполнены)
        $popularDates = Booking::select('date', DB::raw('count(*) as count'))
            ->whereIn('status', ['new', 'confirmed', 'guest_on_place', 'completed'])
            ->groupBy('date')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.statistics', compact(
            'totalActiveBookings',
            'statusStats',
            'bookingsByDay',
            'popularHours',
            'avgGuests',
            'popularDates'
        ));
    }

    private function isTableAvailable($table_number, $date, $time, $excludeBookingId = null)
    {
        if (empty($table_number)) {
            return true;
        }
        
        $query = Booking::where('table_number', $table_number)
            ->where('date', $date)
            ->where('time', $time)
            ->whereIn('status', ['new', 'confirmed', 'guest_on_place']);
        
        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }
        
        return $query->count() == 0;
    }

    

    // В методе createBooking (добавляем переводы)
public function createBooking(Request $request)
{
    $translator = app(YandexTranslateService::class);
    
    $validator = validator($request->all(), [
        'guest_name' => 'required|string|max:255',
        'phone' => ['required', 'string', 'regex:/^[\+0-9\s\-\(\)]{10,20}$/'],
        'email' => 'nullable|email|max:255',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required',
        'guests_count' => 'required|integer|min:1|max:20',
        'status' => 'required',
        'internal_comment' => 'nullable|string',
        'table_number' => 'nullable|integer|min:1|max:20',
    ]);
    
    if ($validator->fails()) {
        if ($request->ajax()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return back()->withErrors($validator)->withInput();
    }
    
    if ($request->table_number) {
        if (!$this->isTableAvailable($request->table_number, $request->date, $request->time)) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Столик №' . $request->table_number . ' уже забронирован на ' . $request->date . ' в ' . $request->time], 422);
            }
            return back()->with('error', 'Столик №' . $request->table_number . ' уже забронирован на это время!');
        }
    }
    
    $booking = Booking::create([
        'guest_name' => $request->guest_name,
        'guest_name_en' => $translator->translate($request->guest_name),
        'phone' => $request->phone,
        'email' => $request->email,
        'date' => $request->date,
        'time' => $request->time,
        'guests_count' => $request->guests_count,
        'status' => $request->status,
        'internal_comment' => $request->internal_comment,
        'internal_comment_en' => $translator->translate($request->internal_comment),
        'table_number' => $request->table_number,
    ]);
    
    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }
    
    return redirect()->route('admin.bookings')->with('success', 'Бронь создана');
}

// В методе updateBooking (добавляем переводы)
public function updateBooking(Request $request, $id)
{
    $translator = app(YandexTranslateService::class);
    $booking = Booking::findOrFail($id);
    
    $request->validate([
        'guest_name' => 'required|string|max:255',
        'phone' => ['required', 'string', 'regex:/^[\+0-9\s\-\(\)]{10,20}$/'],
        'email' => 'nullable|email|max:255',
        'date' => 'required|date',
        'time' => 'required',
        'guests_count' => 'required|integer|min:1|max:20',
        'status' => 'required',
        'internal_comment' => 'nullable|string',
        'table_number' => 'nullable|integer|min:1|max:20',
    ]);
    
    if ($request->table_number) {
        if (!$this->isTableAvailable($request->table_number, $request->date, $request->time, $id)) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Столик №' . $request->table_number . ' уже забронирован'], 422);
            }
            return back()->with('error', 'Столик уже забронирован');
        }
    }
    
    $booking->update([
        'guest_name' => $request->guest_name,
        'guest_name_en' => $translator->translate($request->guest_name),
        'phone' => $request->phone,
        'email' => $request->email,
        'date' => $request->date,
        'time' => $request->time,
        'guests_count' => $request->guests_count,
        'status' => $request->status,
        'internal_comment' => $request->internal_comment,
        'internal_comment_en' => $translator->translate($request->internal_comment),
        'table_number' => $request->table_number,
    ]);
    
    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }
    
    return redirect()->route('admin.bookings')->with('success', 'Бронь обновлена');
}

// Также обновляем метод getBookingDetails, чтобы возвращал переводы
public function getBookingDetails($id)
{
    $booking = Booking::findOrFail($id);
    
    // Явно указываем все поля, которые нужны на фронтенде
    return response()->json([
        'id' => $booking->id,
        'guest_name' => $booking->guest_name,
        'guest_name_en' => $booking->guest_name_en,  // Добавляем перевод имени
        'phone' => $booking->phone,
        'email' => $booking->email,
        'date' => $booking->date,
        'time' => $booking->time,
        'guests_count' => $booking->guests_count,
        'status' => $booking->status,
        'table_number' => $booking->table_number,
        'internal_comment' => $booking->internal_comment,
        'internal_comment_en' => $booking->internal_comment_en,  // Добавляем перевод комментария
    ]);
}

    public function getBookingsAjax(Request $request)
{
    if (!$request->ajax()) {
        return response()->json(['error' => 'Не AJAX запрос'], 400);
    }
    
    $query = Booking::query();
    
    // Фильтр по дате (если передана)
    if ($request->filled('date')) {
        $query->where('date', $request->date);
    }
    
    // Фильтр по статусу
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('date_from')) {
        $query->where('date', '>=', $request->date_from);
    }
    if ($request->filled('date_to')) {
        $query->where('date', '<=', $request->date_to);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('guest_name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }
    
    $bookings = $query->orderBy('date')->orderBy('time')->get();
    
    return response()->json([
        'success' => true,
        'bookings' => $bookings,
        'count' => $bookings->count()
    ]);
}

    public function listGallery()
{
    $gallery = Gallery::orderBy('sort_order')->get();
    return view('admin.gallery', compact('gallery'));
}

    // В методе storeGallery
public function storeGallery(Request $request)
{
    $translator = app(YandexTranslateService::class);
    
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);
    
    $photoPath = $this->uploadImage($request->file('image'), 'gallery');
    
    Gallery::create([
        'image_url' => $photoPath,
        'title' => $request->title,
        'title_en' => $translator->translate($request->title),
        'description' => $request->description,
        'description_en' => $translator->translate($request->description),
        'sort_order' => $request->sort_order ?? 0,
    ]);
    
    Cache::forget('gallery_photos');
    
    return redirect()->route('admin.gallery')->with('success', 'Фото добавлено');
}

// В методе updateGallery
public function updateGallery(Request $request, $id)
{
    $translator = app(YandexTranslateService::class);
    $photo = Gallery::findOrFail($id);
    
    if ($request->hasFile('image')) {
        $this->deleteImage($photo->image_url);
        $photo->image_url = $this->uploadImage($request->file('image'), 'gallery');
    }
    
    $photo->title = $request->title;
    $photo->title_en = $translator->translate($request->title);
    $photo->description = $request->description;
    $photo->description_en = $translator->translate($request->description);
    $photo->sort_order = $request->sort_order ?? 0;
    $photo->save();
    
    Cache::forget('gallery_photos');
    
    return redirect()->route('admin.gallery')->with('success', 'Фото обновлено');
}

    public function destroyGallery($id)
    {
        $photo = Gallery::findOrFail($id);
        $this->deleteImage($photo->image_url);
        $photo->delete();
        
        Cache::forget('gallery_photos');
        
        return redirect()->route('admin.gallery')->with('success', 'Фото удалено');
    }
    // ========== Управление лучшими блюдами ==========
    public function listBestDishes()
    {
        $bestDishes = BestDish::orderBy('sort_order')->get();
        return view('admin.best-dishes', compact('bestDishes'));
    }

    public function storeBestDish(Request $request)
    {
        $translator = app(YandexTranslateService::class);

    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        'description' => 'nullable|string',
        'price' => 'nullable|string',
        'sort_order' => 'nullable|integer',
    ]);

    $photoPath = $this->uploadImage(
        $request->file('image'),
        'best-dishes'
    );
        BestDish::create([
        // Русский
        'title' => $request->title,
        'description' => $request->description,

        // Английский (автоматический перевод)
        'title_en' => $translator->translate($request->title),
        'description_en' => $translator->translate($request->description),

        // Остальное
        'image_url' => $photoPath,
        'price' => $request->price,
        'sort_order' => $request->sort_order ?? 0,
    ]);
        
        
        Cache::forget('menu_best_dishes');

    return redirect()
        ->route('admin.best-dishes')
        ->with('success', 'Блюдо добавлено');
    }

    public function updateBestDish(Request $request, $id)
{
    $translator = app(YandexTranslateService::class);

    $dish = BestDish::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|string',
        'sort_order' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    if ($request->hasFile('image')) {
        $this->deleteImage($dish->image_url);

        $dish->image_url = $this->uploadImage(
            $request->file('image'),
            'best-dishes'
        );
    }

    // Русский
    $dish->title = $request->title;
    $dish->description = $request->description;

    // Английский
    $dish->title_en = $translator->translate($request->title);
    $dish->description_en = $translator->translate($request->description);

    // Остальное
    $dish->price = $request->price;
    $dish->sort_order = $request->sort_order ?? 0;

    $dish->save();

    Cache::forget('menu_best_dishes');

    return redirect()
        ->route('admin.best-dishes')
        ->with('success', 'Блюдо обновлено');
}
    public function destroyBestDish($id)
    {
        $dish = BestDish::findOrFail($id);
        $this->deleteImage($dish->image_url);
        $dish->delete();
        
        Cache::forget('menu_best_dishes');
        
        return redirect()->route('admin.best-dishes')->with('success', 'Блюдо удалено');
    }

    // ========== Управление администраторами ==========
    public function listAdmins()
    {
        $admins = Admin::all();
        return view('admin.admins', compact('admins'));
    }

    public function storeAdmin(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'login' => 'required|string|max:255|unique:admins,login',
        'password' => 'required|string|min:6',
        'role' => 'required|in:super_admin,admin', // Добавить
    ]);
    
    Admin::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'login' => $request->login,
        'password' => bcrypt($request->password),
        'role' => $request->role, // Добавить
    ]);
    
    return redirect()->route('admin.admins')->with('success', 'Администратор добавлен');
}

    public function updateAdmin(Request $request, $id)
{
    $admin = Admin::findOrFail($id);
    
    // Не даём изменить роль самого себя
    $currentAdminId = session('admin_id');
    if ($admin->id == $currentAdminId && $request->role !== $admin->role) {
        return redirect()->route('admin.admins')->with('error', 'Нельзя изменить свою роль');
    }
    
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'login' => 'required|string|max:255|unique:admins,login,' . $id,
        'password' => 'nullable|string|min:6',
        'role' => 'required|in:super_admin,admin', // Добавить
    ]);
    
    $admin->first_name = $request->first_name;
    $admin->last_name = $request->last_name;
    $admin->login = $request->login;
    $admin->role = $request->role; // Добавить
    
    if ($request->filled('password')) {
        $admin->password = bcrypt($request->password);
    }
    
    $admin->save();
    
    return redirect()->route('admin.admins')->with('success', 'Администратор обновлён');
}

    public function destroyAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        
        // Не даём удалить самого себя
        if ($admin->id === auth()->id() || $admin->id === session('admin_id')) {
            return redirect()->route('admin.admins')->with('error', 'Нельзя удалить самого себя');
        }
        
        $admin->delete();
        
        return redirect()->route('admin.admins')->with('success', 'Администратор удалён');
    }
}