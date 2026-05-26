<!-- Переключатель темы -->
<div class="theme-switcher">
    <button id="themeToggle" class="theme-btn" aria-label="Переключить тему">
        <span class="theme-icon-light">☀️</span>
        <span class="theme-icon-dark">🌙</span>
    </button>
</div>

<style>
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
    
    /* Адаптив */
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
</style>

<script>
    // Функция для применения темы
    function setTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-theme');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-theme');
            localStorage.setItem('theme', 'light');
        }
    }
    
    // Загрузка сохранённой темы
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        setTheme('dark');
    }
    
    // Обработчик кнопки
    document.getElementById('themeToggle')?.addEventListener('click', () => {
        const isDark = document.body.classList.contains('dark-theme');
        setTheme(isDark ? 'light' : 'dark');
    });
</script>