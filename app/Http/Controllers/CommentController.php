<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $article = Article::findOrFail($articleId);
        
        Comment::create([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_approved' => false, // По умолчанию ожидает модерации
        ]);

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Комментарий добавлен и ожидает модерации!');
    }

    public function moderation()
    {
        // Проверяем, что пользователь - модератор
        if (!Auth::user()->isModerator()) {
            abort(403, 'Доступ запрещен');
        }

        // Получаем все комментарии, ожидающие модерации
        $comments = Comment::where('is_approved', false)
            ->with(['article', 'user'])
            ->latest()
            ->paginate(10);

        return view('comments.moderation', compact('comments'));
    }

    public function approve($id)
    {
        if (!Auth::user()->isModerator()) {
            abort(403, 'Доступ запрещен');
        }

        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return redirect()->route('comments.moderation')
            ->with('success', 'Комментарий одобрен!');
    }

    public function reject($id)
    {
        if (!Auth::user()->isModerator()) {
            abort(403, 'Доступ запрещен');
        }

        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.moderation')
            ->with('success', 'Комментарий удален!');
    }

    public function destroy($id)
    {
        if (!Auth::user()->isModerator()) {
            abort(403, 'Доступ запрещен');
        }
        
        $comment = Comment::findOrFail($id);
        $articleId = $comment->article_id;
        $comment->delete();
        
        return redirect()->route('articles.show', $articleId)
            ->with('success', 'Комментарий удалён!');
    }
}