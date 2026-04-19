<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #35424a;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .article-title {
            color: #e8491d;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .article-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #e8491d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #999;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Уведомление о новой статье</p>
    </div>
    
    <div class="content">
        <p>Здравствуйте, {{ $moderator->name }}!</p>
        
        <p>Была добавлена новая статья:</p>
        
        <h2 class="article-title">{{ $article->title }}</h2>
        
        <div class="article-meta">
            <strong>Опубликовано:</strong> {{ $article->created_at->format('d.m.Y H:i') }}<br>
            <strong>Автор:</strong> {{ $article->user->name ?? 'Неизвестно' }}
        </div>
        
        <p><strong>Описание:</strong></p>
        <p>{{ $article->description }}</p>
        
        @if($article->content)
            <p><strong>Содержание:</strong></p>
            <p>{{ Str::limit($article->content, 300) }}</p>
        @endif
        
        <a href="{{ route('articles.show', $article->id) }}" class="button">
            Посмотреть статью
        </a>
    </div>
    
    <div class="footer">
        <p>Это автоматическое сообщение от {{ config('app.name') }}</p>
        <p>Не отвечайте на это письмо</p>
    </div>
</body>
</html>