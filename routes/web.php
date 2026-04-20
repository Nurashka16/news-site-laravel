<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// === Публичные маршруты (без защиты) ===

// Главная страница с новостями из JSON (Задание 2)
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');

// Статические страницы
Route::get('/about', fn() => view('about'));
Route::get('/contact', function () {
    $team = [
        ['name' => 'Иванов Иван Иванович', 'position' => 'Главный редактор', 'email' => 'ivanov@newssite.ru'],
        ['name' => 'Петрова Мария Сергеевна', 'position' => 'Редактор новостей', 'email' => 'petrova@newssite.ru'],
        ['name' => 'Сидоров Алексей Петрович', 'position' => 'Корреспондент', 'email' => 'sidorov@newssite.ru']
    ];
    return view('contact', ['team' => $team]);
});

// Регистрация (Задание 3)
Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');

// Вход (Задание 6)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// === Защищённые маршруты (требуют авторизации) ===
Route::middleware(['auth:sanctum'])->group(function () {
    
    // Выход
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // CRUD для статей (Задание 4-5)
    Route::resource('articles', ArticleController::class);
    
    // === Комментарии (Задание 7-9) ===
    
    // Создание комментария (доступно всем авторизованным)
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    
    // Удаление комментария (только модератор)
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
    
    // === Модерация комментариев (Задание 9 - только для модераторов) ===
    Route::get('/comments-moderation', [CommentController::class, 'moderation'])
        ->name('comments.moderation');
    Route::post('/comments/{comment}/approve', [CommentController::class, 'approve'])
        ->name('comments.approve');
    Route::post('/comments/{comment}/reject', [CommentController::class, 'reject'])
        ->name('comments.reject');
});