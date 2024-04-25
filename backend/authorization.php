<?php
require './db.php'; // Подключения файла для взаимодействия с бд
session_start(); // Стартуем сессию

$login = $_POST['login']; // Создание переменной для Логина
$password = $_POST['password']; // Создание переменной для Пароля

if (!empty($login)) { // Проверка логина на пустоту
    $user = select('SELECT * FROM users WHERE login = :login', ['login' => $login]); // Получаем данные о пользователе из бд
    if (!empty($user)) { // Проверка на полученного пользователя
        if (!empty($password)) { // Проверка пароля на пустоту
            if (password_verify($password, $user[0]['password'])) { // Проверка совпадения пароля из бд и от пользователя
                $_SESSION['user']['id'] = $user[0]['id']; // Создание сессии для авторизации пользователя
                header('location: ../'); // Переадресация пользователя на главную страницу
            } else {
                $_SESSION['error'] = 'Неверный пароль!'; // Создание сессии для ошибки
                header('location: ../pages/auth.php'); // Переадресация пользователя на страницу авторизации
            }
        } else {
            $_SESSION['error'] = 'Необходимо ввести пароль!'; // Создание сессии для ошибки
            header('location: ../pages/auth.php'); // Переадресация пользователя на страницу авторизации
        }
    } else {
        $_SESSION['error'] = 'Пользователь не найден!'; // Создание сессии для ошибки
        header('location: ../pages/auth.php'); // Переадресация пользователя на страницу авторизации
    }
} else {
    $_SESSION['error'] = 'Необходимо ввести логин!'; // Создание сессии для ошибки
    header('location: ../pages/auth.php'); // Переадресация пользователя на страницу авторизации
}