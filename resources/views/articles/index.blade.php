@extends('layouts.app')

@section('title', 'Список новостей')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 30px; text-align: center;">Все новости</h1>

    @if($articles->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($articles as $article)
                <article style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div style="height: 180px; background-color: #f4f4f4; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img src="{{ asset($article->preview_image) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 15px;">
                        <h3 style="color: #35424a; margin-bottom: 10px; font-size: 1.2rem;">{{ $article->title }}</h3>
                        <p style="color: #666; margin-bottom: 15px; font-size: 0.95rem;">{{ Str::limit($article->description, 100) }}</p>
                        <small style="color: #999;">📅 {{ \Carbon\Carbon::parse($article->published_at)->format('d.m.Y') }}</small>
                        <br>
                        <a href="#" style="display: inline-block; margin-top: 10px; padding: 6px 12px; background-color: #35424a; color: #fff; text-decoration: none; border-radius: 3px; font-size: 0.9rem;">
                            Читать далее
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p style="text-align: center; color: #666; padding: 40px;">Новостей пока нет.</p>
    @endif
</div>
@endsection