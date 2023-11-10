<?php
include ('header.php');
$title ="Détails";

$pdo = connect_db();

// var_dump($_GET['id']);
// echo $_GET['id'];


if (isset($_GET['id']))
{
    $id =$_GET['id'];
}


// $authorDetails = selectFromId('authors', 'id_authors', $id);

$query = "SELECT authors.*, countries.country FROM authors LEFT JOIN countries ON authors.country_id = countries.id_country WHERE id_authors = :id";
$statement = $pdo ->prepare($query);
$statement -> bindValue(':id', $id, PDO::PARAM_INT);
$statement -> execute();

$authorDetails = $statement -> fetch(PDO::FETCH_ASSOC);

// var_dump($authorDetails);

if (!empty($authorDetails))

{   echo "<table><tr><th>Auteur</th><th>Pays</th></tr>";
    echo "<tr><td> ".$authorDetails['firstNameAuthor'] . " " . $authorDetails['lastNameAuthor'] . "</td>";
    echo "<td>" .$authorDetails['country']. "</td></tr>";
    echo "</table>";
}

else {
    echo "Aucun livre ici.";
}





?>