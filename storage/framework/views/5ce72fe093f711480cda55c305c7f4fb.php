<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход — Ресторан Вкусно</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root {
            --gold: #c9a84c; --gold-light: #e8c97a;
            --bg: #111110; --bg-card: #1c1c1a; --bg-input: #151514;
            --border: rgba(255,255,255,0.07); --border-gold: rgba(201,168,76,0.3);
            --text: #e8e4dc; --text-muted: #7a7670;
            --red-bg: rgba(192,57,43,0.15); --red: #e07070;
            --radius: 14px; --radius-sm: 8px;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        /* subtle grid texture */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201,168,76,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,168,76,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }
        .wrap {
            width: 100%;
            max-width: 400px;
            position: relative;
        }
        .logo-area {
            text-align: center;
            margin-bottom: 36px;
        }
        .logo-icon {
            width: 56px;
            height: 56px;
            background: rgba(201,168,76,0.1);
            border: 1px solid var(--border-gold);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 16px;
        }
        .logo-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 500;
            color: var(--gold);
            letter-spacing: 0.05em;
        }
        .logo-sub {
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 36px 32px;
        }
        .field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
        .field label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .field input {
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 11px 14px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }
        .field input:focus { border-color: var(--border-gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.08); }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--gold);
            color: #0e0d0b;
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.03em;
            margin-top: 8px;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-submit:hover { background: var(--gold-light); transform: translateY(-1px); }
        .alert-error {
            background: var(--red-bg);
            border: 1px solid rgba(192,57,43,0.3);
            color: var(--red);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .footer-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            letter-spacing: 0.03em;
            transition: color 0.2s;
        }
        .footer-link:hover { color: var(--gold); }
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="logo-area">
            <div class="logo-icon">🍽️</div>
            <div class="logo-name">Ресторан Вкусно</div>
            <div class="logo-sub">Панель управления</div>
        </div>

        <div class="card">
            <?php if(session('error')): ?>
                <div class="alert-error"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="field">
                    <label>Логин</label>
                    <input type="text" name="login" placeholder="Введите логин" required autofocus>
                </div>
                <div class="field">
                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-submit">Войти</button>
            </form>
        </div>

        <a href="<?php echo e(route('home')); ?>" class="footer-link">← Вернуться на сайт</a>
    </div>
</body>
</html><?php /**PATH C:\Users\pomer\projects\web\WEB\resources\views/admin/login.blade.php ENDPATH**/ ?>