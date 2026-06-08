<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Персонал — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --red:#e07070; --red-bg:rgba(192,57,43,0.12); --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:1100px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        /* Add form card */
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px;margin-bottom:24px;}
        .card__title{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:500;color:var(--gold);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--border);}
        .form-row{display:grid;grid-template-columns:1fr 1fr 100px auto auto;gap:12px;align-items:end;}
        @media(max-width:768px){.form-row{grid-template-columns:1fr 1fr;}}
        .field{display:flex;flex-direction:column;gap:6px;}
        .field__label{font-size:0.7rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        input[type=text],input[type=number],input[type=file]{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:9px 12px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.875rem;width:100%;outline:none;transition:border-color 0.2s;}
        input:focus{border-color:var(--border-gold);box-shadow:0 0 0 3px rgba(201,168,76,0.07);}
        input[type=file]{cursor:pointer;color:var(--text-muted);font-size:0.8rem;}
        .btn{display:inline-flex;align-items:center;gap:5px;padding:9px 16px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.82rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;white-space:nowrap;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);}
        .btn--sm{padding:7px 12px;font-size:0.78rem;}
        .btn--danger{background:var(--red-bg);color:var(--red);border:1px solid rgba(192,57,43,0.2);}
        .btn--danger:hover{background:rgba(192,57,43,0.2);}
        /* Table */
        .table-wrap{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;}
        table{width:100%;border-collapse:collapse;font-size:0.875rem;}
        thead th{text-align:left;padding:13px 16px;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);border-bottom:1px solid var(--border);background:rgba(0,0,0,0.2);}
        tbody td{padding:14px 16px;border-bottom:1px solid var(--border);vertical-align:middle;}
        tbody tr:hover{background:rgba(255,255,255,0.018);}
        tbody tr:last-child td{border-bottom:none;}
        img.thumb{width:44px;height:44px;object-fit:cover;border-radius:8px;border:1px solid var(--border);}
        .no-photo{width:44px;height:44px;background:var(--bg-input);border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:18px;color:var(--text-muted);}
        /* Inline edit */
        tbody input[type=text]{background:var(--bg-input);width:auto;min-width:110px;padding:7px 10px;font-size:0.82rem;}
        tbody input[type=file]{width:auto;min-width:0;padding:5px 8px;font-size:0.75rem;}
        .actions{display:flex;gap:8px;align-items:center;flex-wrap:wrap;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:32px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Персонал</div>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        <!-- Add form -->
        <div class="card">
            <div class="card__title">Добавить сотрудника</div>
            <form method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="field">
                        <label class="field__label">Имя</label>
                        <input type="text" name="name" placeholder="Иван Иванов" required>
                    </div>
                    <div class="field">
                        <label class="field__label">Должность</label>
                        <input type="text" name="position" placeholder="Шеф-повар" required>
                    </div>
                    <div class="field">
                        <label class="field__label">Порядок</label>
                        <input type="number" name="sort_order" placeholder="1">
                    </div>
                    <div class="field">
                        <label class="field__label">Фото</label>
                        <input type="file" name="photo" accept="image/*">
                    </div>
                    <div class="field">
                        <label class="field__label">&nbsp;</label>
                        <button type="submit" class="btn btn--gold">Добавить</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Имя</th>
                        <th>Должность</th>
                        <th>Порядок</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                {{-- staff.blade.php - исправляем форму редактирования --}}
                <tbody>
                    @foreach($staff as $person)
                    <tr>
                        <td>
                            @if($person->photo_url)
                                <img src="{{ $person->photo_url }}" alt="{{ $person->localizedName }}" class="thumb">
                            @else
                                <div class="no-photo">👤</div>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="name" value="{{ $person->name }}" size="12" form="edit-form-{{ $person->id }}">
                            <small style="display:block; color:#7a7670;">EN: {{ $person->name_en ?? '—' }}</small>
                        </td>
                        <td>
                            <input type="text" name="position" value="{{ $person->position }}" size="12" form="edit-form-{{ $person->id }}">
                            <small style="display:block; color:#7a7670;">EN: {{ $person->position_en ?? '—' }}</small>
                        </td>
                        <td>{{ $person->sort_order }}</td>
                        <td>
                            <div class="actions">
                                <form id="edit-form-{{ $person->id }}" method="POST" action="{{ route('admin.staff.update', $person->id) }}" enctype="multipart/form-data" style="display:contents;">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="photo" accept="image/*">
                                    <button type="submit" class="btn btn--gold btn--sm">Обновить</button>
                                </form>
                                <form method="POST" action="{{ route('admin.staff.destroy', $person->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn--danger btn--sm" onclick="return confirm('Удалить сотрудника?')">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>