<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticleMail;

class ArticleController extends Controller
{
    /**
     * Конструктор
     * Защита маршрутов авторизацией, КРОМЕ index и show
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может создавать статьи');
        }
        return view('articles.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может создавать статьи');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|string',
            'full_image' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Создание статьи
        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'preview_image' => $request->preview_image ?? 'images/1.jpg',
            'full_image' => $request->full_image ?? 'images/1.jpg',
            'published_at' => $request->published_at ?? now(),
            'user_id' => Auth::id(), // Сохраняем автора
        ]);

        $moderators = User::whereHas('role', function($query) {
            $query->where('name', 'moderator');
        })->get();

        // Отправляем письмо каждому модератору
        foreach ($moderators as $moderator) {
            Mail::to($moderator->email)->send(new NewArticleMail($article, $moderator));
        }

        return redirect()->route('articles.index')->with('success', 'Статья успешно создана и модераторы уведомлены!');
    }

    public function show($id)
    {
        // Загружаем статью вместе с комментариями и пользователями, оставившими их
        $article = Article::with('comments.user')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может редактировать статьи');
        }
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может обновлять статьи');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|string',
            'full_image' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может удалять статьи');
        }

        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }
}