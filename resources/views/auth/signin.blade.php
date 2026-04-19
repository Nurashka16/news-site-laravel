@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container" style="max-width: 500px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="color: #35424a; margin-bottom: 25px; text-align: center;">Регистрация</h1>

    {{-- Блок вывода ошибок --}}
    @if($errors->any())
        <div style="background: #fee; border-left: 4px solid #e74c3c; padding: 15px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px; color: #c0392b;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registration') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Имя</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px;" required>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px;" required>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Пароль</label>
            <input type="password" name="password" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px;" required>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Подтвердите пароль</label>
            <input type="password" name="password_confirmation" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px;" required>
        </div>
        
        <button type="submit" 
                style="width: 100%; padding: 12px; background-color: #e8491d; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
            Зарегистрироваться
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center;">
        <p style="color: #666;">Уже есть аккаунт? <a href="{{ route('login') }}" style="color: #e8491d;">Войти</a></p>
    </div>
</div>
@endsection