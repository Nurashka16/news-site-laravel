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
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
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
            background-color: #e8491d;
            border-radius: 3px;
        }
        main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            background-color: #ffffff;
            min-height: 400px;
        }
        footer {
            background-color: #35424a;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">NewsSite</div>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/about">О нас</a></li>
                <li><a href="/contact">Контакты</a></li>
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