<?php
require '../backend/userProfile.php'; // Подключение файла для обработки пользователя
$userId = empty($_GET['id']) ? $_SESSION['user']['id'] : $_GET['id'];
$user = getUser($userId); // Получение данных о пользователе
$books = select("
SELECT
    books.id as id,
    books.title as title,
    books.description as description,
    rent_books.rent_date as rent_date,
    authors.fio as author
FROM rent_books
LEFT JOIN books ON rent_books.book_id = books.id
LEFT JOIN authors ON books.author_id = authors.id
WHERE user_id = :user_id
", ['user_id' => $userId]);
//var_dump($user);

//    /pages/profile.php?id=10

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
        <?php if (is_array($user)) : ?>
            <div class="user_info">
                <?php if (file_exists('../assets/images/users_avatar/' . $user['id'] . '.jpg')): ?>
                    <img src="<?= '../assets/images/users_avatar/' . $user['id'] . '.jpg' ?>" alt="">
                <?php endif; ?>
                <h2><?= $user['fio'] ?></h2>
                <span>#<?= $user['login'] ?></span>
            </div>
            <div class="rent_books">
                <div class="container">
                    <h1>Арендованые книги:</h1>
                    <?php if (!empty($books)): ?>
                        <div class="viewBooks">
                            <?php foreach ($books as $book): ?>
                                <div class="book">
                                    <img src="../assets/images/covers/<?= $book['id'] ?>.jpg" alt="cover">
                                    <h2><?= $book['title'] ?></h2>
                                    <a class="btn" href="../pages/book.php?id=<?= $book['id'] ?>">подробнее</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <? else: ?>
                        <h2>У вас нет арендованных книг</h2>
                    <? endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="error_message">
                <span><?= $user ?></span>
            </div>
        <?php endif; ?>
    </div>
</main>
<footer>
    ©LibraryOnline <?= Date("Y") ?>
</footer>