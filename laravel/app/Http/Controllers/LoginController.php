<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Пользователь с таким e-mail и паролем не найден',
        ])->onlyInput('email');
    }

    public function registration()
    {
        return view('pages.auth.register');
    }

    public function createUser(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $user = User::create($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            event(new Registered($user));

            return redirect()->route('verification.notice');
        }

        return back()->withErrors([
            'email' => 'Пользователь с таким e-mail уже существует',
        ])->onlyInput('email');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function verify()
    {
        return redirect()->route('account')->with('success', 'Вы зарегистрированы');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/account')->with('success', 'Адрес почты подтверждён');
    }
}
