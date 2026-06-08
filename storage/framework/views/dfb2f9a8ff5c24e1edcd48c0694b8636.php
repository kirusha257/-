<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ресторан Вкусно | Меню</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">
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

.contacts-short {
    text-align: center;
    font-size: 0.85rem;
    line-height: 1.5;
    flex: 1;
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

.dishes-carousel-wrap {
    position: relative;
}

.dishes-pagination {
    position: static !important;
    margin-top: 16px;
    text-align: center;
}
    </style>
</head>
<body>
 
<header class="header">
    <div class="header-container">
        <div class="logo">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Ресторан Вкусно">
        </div>
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.home')); ?></a>
                    <ul class="dropdown">
                        <li><a href="<?php echo e(route('home')); ?>#about"><?php echo e(__('messages.about')); ?></a></li>
                        <li><a href="<?php echo e(route('home')); ?>#staff"><?php echo e(__('messages.staff')); ?></a></li>
                        <li><a href="<?php echo e(route('home')); ?>#reviews"><?php echo e(__('messages.reviews')); ?></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('menu')); ?>"><?php echo e(__('messages.menu')); ?></a>
                    <ul class="dropdown">
                        <li><a href="<?php echo e(route('menu')); ?>#best-dishes"><?php echo e(__('messages.best_dishes')); ?></a></li>
                        <li><a href="<?php echo e(route('menu')); ?>#full-menu"><?php echo e(__('messages.menu')); ?></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('events')); ?>"><?php echo e(__('messages.events')); ?></a>
                    <ul class="dropdown">
                        <li><a href="<?php echo e(route('events')); ?>#upcoming"><?php echo e(__('messages.upcoming_events')); ?></a></li>
                        <li><a href="<?php echo e(route('events')); ?>#past"><?php echo e(__('messages.past_events')); ?></a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="<?php echo e(route('booking')); ?>"><?php echo e(__('messages.booking')); ?></a></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('contacts')); ?>"><?php echo e(__('messages.contacts')); ?></a>
                    <ul class="dropdown">
                        <li><a href="<?php echo e(route('contacts')); ?>#map"><?php echo e(__('messages.route_map')); ?></a></li>
                        <li><a href="<?php echo e(route('contacts')); ?>#feedback"><?php echo e(__('messages.feedback')); ?></a></li>
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
        <h2 class="section-title"><?php echo e(__('messages.best_dishes')); ?></h2>
 
        <?php if($bestDishes->count() > 0): ?>
        <div class="dishes-carousel-wrap">
            <div class="dishes-carousel-mask">
                <div class="swiper dishes-swiper">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $bestDishes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dish): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <div class="dish-card" onclick="openLightbox('<?php echo e($dish->image_url); ?>')">
                                <img src="<?php echo e($dish->image_url); ?>" alt="<?php echo e($dish->title); ?>">
                                <div class="dish-overlay"></div>
                                <div class="dish-info">
                                    <div class="dish-name"><?php echo e(app()->getLocale() === 'en'
                                        ? ($dish->title_en ?? $dish->title)
                                        : $dish->title); ?> </div>
                                    <?php if($dish->description): ?>
                                        <div class="dish-desc"><?php echo e(app()->getLocale() === 'en'
                                            ? ($dish->description_en ?? $dish->description)
                                            : $dish->description); ?></div>
                                    <?php endif; ?>
                                    <?php if($dish->price): ?>
                                        <span class="dish-price"><?php echo e($dish->price); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="dishes-pagination swiper-pagination"></div>
        </div>
        <?php else: ?>
        <div class="empty-state">Скоро здесь появятся наши лучшие блюда…</div>
        <?php endif; ?>
    </section>
 
    <!-- ПОЛНОЕ МЕНЮ -->
    <section id="full-menu">
        <h2 class="section-title"><?php echo e(__('messages.menu')); ?></h2>
 
        <?php if($menuImages->count() > 0): ?>
        <div class="menu-slider-wrap">
            <div class="swiper menu-swiper">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $menuImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <img src="<?php echo e($photo->image_url); ?>" alt="Страница меню" onclick="openLightbox(this.src)">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php else: ?>
        <div class="empty-state">🍽️ Фотографии меню скоро появятся…</div>
        <?php endif; ?>
    </section>
 
</main>
 
<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 
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
        <?php echo e(app()->getLocale() === 'ru' ? 'RU' : 'EN'); ?>

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

    const currentLocale = "<?php echo e(app()->getLocale()); ?>";

    const newLocale = currentLocale === 'ru'
        ? 'en'
        : 'ru';

    window.location.href = `/lang/${newLocale}`;
});
</script>
</body>
</html><?php /**PATH C:\Users\pomer\projects\web\WEB\resources\views/menu.blade.php ENDPATH**/ ?>