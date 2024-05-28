<?php
require "../backend/db.php";
session_start();
$bookId = $_GET['id'];
$book = select("
SELECT 
    books.id as id,
    books.title as title,
    books.description as description,
    books.date as date,
    authors.fio as author_fio 
FROM books 
LEFT JOIN authors ON authors.id = books.author_id
WHERE books.id = :id
", ['id' => $bookId]);
$isRent = false;
$rentBooks = [];
if (!empty($_SESSION['user']['id'])) {
    $rentBooks = select('
            SELECT id, rent_date FROM rent_books
            WHERE book_id = :book_id AND user_id = :user_id
        ',
        ['book_id' => $bookId, 'user_id' => $_SESSION['user']['id']]
    );
    $isRent = !empty($rentBooks);
}

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
                <a href="../pages/profile.php">Профиль</a>
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
                <i>Дата добавления: <?= date('d.m.Y H:i:s', strtotime($book[0]['date'])) ?></i>
                <?php if (!$isRent): ?>
                    <a class="btn" href="../backend/newRent.php?id=<?= $bookId ?>">Арендовать</a>
                <?php else: ?>
                    <p>Книга арендована: <?= date('d.m.Y', strtotime($rentBooks[0]['rent_date'])) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<footer>
    ©LibraryOnline <?= Date("Y") ?>
</footer>
