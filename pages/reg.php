<?php
session_start();

!empty($_SESSION['user']) ? header('location: ../') : null; //Проверка на авторизацию. Если она уже прошла, то переадресация на главную страницу
?>

<head>
    <title>Страница регистрации</title>
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
    <form action="../backend/registration.php" method="post" enctype="multipart/form-data">
        <h2>Регистрация</h2>
        <span><?= !empty($_SESSION['error']) ? $_SESSION['error'] : "" ?></span>
        <label>
            Введите ваше ФИО:<br>
            <input type="text" name="fio">
        </label>
        <label>
            Введите ваш логин:<br>
            <input type="text" name="login">
        </label>
        <label>
            Введите ваш пароль:<br>
            <input type="password" name="password">
        </label>
        <label>
            Введите вашу аватарку:<br>
            <input type="file" name="avatar">
            <div class="btn">Выбрать</div>
        </label>
        <button class="btn">Зарегистрироваться</button>
    </form>
</main>
<footer>
    ©LibraryOnline <?= Date("Y") ?>
</footer>