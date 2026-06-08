<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <title>{{ __('messages.vkucno_events') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html {
            scroll-behavior: smooth;
        }

        /* Отступ для всех якорных элементов (шапка не перекрывает) */
        section, [id] {
            scroll-margin-top: 170px;
        }
        body {
        font-family: 'Cormorant Garamond', serif;
        background-color: #fef9f0;
        color: #2c2b28;
        line-height: 1.5;
    }
    .header {
        background-color: #1a1a1a;
        padding: 0.8rem 2rem;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .header-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .logo {
        flex-shrink: 0;
    }
    .logo img {
        max-height: 50px;
        width: auto;
        display: block;
    }
    .nav {
        flex: 1;
        display: flex;
        justify-content: center;
    }
    .nav-list {
        display: flex;
        gap: 2rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .nav-item {
        position: relative;
    }
    .nav-item > a {
        color: #f5e7d9;
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 0;
        display: inline-block;
        font-size: 1.1rem;
        transition: color 0.3s;
    }
    .nav-item > a:hover, .nav-item > a.active {
        color: #d4af37;
    }
        .dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #2a2a2a;
        min-width: 180px;
        border-radius: 8px;
        list-style: none;
        padding: 0.5rem 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .nav-item:hover .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .dropdown li a {
        display: block;
        padding: 0.5rem 1rem;
        color: #f5e7d9;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .dropdown li a:hover {
        background-color: #d4af37;
        color: #1a1a1a;
    }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .section-title {
            font-size: 2rem;
            border-left: 6px solid #d4af37;
            padding-left: 1rem;
            margin-bottom: 1.5rem;
            color: #2c2b28;
        }
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .event-photo {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background-color: #e2d5c0;
        }
        .event-content {
            padding: 1.5rem;
        }
        .event-date {
            display: inline-block;
            background: #d4af37;
            color: #1a1a1a;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-bottom: 0.8rem;
        }
        .event-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 0.8rem;
            color: #2c2b28;
        }
        .event-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        .event-link {
            display: inline-block;
            background: #1a1a1a;
            color: #d4af37;
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
        }
        .event-link:hover {
            background: #d4af37;
            color: #1a1a1a;
        }
        .past-section {
            margin-top: 2rem;
        }
        .past-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .past-card .event-photo {
            height: 180px;
        }
        .social-links {
        display: flex;
        gap: 1rem;
        flex-shrink: 0;
    }
    .social-link {
        background-color: transparent;
        color: #f5e7d9;
        padding: 0.3rem 0.8rem;
        border-radius: 40px;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s;
    }
    .social-link:hover {
        color: #d4af37;
    }
        
        .contacts-short {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 0.9rem;
        }
        
        .admin-toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #222;
            color: gold;
            padding: 10px 16px;
            border-radius: 30px;
            font-size: 0.8rem;
            opacity: 0;
            transition: 0.2s;
            pointer-events: none;
            z-index: 999;
        }
        .empty-message {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 20px;
            color: #999;
        }
        /* ===== ТЁМНАЯ ТЕМА ===== */
body.dark-theme {
    background-color: #121212;
    color: #e0e0e0;
}

body.dark-theme .header {
    background-color: #0d0d0d;
    border-bottom: 1px solid #2a2a2a;
}



body.dark-theme .nav-item > a,
body.dark-theme .social-link {
    color: #e0e0e0;
}

body.dark-theme .nav-item > a:hover,
body.dark-theme .social-link:hover {
    color: #c9a84c;
}

body.dark-theme .dropdown {
    background-color: #1a1a1a;
}

body.dark-theme .section-title {
    color: #e0e0e0;
}

body.dark-theme .about-text,
body.dark-theme .event-card,
body.dark-theme .review-card,
body.dark-theme .staff-card,
body.dark-theme .booking-section,
body.dark-theme .info-card,
body.dark-theme .feedback-form,
body.dark-theme .menu-image,
body.dark-theme .gallery-slider,
body.dark-theme .menu-slider-wrap,
body.dark-theme .dish-card {
    background: #1e1e1e;
    color: #e0e0e0;
    border-color: #333;
}

body.dark-theme .event-description,
body.dark-theme .review-text {
    color: #b0b0b0;
}



body.dark-theme .contacts-short {
    color: #a0a0a0;
}

body.dark-theme input,
body.dark-theme select,
body.dark-theme textarea {
    background: #2a2a2a;
    border-color: #444;
    color: #e0e0e0;
}

body.dark-theme input:focus,
body.dark-theme select:focus,
body.dark-theme textarea:focus {
    border-color: #c9a84c;
}

body.dark-theme .btn-submit {
    background: #c9a84c;
    color: #1a1a1a;
}

body.dark-theme .success-message {
    background: rgba(76, 175, 80, 0.2);
    color: #4caf50;
}

body.dark-theme .error-message {
    background: rgba(244, 67, 54, 0.2);
    color: #f44336;
}

body.dark-theme .empty-message,
body.dark-theme .empty-state {
    background: #1e1e1e;
    color: #a0a0a0;
}

body.dark-theme .swiper-button-next,
body.dark-theme .swiper-button-prev {
    color: #c9a84c;
}

body.dark-theme .slide-caption {
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
}
/* Кнопка переключения темы */
.theme-switcher {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 1000;
}

.theme-btn {
    background: #1a1a1a;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.theme-btn:hover {
    transform: scale(1.1);
}

.theme-icon-dark {
    display: none;
}

body.dark-theme .theme-icon-light {
    display: none;
}

body.dark-theme .theme-icon-dark {
    display: inline;
}

body.dark-theme .theme-btn {
    background: #c9a84c;
    color: #1a1a1a;
}

@media (max-width: 768px) {
    .theme-switcher {
        bottom: 15px;
        left: 15px;
    }
    .theme-btn {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
}
/* ===== ТЁМНАЯ ТЕМА - МЕРОПРИЯТИЯ ===== */
body.dark-theme .event-card {
    background: #1e1e1e;
    border: 1px solid #333;
}

body.dark-theme .event-title {
    color: #e0e0e0;
}

body.dark-theme .event-description {
    color: #b0b0b0;
}

body.dark-theme .event-link {
    background: #c9a84c;
    color: #1a1a1a;
}

body.dark-theme .event-link:hover {
    background: #d4af37;
}

body.dark-theme .empty-message {
    background: #1e1e1e;
    color: #a0a0a0;
    border: 1px solid #333;
}

/* Модальное окно */
body.dark-theme #eventModal > div {
    background: #1e1e1e !important;
    color: #e0e0e0;
    border: 1px solid #444;
}

body.dark-theme #eventModal .event-date {
    background: #c9a84c;
    color: #1a1a1a;
}

body.dark-theme #eventModal h2 {
    color: #e0e0e0;
}

