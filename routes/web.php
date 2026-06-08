<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Http;

// Публичные маршруты
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/menu', [MainController::class, 'menu'])->name('menu');
Route::get('/events', [MainController::class, 'events'])->name('events');
Route::get('/booking', [MainController::class, 'booking'])->name('booking');
Route::post('/booking', [MainController::class, 'storeBooking'])->name('booking.store');
Route::get('/contacts', [MainController::class, 'contacts'])->name('contacts');
Route::post('/contacts/feedback', [MainController::class, 'sendFeedback'])->name('contacts.feedback');

// Авторизация админа
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/translate-test', function () {
    $response = Http::withHeaders([
        'Authorization' => 'Api-Key ' . env('YANDEX_TRANSLATE_API_KEY'),
    ])->post(
        'https://translate.api.cloud.yandex.net/translate/v2/translate',
        [
            'folderId' => env('YANDEX_FOLDER_ID'),
            'texts' => ['Привет мир'],
            'sourceLanguageCode' => 'ru',
            'targetLanguageCode' => 'en',
        ]
    );

    return response()->json([
        'status' => $response->status(),
        'body' => $response->json(),
    ]);
});

Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['ru', 'en'])) {
        abort(404);
    }
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch')->middleware('web');

// ========== АДМИН-ПАНЕЛЬ С РАЗДЕЛЕНИЕМ ПРАВ ==========
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    
    // Главная страница - доступна всем
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings-ajax', [AdminController::class, 'getBookingsAjax'])->name('admin.bookings.ajax');
    
    // ========== ТОЛЬКО ДЛЯ SUPER_ADMIN ==========
    Route::middleware(['admin.role:super_admin'])->group(function () {
        
        // Управление администраторами
        Route::get('/admins', [AdminController::class, 'listAdmins'])->name('admin.admins');
        Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admin.admins.store');
        Route::put('/admins/{id}', [AdminController::class, 'updateAdmin'])->name('admin.admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'destroyAdmin'])->name('admin.admins.destroy');
        
        // О нас
        Route::get('/about', [AdminController::class, 'editAbout'])->name('admin.about');
        Route::post('/about', [AdminController::class, 'updateAbout'])->name('admin.about.update');
        
        // Сотрудники
        Route::get('/staff', [AdminController::class, 'listStaff'])->name('admin.staff');
        Route::post('/staff', [AdminController::class, 'storeStaff'])->name('admin.staff.store');
        Route::put('/staff/{id}', [AdminController::class, 'updateStaff'])->name('admin.staff.update');
        Route::delete('/staff/{id}', [AdminController::class, 'destroyStaff'])->name('admin.staff.destroy');
        
        // Отзывы
        Route::get('/reviews', [AdminController::class, 'listReviews'])->name('admin.reviews');
        Route::post('/reviews', [AdminController::class, 'storeReview'])->name('admin.reviews.store');
        Route::put('/reviews/{id}', [AdminController::class, 'updateReview'])->name('admin.reviews.update');
        Route::delete('/reviews/{id}', [AdminController::class, 'destroyReview'])->name('admin.reviews.destroy');
        
        // Контакты и настройки
        Route::get('/contacts', [AdminController::class, 'editContacts'])->name('admin.contacts');
        Route::post('/contacts', [AdminController::class, 'updateContacts'])->name('admin.contacts.update');
        Route::post('/socials', [AdminController::class, 'updateSocialLinks'])->name('admin.socials.update');
        Route::post('/settings', [AdminController::class, 'updateSiteSettings'])->name('admin.settings.update');
    });
    
    // ========== ДЛЯ SUPER_ADMIN И ADMIN ==========
    Route::middleware(['admin.role:super_admin,admin'])->group(function () {
        
        // Меню
        Route::get('/menu', [AdminController::class, 'editMenu'])->name('admin.menu');
        Route::post('/menu/{category}', [AdminController::class, 'updateMenu'])->name('admin.menu.update');
        Route::post('/menu-image', [AdminController::class, 'storeMenuImage'])->name('admin.menu.store');
        Route::delete('/menu-image/{id}', [AdminController::class, 'destroyMenuImage'])->name('admin.menu.destroy');
        
        // Мероприятия
        Route::get('/events', [AdminController::class, 'listEvents'])->name('admin.events');
        Route::post('/events', [AdminController::class, 'storeEvent'])->name('admin.events.store');
        Route::put('/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
        Route::delete('/events/{id}', [AdminController::class, 'destroyEvent'])->name('admin.events.destroy');
        
        // Статистика
        Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
        
        // Галерея
        Route::get('/gallery', [AdminController::class, 'listGallery'])->name('admin.gallery');
        Route::post('/gallery', [AdminController::class, 'storeGallery'])->name('admin.gallery.store');
        Route::put('/gallery/{id}', [AdminController::class, 'updateGallery'])->name('admin.gallery.update');
        Route::delete('/gallery/{id}', [AdminController::class, 'destroyGallery'])->name('admin.gallery.destroy');
        
        // Лучшие блюда
        Route::get('/best-dishes', [AdminController::class, 'listBestDishes'])->name('admin.best-dishes');
        Route::post('/best-dishes', [AdminController::class, 'storeBestDish'])->name('admin.best-dishes.store');
        Route::put('/best-dishes/{id}', [AdminController::class, 'updateBestDish'])->name('admin.best-dishes.update');
        Route::delete('/best-dishes/{id}', [AdminController::class, 'destroyBestDish'])->name('admin.best-dishes.destroy');
        
        // Бронирования
        Route::get('/bookings', [AdminController::class, 'listBookings'])->name('admin.bookings');
        Route::get('/bookings/{id}/details', [AdminController::class, 'getBookingDetails'])->name('admin.bookings.details');
        Route::post('/bookings', [AdminController::class, 'createBooking'])->name('admin.bookings.store');
        Route::put('/bookings/{id}', [AdminController::class, 'updateBooking'])->name('admin.bookings.update');
        Route::delete('/bookings/{id}', [AdminController::class, 'destroyBooking'])->name('admin.bookings.destroy');
        Route::patch('/bookings/{id}/status', [AdminController::class, 'updateBookingStatus'])->name('admin.bookings.status');
        
        // Загрузка изображений
        Route::post('/upload-image', [AdminController::class, 'uploadImage'])->name('admin.upload.image');
    });
});