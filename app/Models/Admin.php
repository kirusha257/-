<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['login', 'password', 'first_name', 'last_name', 'role'];
    protected $hidden = ['password'];
    
    // Проверка прав
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function hasAccess($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        // Права для обычного администратора
        $adminPermissions = [
            'menu',
            'events', 
            'statistics',
            'gallery',
            'best-dishes',
            'bookings.view',  // Только просмотр броней
            'bookings.edit',  // Редактирование броней
            'bookings.delete', // Удаление броней
        ];
        
        return in_array($permission, $adminPermissions);
    }
}