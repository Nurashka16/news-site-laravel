<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Новостной сайт')</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    html, body {
        height: 100%;
    }
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    header {
        background-color: #35424a;
        color: #ffffff;
        padding: 1rem 0;
    }
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    nav .logo {
        font-size: 1.5rem;
        font-weight: bold;
    }
    nav ul {
        list-style: none;
        display: flex;
        gap: 20px;
    }
    nav ul li a {
        color: #ffffff;
        text-decoration: none;
        padding: 5px 10px;
        transition: background-color 0.3s;
    }
    nav ul li a:hover {
      border-bottom: 1px solid #e8491d;

    }
    main {
        flex: 1;
        max-width: 1200px;
        margin: 20px auto;
        padding: 0 20px;
        background-color: #ffffff;
        width: 100%;
    }
    footer {
        background-color: #35424a;
        color: #ffffff;
        text-align: center;
        padding: 20px 0;
        margin-top: auto;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    nav ul li a.active {
      border-bottom: 1px solid #e8491d;
      font-weight: bold;
      color: #fff;
}
</style>
</head>
<body>
    <header>
        <nav>
    <div class="logo">NewsSite</div>
<ul>
    <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Главная</a></li>
    <li><a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.index') ? 'active' : '' }}">Новости</a></li>
    <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">О нас</a></li>
    <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Контакты</a></li>
    <li><a href="{{ route('signin') }}" style="background-color: #e8491d; padding: 5px 15px; border-radius: 3px;">Регистрация</a></li>
</ul>
</nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Новостной сайт. Все права защищены.</p>
            <p>ФИО: Тилепова Н.А., Группа: 243-323</p>
        </div>
    </footer>
</body>
</html>