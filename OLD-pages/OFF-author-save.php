<?php
include('header.php');
// var_dump($_POST);

if((isset($_POST)) && (!empty($_POST)))
{
    $firstNameAuthor = trim($_POST['firstNameAuthor']);
    $lastNameAuthor = trim($_POST['lastNameAuthor']);

    $country = trim($_POST['country']);
    //$idCountry = trim($_POST['id_country']);
   

var_dump($_POST);

$pdo = connect_db();

$query = ("INSERT INTO authors (firstNameAuthor, lastNameAuthor, country_id) VALUES (:firstNameAuthor , :lastNameAuthor, :country_id)");
$statement = $pdo -> prepare ($query);
$statement->bindValue(':firstNameAuthor', $firstNameAuthor , PDO::PARAM_STR);
$statement->bindValue(':lastNameAuthor', $lastNameAuthor , PDO::PARAM_STR);
$statement->bindValue(':country_id', $country , PDO::PARAM_INT);

$statement->execute();


header('location:authors.php');


} elseif (empty($firstname) || empty($lastname)) {
    echo "Veuillez renseigner tous les champs";
}



?>
