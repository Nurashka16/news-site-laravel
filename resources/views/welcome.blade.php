@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 30px;">Последние новости</h1>

    @if(isset($news) && count($news) > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($news as $item)
                <div style="border: 1px solid #ddd; border-radius: 5px; overflow: hidden; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <img src="{{ asset($item['preview_image']) }}" 
                         alt="{{ $item['title'] }}" 
                         style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 15px;">
                        <h3 style="color: #35424a; margin-bottom: 10px;">{{ $item['title'] }}</h3>
                        <p style="color: #666; margin-bottom: 15px;">{{ $item['description'] }}</p>
                        <small style="color: #999;">{{ $item['created_at'] }}</small>
                        <br>
                        <a href="{{ route('gallery', ['id' => $item['id']]) }}" 
                           style="display: inline-block; margin-top: 10px; padding: 8px 15px; background-color: #e8491d; color: #fff; text-decoration: none; border-radius: 3px;">
                            Подробнее
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p style="color: #666; text-align: center; padding: 40px;">Новости временно отсутствуют</p>
    @endif
</div>
@endsection