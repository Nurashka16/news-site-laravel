@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 20px;">Добро пожаловать на наш новостной сайт!</h1>
    <p style="font-size: 1.1rem; color: #666; line-height: 1.8;">
        Здесь вы найдете самые свежие и актуальные новости из различных сфер жизни.
        Мы стараемся предоставлять только проверенную информацию.
    </p>
    <div style="margin-top: 30px; padding: 20px; background-color: #f9f9f9; border-left: 4px solid #e8491d;">
        <h2 style="color: #e8491d; margin-bottom: 10px;">Что мы предлагаем:</h2>
        <ul style="margin-left: 20px; color: #555;">
            <li>Актуальные новости каждый день</li>
            <li>Аналитика и экспертные мнения</li>
            <li>Широкий спектр тем: от политики до спорта</li>
            <li>Удобный интерфейс и быстрый доступ</li>
        </ul>
    </div>
</div>
@endsection