body.dark-theme #eventModal p {
    color: #b0b0b0;
}

body.dark-theme #eventModal button {
    color: #c9a84c;
    background: transparent;
}

body.dark-theme #eventModal button:hover {
    color: #d4af37;
}

body.dark-theme #eventModal {
    background: rgba(0, 0, 0, 0.95);
}
/* ===== АДАПТИВНАЯ ШАПКА ===== */

/* Планшеты (до 992px) */
@media (max-width: 992px) {
    .header-container {
        gap: 1rem;
    }
    
    .nav-list {
        gap: 1.2rem;
    }
    
    .nav-item > a {
        font-size: 1rem;
    }
    
    .social-link {
        font-size: 0.9rem;
        padding: 0.2rem 0.6rem;
    }
}

/* Мобильные устройства (до 768px) */
@media (max-width: 768px) {
    .header {
        padding: 0.8rem 1rem;
    }
    
    .header-container {
        flex-direction: column;
        gap: 0.8rem;
    }
    
    .logo {
        text-align: center;
    }
    
    .logo img {
        max-height: 45px;
    }
    
    .nav {
        width: 100%;
    }
    
    .nav-list {
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.8rem;
    }
    
    .nav-item > a {
        font-size: 0.9rem;
        padding: 0.3rem 0;
    }
    
    .dropdown {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        background: transparent;
        box-shadow: none;
        padding: 0;
        margin-top: 0.3rem;
        display: none;
    }
    
    /* Выпадающее меню на мобильных - появляется при клике */
    .nav-item.active .dropdown {
        display: block;
    }
    
    .dropdown li a {
        padding: 0.3rem 0 0.3rem 1rem;
        font-size: 0.8rem;
        color: #d4af37;
    }
    
    .dropdown li a:hover {
        background: none;
        color: #ffd700;
    }
    
    .social-links {
        width: 100%;
        justify-content: center;
        gap: 1.5rem;
    }
    
    .social-link {
        font-size: 0.85rem;
        padding: 0.2rem 0.5rem;
    }
}

