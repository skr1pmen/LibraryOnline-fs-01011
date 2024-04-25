<?php
require 'db.php'; // Подключения файла для взаимодействия с бд
session_start(); // Стартуем сессию

function getUser($id = null) // Функция для отображения информации о пользователе
{
    $userId = !empty($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0; // Получение id пользователя, если он авторизован

    if (!empty($userId)) {
        $id = $userId;
    } // Присваивание id пользователя к данной функции
    if (empty($id)) {
        return "Пользователь не найден!";
    } // Выдача ошибки при отсутствии id пользователя

    $user = select('SELECT id, fio, login FROM users WHERE id = :id', ['id' => $id]); // Получение данных о пользователе из бд
    return $user[0]; // Возвращаем данные полученные от бд
}


