<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.account.personal-data');
    }

    public function updateUser(UserRequest $request)
    {
        Auth::user()->update($request->validated());

        return back()->with('success', 'Профиль обновлен!');
    }
}
