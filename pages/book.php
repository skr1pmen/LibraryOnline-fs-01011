<?php
require "../backend/db.php";
session_start();
$bookId = $_GET['id'];
$book = select("SELECT * FROM books WHERE id = :id", ['id' => $bookId]);
$book[0]['author_fio'] = select("SELECT fio FROM authors WHERE id = :id", ['id' => $book[0]['author_id']])[0]['fio'];
?>
<head>
    <title>Главная страница</title>
    <link rel="stylesheet" href="../assets/styles/index.css">
</head>
<header>
    <div class="container">
        <a href="/">LibraryOnline</a>
        <nav>
            <?php if (empty($_SESSION['user'])) : ?>
                <a href="./auth.php">Войти</a>
                <a href="./reg.php">Регистрация</a>
            <?php else : ?>
                <a href="../backend/logout.php">Выйти</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <div class="book_page">
            <img src="../assets/images/covers/<?= $book[0]['id'] ?>.jpg" alt="">
            <div class="book_info">
                <h1><?= $book[0]['title'] ?></h1>
                <span><?= $book[0]['description'] ?></span>
                <p>Автор: <?= $book[0]['author_fio'] ?></p>
                <i>Дата добавления: <?= $book[0]['date'] ?></i>
                <a class="btn" href="../backend/newRent.php?id=<?= $bookId ?>">Арендовать</a>
            </div>
        </div>
    </div>
</main>
<footer>
    ©LibraryOnline <?= Date("Y") ?>
</footer>
