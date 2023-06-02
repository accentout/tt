<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //страница регистрации
    public function register()
    {
        return view('/auth.register');
    }

    //сохраняем пользователя в бд + авторизация
    public function registerStore(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        auth()->login($user);

        return redirect(route('home'));
    }

    // лстраница входа
    public function login()
    {
        return view('/auth.login');
    }

    //проверяем пользователя, если проверки проходят, то логин
    public function loginStore(LoginRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->input('email'))->first();

        if (Hash::check($request->input('password'), $user->password))
            auth()->login($user);

        return redirect(route('home'));

    }

    public function logout()
    {
        auth()->logout();

        return redirect(route('home'));
    }
}
