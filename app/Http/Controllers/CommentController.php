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
        ]);

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Комментарий добавлен!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Проверяем, что пользователь - модератор
        if (!Auth::user()->isModerator()) {
            abort(403, 'Только модератор может удалять комментарии');
        }
        
        $articleId = $comment->article_id;
        $comment->delete();
        
        return redirect()->route('articles.show', $articleId)
            ->with('success', 'Комментарий удалён!');
    }
}