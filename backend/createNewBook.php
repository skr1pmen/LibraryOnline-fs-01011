<?php
session_start();
require './db.php';
//var_dump($_POST);
//var_dump($_FILES);
$name = $_POST['name'];
$description = $_POST['description'];
$author = $_POST['author'];
$cover = $_FILES['cover'];

if (empty($name)) {
    $_SESSION['error'] = 'Необходимо указать название книги';
    header('location: ../pages/addBook.php');
}
if (empty($description)) {
    $_SESSION['error'] = 'Необходимо указать описание книги';
    header('location: ../pages/addBook.php');
}
if (empty($author)) {
    $_SESSION['error'] = 'Необходимо указать автора книги';
    header('location: ../pages/addBook.php');
}
if (empty($cover)) {
    $_SESSION['error'] = 'Необходимо указать обложку книги';
    header('location: ../pages/addBook.php');
}

$getAuthor = select(
    'SELECT * FROM authors WHERE fio = :fio',
    ['fio' => $author]
);
//var_dump($getAuthor);

if (empty($getAuthor)) { //Проверка существования автора в бд от пользователя
    $author_id = insert( //Запись нового автора с получением его id
        'INSERT INTO authors (fio) VALUES (:fio)',
        ['fio' => $author]
    );
} else { // Если автор уже есть, то получаем его id
    $author_id = $getAuthor[0]['id'];
}

$newBook = insert( // Создание Новой книги и получение её id
    'INSERT INTO books (title, description, author_id) VALUES (:title, :description, :author_id)',
    [
        'title' => $name,
        'description' => $description,
        'author_id' => $author_id
    ]
);

move_uploaded_file($cover['tmp_name'], '../assets/images/covers/' . $newBook . '.jpg'); // Сохранение обложки книги с названием id книги
header('location: ../'); // Переадресация пользователя на главную страницу