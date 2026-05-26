<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лучшие блюда</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #111110; color: #e8e4dc; padding: 36px 28px 60px; }
        .page-wrap { max-width: 1200px; margin: 0 auto; }
        .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; padding-bottom: 22px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .topbar__title { font-family: 'Cormorant Garamond', serif; font-size: 1.9rem; font-weight: 500; color: #c9a84c; }
        .back-link { display: inline-flex; align-items: center; gap: 7px; color: #7a7670; text-decoration: none; font-size: 0.8rem; margin-top: 24px; }
        .back-link:hover { color: #c9a84c; }
        .back-link::before { content: '←'; }
        
        .form-add { background: #1c1c1a; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 20px; margin-bottom: 30px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 15px; }
        .field { display: flex; flex-direction: column; gap: 5px; }
        .field__label { font-size: 0.7rem; color: #7a7670; text-transform: uppercase; }
        input, textarea { background: #151514; border: 1px solid rgba(255,255,255,0.07); border-radius: 7px; padding: 10px; color: #e8e4dc; }
        textarea { resize: vertical; min-height: 80px; }
        .btn { background: #c9a84c; color: #0e0d0b; border: none; border-radius: 7px; padding: 10px 20px; cursor: pointer; font-weight: 500; }
        .btn-danger { background: rgba(192,57,43,0.12); color: #e07070; border: 1px solid rgba(192,57,43,0.2); }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        
        .dishes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
        .dish-card { background: #1c1c1a; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; overflow: hidden; }
        .dish-card img { width: 100%; height: 200px; object-fit: cover; }
        .dish-info { padding: 15px; }
        .dish-title { font-size: 1.2rem; font-weight: 600; margin-bottom: 5px; }
        .dish-desc { font-size: 0.85rem; color: #7a7670; margin-bottom: 8px; }
        .dish-price { color: #c9a84c; font-weight: 600; margin-bottom: 12px; }
        .dish-actions { display: flex; gap: 10px; justify-content: flex-end; border-top: 1px solid rgba(255,255,255,0.07); padding-top: 12px; }
        .section-title { font-family: 'Cormorant Garamond', serif; font-size: 1.3rem; color: #c9a84c; margin: 20px 0 15px; }
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Лучшие блюда</div>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        @if(session('success'))
            <div style="background: rgba(76,175,80,0.15); border: 1px solid #4caf50; color: #4caf50; padding: 12px; border-radius: 7px; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        
        <div class="form-add">
            <h3 style="margin-bottom: 15px;">➕ Добавить блюдо</h3>
            <form method="POST" action="{{ route('admin.best-dishes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label class="field__label">🍽️ Название блюда</label>
                        <input type="text" name="title" placeholder="Название" required>
                    </div>
                    <div class="field">
                        <label class="field__label">💰 Цена</label>
                        <input type="text" name="price" placeholder="1 200 ₽">
                    </div>
                    <div class="field">
                        <label class="field__label">📷 Фото</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                    <div class="field">
                        <label class="field__label">📌 Порядок</label>
                        <input type="number" name="sort_order" placeholder="0, 1, 2...">
                    </div>
                </div>
                <div class="field" style="margin-bottom: 15px;">
                    <label class="field__label">📝 Описание</label>
                    <textarea name="description" placeholder="Краткое описание блюда..."></textarea>
                </div>
                <button type="submit" class="btn">➕ Добавить</button>
            </form>
        </div>
        
        <div class="section-title">📋 Список блюд</div>
<div class="dishes-grid">
    @foreach($bestDishes as $dish)
    <div class="dish-card">
        <img src="{{ $dish->image_url }}" alt="{{ $dish->title }}">
        <div class="dish-info">
            <div class="dish-title">{{ $dish->title }}</div>
            <div class="dish-desc">{{ $dish->description ?? '' }}</div>
            <div class="dish-price">{{ $dish->price ?? '' }}</div>
            <div class="dish-actions">
                <form method="POST" action="{{ route('admin.best-dishes.update', $dish->id) }}" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    @method('PUT')
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <input type="text" name="title" value="{{ $dish->title }}" placeholder="Название" style="width: 100%;">
                        <input type="text" name="price" value="{{ $dish->price }}" placeholder="Цена" style="width: 100%;">
                        <input type="number" name="sort_order" value="{{ $dish->sort_order }}" placeholder="Порядок" style="width: 100%;">
                        <input type="file" name="image" style="width: 100%;">
                        <textarea name="description" placeholder="Описание" style="width: 100%; min-height: 60px;">{{ $dish->description }}</textarea>
                        <button type="submit" class="btn btn-sm" style="width: 100%;">Обновить</button>
                    </div>
                </form>
                <form method="POST" action="{{ route('admin.best-dishes.destroy', $dish->id) }}" style="margin-top: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger btn-sm" style="width: 100%;" onclick="return confirm('Удалить?')">Удалить</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
        
    </div>
</body>
</html>