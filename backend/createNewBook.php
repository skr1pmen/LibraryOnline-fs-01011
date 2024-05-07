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
var_dump($getAuthor);