<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:1200px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:32px;margin-bottom:28px;}
        .card__title{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:500;color:var(--gold);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--border);}
        .form-grid{display:grid;grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));gap:20px;margin-bottom:20px;}
        .field{display:flex;flex-direction:column;gap:7px;}
        .field__label{font-size:0.72rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        input[type=text], input[type=file], textarea{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:12px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.875rem;width:100%;outline:none;transition:border-color 0.2s;}
        input:focus, textarea:focus{border-color:var(--border-gold);box-shadow:0 0 0 3px rgba(201,168,76,0.07);}
        textarea{resize:vertical;min-height:80px;line-height:1.5;}
        input[type=file]{cursor:pointer;color:var(--text-muted);font-size:0.82rem;padding:10px;}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:10px 22px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.875rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);box-shadow:0 4px 14px rgba(201,168,76,0.25);}
        .btn--danger{background:rgba(192,57,43,0.12);color:#e07070;border:1px solid rgba(192,57,43,0.2);}
        .btn--danger:hover{background:rgba(192,57,43,0.22);}
        .btn--sm{padding:6px 12px;font-size:0.78rem;}
        
        /* Галерея сетка */
        .gallery-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));gap:24px;margin-top:20px;}
        .gallery-item{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:transform 0.2s, border-color 0.2s;}
        .gallery-item:hover{transform:translateY(-3px);border-color:var(--border-gold);}
        .gallery-item img{width:100%;height:180px;object-fit:cover;border-bottom:1px solid var(--border);}
        .gallery-info{padding:14px;}
        .gallery-info strong{font-size:0.9rem;color:var(--text);}
        .gallery-info p{font-size:0.75rem;color:var(--text-muted);margin-top:5px;line-height:1.4;}
        .gallery-actions{display:flex;gap:10px;margin-top:12px;padding-top:10px;border-top:1px solid var(--border);}
        
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:24px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .return{margin:-50px 0px 20px 0px}
        .alert-success{background:rgba(76,175,80,0.15);border:1px solid #4caf50;color:#4caf50;padding:12px 18px;border-radius:var(--radius-sm);margin-bottom:24px;font-size:0.85rem;}
        .section-label{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:500;color:var(--text);margin-bottom:20px;display:flex;align-items:center;gap:10px;}
        .section-label::before{content:'';display:block;width:3px;height:20px;background:var(--gold);border-radius:2px;}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">📸 Галерея</div>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        
        <!-- Форма добавления фото -->
        <div class="card">
            <div class="card__title">➕ Добавить фото</div>
            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label class="field__label">📷 Фото</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                    <div class="field">
                        <label class="field__label">🏷️ Название</label>
                        <input type="text" name="title" placeholder="Название фото">
                    </div>
                    <div class="field">
                        <label class="field__label">📝 Описание</label>
                        <textarea name="description" placeholder="Краткое описание фото" rows="3"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn--gold">➕ Добавить</button>
            </form>
        </div>
        
        <!-- Список фотографий -->
        <div class="section-label">Все фотографии</div>
        <div class="gallery-grid">
            @foreach($gallery as $photo)
                <div class="gallery-item">
                    <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}">
                    <div class="gallery-info">
                        <strong>{{ $photo->title ?? 'Без названия' }}</strong>
                        <small style="display:block; color:#7a7670;">EN: {{ $photo->title_en ?? '—' }}</small>
                        <p>{{ $photo->description ?? '' }}</p>
                        <small style="display:block; color:#7a7670;">EN desc: {{ $photo->description_en ?? '—' }}</small>
                        <div class="gallery-actions">
                            <form method="POST" action="{{ route('admin.gallery.update', $photo->id) }}" enctype="multipart/form-data" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" value="{{ $photo->title }}" placeholder="Название RU" style="width:100%; margin-bottom:5px;">
                                <input type="text" name="description" value="{{ $photo->description }}" placeholder="Описание RU" style="width:100%; margin-bottom:5px;">
                                <input type="file" name="image" style="display: none;" id="file-{{ $photo->id }}" onchange="this.form.submit()">
                                <button type="button" class="btn btn--gold btn--sm" onclick="document.getElementById('file-{{ $photo->id }}').click()">Заменить</button>
                                <button type="submit" class="btn btn--gold btn--sm">Обновить</button>
                            </form>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $photo->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn--danger btn--sm" onclick="return confirm('Удалить фото?')">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</body>
</html>