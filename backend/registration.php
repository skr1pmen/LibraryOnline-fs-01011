<?php
//var_dump($_POST);
//var_dump($_FILES);
require './db.php';

$fio = $_POST['fio'];
$login = $_POST['login'];
$password = $_POST['password'];
$avatar = $_FILES['avatar'];

var_dump($fio, $login, $password, $avatar);