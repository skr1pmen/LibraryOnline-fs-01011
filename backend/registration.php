<?php
//var_dump($_POST);
//var_dump($_FILES);
require './db.php'; // Подключения файла для взаимодействия с бд

$fio = $_POST['fio']; //Создание переменной для ФИО пользователя
$login = $_POST['login']; //Создание переменной для ЛОГИНА пользователя
$password = $_POST['password']; //Создание переменной для ПАРОЛЯ пользователя
$avatar = $_FILES['avatar']; //Создание переменной для АВАТАРКИ пользователя

var_dump($fio, $login, $password, $avatar);