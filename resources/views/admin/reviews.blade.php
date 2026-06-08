<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --green:#6ee8a0; --green-bg:rgba(46,204,113,0.1); --red:#e07070; --red-bg:rgba(192,57,43,0.12); --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:1200px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        .logout-btn{background:transparent;border:1px solid var(--border);color:var(--text-muted);padding:8px 16px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.82rem;cursor:pointer;transition:all 0.2s;}
        .logout-btn:hover{border-color:var(--border-gold);color:var(--gold);}
        .alert{padding:13px 17px;border-radius:var(--radius-sm);font-size:0.85rem;margin-bottom:24px;display:flex;align-items:center;gap:10px;}
        .alert--success{background:var(--green-bg);border:1px solid rgba(46,204,113,0.2);color:var(--green);}
        /* Add form */
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px;margin-bottom:24px;}
        .card__title{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:500;color:var(--gold);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--border);}
        .form-grid{display:grid;gap:14px;}
        .form-grid--3{grid-template-columns:1fr 1fr auto;}
        @media(max-width:640px){.form-grid--3{grid-template-columns:1fr;}}
        .field{display:flex;flex-direction:column;gap:6px;}
        .field__label{font-size:0.7rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        input[type=text],select,textarea{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:9px 12px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.875rem;width:100%;outline:none;transition:border-color 0.2s;}
        input:focus,select:focus,textarea:focus{border-color:var(--border-gold);box-shadow:0 0 0 3px rgba(201,168,76,0.07);}
        select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237a7670' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:32px;cursor:pointer;}
        textarea{resize:vertical;min-height:80px;line-height:1.5;}
        input[type=checkbox]{width:16px;height:16px;accent-color:var(--gold);cursor:pointer;}
        .checkbox-row{display:flex;align-items:center;gap:10px;padding-top:4px;}
        .checkbox-row label{font-size:0.875rem;color:var(--text);cursor:pointer;}
        .btn{display:inline-flex;align-items:center;gap:5px;padding:9px 18px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.85rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);}
        .btn--sm{padding:6px 12px;font-size:0.78rem;}
        .btn--ghost{background:transparent;color:var(--text-muted);border:1px solid var(--border);}
        .btn--ghost:hover{border-color:var(--border-gold);color:var(--gold);}
        .btn--danger{background:var(--red-bg);color:var(--red);border:1px solid rgba(192,57,43,0.2);}
        .btn--danger:hover{background:rgba(192,57,43,0.22);}
        /* Table */
        .table-wrap{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;}
        table{width:100%;border-collapse:collapse;font-size:0.875rem;}
        thead th{text-align:left;padding:13px 16px;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);border-bottom:1px solid var(--border);background:rgba(0,0,0,0.2);}
        tbody td{padding:14px 16px;border-bottom:1px solid var(--border);vertical-align:middle;}
        tbody tr:hover{background:rgba(255,255,255,0.018);}
        tbody tr:last-child td{border-bottom:none;}
        .stars{color:var(--gold);letter-spacing:2px;font-size:13px;}
        .badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:0.72rem;font-weight:500;}
        .badge--approved{background:var(--green-bg);color:var(--green);border:1px solid rgba(46,204,113,0.2);}
        .badge--pending{background:var(--gold-dim);color:var(--gold);border:1px solid var(--border-gold);}
        .empty-state{text-align:center;padding:52px 20px;color:var(--text-muted);}
        .empty-state__icon{font-size:32px;margin-bottom:10px;}
        /* Inline tbody inputs */
        tbody input[type=text]{background:var(--bg-input);width:auto;min-width:110px;padding:6px 10px;font-size:0.82rem;}
        tbody select{width:auto;min-width:80px;padding:6px 28px 6px 10px;font-size:0.82rem;}
        tbody textarea{min-width:200px;min-height:50px;padding:6px 10px;font-size:0.82rem;}
        .row-actions{display:flex;gap:8px;align-items:center;flex-wrap:wrap;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:32px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Отзывы</div>
            
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        @if(session('success'))
            <div class="alert alert--success">✓ {{ session('success') }}</div>
        @endif

        <!-- Add review -->
        <div class="card">
            <div class="card__title">Добавить отзыв</div>
            <form method="POST" action="{{ route('admin.reviews.store') }}">
                @csrf
                <div class="form-grid form-grid--3" style="margin-bottom:14px;">
                    <div class="field">
                        <label class="field__label">Автор</label>
                        <input type="text" name="author" placeholder="Имя гостя" required>
                    </div>
                    <div class="field">
                        <label class="field__label">Рейтинг</label>
                        <select name="rating">
                            <option value="5">★★★★★ — 5</option>
                            <option value="4">★★★★☆ — 4</option>
                            <option value="3">★★★☆☆ — 3</option>
                            <option value="2">★★☆☆☆ — 2</option>
                            <option value="1">★☆☆☆☆ — 1</option>
                        </select>
                    </div>
                    <div class="field">
                        <label class="field__label">Статус</label>
                        <div class="checkbox-row" style="padding-top:10px;">
                            <input type="checkbox" name="is_approved" id="is_approved" checked>
                            <label for="is_approved">Опубликовать сразу</label>
                        </div>
                    </div>
                </div>
                <div class="field" style="margin-bottom:16px;">
                    <label class="field__label">Текст отзыва</label>
                    <textarea name="text" placeholder="Введите текст отзыва..." required></textarea>
                </div>
                <button type="submit" class="btn btn--gold">Добавить отзыв</button>
            </form>
        </div>

        <!-- Reviews table -->
        <div class="table-wrap">
            @if($reviews->isEmpty())
                <div class="empty-state">
                    <div class="empty-state__icon">💬</div>
                    Пока нет отзывов
                </div>
            @else
            <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Автор</th>
                        <th>Текст</th>
                        <th>Рейтинг</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                    <tbody>
                @foreach($reviews as $review)
                <tr>
                    <form method="POST" action="{{ route('admin.reviews.update', $review->id) }}" style="display:contents;">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="author" value="{{ $review->author }}" size="14"></td>
                        <td>
                            <textarea name="text">{{ $review->text }}</textarea>
                            <small style="display:block; color:#7a7670; margin-top:5px;">EN перевод: {{ $review->text_en ?? '—' }}</small>
                        </td>
                        <td>
                            <select name="rating">
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}" {{ $review->rating==$i?'selected':'' }}>{{ $i }} ★</option>
                                @endfor
                            </select>
                        </td>
                        <td>
                            <div class="checkbox-row">
                                <input type="checkbox" name="is_approved" id="app_{{ $review->id }}" {{ $review->is_approved?'checked':'' }}>
                                <label for="app_{{ $review->id }}">
                                    @if($review->is_approved)
                                        <span class="badge badge--approved">Одобрен</span>
                                    @else
                                        <span class="badge badge--pending">На модерации</span>
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="row-actions">
                                <button type="submit" class="btn btn--gold btn--sm">Сохранить</button>
                            </div>
                        </td>
                    </form>
                    <td style="border-left:1px solid var(--border);">
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn--danger btn--sm" onclick="return confirm('Удалить отзыв?')">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
            @endif
        </div>
    </div>
</body>
</html>