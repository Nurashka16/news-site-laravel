<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Главная страница
Route::get('/', function () {
    return view('welcome');
});

// Страница "О нас"
Route::get('/about', function () {
    return view('about');
});

// Страница "Контакты" с динамическими данными
Route::get('/contact', function () {
    // Массив данных о команде
    $team = [
        [
            'name' => 'Иванов Иван Иванович',
            'position' => 'Главный редактор',
            'email' => 'ivanov@newssite.ru'
        ],
        [
            'name' => 'Петрова Мария Сергеевна',
            'position' => 'Редактор новостей',
            'email' => 'petrova@newssite.ru'
        ],
        [
            'name' => 'Сидоров Алексей Петрович',
            'position' => 'Корреспондент',
            'email' => 'sidorov@newssite.ru'
        ],
        [
            'name' => 'Козлова Анна Владимировна',
            'position' => 'Технический редактор',
        ]
    ];

    return view('contact', ['team' => $team]);
});