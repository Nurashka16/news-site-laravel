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
      @can('update', $article)
         <a href="{{ route('articles.edit', $article->id) }}" 
            style="padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 3px;">
               ✏️ Редактировать
         </a>
         
         <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
               onsubmit="return confirm('Вы уверены?');">
               @csrf @method('DELETE')
               <button type="submit" 
                     style="padding: 10px 20px; background-color: #e74c3c; color: #fff; border: none; border-radius: 3px; cursor: pointer;">
                  🗑️ Удалить
               </button>
         </form>
      @endcan
      
      <a href="{{ route('articles.index') }}" 
         style="padding: 10px 20px; background-color: #35424a; color: #fff; text-decoration: none; border-radius: 3px;">
         ← Назад
      </a>
   </div>
</div>
<!-- Блок комментариев -->
<div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #ddd;">
    <h2 style="color: #35424a; margin-bottom: 20px;">Комментарии</h2>

    @if(session('success'))
        <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 15px; margin-bottom: 20px; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма добавления комментария (только для авторизованных) -->
    @auth
        <form action="{{ route('comments.store', $article->id) }}" method="POST" style="margin-bottom: 30px;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Ваш комментарий:</label>
                <textarea name="content" rows="4" 
                          style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;"
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" 
                    style="padding: 10px 20px; background-color: #27ae60; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                Добавить комментарий
            </button>
        </form>
    @else
        <p style="color: #666; margin-bottom: 20px;">
            <a href="{{ route('login') }}" style="color: #e8491d;">Войдите</a>, чтобы оставить комментарий.
        </p>
    @endauth

    <!-- Список комментариев (ТОЛЬКО одобренные!) -->
    @php
        $approvedComments = $article->comments()->where('is_approved', true)->with('user')->latest()->get();
    @endphp

    @if($approvedComments->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($approvedComments as $comment)
                <div style="border: 1px solid #ddd; border-radius: 5px; padding: 15px; background: #f9f9f9;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <strong style="color: #35424a;">{{ $comment->user->name }}</strong>
                        <small style="color: #999;">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                    </div>
                    <p style="color: #555; margin: 0;">{{ $comment->content }}</p>
                    
                    <!-- Кнопка удаления (только для модератора) -->
                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" 
                              style="margin-top: 10px;" 
                              onsubmit="return confirm('Удалить комментарий?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="padding: 5px 10px; background-color: #e74c3c; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 0.9rem;">
                                Удалить
                            </button>
                        </form>
                    @endcan
                </div>
            @endforeach
        </div>
    @else
        <p style="color: #999; text-align: center; padding: 20px;">Пока нет комментариев. Будьте первым!</p>
    @endif
</div>
@endsection