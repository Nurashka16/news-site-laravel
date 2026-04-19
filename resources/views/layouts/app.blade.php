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
   /* Стили для пагинации Laravel */
   .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      margin-top: 40px;
      list-style: none;
      padding: 0;
   }

   .pagination li {
      display: inline-block;
   }

   .pagination li a,
   .pagination li span {
      padding: 10px 16px;
      background-color: #fff;
      color: #35424a;
      text-decoration: none;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: all 0.3s;
      display: inline-block;
   }

   .pagination li a:hover {
      background-color: #35424a;
      color: #fff;
      border-color: #35424a;
   }

   .pagination li.active span {
      background-color: #e8491d;
      color: #fff;
      border-color: #e8491d;
      font-weight: bold;
   }

   .pagination li.disabled span {
      color: #999;
      cursor: not-allowed;
      opacity: 0.6;
   }

   /* Скрываем стрелки если нужно */
   .pagination .relative:first-child svg,
   .pagination .relative:last-child svg {
      display: none;
   }
</style>
</head>
<body>
    <header>
        <nav>
    <div class="logo">
        <a href="/" style="color: #fff; text-decoration: none;">NewsSite</a>
    </div>
   <ul>
      <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Главная</a></li>
      <li><a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Новости</a></li>
      <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">О нас</a></li>
      <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Контакты</a></li>
      <li><a href="{{ route('signin') }}">Регистрация</a></li>
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