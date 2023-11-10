<?php
include('header.php');
$title = "Delete";
$pdo = connect_db();

$id = $_GET['id'];

deleteRow('subscribers', 'id_sub', $id);

header('location:users.php?message=success');
exit();

?>