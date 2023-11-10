<?php
include('header.php');
$title = "Delete";

$id = $_GET['id'];

$pdo =connect_db();
deleteRow('authors', 'id_authors', $id);
// $query = 'DELETE FROM authors WHERE id_author=:id';
// $statement = $pdo ->prepare($query);
// $statement ->bindValue(':id', $id , \PDO::PARAM_INT);
// $statement->execute();

//redirection
header('location:authors.php?message=success');
exit();

//UNE CONTRAINTE DE CLE ETRANGERE EMPECHE LA SUPPRESSION DES LIGNES


?>