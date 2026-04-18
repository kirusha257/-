<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ресторан AAA | Главная</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fef9f0;
            color: #2c2b28;
            line-height: 1.5;
        }
        .header {
            background-color: #1a1a1a;
            color: #f5e7d9;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            background: #d4af37;
            display: inline-block;
            padding: 0.3rem 1rem;
            border-radius: 8px;
            color: #1a1a1a;
        }
        .nav {
            margin-top: 1rem;
        }
        .nav-list {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        .nav-item {
            position: relative;
        }
        .nav-item > a {
            color: #f5e7d9;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 0;
            display: inline-block;
        }
        .nav-item > a:hover {
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
        }
        .social-link {
            background-color: #1a1a1a;
            color: #f5e7d9;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            text-decoration: none;
        }
        .social-link:hover {
            background-color: #d4af37;
            color: #1a1a1a;
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
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
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
    </style>
</head>
<body>

<header class="header">
    <div class="logo-area">
        <div class="logo">AAA</div>
        <div class="social-links">
            <a href="#" class="social-link">Telegram</a>
            <a href="#" class="social-link">VK</a>
        </div>
    </div>
    <div class="nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#">Главная</a>
                <ul class="dropdown">
                    <li><a href="#about">О нас</a></li>
                    <li><a href="#staff">Персонал</a></li>
                    <li><a href="#reviews">Отзывы</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">Меню</a>
                <ul class="dropdown">
                    <li><a href="#">Основное меню</a></li>
                    <li><a href="#">Винная карта</a></li>
                    <li><a href="#">Бар</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">Мероприятия</a>
                <ul class="dropdown">
                    <li><a href="#">Предстоящие</a></li>
                    <li><a href="#">Прошедшие</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#">Заказ столика</a></li>
            <li class="nav-item">
                <a href="#">Контакты</a>
                <ul class="dropdown">
                    <li><a href="#">Схема проезда</a></li>
                    <li><a href="#">Обратная связь</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<main class="container">
    <section id="about">
        <h2 class="section-title">О нас</h2>
        <div class="about-text">
            {!! nl2br(e($about->content)) !!}
        </div>
    </section>

    <section id="staff">
        <h2 class="section-title">Персонал</h2>
        <div class="staff-grid">
            @forelse($staff as $person)
            <div class="staff-card">
                <img src="{{ $person->photo_url ? asset($person->photo_url) : 'https://placehold.co/400x400?text='.urlencode($person->name) }}" alt="{{ $person->name }}" class="staff-photo">
                <div class="staff-name">{{ $person->name }}</div>
                <div class="staff-position">{{ $person->position }}</div>
            </div>
            @empty
                <p>Нет данных о персонале.</p>
            @endforelse
        </div>
    </section>

    <section id="reviews">
        <h2 class="section-title">Отзывы</h2>
        <div class="reviews-grid">
            @forelse($reviews as $review)
            <div class="review-card">
                <div class="review-author">{{ $review->author }}</div>
                <div class="review-rating">
                    @for($i=1; $i<=5; $i++)
                        @if($i <= $review->rating) ★ @else ☆ @endif
                    @endfor
                </div>
                <div class="review-text">«{{ $review->text }}»</div>
            </div>
            @empty
                <p>Пока нет отзывов.</p>
            @endforelse
        </div>
    </section>
</main>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-logo-click" id="adminSecretButton">AAA</div>
        <div class="contacts-short">
            📍 ул. Тверская, 10, Москва<br>
            📞 +7 (495) 123-45-67<br>
            🕑 Пн–Вс: 12:00 – 00:00
        </div>
        <div class="social-links">
            <a href="#" class="social-link">Telegram</a>
            <a href="#" class="social-link">VK</a>
        </div>
    </div>
    <div style="margin-top: 1rem; font-size: 0.8rem;">© 2025 Ресторан AAA</div>
</footer>

<div id="adminToast" class="admin-toast">🔐 Админ-панель</div>

<script>
    let clickCount = 0;
    let timeoutId = null;
    const logoBtn = document.getElementById('adminSecretButton');
    const toast = document.getElementById('adminToast');

    function showToastMessage(msg) {
        toast.textContent = msg || '🔐 Админ-панель: демо-вход';
        toast.style.opacity = '1';
        setTimeout(() => { toast.style.opacity = '0'; }, 2000);
    }

    logoBtn.addEventListener('click', () => {
        clickCount++;
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => { clickCount = 0; }, 1000);
        if (clickCount === 5) {
            showToastMessage('✅ Доступ в интерфейс администратора');
            alert('Переход в админ-панель (согласно ТЗ: 5 кликов по логотипу в подвале)');
            clickCount = 0;
            // window.location.href = '/admin';
        }
    });
</script>
</body>
</html>