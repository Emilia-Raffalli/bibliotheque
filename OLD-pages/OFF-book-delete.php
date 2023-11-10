<?php
include ('header.php');
$title = "Delete";

$id = $_GET['id'];

$pdo = connect_db();


deleteRow('books_categories', 'book_id', $id);
deleteRow('books_categories', 'category_id', $id);
deleteRow('books', 'id_book', $id);
// $query = 'DELETE FROM books WHERE id_book=:id';
// $statement = $pdo ->prepare($query);
// $statement ->bindValue(':id', $id , \PDO::PARAM_INT);
// $statement->execute();

//redirection
header('location:books.php?message=success');
exit();



?>