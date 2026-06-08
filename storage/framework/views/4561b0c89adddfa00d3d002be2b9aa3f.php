<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">
    <title><?php echo e(__('messages.vkucno_contacts')); ?></title>
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
        .contacts-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .info-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .info-card h3 {
            color: #d4af37;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .info-icon {
            font-size: 1.5rem;
            min-width: 40px;
        }
        .info-text {
            color: #333;
        }
        .info-text strong {
            display: block;
            color: #2c2b28;
        }
        .map-container {
            background: white;
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .map-container iframe {
            width: 100%;
            height: 350px;
            border-radius: 12px;
            border: none;
        }
        .feedback-form {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c2b28;
        }
        .required {
            color: #e74c3c;
        }
        input, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #d4af37;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background: #d4af37;
            color: #1a1a1a;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover {
            background: #ffd700;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
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
            line-height: 1.6;
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
        @media (max-width: 768px) {
            .contacts-wrapper {
                grid-template-columns: 1fr;
            }
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
body.dark-theme label { color: #c9a84c; }
.info-text{
    color: #c9a84c;
}
body.dark-theme .info-text strong { color: #d4af37; }
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
    
    
    <div class="contacts-wrapper">
        <!-- Контактная информация -->
        <div class="info-card">
            <h3><?php echo e(__('messages.Contact us')); ?></h3>
            <div class="info-item">
                <div class="info-icon">📍</div>
                <div class="info-text">
                    <strong><?php echo e(__('messages.Address')); ?></strong>
                    <?php echo e(app()->getLocale() === 'en'
                        ? ($contacts->address_en ?? $contacts->address)
                        : $contacts->address ?? 'улица Володарского, 19, Севастополь'); ?>

                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">📞</div>
                <div class="info-text">
                    <strong><?php echo e(__('messages.Telephone')); ?></strong>
                    <?php echo e($contacts->phone ?? '+7 (495) 123-45-67'); ?>

                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">✉️</div>
                <div class="info-text">
                    <strong>Email</strong>
                    <a href="mailto:<?php echo e($contacts->email ?? 'vkusno@bk.ru'); ?>" style="color: #d4af37;"><?php echo e($contacts->email ?? 'vkusno@bk.ru'); ?></a>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">🕑</div>
                <div class="info-text">
                    <strong><?php echo e(__('messages.Operating mode')); ?></strong>
                    <?php echo e(app()->getLocale() === 'en'
                        ? ($contacts->work_hours_en ?? $contacts->work_hours)
                        : $contacts->work_hours ?? 'Пн–Вс: 12:00 – 00:00'); ?>

                </div>
            </div>
        </div>
        
        <!-- Карта -->
        <div class="map-container" id="map">
            <h3 style="margin-bottom: 1rem; color: #d4af37;"><?php echo e(__('messages.route_map')); ?></h3>
            <iframe 
                src="https://yandex.ru/map-widget/v1/?ll=33.523159,44.606298&z=17&pt=33.523159,44.606298,pm2rdm"
                allowfullscreen="true">
            </iframe>
        </div>
    </div>
    
    <!-- Форма обратной связи -->
    <div class="feedback-form" id="feedback">
        <h3 style="color: #d4af37; margin-bottom: 1rem;"><?php echo e(__('messages.feedback')); ?></h3>
        
        <?php if(session('feedback_success')): ?>
            <div class="success-message">
                <?php echo e(session('feedback_success')); ?>

            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo e(route('contacts.feedback')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label><?php echo e(__('messages.Your name')); ?><span class="required">*</span></label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <div style="color: #e74c3c; font-size: 0.85rem;"><?php echo e($message); ?></div> 
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="form-group">
                <label><?php echo e(__('messages.Email for the response')); ?><span class="required">*</span></label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <div style="color: #e74c3c; font-size: 0.85rem;"><?php echo e($message); ?></div> 
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="form-group">
                <label><?php echo e(__('messages.Message subject')); ?></label>
                <input type="text" name="subject" value="<?php echo e(old('subject')); ?>">
                <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: #e74c3c; font-size: 0.85rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label><?php echo e(__('messages.Evaluation')); ?></label>
                <select name="rating" style="width: auto;">
                    <option value="5">★★★★★ (5)</option>
                    <option value="4">★★★★☆ (4)</option>
                    <option value="3">★★★☆☆ (3)</option>
                    <option value="2">★★☆☆☆ (2)</option>
                    <option value="1">★☆☆☆☆ (1)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label><?php echo e(__('messages.Message')); ?> <span class="required">*</span></label>
                <textarea name="message" required><?php echo e(old('message')); ?></textarea>
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: #e74c3c; font-size: 0.85rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <button type="submit" class="btn-submit">Отправить сообщение</button>
        </form>
    </div>
</main>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div id="adminToast" class="admin-toast">🔐 Админ-панель</div>

<script>
    let clickCount = 0;
    let timeoutId = null;
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
            window.location.href = "<?php echo e(route('admin.login')); ?>";
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
</html><?php /**PATH C:\Users\pomer\projects\web\WEB\resources\views/contacts.blade.php ENDPATH**/ ?>