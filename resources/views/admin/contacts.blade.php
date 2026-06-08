<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты и настройки — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:820px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px;margin-bottom:20px;}
        .card__title{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:500;color:var(--gold);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--border);}
        .form-grid{display:grid;gap:14px;}
        .form-grid--2{grid-template-columns:repeat(2,1fr);}
        @media(max-width:640px){.form-grid--2{grid-template-columns:1fr;}}
        .field{display:flex;flex-direction:column;gap:6px;}
        .field__label{font-size:0.72rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        input[type=text],input[type=email],input[type=file]{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:10px 13px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.875rem;width:100%;outline:none;transition:border-color 0.2s;}
        input:focus{border-color:var(--border-gold);box-shadow:0 0 0 3px rgba(201,168,76,0.07);}
        input[type=file]{cursor:pointer;color:var(--text-muted);}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:10px 22px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.875rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;margin-top:8px;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:28px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Контакты и настройки</div>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        <!-- Контактная информация -->
        <div class="card">
    <div class="card__title">Контактная информация</div>
            <form method="POST" action="{{ route('admin.contacts.update') }}">
                @csrf
                <div class="form-grid form-grid--2">
                    <div class="field">
                        <label class="field__label">Адрес (RU)</label>
                        <input type="text" name="address" value="{{ $contacts->address ?? '' }}" placeholder="ул. Примерная, 1">
                        <small style="color:#7a7670;">EN: {{ $contacts->address_en ?? '—' }}</small>
                    </div>
                    <div class="field">
                        <label class="field__label">Телефон</label>
                        <input type="text" name="phone" value="{{ $contacts->phone ?? '' }}" placeholder="+7 (000) 000-00-00">
                    </div>
                    <div class="field">
                        <label class="field__label">Email</label>
                        <input type="email" name="email" value="{{ $contacts->email ?? '' }}" placeholder="info@restaurant.ru">
                    </div>
                    <div class="field">
                        <label class="field__label">Часы работы (RU)</label>
                        <input type="text" name="work_hours" value="{{ $contacts->work_hours ?? '' }}" placeholder="Пн–Вс 12:00–23:00">
                        <small style="color:#7a7670;">EN: {{ $contacts->work_hours_en ?? '—' }}</small>
                    </div>
                    <div class="field">
                        <label class="field__label">Координаты карты</label>
                        <input type="text" name="map_coordinates" value="{{ $contacts->map_coordinates ?? '' }}" placeholder="55.7558, 37.6176">
                    </div>
                </div>
                <button type="submit" class="btn btn--gold">Сохранить</button>
            </form>
        </div>

        <!-- Социальные сети -->
        <div class="card">
            <div class="card__title">Социальные сети</div>
            <form method="POST" action="{{ route('admin.socials.update') }}">
                @csrf
                <div class="form-grid form-grid--2">
                    <div class="field">
                        <label class="field__label">Telegram</label>
                        <input type="text" name="telegram" value="{{ $socials->where('platform','telegram')->first()->url ?? '' }}" placeholder="https://t.me/...">
                    </div>
                    <div class="field">
                        <label class="field__label">ВКонтакте</label>
                        <input type="text" name="vk" value="{{ $socials->where('platform','vk')->first()->url ?? '' }}" placeholder="https://vk.com/...">
                    </div>
                </div>
                <button type="submit" class="btn btn--gold">Сохранить</button>
            </form>
        </div>
    </div>
</body>
</html>