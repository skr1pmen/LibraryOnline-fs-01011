<?php
require '../backend/userProfile.php'; // Подключение файла для обработки пользователя
$userId = empty($_GET['id']) ? $_SESSION['user']['id'] : $_GET['id'];
$user = getUser($userId); // Получение данных о пользователе
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