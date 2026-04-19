<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Главная страница с новостями
     */
    public function index()
    {
        // Читаем JSON файл
        $jsonPath = public_path('articles.json');
        $jsonData = file_get_contents($jsonPath);
        $news = json_decode($jsonData, true);

        return view('welcome', ['news' => $news]);
    }

    /**
     * Страница галереи
     */
    public function gallery($id)
    {
        // Читаем JSON файл
        $jsonPath = public_path('articles.json');
        $jsonData = file_get_contents($jsonPath);
        $news = json_decode($jsonData, true);

        // Ищем новость по ID
        $item = collect($news)->firstWhere('id', $id);

        return view('gallery', ['item' => $item]);
    }
}