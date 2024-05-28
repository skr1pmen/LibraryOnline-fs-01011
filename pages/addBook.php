<?php
session_start();
require '../backend/db.php';
$authors = select("SELECT * FROM authors"); // Получение всех авторов из бд
?>

<head>
    <title>Добавление книги</title>
    <link rel="stylesheet" href="../assets/styles/index.css">
</head>
<header>
    <div class="container">
        <a href="/">LibraryOnline</a>
        <nav>
            <?php if (empty($_SESSION['user'])) : ?>
                <a href="../pages/auth.php">Войти</a>
                <a href="../pages/reg.php">Регистрация</a>
            <?php else : ?>
                <a href="../pages/profile.php">Профиль</a>
                <a href="../backend/logout.php">Выйти</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container form_page">
    <form action="../backend/createNewBook.php" method="post" enctype="multipart/form-data">
        <h2>Добавление книги</h2>
        <span><?= !empty($_SESSION['error']) ? $_SESSION['error'] : "" ?></span>
        <label>
            Введите название книги:<br>
            <input type="text" name="name">
        </label>
        <label>
            Введите описание книги:<br>
            <textarea name="description"></textarea>
        </label>
        <label>
            Введите автора книги:<br>
            <input type="text" name="author" list="authors">
            <datalist id="authors">
                <?php foreach ($authors as $author): ?> <!-- Перебор авторов -->
                    <option><?= $author['fio'] ?></option> <!-- Вывод списка авторов -->
                <?php endforeach; ?> <!-- Конец перебора -->
            </datalist>
        </label>
        <label>
            Добавьте обложку:<br>
            <div class="btn">Выбрать</div>
            <input type="file" name="cover">
        </label>
        <button class="btn">Добавить</button>
    </form>
</main>
<footer>
    ©LibraryOnline <?= Date("Y") ?>
</footer>
