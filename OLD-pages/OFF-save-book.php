<?php
include('header.php');
// var_dump($_POST);


var_dump($_POST['author']);

//Si l'utilisateur à cliqué sur le bouton du formulaire
if((isset($_POST)) && (!empty($_POST)))
{
    $bookTitle = trim($_POST['bookTitle']);
    $summary = trim($_POST['summary']);
    $price = trim($_POST['price']);
    $idAuthor = trim($_POST['author']);
    
    $idCategory = trim($_POST['category']);


    // insertBook($table, $bookTitle , $summary ,$price)
    $pdo = connect_db();

    $query = ("INSERT INTO books( bookTitle , summary , price, author_id, category_id ) VALUES (:bookTitle , :summary, :price, :author_id, :category_id)");
    $statement = $pdo -> prepare ($query);
    $statement->bindValue(':bookTitle', $bookTitle, PDO::PARAM_STR);
    $statement->bindValue(':summary', $summary, PDO::PARAM_STR);
    $statement->bindValue(':price', $price, PDO::PARAM_STR);
    $statement ->bindValue(':author_id', $idAuthor, PDO::PARAM_INT);
    $statement ->bindValue(':category_id', $idCategory, PDO::PARAM_INT);
    $statement->execute();

    // to retrieve the last inserted id :
    $lastInsertId = $pdo->lastInsertId();

    echo "voici le dernier id généré :" . $lastInsertId ;

    $query = ("INSERT INTO books_categories (book_id, category_id) VALUES (:book_id , :category_id)");
    $statement = $pdo -> prepare($query);
    $statement->bindValue(':category_id' , $idCategory, PDO::PARAM_INT);
    $statement->bindValue(':book_id' , $lastInsertId, PDO::PARAM_INT);

    $statement-> execute();

    header('location:books.php');




} elseif (empty($bookTitle) || empty($summary) || empty($price)|| empty($idAuthor)|| empty($idCategory)) {
    echo "Veuillez renseigner tous les champs";
}



?>