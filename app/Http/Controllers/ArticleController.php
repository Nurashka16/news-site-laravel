<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // Валидация
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|string',
            'full_image' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Создание статьи
        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'preview_image' => $request->preview_image ?? 'images/1.jpg',
            'full_image' => $request->full_image ?? 'images/1.jpg',
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        // Валидация
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|string',
            'full_image' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Обновление статьи
        $article = Article::findOrFail($id);
        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'preview_image' => $request->preview_image ?? $article->preview_image,
            'full_image' => $request->full_image ?? $article->full_image,
            'published_at' => $request->published_at ?? $article->published_at,
        ]);

        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }
}