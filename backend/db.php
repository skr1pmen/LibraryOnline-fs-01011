<?php

//Создание констант для дальнейшего общения с базой данных
const DB_PROVIDER = 'pgsql';
const DB_HOST = 'localhost';
const DB_BASENAME = 'libraryonline';
const DB_USERNAME = 'postgres';
const DB_PASSWORD = '';

function db_connect() //Функция для соединения с базой данных
{
    $pdo = new PDO(
        DB_PROVIDER . ':host=' . DB_HOST . ';dbname=' . DB_BASENAME,
        DB_USERNAME,
        DB_PASSWORD
    );
    return $pdo;
}

function query($sql, $params = []) //Функция для отправки запросов
{
    $pdo = db_connect(); //Получение соединения с бд
    $que = $pdo->prepare($sql); //Подготовка запроса
    if (!empty($params)) { //Проверка доп.параметров на существование
        foreach ($params as $key => $value) { //Перебор доп.параметров
            $que->bindValue(':' . $key, $value); //Внедрение параметров в запрос
        }
    }
    $que->execute(); //Отправка запроса
    return $que; //Возвращаем результат запроса
}

function select($sql, $params = []) //Функция для получения данных из бд
{
    $que = query($sql, $params); //Отправка запроса для получения данных
    $que->setFetchMode(PDO::FETCH_ASSOC); //Преобразование полученных данных в ассоциативный массив
    return $que->fetchAll(); //Получение всех данных из запроса
}

function insert($sql, $params = []) //Функция добавления новых данных
{
    $pdo = db_connect();
    $que = $pdo->prepare($sql);
    if (!empty($params)) {
        foreach ($params as $key => $value) {
            $que->bindValue(':' . $key, $value);
        }
    }
    $que->execute();
    return $pdo->lastInsertId(); //Получение id последней записи
}

function update($sql, $params = []) //Функция изменения данных
{
    $que = query($sql, $params); //Отправка запроса для получения данных
    return $que; //Возвращаем результат операции
}

function delete($sql, $params = []) //Функция удаления данных
{
    $que = query($sql, $params); //Отправка запроса для получения данных
    return $que; //Возвращаем результат операции
}