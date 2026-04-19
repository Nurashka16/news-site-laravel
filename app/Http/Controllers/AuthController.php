<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Показать форму регистрации
    public function create()
    {
        return view('auth.signin');
    }

    //Обработать регистрацию
public function registration(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Возвращаем данные в JSON (без сохранения в БД)
    return response()->json([
        'success' => true,
        'message' => 'Пользователь успешно зарегистрирован',
        'user' => [
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => now(),
        ]
    ]);
}
}