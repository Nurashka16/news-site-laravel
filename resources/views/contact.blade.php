@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="color: #35424a; margin-bottom: 20px;">Контакты</h1>
    
    <div style="margin-bottom: 30px;">
        <h2 style="color: #e8491d; margin-bottom: 15px;">Наша команда</h2>
        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
            @if(isset($team) && count($team) > 0)
                <ul style="list-style: none;">
                    @foreach($team as $member)
                        <li style="padding: 10px 0; border-bottom: 1px solid #ddd;">
                            <strong style="color: #35424a;">{{ $member['position'] }}:</strong> 
                            {{ $member['name'] }}
                            @if(isset($member['email']))
                                <br>📧 {{ $member['email'] }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Информация о команде временно недоступна</p>
            @endif
        </div>
    </div>

    <div>
        <h2 style="color: #e8491d; margin-bottom: 15px;">Свяжитесь с нами</h2>
        <p style="color: #555; line-height: 1.8;">
            <strong>Email:</strong> info@newssite.ru<br>
            <strong>Телефон:</strong> +7 (999) 123-45-67<br>
            <strong>Адрес:</strong> г. Москва, ул. Примерная, д. 1<br>
            <strong>Режим работы:</strong> Пн-Пт с 9:00 до 18:00
        </p>
    </div>
</div>
@endsection