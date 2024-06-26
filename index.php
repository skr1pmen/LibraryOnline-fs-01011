<?php
session_start();
require './backend/db.php';
$books = select("SELECT id, title FROM books");
//var_dump($books);
?>
<head> <!--Объявление блока "головы" страницы для отображения заголовка и подключения стилей-->
    <title>Главная страница</title> <!--Отображение заголовка-->
    <link rel="stylesheet" href="./assets/styles/index.css"> <!--Подключения стилей-->
</head>
<header> <!--Отображение "шапки" сайта-->
    <div class="container"> <!--Создание ограничительного контейнера для сторонницы-->
        <a href="/">LibraryOnline</a> <!--Создание ссылки на главную страницу сайта-->
        <nav> <!--Семантический блок HTML предназначений для навигационных панелей-->
            <?php if (empty($_SESSION['user'])) : ?> <!-- Проверка на авторизацию пользователя-->
                <a href="./pages/auth.php">Войти</a> <!--Ссылка на страницу авторизации-->
                <a href="./pages/reg.php">Регистрация</a> <!--Ссылка на страницу регистрации-->
            <?php else : ?>
                <a href="./backend/logout.php">Выйти</a> <!--Ссылка на страницу выхода из аккаунта-->
            <?php endif; ?>
        </nav>
    </div>
</header>
<main> <!--Отображение основного контента сайта-->
    <div class="container">
        <a class="btn" href="./pages/addBook.php">Добавление книги</a>
        <div class="viewBooks">
            <?php foreach ($books as $book): ?>
                <div class="book">
                    <img src="./assets/images/covers/<?= $book['id'] ?>.jpg" alt="cover">
                    <h2><?= $book['title'] ?></h2>
                    <a class="btn" href="./pages/book.php?id=<?= $book['id'] ?>">подробнее</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<footer> <!--Отображение "подвала" сайта-->
    ©LibraryOnline <?= Date("Y") ?>
    <!--Знак копирайтинга (защиты прав на использование и лицензирование сайта) + php класс Date выводит текущий год через шаблон "Y"-->
</footer>
