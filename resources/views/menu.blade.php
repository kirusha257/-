<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ресторан Вкусно | Меню</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');
 
        :root {
            --gold: #b8963e;
            --gold-light: #d4af37;
            --gold-pale: #f7f0dc;
            --gold-border: rgba(184,150,62,0.2);
            --bg: #faf7f2;
            --bg-warm: #f5efe4;
            --white: #fff;
            --text: #2a2520;
            --text-mid: #5a5248;
            --text-muted: #9a9088;
            --border: rgba(42,37,32,0.08);
            --dark: #1e1c19;
            --dark-card: #252320;
            --radius: 14px;
            --radius-sm: 8px;
            --shadow-sm: 0 2px 12px rgba(0,0,0,0.07);
            --shadow: 0 4px 24px rgba(0,0,0,0.1);
        }
 
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        section, [id] { scroll-margin-top: 120px; }
 
        body {
            font-family: 'Cormorant Garamond', serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }
 
        /* HEADER */
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
        .logo { flex-shrink: 0; }
        .logo img { max-height: 50px; width: auto; display: block; }
        .nav { flex: 1; display: flex; justify-content: center; }
        .nav-list { display: flex; gap: 2rem; list-style: none; margin: 0; padding: 0; }
        .nav-item { position: relative; }
        .nav-item > a { color: #f5e7d9; text-decoration: none; font-weight: 500; padding: 0.5rem 0; display: inline-block; font-size: 1.1rem; transition: color 0.3s; }
        .nav-item > a:hover, .nav-item > a.active { color: #d4af37; }
        .dropdown {
            position: absolute; top: 100%; left: 0; background-color: #2a2a2a; min-width: 180px; border-radius: 8px;
            list-style: none; padding: 0.5rem 0; opacity: 0; visibility: hidden; transform: translateY(-10px);
            transition: all 0.2s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .nav-item:hover .dropdown { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown li a { display: block; padding: 0.5rem 1rem; color: #f5e7d9; text-decoration: none; font-size: 0.9rem; }
        .dropdown li a:hover { background-color: #d4af37; color: #1a1a1a; }
        .social-links { display: flex; gap: 1rem; flex-shrink: 0; }
        .social-link { background-color: transparent; color: #f5e7d9; padding: 0.3rem 0.8rem; border-radius: 40px; text-decoration: none; font-size: 1rem; transition: color 0.3s; }
        .social-link:hover { color: #d4af37; }
 
        /* LAYOUT */
        .container { max-width: 1200px; margin: 0 auto; padding: 52px 32px 80px; }
        section { margin-bottom: 68px; }
 
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 28px;
            letter-spacing: 0.01em;
            position: relative;
            padding-bottom: 14px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 48px; height: 2px;
            background: var(--gold-light);
            border-radius: 2px;
        }
 
        /* DISHES CAROUSEL — фото вплотную */
        .dishes-carousel-mask {
            overflow: hidden;
            border-radius: var(--radius);
        }
        .dishes-swiper {
            overflow: visible; /* соседние слайды немного видны */
        }
        .dishes-swiper .swiper-slide {
            width: 340px;
            flex-shrink: 0;
        }
 
        .dish-card {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 4/5;
            cursor: pointer;
            background: var(--bg-warm);
        }
        .dish-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.45s ease;
        }
        .dish-card:hover img { transform: scale(1.05); }
 
        /* Градиент поверх — снизу темнее */
        .dish-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                transparent 35%,
                rgba(15,11,7,0.45) 60%,
                rgba(15,11,7,0.87) 100%
            );
            pointer-events: none;
        }
 
        .dish-info {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 18px 20px 22px;
        }
        .dish-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 500;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 5px;
        }
        .dish-desc {
            font-size: 0.77rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.5;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .dish-price {
            display: inline-block;
            background: var(--gold-light);
            color: var(--dark);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 4px 13px;
            border-radius: 20px;
            letter-spacing: 0.02em;
        }
 
        /* Кнопки карусели */
        .dishes-carousel-wrap .swiper-button-next,
        .dishes-carousel-wrap .swiper-button-prev {
            color: var(--gold-light);
            background: rgba(20,16,10,0.7);
            width: 42px; height: 42px;
            border-radius: 50%;
            backdrop-filter: blur(4px);
            transition: background 0.2s;
            top: 45%;
        }
        .dishes-carousel-wrap .swiper-button-next:hover,
        .dishes-carousel-wrap .swiper-button-prev:hover { background: rgba(20,16,10,0.95); }
        .dishes-carousel-wrap .swiper-button-next::after,
        .dishes-carousel-wrap .swiper-button-prev::after { font-size: 13px; font-weight: 800; }
        .dishes-pagination {
            text-align: center;
            margin-top: 16px;
        }
        .dishes-pagination .swiper-pagination-bullet { background: var(--text-muted); opacity: 0.45; }
        .dishes-pagination .swiper-pagination-bullet-active { background: var(--gold-light); opacity: 1; }
 
        /* FULL MENU SLIDER */
        .menu-slider-wrap {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow-sm);
        }
        .menu-swiper {
            width: 100%;
            height: 540px;
            border-radius: 10px;
            overflow: hidden;
        }
        .menu-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: zoom-in;
            background: var(--bg-warm);
        }
        .menu-swiper .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 6px;
        }
        .menu-swiper .swiper-button-next,
        .menu-swiper .swiper-button-prev { color: var(--gold-light); }
        .menu-swiper .swiper-pagination-bullet-active { background: var(--gold-light); }
 
        /* EMPTY STATE */
        .empty-state {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 52px 24px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
 
        /* FOOTER */
        .footer {
            background-color: #1a1a1a;
            color: #cbc3b5;
            padding: 1rem;
            text-align: center;
        }
        
        .footer-center { text-align: center; font-size: 0.82rem; line-height: 1.9; color: rgba(255,255,255,0.4); }
        .footer-logo-click {
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
            background: #2a2a2a;
            padding: 0.2rem 1rem;
            border-radius: 30px;
            user-select: none;
        }
        .footer-logo-click:hover { opacity: 1; }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
 
        .admin-toast {
            position: fixed; bottom: 24px; right: 24px;
            background: var(--dark-card); color: var(--gold-light);
            padding: 10px 18px; border-radius: 30px; font-size: 0.78rem;
            border: 1px solid var(--gold-border);
            opacity: 0; transition: opacity 0.2s; pointer-events: none; z-index: 9999;
        }
 
        /* LIGHTBOX */
        .lightbox {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.93);
            z-index: 2000;
            justify-content: center; align-items: center;
            cursor: zoom-out;
            backdrop-filter: blur(6px);
        }
        .lightbox img {
            max-width: 92vw; max-height: 92vh;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        .lightbox-close {
            position: absolute; top: 20px; right: 28px;
            font-size: 1.8rem; color: rgba(255,255,255,0.55);
            cursor: pointer; line-height: 1;
            transition: color 0.2s;
        }
        .lightbox-close:hover { color: #fff; }
 
        /* RESPONSIVE */
        @media (max-width: 900px) {
            .dishes-swiper .swiper-slide { width: 270px; }
            .menu-swiper { height: 380px; }
        }
        @media (max-width: 640px) {
            .header-container { padding: 0 18px; height: auto; flex-wrap: wrap; padding: 12px 18px; }
            .container { padding: 36px 18px 60px; }
            .nav-list { gap: 14px; flex-wrap: wrap; justify-content: center; }
            .dishes-swiper .swiper-slide { width: 230px; }
            .menu-swiper { height: 280px; }
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

body.dark-theme .footer {
    background-color: #0d0d0d;
}

body.dark-theme .footer-logo-click {
    background: #2a2a2a;
    color: #c9a84c;
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
/* ===== ПОДВАЛ ===== */
.footer {
    background-color: #1a1a1a;
    color: #cbc3b5;
    padding: 1.5rem 2rem;
    text-align: center;
    margin-top: 2rem;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.footer-logo-click {
    cursor: pointer;
    font-weight: bold;
    font-size: 1.1rem;
    background: #2a2a2a;
    padding: 0.3rem 1rem;
    border-radius: 30px;
    user-select: none;
    transition: opacity 0.3s;
}

.footer-logo-click:hover {
    opacity: 0.8;
}

.contacts-short {
    text-align: center;
    font-size: 0.85rem;
    line-height: 1.5;
    flex: 1;
}

/* Адаптивный подвал */
@media (max-width: 768px) {
    .footer {
        padding: 1.2rem 1rem;
    }
    
    .footer-content {
        flex-direction: column;
        gap: 0.8rem;
        justify-content: center;
    }
    
    .contacts-short {
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .footer {
        padding: 1rem 0.8rem;
    }
    
    .contacts-short {
        font-size: 0.7rem;
    }
    
    .footer-logo-click {
        font-size: 0.9rem;
        padding: 0.2rem 0.8rem;
    }
}
.footer {
    background-color: #1a1a1a;
    color: #cbc3b5;
    padding: 2rem;
    text-align: center;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.contacts-short {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    font-size: 0.9rem;
}

.footer-logo-click {
    cursor: pointer;
    font-weight: bold;
    font-size: 1.2rem;
    background: #2a2a2a;
    padding: 0.2rem 1rem;
    border-radius: 30px;
    user-select: none;
}

/* Адаптивный подвал */
@media (max-width: 768px) {
    .footer {
        padding: 1.5rem 1rem;
    }
    
    .footer-content {
        flex-direction: column;
        gap: 1rem;
    }
    
    .contacts-short {
        position: static;
        transform: none;
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
                    <a href="{{ route('home') }}">Главная</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('home') }}#about">О нас</a></li>
                        <li><a href="{{ route('home') }}#staff">Персонал</a></li>
                        <li><a href="{{ route('home') }}#reviews">Отзывы</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menu') }}">Меню</a>
                    <ul class="dropdown">
                        <li><a href="#best-dishes">Лучшие блюда</a></li>
                        <li><a href="#full-menu">Меню</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events') }}">Мероприятия</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('events') }}#upcoming">Предстоящие</a></li>
                        <li><a href="{{ route('events') }}#past">Прошедшие</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('booking') }}">Заказ столика</a></li>
                <li class="nav-item">
                    <a href="{{ route('contacts') }}">Контакты</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('contacts') }}#map">Схема проезда</a></li>
                        <li><a href="{{ route('contacts') }}#feedback">Обратная связь</a></li>
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
 
    <!-- ЛУЧШИЕ БЛЮДА -->
    <section id="best-dishes">
        <h2 class="section-title">Наши лучшие блюда</h2>
 
        @if($bestDishes->count() > 0)
        <div class="dishes-carousel-wrap">
            <div class="dishes-carousel-mask">
                <div class="swiper dishes-swiper">
                    <div class="swiper-wrapper">
                        @foreach($bestDishes as $dish)
                        <div class="swiper-slide">
                            <div class="dish-card" onclick="openLightbox('{{ $dish->image_url }}')">
                                <img src="{{ $dish->image_url }}" alt="{{ $dish->title }}">
                                <div class="dish-overlay"></div>
                                <div class="dish-info">
                                    <div class="dish-name">{{ $dish->title }}</div>
                                    @if($dish->description)
                                        <div class="dish-desc">{{ $dish->description }}</div>
                                    @endif
                                    @if($dish->price)
                                        <span class="dish-price">{{ $dish->price }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="dishes-pagination swiper-pagination"></div>
        </div>
        @else
        <div class="empty-state">Скоро здесь появятся наши лучшие блюда…</div>
        @endif
    </section>
 
    <!-- ПОЛНОЕ МЕНЮ -->
    <section id="full-menu">
        <h2 class="section-title">Полное меню</h2>
 
        @if($menuImages->count() > 0)
        <div class="menu-slider-wrap">
            <div class="swiper menu-swiper">
                <div class="swiper-wrapper">
                    @foreach($menuImages as $photo)
                    <div class="swiper-slide">
                        <img src="{{ $photo->image_url }}" alt="Страница меню" onclick="openLightbox(this.src)">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        @else
        <div class="empty-state">🍽️ Фотографии меню скоро появятся…</div>
        @endif
    </section>
 
</main>
 
<footer class="footer">
    <div class="footer-content">
        <div class="footer-logo-click" id="adminSecretButton">Вкусно</div>
        <div class="contacts-short">
            улица Володарского, 19, Севастополь<br>
            +7 (495) 123-45-67<br>
            Пн–Вс: 12:00 – 00:00
        </div>
    </div>
</footer>
 
<div id="adminToast" class="admin-toast">🔐 Админ-панель</div>
 
<!-- Lightbox -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <div class="lightbox-close" onclick="closeLightbox()">✕</div>
    <img id="lightboxImg" src="" alt="" onclick="event.stopPropagation()">
</div>
 
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    /* Карусель блюд: slidesPerView:'auto' + spaceBetween:12 = фото вплотную */
    if (document.querySelector('.dishes-swiper')) {
        new Swiper('.dishes-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 12,
            loop: true,
            centeredSlides: true,
            autoplay: { delay: 3500, disableOnInteraction: false },
            pagination: { el: '.dishes-pagination', clickable: true },
            navigation: {
                nextEl: '.dishes-swiper .swiper-button-next',
                prevEl: '.dishes-swiper .swiper-button-prev',
            },
            speed: 550,
            grabCursor: true,
        });
    }
 
    /* Слайдер полного меню */
    if (document.querySelector('.menu-swiper')) {
        new Swiper('.menu-swiper', {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.menu-swiper .swiper-pagination', clickable: true },
            navigation: {
                nextEl: '.menu-swiper .swiper-button-next',
                prevEl: '.menu-swiper .swiper-button-prev',
            },
            speed: 700,
            grabCursor: true,
        });
    }
 
    /* Lightbox */
    function openLightbox(src) {
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightbox').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
 
    /* Секрет-кнопка */
    let clickCount = 0, timeoutId = null;
    const logoBtn = document.getElementById('adminSecretButton');
    const toast = document.getElementById('adminToast');
    function showToastMessage(msg) {
        toast.textContent = msg || '🔐 Админ-панель';
        toast.style.opacity = '1';
        setTimeout(() => { toast.style.opacity = '0'; }, 2000);
    }
    logoBtn.addEventListener('click', () => {
        clickCount++;
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => { clickCount = 0; }, 1000);
        if (clickCount === 5) {
            showToastMessage('✅ Перенаправление на страницу входа...');
            window.location.href = "{{ route('admin.login') }}";
            clickCount = 0;
        }
    });
</script>
<!-- Переключатель темы -->
<div class="theme-switcher">
    <button id="themeToggle" class="theme-btn" aria-label="Переключить тему">
        <span class="theme-icon-light">☀️</span>
        <span class="theme-icon-dark">🌙</span>
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
</script>
</body>
</html>