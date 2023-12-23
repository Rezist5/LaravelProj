<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Если пользователь аутентифицирован успешно, выполните необходимые действия
            return redirect()->intended('/'); // Перенаправление на страницу после успешного входа
        }

        // В случае неудачной аутентификации возвращаем пользователя на страницу логина с сообщением об ошибке
        return back()->withErrors([
            'message' => $credentials,
        ])->withInput($request->except('password')); 
    }

    public function showLoginForm()
    {
        return view('auth.login'); 
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Перенаправление на страницу логина после выхода
    }
}
