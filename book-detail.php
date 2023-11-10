<?php
include ('header.php');
$title = "Détails";

// var_dump($_GET);

// echo $_GET['id'];


if (isset($_GET['id']))
{
    $id = $_GET['id'];
}
echo $id;

// 1 | CETTE REQUETE EST PROSCRITE CAR ELLE DONNE ACCES A L'URL A L'UTILISATEUR -> utiliser $pdo->prepare($query) et non $pdo->query($query)

// $query = " SELECT * FROM  books WHERE id_book = $id " ;
// $statement = $pdo->query($query);
// $array = $statement -> fetch(PDO::FETCH_ASSOC);


// 2 | UTILISER CELLE CI :
    // $query = ("SELECT * FROM books WHERE id_book = :id");
    // $statement = $pdo->prepare($query);
    // $statement->bindValue(':id', $id, PDO::PARAM_INT);
    // $statement ->execute();
    // $bookDetails = $statement->fetch(PDO::FETCH_ASSOC); //fetchAll affiche tous les array | fetch n'affiche que le premier tableau
    // var_dump($bookDetails);


$pdo = connect_db();

$query = ("SELECT books.*, authors.firstNameAuthor, authors.lastNameAuthor, categories.bookType, countries.country 
FROM books 
LEFT JOIN authors ON books.author_id=authors.id_authors 
LEFT JOIN categories ON books.category_id = categories.id_category 
LEFT JOIN countries ON authors.country_id= countries.id_country
WHERE id_book =:id");
$statement = $pdo -> prepare($query);
$statement ->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$bookDetails = $statement -> fetch(PDO::FETCH_ASSOC);

// var_dump($bookDetails);





if (!empty($bookDetails))

{   echo "<table><tr><th>Titre du livre</th><th>Résumé</th><th>Prix</th><th>Auteur</th><th>Genre littéraire</th></tr>";
    echo "<tr><td> ".$bookDetails['bookTitle'] . "</td><br>";
    echo "<td>" . $bookDetails['summary'] . "</td><br>";
    echo "<td>" .$bookDetails['price']. " €</td><br>";
    echo "<td>" .$bookDetails['lastNameAuthor'] . " " . $bookDetails['firstNameAuthor']. "</td>";
    echo "<td>" .$bookDetails['bookType']."</td>";


    echo "</table>";
}

else {
    echo "Aucun livre ici.";
}





?>