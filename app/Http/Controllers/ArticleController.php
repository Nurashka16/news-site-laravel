<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display a listing of the resource. (Доступно ВСЕМ)
     */
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource. (Только модератор)
     */
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может создавать статьи');
        }
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage. (Только модератор)
     */
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

    /**
     * Display the specified resource. (Доступно ВСЕМ — без проверок!)
     */
public function show($id)
{
    $article = Article::with('comments.user')->findOrFail($id);
    return view('articles.show', compact('article'));
}

    /**
     * Show the form for editing the specified resource. (Только модератор)
     */
    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->isModerator()) {
            abort(403, 'Только модератор может редактировать статьи');
        }
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage. (Только модератор)
     */
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

    /**
     * Remove the specified resource from storage. (Только модератор)
     */
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