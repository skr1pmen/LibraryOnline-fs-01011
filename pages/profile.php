<?php
require '../backend/userProfile.php'; // Подключение файла для обработки пользователя
$user = getUser(); // Получение данных о пользователе
var_dump($user);

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

</main>
<footer>
    ©LibraryOnline <?= Date("Y") ?>
</footer>
