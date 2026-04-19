@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 20px;">{{ $article->title }}</h1>
    
    <div style="margin-bottom: 30px;">
        <div style="background-color: #f4f4f4; padding: 40px; text-align: center; border-radius: 5px;">
            <img src="{{ asset($article->full_image) }}" alt="{{ $article->title }}" 
                 style="max-width: 100%; height: auto; border-radius: 5px;">
        </div>
    </div>

    <div style="line-height: 1.8; color: #555; margin-bottom: 20px;">
        <p>{{ $article->content }}</p>
    </div>

    <small style="color: #999;">Опубликовано: {{ \Carbon\Carbon::parse($article->published_at)->format('d.m.Y H:i') }}</small>

    <div style="margin-top: 30px; display: flex; gap: 10px;">
        <a href="{{ route('articles.edit', $article->id) }}" 
           style="padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 3px;">
            ✏️ Редактировать
        </a>
        
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
              onsubmit="return confirm('Вы уверены, что хотите удалить эту статью?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    style="padding: 15px 20px; background-color: #e74c3c; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
                🗑️ Удалить
            </button>
        </form>
        
        <a href="{{ route('articles.index') }}" 
           style="padding: 10px 20px; background-color: #35424a; color: #fff; text-decoration: none; border-radius: 3px;">
            ← Назад к списку
        </a>
    </div>
</div>
@endsection