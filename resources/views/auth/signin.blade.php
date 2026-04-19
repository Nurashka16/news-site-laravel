@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container" style="max-width: 500px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="color: #35424a; margin-bottom: 25px; text-align: center;">Регистрация</h1>
    
    <form action="{{ route('registration') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Имя</label>
            <input type="text" name="name" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;"
                   required>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Email</label>
            <input type="email" name="email" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;"
                   required>
        </div>
        
        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Пароль</label>
            <input type="password" name="password" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;"
                   required>
        </div>
        
        <button type="submit" 
                style="width: 100%; padding: 12px; background-color: #e8491d; color: #fff; border: none; border-radius: 3px; font-size: 1rem; cursor: pointer;">
            Зарегистрироваться
        </button>
    </form>
</div>
@endsection