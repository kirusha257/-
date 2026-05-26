<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление меню</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #111110;
            color: #e8e4dc;
            padding: 36px 28px 60px;
        }
        .page-wrap { max-width: 1200px; margin: 0 auto; }
        .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; padding-bottom: 22px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .topbar__title { font-family: 'Cormorant Garamond', serif; font-size: 1.9rem; font-weight: 500; color: #c9a84c; }
        .back-link { display: inline-flex; align-items: center; gap: 7px; color: #7a7670; text-decoration: none; font-size: 0.8rem; margin-top: 24px; }
        .back-link:hover { color: #c9a84c; }
        .back-link::before { content: '←'; }
        
        .section { margin-bottom: 40px; }
        .section-title { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; color: #c9a84c; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        
        .form-add { background: #1c1c1a; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 20px; margin-bottom: 20px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 15px; }
        .field { display: flex; flex-direction: column; gap: 5px; }
        .field__label { font-size: 0.7rem; color: #7a7670; text-transform: uppercase; }
        input, select { background: #151514; border: 1px solid rgba(255,255,255,0.07); border-radius: 7px; padding: 10px; color: #e8e4dc; }
        .btn { background: #c9a84c; color: #0e0d0b; border: none; border-radius: 7px; padding: 10px 20px; cursor: pointer; font-weight: 500; }
        .btn-danger { background: rgba(192,57,43,0.12); color: #e07070; border: 1px solid rgba(192,57,43,0.2); }
        
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 15px; }
        .gallery-item { background: #1c1c1a; border: 1px solid rgba(255,255,255,0.07); border-radius: 10px; overflow: hidden; }
        .gallery-item img { width: 100%; height: 150px; object-fit: cover; cursor: pointer; }
        .gallery-info { padding: 10px; display: flex; justify-content: space-between; align-items: center; }
        .gallery-actions { display: flex; gap: 8px; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">🍽️ Управление меню</div>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        @if(session('success'))
            <div style="background: rgba(76,175,80,0.15); border: 1px solid #4caf50; color: #4caf50; padding: 12px; border-radius: 7px; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        
        <!-- Основное меню -->
        <div class="section">
            <div class="section-title">📋 Основное меню</div>
            <div class="form-add">
                <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category" value="main">
                    <div class="form-grid">
                        <div class="field">
                            <label class="field__label">📷 Фото</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <div class="field">
                            <label class="field__label">📌 Порядок</label>
                            <input type="number" name="sort_order" placeholder="0, 1, 2...">
                        </div>
                    </div>
                    <button type="submit" class="btn">➕ Добавить фото</button>
                </form>
            </div>
            <div class="gallery-grid">
                @foreach($mainMenu as $photo)
                <div class="gallery-item">
                    <img src="{{ $photo->image_url }}" alt="Фото меню" onclick="openModal('{{ $photo->image_url }}')">
                    <div class="gallery-info">
                        <span>Порядок: {{ $photo->sort_order }}</span>
                        <div class="gallery-actions">
                            <form method="POST" action="{{ route('admin.menu.destroy', $photo->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Винная карта -->
        <div class="section">
            <div class="section-title">🍷 Винная карта</div>
            <div class="form-add">
                <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category" value="wine">
                    <div class="form-grid">
                        <div class="field">
                            <label class="field__label">📷 Фото</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <div class="field">
                            <label class="field__label">📌 Порядок</label>
                            <input type="number" name="sort_order" placeholder="0, 1, 2...">
                        </div>
                    </div>
                    <button type="submit" class="btn">➕ Добавить фото</button>
                </form>
            </div>
            <div class="gallery-grid">
                @foreach($wineMenu as $photo)
                <div class="gallery-item">
                    <img src="{{ $photo->image_url }}" alt="Фото винной карты" onclick="openModal('{{ $photo->image_url }}')">
                    <div class="gallery-info">
                        <span>Порядок: {{ $photo->sort_order }}</span>
                        <div class="gallery-actions">
                            <form method="POST" action="{{ route('admin.menu.destroy', $photo->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Бар -->
        <div class="section">
            <div class="section-title">🍸 Бар</div>
            <div class="form-add">
                <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category" value="bar">
                    <div class="form-grid">
                        <div class="field">
                            <label class="field__label">📷 Фото</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <div class="field">
                            <label class="field__label">📌 Порядок</label>
                            <input type="number" name="sort_order" placeholder="0, 1, 2...">
                        </div>
                    </div>
                    <button type="submit" class="btn">➕ Добавить фото</button>
                </form>
            </div>
            <div class="gallery-grid">
                @foreach($barMenu as $photo)
                <div class="gallery-item">
                    <img src="{{ $photo->image_url }}" alt="Фото барного меню" onclick="openModal('{{ $photo->image_url }}')">
                    <div class="gallery-info">
                        <span>Порядок: {{ $photo->sort_order }}</span>
                        <div class="gallery-actions">
                            <form method="POST" action="{{ route('admin.menu.destroy', $photo->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </div>
    
    <!-- Модальное окно для увеличения фото -->
    <div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 1000; justify-content: center; align-items: center; cursor: pointer;">
        <span onclick="closeModal()" style="position: absolute; top: 20px; right: 30px; font-size: 40px; color: white; cursor: pointer;">&times;</span>
        <img id="modalImage" src="" alt="Увеличенное фото" style="max-width: 90%; max-height: 90%; object-fit: contain;">
    </div>
    
    <script>
        function openModal(imgSrc) {
            document.getElementById('modalImage').src = imgSrc;
            document.getElementById('imageModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
        document.getElementById('imageModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>