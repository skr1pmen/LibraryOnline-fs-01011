<?php
?>

<head>
    <title>Страница регистрации</title>
    <link rel="stylesheet" href="../assets/styles/index.css">
</head>
<header>
    <div class="container">
        <a href="/">LibraryOnline</a>
        <nav>
            <a href="./auth.php">Войти</a>
            <a href="./reg.php">Регистрация</a>
        </nav>
    </div>
</header>
<main class="container form_page">
    <form action="../backend/registration.php" method="post" enctype="multipart/form-data">
        <h2>Регистрация</h2>
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