<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function logoutUser(Request $request)
    {
        Auth::guard('web')->logout();

        return redirect(route('auth'));
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admins')->logout();

        return redirect(route('admin.login'));
    }

    public function loginUser(Request $request)
    {
        $data = $request->all();
        $credential = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (Auth::guard('web')->attempt($credential)) {
            $request->session()->regenerate();

            return redirect(route('user.profile'));
        }

        return back()->with('error', 'Неправильный логин или пароль');
    }

    public function loginAdmin(Request $request)
    {
        $data = $request->all();
        $credential = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (Auth::guard('admins')->attempt($credential)) {
            $request->session()->regenerate();

            return redirect(route('admin.panel'));
        }

        return back()->with('error', 'Неправильный логин или пароль');
    }

}
