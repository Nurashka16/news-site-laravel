@extends('layouts.app')

@section('title', 'Галерея')

@section('content')
<div class="container" style="padding: 40px 20px;">
    @if(isset($item))
        <h1 style="color: #35424a; margin-bottom: 20px;">{{ $item['title'] }}</h1>
        
        <div style="margin-bottom: 30px;">
            <div style="background-color: #f4f4f4; padding: 40px; text-align: center; border-radius: 5px;">
                <p style="color: #999; font-size: 1.2rem;">{{ $item['full_image'] }}</p>
                <img src="{{ asset($item['full_image']) }}" 
                  alt="{{ $item['title'] }}" 
                  style="width: 100%; height: auto; border-radius: 5px;">
            </div>
        </div>

        <div style="line-height: 1.8; color: #555;">
            <p>{{ $item['description'] }}</p>
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('home') }}" 
               style="display: inline-block; padding: 10px 20px; background-color: #35424a; color: #fff; text-decoration: none; border-radius: 3px;">
                ← Назад к новостям
            </a>
        </div>
    @else
        <p style="color: #666; text-align: center;">Новость не найдена</p>
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('home') }}" 
               style="display: inline-block; padding: 10px 20px; background-color: #35424a; color: #fff; text-decoration: none; border-radius: 3px;">
                ← На главную
            </a>
        </div>
    @endif
</div>
@endsection