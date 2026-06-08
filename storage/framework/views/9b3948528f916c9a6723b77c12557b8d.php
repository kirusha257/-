<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление администраторами</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #111110;
            color: #e8e4dc;
            padding: 36px 28px 60px;
        }
        .page-wrap { max-width: 1000px; margin: 0 auto; }
        .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; padding-bottom: 22px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .topbar__title { font-family: 'Cormorant Garamond', serif; font-size: 1.9rem; font-weight: 500; color: #c9a84c; }
        .back-link { display: inline-flex; align-items: center; gap: 7px; color: #7a7670; text-decoration: none; font-size: 0.8rem; margin-top: 24px; }
        .back-link:hover { color: #c9a84c; }
        .back-link::before { content: '←'; }
        
        .form-add { background: #1c1c1a; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 24px; margin-bottom: 30px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 15px; }
        .field { display: flex; flex-direction: column; gap: 5px; }
        .field__label { font-size: 0.7rem; color: #7a7670; text-transform: uppercase; }
        input, select { background: #151514; border: 1px solid rgba(255,255,255,0.07); border-radius: 7px; padding: 10px; color: #e8e4dc; width: 100%; }
        .btn { background: #c9a84c; color: #0e0d0b; border: none; border-radius: 7px; padding: 10px 20px; cursor: pointer; font-weight: 500; }
        .btn-danger { background: rgba(192,57,43,0.12); color: #e07070; border: 1px solid rgba(192,57,43,0.2); }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        
        .admins-table { width: 100%; border-collapse: collapse; }
        .admins-table th, .admins-table td { padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .admins-table th { color: #c9a84c; font-weight: 500; }
        .admins-table tr:hover { background: rgba(255,255,255,0.02); }
        
        .alert-success { background: rgba(76,175,80,0.15); border: 1px solid #4caf50; color: #4caf50; padding: 12px; border-radius: 7px; margin-bottom: 20px; }
        .alert-error { background: rgba(244,67,54,0.15); border: 1px solid #f44336; color: #f44336; padding: 12px; border-radius: 7px; margin-bottom: 20px; }
        
        .inline-form { display: inline; }
        .return { margin: -50px 0px 20px 0px; }
        
        .action-cell {
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .admins-table { font-size: 0.8rem; }
            .action-cell { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div class="topbar__title">👥 Управление администраторами</div>
        </div>
        <div class="return"> 
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="back-link">Вернуться в панель управления</a>
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        
        <!-- Форма добавления -->
        <div class="form-add">
            <h3 style="margin-bottom: 20px;">➕ Добавить администратора</h3>
            <form method="POST" action="<?php echo e(route('admin.admins.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-grid">
                    <div class="field">
                        <label class="field__label">👤 Имя</label>
                        <input type="text" name="first_name" placeholder="Иван" required>
                    </div>
                    <div class="field">
                        <label class="field__label">👤 Фамилия</label>
                        <input type="text" name="last_name" placeholder="Иванов" required>
                    </div>
                    <div class="field">
                        <label class="field__label">🔑 Логин</label>
                        <input type="text" name="login" placeholder="ivan" required>
                    </div>
                    <div class="field">
                        <label class="field__label">🔒 Пароль</label>
                        <input type="password" name="password" placeholder="минимум 6 символов" required>
                    </div>
                    <div class="field">
                        <label class="field__label">👑 Роль</label>
                        <select name="role" required>
                            <option value="admin">Администратор</option>
                            <option value="super_admin">Главный администратор</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn">➕ Добавить</button>
            </form>
        </div>
        
        <!-- Список администраторов -->
        <table class="admins-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Логин</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <form method="POST" action="<?php echo e(route('admin.admins.update', $admin->id)); ?>" id="edit-form-<?php echo e($admin->id); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <td><?php echo e($admin->id); ?></td>
                        <td><input type="text" name="first_name" value="<?php echo e($admin->first_name); ?>" style="width: 120px;" required></td>
                        <td><input type="text" name="last_name" value="<?php echo e($admin->last_name); ?>" style="width: 120px;" required></td>
                        <td><input type="text" name="login" value="<?php echo e($admin->login); ?>" style="width: 120px;" required></td>
                        <td>
                            <select name="role" style="width: 130px;">
                                <option value="admin" <?php echo e($admin->role == 'admin' ? 'selected' : ''); ?>>Администратор</option>
                                <option value="super_admin" <?php echo e($admin->role == 'super_admin' ? 'selected' : ''); ?>>Главный админ</option>
                            </select>
                        </td>
                        <td>
                            <div class="action-cell">
                                <input type="password" name="password" placeholder="Новый пароль" style="width: 130px;">
                                <button type="submit" class="btn btn-sm">Обновить</button>
                            </div>
                        </td>
                    </form>
                    <td>
                        <form method="POST" action="<?php echo e(route('admin.admins.destroy', $admin->id)); ?>" class="inline-form" onsubmit="return confirm('Удалить администратора <?php echo e($admin->first_name); ?> <?php echo e($admin->last_name); ?>?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\Users\pomer\projects\web\WEB\resources\views/admin/admins.blade.php ENDPATH**/ ?>