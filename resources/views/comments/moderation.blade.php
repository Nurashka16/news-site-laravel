@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 30px;">Модерация комментариев</h1>

    @if(session('success'))
        <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 15px; margin-bottom: 20px; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    @if($comments->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($comments as $comment)
                <div style="border: 2px solid #ffc107; border-radius: 5px; padding: 20px; background: #fff;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                        <div>
                            <strong style="color: #35424a; font-size: 1.1rem;">{{ $comment->user->name }}</strong>
                            <div style="color: #666; font-size: 0.9rem; margin-top: 5px;">
                                Статья: <a href="{{ route('articles.show', $comment->article->id) }}" style="color: #e8491d;">
                                    {{ Str::limit($comment->article->title, 50) }}
                                </a>
                            </div>
                            <small style="color: #999;">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                    </div>
                    
                    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                        <p style="color: #555; margin: 0;">{{ $comment->content }}</p>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <form action="{{ route('comments.approve', $comment->id) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    style="padding: 8px 20px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
                                ✓ Одобрить
                            </button>
                        </form>
                        
                        <form action="{{ route('comments.reject', $comment->id) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    style="padding: 8px 20px; background-color: #e74c3c; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
                                ✗ Отклонить
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div style="margin-top: 30px;">
            {{ $comments->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 60px; color: #999;">
            <p style="font-size: 1.2rem;">Нет комментариев, ожидающих модерации</p>
            <p>Все комментарии уже проверены!</p>
        </div>
    @endif
</div>
@endsection