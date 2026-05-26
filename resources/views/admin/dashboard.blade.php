<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root {
            --gold: #c9a84c; --gold-light: #e8c97a; --gold-dim: rgba(201,168,76,0.1);
            --bg: #111110; --bg-card: #1c1c1a; --bg-card-hover: #212120;
            --border: rgba(255,255,255,0.07); --border-gold: rgba(201,168,76,0.25);
            --text: #e8e4dc; --text-muted: #7a7670;
            --radius: 12px; --radius-sm: 8px;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 36px 28px 60px;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201,168,76,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }
        .page-wrap { max-width: 1100px; margin: 0 auto; position: relative; z-index: 1; }
        .topbar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 52px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }
        .topbar__brand { display: flex; align-items: center; gap: 16px; }
        .topbar__icon {
            width: 46px; height: 46px;
            background: var(--gold-dim);
            border: 1px solid var(--border-gold);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .topbar__name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.75rem;
            font-weight: 500;
            color: var(--gold);
            letter-spacing: 0.03em;
        }
        .topbar__sub {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 2px;
        }
        .logout-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-muted);
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            cursor: pointer;
            letter-spacing: 0.03em;
            transition: all 0.2s;
        }
        .logout-btn:hover { border-color: var(--border-gold); color: var(--gold); }

        .section-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 16px;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 12px;
        }
        .menu-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px 22px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .menu-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gold);
            transform: scaleX(0);
            transition: transform 0.2s;
            transform-origin: left;
        }
        .menu-card:hover { background: var(--bg-card-hover); border-color: var(--border-gold); transform: translateY(-2px); }
        .menu-card:hover::after { transform: scaleX(1); }
        .menu-card__icon {
            width: 40px; height: 40px;
            background: var(--gold-dim);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .menu-card__label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
        }
        .menu-card__arrow {
            margin-left: auto;
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: transform 0.2s;
        }
        .menu-card:hover .menu-card__arrow { transform: translateX(3px); color: var(--gold); }

        @media (max-width: 600px) {
            .menu-grid { grid-template-columns: 1fr 1fr; }
            body { padding: 20px 16px 40px; }
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__brand">
                <div class="topbar__icon">🍽️</div>
                <div>
                    <div class="topbar__name">Ресторан Вкусно</div>
                    <div class="topbar__sub">Панель управления</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Выйти →</button>
            </form>
        </div>

        <div class="section-label">Разделы</div>
        <div class="menu-grid">
            <a href="{{ route('admin.about') }}" class="menu-card">
                <div class="menu-card__icon">📝</div>
                <div class="menu-card__label">О нас</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.staff') }}" class="menu-card">
                <div class="menu-card__icon">👥</div>
                <div class="menu-card__label">Персонал</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.reviews') }}" class="menu-card">
                <div class="menu-card__icon">⭐</div>
                <div class="menu-card__label">Отзывы</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.menu') }}" class="menu-card">
                <div class="menu-card__icon">🍽️</div>
                <div class="menu-card__label">Меню</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.events') }}" class="menu-card">
                <div class="menu-card__icon">🎉</div>
                <div class="menu-card__label">Мероприятия</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.bookings') }}" class="menu-card">
                <div class="menu-card__icon">📅</div>
                <div class="menu-card__label">Бронирования</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.contacts') }}" class="menu-card">
                <div class="menu-card__icon">📞</div>
                <div class="menu-card__label">Контакты</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.statistics') }}" class="menu-card">
                <div class="menu-card__icon">📊</div>
                <div class="menu-card__label">Статистика</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.gallery') }}" class="menu-card">
                <div class="menu-card__icon">📸</div>
                <div class="menu-card__label">Галерея</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.best-dishes') }}" class="menu-card">
                <div class="menu-card__icon">⭐</div>
                <div class="menu-card__label">Лучшие блюда</div>
                <div class="menu-card__arrow">›</div>
            </a>
            <a href="{{ route('admin.admins') }}" class="menu-card">
                <div class="menu-card__icon">👥</div>
                <div class="menu-card__label">Администраторы</div>
                <div class="menu-card__arrow">›</div>
            </a>
        </div>
    </div>
</body>
</html>