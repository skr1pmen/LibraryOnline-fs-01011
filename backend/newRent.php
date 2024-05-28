<?php
session_start();
require "./db.php";

if (empty($_SESSION['user'])) {
    header("location: ../pages/auth.php");
    return false;
}
$bookId = $_GET["id"];
$userId = $_SESSION['user']['id'];
$book = select("SELECT id FROM books WHERE id = :id", ["id" => $bookId]);

if (empty($book)) {
    echo "
        <h2>Не удалось найти книгу!</h2>
        <a href='../'>Назад</a>
        ";
    return false;
}

$rentBooks = select('
        SELECT id FROM rent_books
        WHERE book_id = :book_id AND user_id = :user_id
    ',
    ['book_id' => $bookId, 'user_id' => $userId]
);
if (!empty($rentBooks)) {
    echo "
        <h2>Книга уже арендована вами!</h2>
        <a href='../'>Назад</a>
        ";
    return false;
}

$id = insert(
    'INSERT INTO rent_books (user_id, book_id) VALUES (:user_id, :book_id)',
    [
        'user_id' => $userId,
        'book_id' => $bookId
    ]
);

header("location: ../pages/profile.php");