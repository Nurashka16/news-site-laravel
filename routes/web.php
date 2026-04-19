<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

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

// Вход (Задание 6 - новые маршруты)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// === Защищённые маршруты (требуют авторизации) ===
Route::middleware(['auth:sanctum'])->group(function () {
    // Выход
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // CRUD для статей (Задание 4-5) - теперь защищены
    Route::resource('articles', ArticleController::class);
});

use App\Http\Controllers\CommentController;

// Маршруты для комментариев (внутри группы auth:sanctum)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

// Route::get('/test-mail', function () {
//     Mail::raw('Тестовое сообщение от Laravel', function ($message) {
//         $message->to('tnuraika16@gmail.com')
//                 ->subject('Тест SMTP');
//     });
//     return 'Письмо отправлено! Проверь почту.';
// });