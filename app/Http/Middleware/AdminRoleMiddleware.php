<?php
// app/Http/Middleware/AdminRoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Session::has('admin_logged_in') || !Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $adminId = Session::get('admin_id');
        $admin = \App\Models\Admin::find($adminId);
        
        if (!$admin) {
            Session::forget('admin_logged_in');
            return redirect()->route('admin.login')->with('error', 'Администратор не найден');
        }
        
        // Если переданы роли, проверяем соответствие
        if (!empty($roles)) {
            $userRole = $admin->role;
            if (!in_array($userRole, $roles)) {
                abort(403, 'У вас нет доступа к этому разделу');
            }
        }
        
        // Сохраняем объект админа в запросе для использования в контроллерах
        $request->merge(['current_admin' => $admin]);
        
        return $next($request);
    }
}