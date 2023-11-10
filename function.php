<?php

//CREATION DE FONCTIONS :

// Fonction pour se connecter à la base de données, qui remplacera la ligne de code classique que l'on a reportée les pages 

function connect_db()
{
    require_once ('_connect.php');
    $pdo = new \PDO(DSN,USER, PASS);
    return $pdo;
}


function selectAllFrom($table) : array
{
    $pdo = connect_db();
    $query = "SELECT * FROM  $table " ;
    $statement = $pdo->query($query);
    $array = $statement -> fetchAll(PDO::FETCH_ASSOC);
    return $array;
}


//function to retrieve all the data order by name

function selectAllOrderByName($table, $column)
{
    $pdo = connect_db();
    $query = "SELECT * from $table ORDER BY $column";
    $statement = $pdo ->query($query);
    $array = $statement -> fetchAll(PDO::FETCH_ASSOC);
    return $array;
}







//fonction pour récupérer des données SQL depuis l'id de l'url


function selectFromId(string $table, string $idName, $id): array
{
    $pdo = connect_db();
    $query = ("SELECT * FROM $table WHERE $idName = :id");
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement ->execute();
    $array = $statement->fetch(PDO::FETCH_ASSOC); //fetchAll affiche tous les array | fetch n'affiche que le premier tableau
    return $array;
}



function deleteRow(string $table, string $idName, $id)
{
    $pdo = connect_db();
    $query = ("DELETE FROM $table WHERE $idName = :id");
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement ->execute();

}



function insertBook($table, $bookTitle , $summary ,$price)
{

    $pdo = connect_db();
    $query = ("INSERT INTO books( bookTitle , summary , price ) VALUES (:bookTitle , :summary, :price)");
    $statement = $pdo ->prepare($query);
    $statement->bindValue(':bookTitle', $bookTitle, PDO::PARAM_STR);
    $statement->bindValue(':summary', $summary, PDO::PARAM_STR);
    $statement->bindValue(':price', $price, PDO::PARAM_STR);
    $newBook = $statement->execute();
    return $newBook;

}







// $query = 'DELETE FROM books WHERE id_book=:id';
// $statement = $pdo ->prepare($query);
// $statement ->bindValue(':id', $id , \PDO::PARAM_INT);
// $statement->execute();







//EXERCICES 


// 1. crééz une fonction qui affiche hello
// 2. crééz une fonction qui retourne un age
// 3. crééz une fonction qui affiche hello suivi du prénom en parametre de la fonction.
// 4. crééz une fonction qui permet de recuperer les données des tables book , author et user



function printHello($firstName) 
{
    return "Hello " . $firstName . " !<br>";
}

function age($birthDate) 
{
    if ($birthDate < 2023 && $birthDate > 1900 ) {
        $age = 2023 - $birthDate;
        return "Vous avez " . $age . " ans.";
    } 
    else {
        "Votre date de naissance n'est pas valide.";
    }
}





?>