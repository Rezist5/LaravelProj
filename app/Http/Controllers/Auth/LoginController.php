<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AdminModel;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'message' => 'Invalid credentials',
        ])->withInput($request->except('password'));
    }
    public function showLoginForm(UserController $userController)
    {
        
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); 
    }
}