@extends('layouts.app')

@section('title', 'Список новостей')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <!-- Заголовок и кнопка создания (только для модератора) -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="color: #35424a; margin: 0;">Все новости</h1>
        
        @can('create', \App\Models\Article::class)
            <a href="{{ route('articles.create') }}" 
               style="padding: 12px 25px; background-color: #27ae60; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                + Создать новость
            </a>
        @endcan
    </div>

    @if($articles->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($articles as $article)
                <!-- Карточки новостей -->
                <article style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div style="height: 180px; background-color: #f4f4f4; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img src="{{ asset($article->preview_image) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 15px;">
                        <h3 style="color: #35424a; margin-bottom: 10px; font-size: 1.2rem;">{{ $article->title }}</h3>
                        <p style="color: #666; margin-bottom: 15px; font-size: 0.95rem;">{{ Str::limit($article->description, 100) }}</p>
                        <small style="color: #999;">📅 {{ \Carbon\Carbon::parse($article->published_at)->format('d.m.Y') }}</small>
                        <br>
                        <a href="{{ route('articles.show', $article->id) }}" style="display: inline-block; margin-top: 10px; padding: 6px 12px; background-color: #35424a; color: #fff; text-decoration: none; border-radius: 3px; font-size: 0.9rem;">
                            Читать далее
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
        
        <!-- Пагинация -->
        <div style="margin-top: 40px;">
            @if ($articles->hasPages())
                <div style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 40px;">
                    @if ($articles->onFirstPage())
                        <span style="padding: 10px 16px; background: #f4f4f4; color: #999; border: 1px solid #ddd; border-radius: 5px; cursor: not-allowed;">← Назад</span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" style="padding: 10px 16px; background: #fff; color: #35424a; border: 1px solid #ddd; border-radius: 5px; text-decoration: none; transition: all 0.3s;">← Назад</a>
                    @endif

                    @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        @if ($page == $articles->currentPage())
                            <span style="padding: 10px 16px; background: #e8491d; color: #fff; border: 1px solid #e8491d; border-radius: 5px; font-weight: bold;">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="padding: 10px 16px; background: #fff; color: #35424a; border: 1px solid #ddd; border-radius: 5px; text-decoration: none; transition: all 0.3s;">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" style="padding: 10px 16px; background: #fff; color: #35424a; border: 1px solid #ddd; border-radius: 5px; text-decoration: none; transition: all 0.3s;">Вперед →</a>
                    @else
                        <span style="padding: 10px 16px; background: #f4f4f4; color: #999; border: 1px solid #ddd; border-radius: 5px; cursor: not-allowed;">Вперед →</span>
                    @endif
                </div>
            @endif
        </div>
    @else
        <p style="text-align: center; color: #666; padding: 40px;">Новостей пока нет.</p>
    @endif
</div>
@endsection