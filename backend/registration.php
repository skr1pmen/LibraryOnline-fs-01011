<?php
//var_dump($_POST);
//var_dump($_FILES);
require './db.php'; // Подключения файла для взаимодействия с бд
session_start(); // Стартуем сессию

$fio = !empty($_POST['fio']) ? $_POST['fio'] : null; //Создание переменной для ФИО пользователя
$login = !empty($_POST['login']) ? $_POST['login'] : null; //Создание переменной для ЛОГИНА пользователя
$password = !empty($_POST['password']) ? $_POST['password'] : null; //Создание переменной для ПАРОЛЯ пользователя
$avatar = !empty($_FILES['avatar']) ? $_FILES['avatar'] : null; //Создание переменной для АВАТАРКИ пользователя

if (!empty($login)) { // Проверка Логина на пустоту
    $user = select("SELECT * FROM users WHERE login = :login", ['login' => $login]); // получение пользователя из бд
    if (empty($user)) { // Проверка пользователя на наличие
        if (!empty($fio)) { // Проверка ФИО на пустоту
            if (!empty($password)) { // Проверка Пароля на пустоту

                $user_id = insert(
                    "INSERT INTO users (fio, login, password) VALUES (:fio, :login, :password)",
                    [
                        'fio' => $fio,
                        'login' => $login,
                        'password' => password_hash($password, PASSWORD_DEFAULT)
                    ]
                ); // Отправка запроса в бд на регистрацию нового пользователя с получением его id
                $_SESSION['user']['id'] = $user_id; // Сохранение id пользователя в сессию
                move_uploaded_file($avatar['tmp_name'], "../assets/images/users_avatar/" . $user_id . ".jpg"); // Загружаем аватарку пользователя
                header("location: ../"); // Переадресация пользователя на главную страницу

            } else {
                $_SESSION['error'] = "Необходимо ввести пароль!"; // Создание ключа сессии с ошибкой для пользователя
                header("location: ../pages/reg.php"); // Переадресация пользователя на страницу регистрации
            }
        } else {
            $_SESSION['error'] = "Необходимо ввести ФИО!"; // Создание ключа сессии с ошибкой для пользователя
            header("location: ../pages/reg.php"); // Переадресация пользователя на страницу регистрации
        }
    } else {
        $_SESSION['error'] = "Такой пользователь уже существует!"; // Создание ключа сессии с ошибкой для пользователя
        header("location: ../pages/reg.php"); // Переадресация пользователя на страницу регистрации
    }
} else {
    $_SESSION['error'] = "Необходимо ввести логин!"; // Создание ключа сессии с ошибкой для пользователя
    header("location: ../pages/reg.php"); // Переадресация пользователя на страницу регистрации
}