<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мероприятия — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --red:#e07070; --red-bg:rgba(192,57,43,0.12); --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:1200px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        /* Form card */
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px;margin-bottom:28px;}
        .card__title{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:500;color:var(--gold);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--border);}
        .form-grid{display:grid;gap:14px;}
        .form-grid--3{grid-template-columns:1fr 1fr 1fr;}
        @media(max-width:768px){.form-grid--3{grid-template-columns:1fr;}}
        .field{display:flex;flex-direction:column;gap:6px;}
        .field__label{font-size:0.7rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        input[type=text],input[type=date],input[type=file],select,textarea{background:var(--bg-input);border:1px solid var(--border);border-radius:var(--radius-sm);padding:9px 12px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.875rem;width:100%;outline:none;transition:border-color 0.2s;}
        input:focus,select:focus,textarea:focus{border-color:var(--border-gold);box-shadow:0 0 0 3px rgba(201,168,76,0.07);}
        select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237a7670' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:32px;cursor:pointer;}
        textarea{resize:vertical;min-height:80px;line-height:1.5;}
        input[type=file]{cursor:pointer;color:var(--text-muted);font-size:0.82rem;}
        .btn{display:inline-flex;align-items:center;gap:5px;padding:9px 18px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.85rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);}
        .btn--sm{padding:6px 12px;font-size:0.78rem;}
        .btn--danger{background:var(--red-bg);color:var(--red);border:1px solid rgba(192,57,43,0.2);}
        .btn--danger:hover{background:rgba(192,57,43,0.22);}
        /* Section label */
        .section-label{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:500;color:var(--text);margin-bottom:14px;display:flex;align-items:center;gap:10px;}
        .section-label::before{content:'';display:block;width:3px;height:20px;background:var(--gold);border-radius:2px;}
        /* Table */
        .table-wrap{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:32px;}
        table{width:100%;border-collapse:collapse;font-size:0.875rem;}
        thead th{text-align:left;padding:12px 16px;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);border-bottom:1px solid var(--border);background:rgba(0,0,0,0.2);}
        tbody td{padding:14px 16px;border-bottom:1px solid var(--border);vertical-align:middle;}
        tbody tr:hover{background:rgba(255,255,255,0.018);}
        tbody tr:last-child td{border-bottom:none;}
        img.thumb{width:60px;height:48px;object-fit:cover;border-radius:6px;border:1px solid var(--border);}
        .row-actions{display:flex;gap:8px;align-items:center;}
        /* Inline inputs */
        tbody input[type=text],tbody input[type=date]{background:var(--bg-input);width:auto;min-width:120px;padding:6px 10px;font-size:0.82rem;}
        tbody input[type=file]{width:auto;padding:5px 8px;font-size:0.75rem;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:24px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .return{margin:-50px 0px 20px 0px}
        /* Кастомная горизонтальная прокрутка (чёрная) */
.table-wrap {
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #d4af37 #2a2a2a;
}

.table-wrap::-webkit-scrollbar {
    height: 8px;
}

.table-wrap::-webkit-scrollbar-track {
    background: #2a2a2a;
    border-radius: 10px;
}

.table-wrap::-webkit-scrollbar-thumb {
    background: #d4af37;
    border-radius: 10px;
}

.table-wrap::-webkit-scrollbar-thumb:hover {
    background: #e8c97a;
}
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">Мероприятия</div>
        </div>
        <div class="return"> 
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="back-link">Вернуться в панель управления</a>
        </div>
        <!-- Add form -->
        <div class="card">
            <div class="card__title">➕ Добавить мероприятие</div>
            <form method="POST" action="<?php echo e(route('admin.events.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-grid form-grid--3" style="margin-bottom:14px;">
                    <div class="field">
                        <label class="field__label">📌 Название</label>
                        <input type="text" name="title" placeholder="Название мероприятия" required>
                    </div>
                    <div class="field">
                        <label class="field__label">📅 Дата</label>
                        <input type="date" name="date" required>
                    </div>
                    <div class="field">
                        <label class="field__label">🕐 Время начала</label>
                        <input type="time" name="start_time" placeholder="Время начала" style="background: var(--bg-input); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 12px; color: var(--text); width: 100%;">
                    </div>
                    <div class="field">
                        <label class="field__label">🏷️ Тип</label>
                        <select name="type">
                            <option value="upcoming">⭐ Предстоящее</option>
                            <option value="past">📆 Прошедшее</option>
                        </select>
                    </div>
                    <div class="field">
                        <label class="field__label">📝 Краткое описание</label>
                        <input type="text" name="short_description" placeholder="Несколько слов о событии" required>
                    </div>
                    <div class="field">
                        <label class="field__label">🖼️ Фото</label>
                        <input type="file" name="photo" accept="image/*">
                    </div>
                </div>
                <div class="field" style="margin-bottom:16px;">
                    <label class="field__label">📖 Полное описание</label>
                    <textarea name="full_description" placeholder="Подробное описание мероприятия..."></textarea>
                </div>
                <button type="submit" class="btn btn--gold">➕ Добавить мероприятие</button>
            </form>
        </div>

        <!-- Upcoming -->
<div class="section-label">⭐ Предстоящие мероприятия</div>
<div class="table-wrap" style="overflow-x: auto;">
    <table>
        <thead>
            <tr>
                <th style="min-width:80px;">Фото</th>
                <th style="min-width:150px;">Название</th>
                <th style="min-width:120px;">Дата</th>
                <th style="min-width:100px;">🕐 Время</th>
                <th style="min-width:180px;">Краткое описание</th>
                <th style="min-width:250px;">📖 Полное описание</th>
                <th style="min-width:100px;">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <form method="POST" action="<?php echo e(route('admin.events.update', $event->id)); ?>" enctype="multipart/form-data" style="display:contents;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="type" value="<?php echo e($event->type); ?>">
                    <td>
                        <?php if($event->photo_url): ?><img src="<?php echo e($event->photo_url); ?>" class="thumb"><br><?php endif; ?>
                        <div style="margin-top:6px;"><input type="file" name="photo" style="font-size:0.75rem;"></div>
                    </td>
                    <td><input type="text" name="title" value="<?php echo e($event->title); ?>" style="width:100%;"></td>
                    <td><input type="date" name="date" value="<?php echo e($event->date); ?>" style="width:100%;"></td>
                    <td><input type="time" name="start_time" value="<?php echo e($event->start_time); ?>" style="width:100%;"></td>
                    <td><input type="text" name="short_description" value="<?php echo e($event->short_description); ?>" style="width:100%;" placeholder="Краткое описание"></td>
                    <td>
                        <textarea name="full_description" style="width:100%; min-height:60px; background:var(--bg-input); border:1px solid var(--border); border-radius:6px; padding:6px 10px; color:var(--text); font-size:0.8rem;"><?php echo e($event->full_description); ?></textarea>
                    </td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <button type="submit" class="btn btn--gold btn--sm">Обновить</button>
                        </div>
                    </td>
                </form>
                <td style="white-space:nowrap;">
                    <form method="POST" action="<?php echo e(route('admin.events.destroy', $event->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn--danger btn--sm" onclick="return confirm('Удалить мероприятие?')">Удалить</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

        <!-- Past -->
<div class="section-label">📆 Прошедшие мероприятия</div>
<div class="table-wrap" style="overflow-x: auto;">
    <table>
        <thead>
            <tr>
                <th style="min-width:80px;">Фото</th>
                <th style="min-width:150px;">Название</th>
                <th style="min-width:120px;">Дата</th>
                <th style="min-width:100px;">🕐 Время</th>
                <th style="min-width:180px;">Краткое описание</th>
                <th style="min-width:250px;">📖 Полное описание</th>
                <th style="min-width:100px;">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $past; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <form method="POST" action="<?php echo e(route('admin.events.update', $event->id)); ?>" enctype="multipart/form-data" style="display:contents;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="type" value="<?php echo e($event->type); ?>">
                    <td>
                        <?php if($event->photo_url): ?><img src="<?php echo e($event->photo_url); ?>" class="thumb"><br><?php endif; ?>
                        <div style="margin-top:6px;"><input type="file" name="photo" style="font-size:0.75rem;"></div>
                    </td>
                    <td><input type="text" name="title" value="<?php echo e($event->title); ?>" style="width:100%;"></td>
                    <td><input type="date" name="date" value="<?php echo e($event->date); ?>" style="width:100%;"></td>
                    <td><input type="time" name="start_time" value="<?php echo e($event->start_time); ?>" style="width:100%;"></td>
                    <td><input type="text" name="short_description" value="<?php echo e($event->short_description); ?>" style="width:100%;" placeholder="Краткое описание"></td>
                    <td>
                        <textarea name="full_description" style="width:100%; min-height:60px; background:var(--bg-input); border:1px solid var(--border); border-radius:6px; padding:6px 10px; color:var(--text); font-size:0.8rem;"><?php echo e($event->full_description); ?></textarea>
                    </td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <button type="submit" class="btn btn--gold btn--sm">Обновить</button>
                        </div>
                    </td>
                </form>
                <td style="white-space:nowrap;">
                    <form method="POST" action="<?php echo e(route('admin.events.destroy', $event->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn--danger btn--sm" onclick="return confirm('Удалить мероприятие?')">Удалить</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

    </div>
</body>
</html><?php /**PATH C:\Users\pomer\projects\web\WEB\resources\views/admin/events.blade.php ENDPATH**/ ?>