<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    // Показать форму входа
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Обработка входа
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('login', $request->login)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_logged_in', true);
            Session::put('admin_id', $admin->id);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Неверный логин или пароль');
    }

    // Выход из админки
    public function logout()
    {
        Session::forget('admin_logged_in');
        Session::forget('admin_id');
        return redirect()->route('home');
    }

    // Проверка авторизации
    public static function isLoggedIn()
    {
        return Session::has('admin_logged_in') && Session::get('admin_logged_in') === true;
    }
}