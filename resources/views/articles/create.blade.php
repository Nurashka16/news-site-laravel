@extends('layouts.app')

@section('title', 'Создание новости')

@section('content')
<div class="container" style="max-width: 800px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="color: #35424a; margin-bottom: 25px;">Создание новой новости</h1>

    @if($errors->any())
        <div style="background: #fee; border-left: 4px solid #e74c3c; padding: 15px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px; color: #c0392b;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Заголовок</label>
            <input type="text" name="title" value="{{ old('title') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;"
                   required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Описание</label>
            <textarea name="description" rows="3" 
                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;"
                      required>{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Содержание</label>
            <textarea name="content" rows="6" 
                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;"
                      required>{{ old('content') }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Изображение превью (путь)</label>
            <input type="text" name="preview_image" value="{{ old('preview_image', 'images/1.jpg') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Полное изображение (путь)</label>
            <input type="text" name="full_image" value="{{ old('full_image', 'images/1.jpg') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;">
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 5px; color: #35424a; font-weight: bold;">Дата публикации</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', date('Y-m-d\TH:i')) }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 1rem;">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; font-size: 1rem; cursor: pointer;">
                Создать статью
            </button>
            <a href="{{ route('articles.index') }}" 
               style="flex: 1; padding: 12px; background-color: #95a5a6; color: #fff; text-align: center; text-decoration: none; border-radius: 3px; font-size: 1rem;">
                Отмена
            </a>
        </div>
    </form>
</div>
@endsection