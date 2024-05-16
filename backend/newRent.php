<?php
session_start();
require "./db.php";

if (empty($_SESSION['user'])) {
    header("location: ../pages/auth.php");
    return false;
}

$book = select("SELECT id FROM books WHERE id = :id", ["id" => $_GET["id"]]);

if (empty($book)) {
    echo "
        <h2>Не удалось найти книгу!</h2>
        <a href='../'>Назад</a>
        ";
    return false;
}

$id = insert(
    'INSERT INTO rent_books (user_id, book_id) VALUES (:user_id, :book_id)',
    [
        'user_id' => $_SESSION['user']['id'],
        'book_id' => $_GET['id']
    ]
);

header("location: ../pages/profile.php");