<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирования — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --red:#e07070; --red-bg:rgba(192,57,43,0.12); --green:#6ee8a0; --green-bg:rgba(46,204,113,0.1); --radius:12px; --radius-sm:7px; --shadow:0 8px 32px rgba(0,0,0,0.5); }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:1400px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:36px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        /* alerts */
        .alert{padding:12px 16px;border-radius:var(--radius-sm);font-size:0.85rem;margin-bottom:20px;display:flex;align-items:center;gap:10px;}
        .alert--success{background:var(--green-bg);border:1px solid rgba(46,204,113,0.2);color:var(--green);}
        .alert--error{background:var(--red-bg);border:1px solid rgba(192,57,43,0.25);color:var(--red);}
        /* Filters */
        .filters-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:22px 24px;margin-bottom:20px;}
        .filters-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;margin-bottom:16px;}
        .field{display:flex;flex-direction:column;gap:6px;}
        .field__label{font-size:0.7rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        input[type=text],input[type=date],input[type=email],input[type=number],select,textarea{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:9px 12px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.875rem;width:100%;outline:none;transition:border-color 0.2s;}
        input:focus,select:focus,textarea:focus{border-color:var(--border-gold);box-shadow:0 0 0 3px rgba(201,168,76,0.07);}
        select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237a7670' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:32px;cursor:pointer;}
        textarea{resize:vertical;min-height:80px;line-height:1.5;}
        input.error-input,select.error-input{border-color:#c0392b!important;}
        .filters-actions{display:flex;gap:10px;justify-content:flex-end;}
        /* Buttons */
        .btn{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.85rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;white-space:nowrap;text-decoration:none;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);}
        .btn--ghost{background:transparent;color:var(--text-muted);border:1px solid var(--border);}
        .btn--ghost:hover{border-color:var(--border-gold);color:var(--gold);}
        .btn--danger{background:var(--red-bg);color:var(--red);border:1px solid rgba(192,57,43,0.2);}
        .btn--danger:hover{background:rgba(192,57,43,0.22);}
        .btn--sm{padding:6px 12px;font-size:0.78rem;}
        /* Record count */
        .record-count{font-size:0.8rem;color:var(--text-muted);margin-bottom:10px;letter-spacing:0.02em;}
        .info-count{color:var(--gold);}
        /* Table */
        .table-wrap{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;}
        .table-inner{overflow-x:auto;}
        table{width:100%;border-collapse:collapse;font-size:0.875rem;}
        thead th{text-align:left;padding:12px 14px;font-size:0.68rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);border-bottom:1px solid var(--border);background:rgba(0,0,0,0.2);white-space:nowrap;}
        tbody td{padding:13px 14px;border-bottom:1px solid var(--border);vertical-align:middle;}
        tbody tr:hover{background:rgba(255,255,255,0.018);}
        tbody tr:last-child td{border-bottom:none;}
        /* Status selects in table */
        tbody select{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:5px 28px 5px 9px;font-size:0.78rem;width:auto;min-width:130px;color:var(--text);}
        /* Row actions */
        .row-actions{display:flex;gap:7px;align-items:center;flex-wrap:wrap;}
        /* Back */
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:28px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        /* Modal */
        .modal{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.72);z-index:999;justify-content:center;align-items:center;padding:20px;backdrop-filter:blur(4px);}
        .modal__box{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:32px;width:100%;max-width:520px;max-height:92vh;overflow-y:auto;box-shadow:var(--shadow);}
        .modal__head{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}
        .modal__title{font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:var(--gold);}
        .modal__close{background:none;border:none;color:var(--text-muted);font-size:1.4rem;cursor:pointer;line-height:1;padding:4px 6px;transition:color 0.2s;border-radius:6px;}
        .modal__close:hover{color:var(--text);background:rgba(255,255,255,0.05);}
        .modal-field{display:flex;flex-direction:column;gap:6px;margin-bottom:14px;}
        .modal-field label{font-size:0.7rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        .field-error{font-size:0.72rem;color:var(--red);margin-top:3px;display:block;}
        /* Toast notifications */
        .toast{position:fixed;top:20px;right:20px;z-index:1001;padding:12px 18px;border-radius:var(--radius-sm);font-size:0.85rem;display:flex;align-items:center;gap:10px;max-width:300px;box-shadow:var(--shadow);animation:slideIn 0.25s ease;}
        @keyframes slideIn{from{opacity:0;transform:translateX(16px);}to{opacity:1;transform:translateX(0);}}
        .toast--success{background:var(--green-bg);border:1px solid rgba(46,204,113,0.25);color:var(--green);}
        .toast--error{background:var(--red-bg);border:1px solid rgba(192,57,43,0.3);color:var(--red);}
        .return{margin:-50px 0px 20px 0px}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Бронирования</div>
            <button class="btn btn--gold" onclick="openCreateModal()">+ Создать бронь</button>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        @if(session('success'))
            <div class="alert alert--success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert--error">{{ session('error') }}</div>
        @endif

        <!-- Filters -->
        <div class="filters-card">
            <form method="GET" action="{{ route('admin.bookings') }}" id="filterForm">
                <div class="filters-grid">
                    <div class="field">
                        <label class="field__label">Поиск</label>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Имя гостя или телефон">
                    </div>
                    <div class="field">
                        <label class="field__label">Статус</label>
                        <select name="status">
                            <option value="">Все статусы</option>
                            <option value="new" {{ ($filters['status'] ?? '') == 'new' ? 'selected' : '' }}>Новая</option>
                            <option value="confirmed" {{ ($filters['status'] ?? '') == 'confirmed' ? 'selected' : '' }}>Подтверждена</option>
                            <option value="guest_on_place" {{ ($filters['status'] ?? '') == 'guest_on_place' ? 'selected' : '' }}>Гость на месте</option>
                            <option value="completed" {{ ($filters['status'] ?? '') == 'completed' ? 'selected' : '' }}>Выполнена</option>
                            <option value="cancelled" {{ ($filters['status'] ?? '') == 'cancelled' ? 'selected' : '' }}>Отменена</option>
                        </select>
                    </div>
                    <div class="field">
                        <label class="field__label">Дата от</label>
                        <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}">
                    </div>
                    <div class="field">
                        <label class="field__label">Дата до</label>
                        <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}">
                    </div>
                </div>
                <div class="filters-actions">
                    <button type="submit" class="btn btn--gold btn--sm">Применить</button>
                    <a href="{{ route('admin.bookings') }}" class="btn btn--ghost btn--sm">Сбросить</a>
                </div>
            </form>
        </div>

        <div class="record-count">Найдено записей: <span class="info-count">{{ $bookings->count() }}</span></div>

        <div class="table-wrap">
            <div class="table-inner">
                <table>
                    <thead>
                        <tr>
                            <th>Статус</th>
                            <th>Дата / Время</th>
                            <th>Гость</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Гостей</th>
                            <th>Столик</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>
                                <form method="POST" action="{{ route('admin.bookings.status', $booking->id) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="new" {{ $booking->status=='new'?'selected':'' }}>Новая</option>
                                        <option value="confirmed" {{ $booking->status=='confirmed'?'selected':'' }}>Подтверждена</option>
                                        <option value="guest_on_place" {{ $booking->status=='guest_on_place'?'selected':'' }}>Гость на месте</option>
                                        <option value="completed" {{ $booking->status=='completed'?'selected':'' }}>Выполнена</option>
                                        <option value="cancelled" {{ $booking->status=='cancelled'?'selected':'' }}>Отменена</option>
                                    </select>
                                </form>
                            </td>
                            <td style="white-space:nowrap;">{{ $booking->date }}<br><span style="color:var(--text-muted);font-size:0.8rem;">{{ $booking->time }}</span></td>
                            <td>{{ $booking->guest_name }}</td>
                            <td>{{ $booking->phone }}</td>
                            <td style="color:var(--text-muted);font-size:0.82rem;">{{ $booking->email }}</td>
                            <td style="text-align:center;">{{ $booking->guests_count }}</td>
                            <td style="text-align:center;">{{ $booking->table_number ?? '—' }}</td>
                            <td>
                                <div class="row-actions">
                                    <button class="btn btn--ghost btn--sm" onclick="openEditModal({{ $booking->id }})">Изменить</button>
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn--danger btn--sm" onclick="return confirm('Удалить бронь?')">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal__box">
            <div class="modal__head">
                <div class="modal__title" id="modalTitle">Создание брони</div>
                <button class="modal__close" onclick="closeModal()">✕</button>
            </div>
            <form id="bookingForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="bookingId">

                <div class="modal-field">
                    <label>Имя гостя *</label>
                    <input type="text" name="guest_name" id="guest_name">
                    <span class="field-error" id="error-guest_name"></span>
                </div>
                <div class="modal-field">
                    <label>Телефон *</label>
                    <input type="text" name="phone" id="phone">
                    <span class="field-error" id="error-phone"></span>
                </div>
                <div class="modal-field">
                    <label>Email</label>
                    <input type="email" name="email" id="email">
                    <span class="field-error" id="error-email"></span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="modal-field">
                        <label>Дата *</label>
                        <input type="date" name="date" id="date" min="{{ date('Y-m-d') }}">
                        <span class="field-error" id="error-date"></span>
                    </div>
                    <div class="modal-field">
                        <label>Время *</label>
                        <select name="time" id="time">
                            <option value="">Выберите время</option>
                            @foreach(['12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00'] as $t)
                                <option value="{{ $t }}">{{ $t }}</option>
                            @endforeach
                        </select>
                        <span class="field-error" id="error-time"></span>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="modal-field">
                        <label>Количество гостей *</label>
                        <select name="guests_count" id="guests_count">
                            @for($i=1;$i<=20;$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <span class="field-error" id="error-guests_count"></span>
                    </div>
                    <div class="modal-field">
                        <label>Номер столика</label>
                        <select name="table_number" id="table_number">
                            <option value="">Не назначен</option>
                            @for($i=1;$i<=20;$i++)
                                <option value="{{ $i }}">Столик №{{ $i }}</option>
                            @endfor
                        </select>
                        <span class="field-error" id="error-table_number"></span>
                    </div>
                </div>
                <div class="modal-field">
                    <label>Статус</label>
                    <select name="status" id="status">
                        <option value="new">Новая</option>
                        <option value="confirmed">Подтверждена</option>
                        <option value="guest_on_place">Гость на месте</option>
                        <option value="completed">Выполнена</option>
                        <option value="cancelled">Отменена</option>
                    </select>
                    <span class="field-error" id="error-status"></span>
                </div>
                <div class="modal-field">
                    <label>Внутренний комментарий</label>
                    <textarea name="internal_comment" id="internal_comment" rows="3"></textarea>
                    <span class="field-error" id="error-internal_comment"></span>
                </div>
                <button type="submit" id="submitBtn" class="btn btn--gold" style="width:100%;justify-content:center;margin-top:4px;">Сохранить</button>
            </form>
        </div>
    </div>

    <script>
    const modal = document.getElementById('bookingModal');
    const form = document.getElementById('bookingForm');
    const submitBtn = document.getElementById('submitBtn');
    let isSubmitting = false;

    function loadBookings() {
        const search = document.querySelector('input[name="search"]')?.value || '';
        const status = document.querySelector('select[name="status"]')?.value || '';
        const date_from = document.querySelector('input[name="date_from"]')?.value || '';
        const date_to = document.querySelector('input[name="date_to"]')?.value || '';
        let url = "/admin/bookings-ajax?";
        if (search) url += `search=${encodeURIComponent(search)}&`;
        if (status) url += `status=${encodeURIComponent(status)}&`;
        if (date_from) url += `date_from=${encodeURIComponent(date_from)}&`;
        if (date_to) url += `date_to=${encodeURIComponent(date_to)}&`;
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(data => { if (data.success) updateTable(data.bookings, data.count); })
            .catch(e => console.error('Ошибка загрузки:', e));
    }

    function updateTable(bookings, count) {
        const tbody = document.querySelector('table tbody');
        const infoCount = document.querySelector('.info-count');
        if (!tbody) return;
        if (!bookings || bookings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted);">Нет бронирований</td></tr>';
            if (infoCount) infoCount.innerHTML = '0';
            return;
        }
        let html = '';
        bookings.forEach(b => {
            html += `<tr>
                <td><select onchange="updateStatus(${b.id}, this.value)" style="background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:5px 28px 5px 9px;font-size:0.78rem;color:var(--text);appearance:none;cursor:pointer;">
                    <option value="new" ${b.status==='new'?'selected':''}>Новая</option>
                    <option value="confirmed" ${b.status==='confirmed'?'selected':''}>Подтверждена</option>
                    <option value="guest_on_place" ${b.status==='guest_on_place'?'selected':''}>Гость на месте</option>
                    <option value="completed" ${b.status==='completed'?'selected':''}>Выполнена</option>
                    <option value="cancelled" ${b.status==='cancelled'?'selected':''}>Отменена</option>
                </select></td>
                <td style="white-space:nowrap;">${b.date}<br><span style="color:var(--text-muted);font-size:0.8rem;">${b.time}</span></td>
                <td>${escapeHtml(b.guest_name)}</td>
                <td>${escapeHtml(b.phone)}</td>
                <td style="color:var(--text-muted);font-size:0.82rem;">${b.email||''}</td>
                <td style="text-align:center;">${b.guests_count}</td>
                <td style="text-align:center;">${b.table_number||'—'}</td>
                <td><div class="row-actions">
                    <button class="btn btn--ghost btn--sm" onclick="openEditModal(${b.id})">Изменить</button>
                    <button class="btn btn--danger btn--sm" onclick="deleteBooking(${b.id})">Удалить</button>
                </div></td>
            </tr>`;
        });
        tbody.innerHTML = html;
        if (infoCount) infoCount.innerHTML = count;
    }

    function escapeHtml(s) {
        if (!s) return '';
        return s.replace(/[&<>]/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;'})[m]||m);
    }

    window.updateStatus = function(id, status) {
        fetch(`/admin/bookings/${id}/status`, {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('input[name="_token"]').value,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'},
            body: JSON.stringify({status, _method:'PATCH'})
        }).then(r=>r.json()).then(d=>{if(d.success){showToast('success','Статус обновлён');loadBookings();}});
    };

    window.deleteBooking = function(id) {
        if (!confirm('Удалить бронь?')) return;
        fetch(`/admin/bookings/${id}`, {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('input[name="_token"]').value,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'},
            body: JSON.stringify({_method:'DELETE'})
        }).then(r=>r.json()).then(d=>{if(d.success){showToast('success','Бронь удалена');loadBookings();}});
    };

    function showToast(type, text) {
        const existing = document.querySelector('.toast');
        if (existing) existing.remove();
        const t = document.createElement('div');
        t.className = `toast toast--${type}`;
        t.textContent = text;
        document.body.appendChild(t);
        setTimeout(()=>t.remove(), 3000);
    }

    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Создание брони';
        document.getElementById('formMethod').value = 'POST';
        form.action = "{{ route('admin.bookings.store') }}";
        form.reset();
        clearErrors();
        modal.style.display = 'flex';
        isSubmitting = false;
        if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Сохранить'; }
    }

    window.openEditModal = function(id) {
        fetch(`/admin/bookings/${id}/details`).then(r=>r.json()).then(data=>{
            document.getElementById('modalTitle').innerText = 'Редактирование брони';
            document.getElementById('formMethod').value = 'PUT';
            form.action = `/admin/bookings/${id}`;
            document.getElementById('bookingId').value = data.id;
            document.getElementById('guest_name').value = data.guest_name;
            document.getElementById('phone').value = data.phone;
            document.getElementById('email').value = data.email||'';
            document.getElementById('date').value = data.date;
            document.getElementById('time').value = data.time;
            document.getElementById('guests_count').value = data.guests_count;
            document.getElementById('status').value = data.status;
            document.getElementById('table_number').value = data.table_number||'';
            document.getElementById('internal_comment').value = data.internal_comment||'';
            clearErrors();
            modal.style.display = 'flex';
            isSubmitting = false;
            if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Сохранить'; }
        });
    };

    function closeModal() {
        modal.style.display = 'none';
        clearErrors();
        isSubmitting = false;
        if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Сохранить'; }
    }

    function clearErrors() {
        ['guest_name','phone','email','date','time','guests_count','status','table_number','internal_comment'].forEach(f=>{
            const s = document.getElementById(`error-${f}`); if(s) s.innerHTML='';
            const i = document.querySelector(`[name="${f}"]`); if(i) i.classList.remove('error-input');
        });
    }

    function displayErrors(errors) {
        clearErrors();
        for (const [f,msgs] of Object.entries(errors)) {
            const s = document.getElementById(`error-${f}`); if(s) s.innerHTML = msgs.join(', ');
            const i = document.querySelector(`[name="${f}"]`); if(i) i.classList.add('error-input');
        }
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isSubmitting) return;
        const formData = new FormData(form);
        let method = document.getElementById('formMethod').value;
        let url = form.action;
        if (method === 'PUT') formData.append('_method','PUT');
        isSubmitting = true;
        if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Сохранение...'; }
        fetch(url, {
            method:'POST',
            headers:{'X-CSRF-TOKEN':document.querySelector('input[name="_token"]').value,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'},
            body: formData
        }).then(r=>r.json()).then(data=>{
            isSubmitting = false;
            if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Сохранить'; }
            if (data.success) { closeModal(); loadBookings(); showToast('success','Бронь сохранена'); }
            else if (data.errors) displayErrors(data.errors);
            else if (data.error) showToast('error', data.error);
        }).catch(e=>{
            isSubmitting = false;
            if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Сохранить'; }
            showToast('error','Ошибка при сохранении');
        });
    });

    document.querySelector('#filterForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        loadBookings();
    });

    document.addEventListener('DOMContentLoaded', function() { loadBookings(); });
    window.onclick = function(e) { if (e.target == modal) closeModal(); };
    </script>
</body>
</html>