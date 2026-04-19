@extends('layouts.app')

@section('title', 'О нас')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 20px;">О нас</h1>
    <div style="line-height: 1.8; color: #555;">
        <p style="margin-bottom: 15px;">
            Наш новостной сайт был создан с целью предоставления пользователям 
            достоверной и актуальной информации о событиях в мире.
        </p>
        <p style="margin-bottom: 15px;">
            Мы работаем с 2024 года и за это время зарекомендовали себя как 
            надежный источник новостей. Наша команда состоит из профессиональных 
            журналистов и редакторов.
        </p>
        <h2 style="color: #e8491d; margin: 25px 0 15px;">Наши ценности:</h2>
        <ul style="margin-left: 20px;">
            <li>Объективность и беспристрастность</li>
            <li>Оперативность публикации</li>
            <li>Проверка фактов</li>
            <li>Уважение к читателям</li>
        </ul>
    </div>
</div>
@endsection