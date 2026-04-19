<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Главная страница с новостями (через контроллер)
Route::get('/', [MainController::class, 'index'])->name('home');

// Страница галереи
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');

// Страница "О нас"
Route::get('/about', function () {
    return view('about');
});

// Страница "Контакты"
Route::get('/contact', function () {
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
        ]
    ];

    return view('contact', ['team' => $team]);
});

// === Маршруты авторизации ===
use App\Http\Controllers\AuthController;

// Показать форму регистрации
Route::get('/signin', [AuthController::class, 'create'])->name('signin');

// Обработать регистрацию
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');

use App\Http\Controllers\ArticleController;

// Маршрут для списка статей (Задание 4)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');


// Ресурсный маршрут для CRUD операций со статьями
Route::resource('articles', ArticleController::class);