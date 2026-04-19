<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function create() { return view('auth.signin'); }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна! Войдите.');
    }

    public function showLoginForm() { return view('auth.login'); }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $token = Auth::user()->createToken('auth-token')->plainTextToken;
            session(['auth_token' => $token]);
            return redirect()->route('articles.index')->with('success', 'Вы вошли!');
        }

        return redirect()->back()->withErrors(['email' => 'Неверный email или пароль'])->withInput();
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $token = $request->user()->currentAccessToken();
            if ($token instanceof \Laravel\Sanctum\PersonalAccessToken) {
                $token->delete();
            }
            Auth::guard('web')->logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('articles.index')->with('success', 'Вы вышли из системы.');
    }
}