/* Маленькие телефоны (до 480px) */
@media (max-width: 480px) {
    .header {
        padding: 0.6rem 0.8rem;
    }
    
    .logo img {
        max-height: 38px;
    }
    
    .nav-list {
        gap: 0.6rem;
    }
    
    .nav-item > a {
        font-size: 0.8rem;
    }
    
    .social-link {
        font-size: 0.75rem;
        padding: 0.15rem 0.4rem;
    }
}
.language-switcher {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.language-btn {
    background: #1a1a1a;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    color: #ffffff;
    font-family: 'DM Sans', sans-serif;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
    letter-spacing: 0.5px;
}

.language-btn:hover {
    transform: scale(1.1);
}
body.dark-theme .language-btn {
    background: #c9a84c;
}

@media (max-width: 768px) {

    .language-switcher {
        bottom: 15px;
        right: 15px;
    }

    .language-btn {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
}
</style>
</head>
<body>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Ресторан Вкусно">
        </div>
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('home') }}">{{ __('messages.home') }}</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('home') }}#about">{{ __('messages.about') }}</a></li>
                        <li><a href="{{ route('home') }}#staff">{{ __('messages.staff') }}</a></li>
                        <li><a href="{{ route('home') }}#reviews">{{ __('messages.reviews') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menu') }}">{{ __('messages.menu') }}</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('menu') }}#best-dishes">{{ __('messages.best_dishes') }}</a></li>
                        <li><a href="{{ route('menu') }}#full-menu">{{ __('messages.menu') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events') }}">{{ __('messages.events') }}</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('events') }}#upcoming">{{ __('messages.upcoming_events') }}</a></li>
                        <li><a href="{{ route('events') }}#past">{{ __('messages.past_events') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('booking') }}">{{ __('messages.booking') }}</a></li>
                <li class="nav-item">
                    <a href="{{ route('contacts') }}">{{ __('messages.contacts') }}</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('contacts') }}#map">{{ __('messages.route_map') }}</a></li>
                        <li><a href="{{ route('contacts') }}#feedback">{{ __('messages.feedback') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="social-links">
            <a href="#" class="social-link">Telegram</a>
            <a href="#" class="social-link">VK</a>
        </div>
    </div>
</header>

<main class="container">
    <!-- Предстоящие мероприятия -->
    <section id="upcoming">
        <h2 class="section-title">{{ __('messages.upcoming_events') }}</h2>
        
        @if($upcomingEvents->count() > 0)
            <div class="events-grid">
                @foreach($upcomingEvents as $event)
                    <div class="event-card">
                        @if($event->photo_url)
                            <img src="{{ $event->photo_url }}" alt="{{ $event->title }}" class="event-photo">
                        @else
                            <img src="https://placehold.co/400x220?text=Нет+фото" alt="Нет фото" class="event-photo">
                        @endif
                        <div class="event-content">
                            <div class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('d.m.Y') }}
                                @if($event->start_time)
                                    <span style="margin-left: 10px;">🕐 {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}</span>
                                @endif
                            </div>
                            <h3 class="event-title">{{ app()->getLocale() === 'en'
                                ? ($event->title_en ?? $event->title)
                                : $event->title }}</h3>
                            <p class="event-description">{{ app()->getLocale() === 'en'
                                ? ($event->short_description_en ?? $event->short_description)
                                : $event->short_description }}</p>
                            <a href="#" class="event-link"
   data-title="{{ e(app()->getLocale() === 'en' ? ($event->title_en ?? $event->title) : $event->title) }}"
   data-description="{{ e(app()->getLocale() === 'en' ? ($event->full_description_en ?? $event->short_description_en ?? $event->full_description ?? $event->short_description) : ($event->full_description ?? $event->short_description)) }}"
   data-date="{{ e(\Carbon\Carbon::parse($event->date)->format('d.m.Y') . ($event->start_time ? ' в ' . \Carbon\Carbon::parse($event->start_time)->format('H:i') : '')) }}"
   onclick="showEventDetails(this); return false;">Подробнее →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <p>🎉 Скоро здесь появятся анонсы новых мероприятий!</p>
                <p>Следите за обновлениями.</p>
            </div>
        @endif
    </section>

    <!-- Прошедшие мероприятия -->
    <section id="past" class="past-section">
        <h2 class="section-title">{{ __('messages.past_events') }}</h2>
        
        @if($pastEvents->count() > 0)
            <div class="events-grid">
                @foreach($pastEvents as $event)
                    <div class="event-card past-card">
                        @if($event->photo_url)
                            <img src="{{ $event->photo_url }}" alt="{{ $event->title }}" class="event-photo">
                        @else
                            <img src="https://placehold.co/400x180?text=Нет+фото" alt="Нет фото" class="event-photo">
                        @endif
                        <div class="event-content">
                            <h3 class="event-title">{{ app()->getLocale() === 'en'
                                ? ($event->title_en ?? $event->title)
                                : $event->title }} </h3>
                            <p class="event-description">{{ app()->getLocale() === 'en'
                                ? ($event->short_description_en ?? $event->short_description)
                                : $event->short_description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <p>📸 Здесь будут фото и отчёты о прошедших событиях.</p>
            </div>
        @endif
    </section>
</main>

@include('layouts.footer')

<div id="adminToast" class="admin-toast">🔐 Админ-панель</div>

<!-- Модальное окно для подробной информации -->
<div id="eventModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; max-width: 500px; width: 90%; border-radius: 20px; padding: 2rem; position: relative; max-height: 80vh; overflow-y: auto;">
        <button onclick="closeModal()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 28px; cursor: pointer;">&times;</button>
        <div id="modalDate" style="background: #d4af37; display: inline-block; padding: 0.2rem 1rem; border-radius: 20px; margin-bottom: 1rem;"></div>
        <h2 id="modalTitle" style="margin-bottom: 1rem;"></h2>
        <p id="modalDescription" style="line-height: 1.6;"></p>
    </div>
</div>

<script>
    

    function showEventDetails(el) {
    const link = el.closest('[data-title]');
    
    console.log('link:', link);
    console.log('title:', link?.dataset.title);
    console.log('description:', link?.dataset.description);
    
    const title = link.dataset.title;
    const description = link.dataset.description;
    const dateTime = link.dataset.date;

    document.getElementById('modalDate').innerHTML = dateTime;
    document.getElementById('modalTitle').innerHTML = title;
    document.getElementById('modalDescription').innerHTML = description;
    document.getElementById('eventModal').style.display = 'flex';
}

    function closeModal() {
        document.getElementById('eventModal').style.display = 'none';
    }
</script>
<!-- Переключатель темы -->
<div class="theme-switcher">
    <button id="themeToggle" class="theme-btn" aria-label="Переключить тему">
        <span class="theme-icon-light">☀️</span>
        <span class="theme-icon-dark">🌙</span>
    </button>
</div>

<!-- Переключатель языка -->
<div class="language-switcher">
    <button id="languageToggle" class="language-btn">
        {{ app()->getLocale() === 'ru' ? 'RU' : 'EN' }}
    </button>
</div>

<script>
    function setTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-theme');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-theme');
            localStorage.setItem('theme', 'light');
        }
    }
    
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        setTheme('dark');
    }
    
    document.getElementById('themeToggle')?.addEventListener('click', () => {
        const isDark = document.body.classList.contains('dark-theme');
        setTheme(isDark ? 'light' : 'dark');
    });
    // Мобильное меню: клик по пункту с подменю
document.querySelectorAll('.nav-item').forEach(item => {
    const link = item.querySelector('a');
    const dropdown = item.querySelector('.dropdown');
    
    if (dropdown) {
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                // Закрываем другие открытые меню
                document.querySelectorAll('.nav-item').forEach(navItem => {
                    if (navItem !== item) {
                        navItem.classList.remove('active');
                    }
                });
                item.classList.toggle('active');
            }
        });
    }
});

// При клике вне меню закрываем его
document.addEventListener('click', function(e) {
    if (window.innerWidth <= 768) {
        if (!e.target.closest('.nav-item')) {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
        }
    }
});

// При изменении размера окна сбрасываем активные классы
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
    }
});

document.getElementById('languageToggle')?.addEventListener('click', function () {

    const currentLocale = "{{ app()->getLocale() }}";

    const newLocale = currentLocale === 'ru'
        ? 'en'
        : 'ru';

    window.location.href = `/lang/${newLocale}`;
});
</script>
</body>
</html>