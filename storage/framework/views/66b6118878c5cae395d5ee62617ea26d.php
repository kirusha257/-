<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('messages.vkucno_glavn')); ?></title>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">
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
        section {
            margin-bottom: 3rem;
            scroll-margin-top: 100px;
        }
        .section-title {
            font-size: 2rem;
            border-left: 6px solid #d4af37;
            padding-left: 1rem;
            margin-bottom: 1.5rem;
            color: #2c2b28;
        }
        .about-text {
            font-size: 1.1rem;
            background: #fff7ef;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        /* Галерея */
        .gallery-section {
            margin-bottom: 3rem;
        }
        .gallery-slider {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .swiper {
            width: 100%;
            height: 500px;
        }
        .swiper-slide {
            position: relative;
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .slide-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 40px 20px 20px;
            text-align: center;
        }
        .slide-caption h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        .slide-caption p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .swiper-button-next,
        .swiper-button-prev {
            color: #d4af37;
        }
        .swiper-pagination-bullet-active {
            background: #d4af37;
        }
        
        .staff-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }
        .staff-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            width: 220px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .staff-card:hover { transform: translateY(-5px); }
        .staff-photo {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background-color: #e2d5c0;
        }
        .staff-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0.8rem 0 0.2rem;
        }
        .staff-position {
            color: #b8860b;
            margin-bottom: 1rem;
        }
        .reviews-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .review-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            flex: 1 1 280px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #f0e1d0;
        }
        .review-author {
            font-weight: bold;
            color: #b45f1b;
        }
        .review-rating {
            color: #d4af37;
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }
        .review-text {
            font-style: italic;
            color: #3e3a35;
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
        
        /* Адаптив */
        @media (max-width: 768px) {
            .swiper { height: 300px; }
            .slide-caption h3 { font-size: 1.2rem; }
            .slide-caption p { font-size: 0.8rem; }
            .nav { position: static; transform: none; white-space: normal; }
            .nav-list { gap: 1rem; flex-wrap: wrap; justify-content: center; }
            .logo-area { flex-wrap: wrap; justify-content: center; gap: 1rem; }
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
/* Стили для форматированного текста в секции "О нас" */
.about-text {
    font-size: 1.1rem;
    background: #fff7ef;
    padding: 1.5rem;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    line-height: 1.6;
}

/* Стили для HTML-элементов внутри about-text */
.about-text h1,
.about-text h2,
.about-text h3 {
    margin-top: 1.2em;
    margin-bottom: 0.6em;
    font-family: 'Cormorant Garamond', serif;
    font-weight: 600;
}

.about-text h1 { font-size: 2rem; }
.about-text h2 { font-size: 1.75rem; }
.about-text h3 { font-size: 1.5rem; }

.about-text p {
    margin-bottom: 1em;
    line-height: 1.7;
}

.about-text ul,
.about-text ol {
    margin: 1em 0;
    padding-left: 2em;
}

.about-text li {
    margin-bottom: 0.5em;
}

.about-text strong {
    font-weight: 600;
    color: #b45f1b;
}

.about-text em {
    font-style: italic;
}

.about-text a {
    color: #d4af37;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: border-color 0.2s;
}

.about-text a:hover {
    border-bottom-color: #d4af37;
}

/* Для темной темы */
body.dark-theme .about-text {
    background: #1e1e1e;
}

body.dark-theme .about-text strong {
    color: #c9a84c;
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
    <!-- О нас -->
    <section id="about">
        <h2 class="section-title"><?php echo e(__('messages.about')); ?></h2>
        <div class="about-text">
            <?php echo app()->getLocale() === 'en'
        ? ($about->content_en ?? $about->content)
        : $about->content ?? 'Информация о ресторане временно недоступна. Пожалуйста, зайдите позже.'; ?>

        </div>
    </section>

    <!-- Фотогалерея -->
    <section id="gallery" class="gallery-section">
        <div class="gallery-slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="swiper-slide">
                        <img src="<?php echo e($photo->image_url); ?>" alt="<?php echo e($photo->title); ?>">
                        <?php if($photo->title || $photo->description): ?>
                        <div class="slide-caption">
                            <h3><?php echo e(app()->getLocale() === 'en'
                                ? ($photo->title_en ?? $photo->title)
                                : $photo->title); ?></h3>
                            <p><?php echo e(app()->getLocale() === 'en'
                                ? ($photo->description_en ?? $photo->description)
                                : $photo->description); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/1200x500?text=Добавьте+фото+в+галерею" alt="Нет фото">
                        <div class="slide-caption">
                            <h3>Загрузите фото в админ-панели</h3>
                            <p>Раздел "Управление галереей"</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Персонал -->
    <section id="staff">
        <h2 class="section-title"><?php echo e(__('messages.staff')); ?></h2>
        <div class="staff-grid">
            <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="staff-card">
                <img src="<?php echo e($person->photo_url ? asset($person->photo_url) : 'https://placehold.co/400x400?text='.urlencode($person->name)); ?>" alt="<?php echo e($person->name); ?>" class="staff-photo">
                <div class="staff-name"><?php echo e(app()->getLocale() === 'en'
                    ? ($person->name_en ?? $person->name)
                    : $person->name); ?> </div>
                <div class="staff-position"><?php echo e(app()->getLocale() === 'en'
                    ? ($person->position_en ?? $person->position)
                    : $person->position); ?> </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Нет данных о персонале.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Отзывы -->
    <section id="reviews">
        <h2 class="section-title"><?php echo e(__('messages.reviews')); ?></h2>
        <div class="reviews-grid">
            <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="review-card">
                <div class="review-author"><?php echo e(app()->getLocale() === 'en'
                    ? ($review->author_en ?? $review->author)
                    : $review->author); ?> </div>
                <div class="review-rating">
                    <?php for($i=1; $i<=5; $i++): ?>
                        <?php if($i <= $review->rating): ?> ★ <?php else: ?> ☆ <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <div class="review-text">«<?php echo e(app()->getLocale() === 'en'
                    ? ($review->text_en ?? $review->text)
                    : $review->text); ?> »</div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Пока нет отзывов.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div id="adminToast" class="admin-toast">🔐 Админ-панель</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    
    // Инициализация слайдера Swiper с автопрокруткой
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'slide',
            speed: 800,
        });
    });
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
</html><?php /**PATH C:\Users\pomer\projects\web\WEB\resources\views/home.blade.php ENDPATH**/ ?>