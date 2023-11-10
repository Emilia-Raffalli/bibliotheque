<?php
include ('header.php');
$title = "Livres";

//CONNEXION A LA BASE DE DEONNEES AVEC PDO
// $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root','');// appel à la base de données classique
//plus simple, en faisant appel à la function créée dans function.php (qui est include dans le header)

$pdo = connect_db();


$query = ("SELECT books.*, authors.firstNameAuthor, authors.lastNameAuthor, categories.bookType, countries.country 
FROM books LEFT JOIN authors ON books.author_id=authors.id_authors LEFT JOIN categories ON books.category_id = categories.id_category 
LEFT JOIN countries ON authors.country_id= countries.id_country");
$statement = $pdo -> query($query);
$tableBooks = $statement -> fetchAll(PDO::FETCH_ASSOC);

// var_dump($tableBooks);

//SI IL Y A UN ID DANS L'URL ALORS JE FAIS MA REQUETE POUR SUPPRIMER (D'ABORD LES CONTRAINTES DE CLES ETRANGERES, ENSUITE LE LIVRE EN QUESTION)
if (isset($_GET['id']))
{
     $id = $_GET['id'];

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

}


?>
<main>

<h3>Liste des livres</h3>


<?php
    if (isset($tableBooks))
    {
        echo "<table><tr><th>Titre du livre</th><th>Prix</th><th>Auteurs</th></tr>";

    foreach ($tableBooks as $book) 
    {
        echo "<tr>";
        echo "<td><a href='book-detail.php?id=" . $book['id_book'] . "'</a>" . $book['bookTitle'] . "</td><td>" . $book['price'] . " €</td>";
        echo "<td>" .$book['lastNameAuthor'] . " " . $book['firstNameAuthor']. "</td>";
        echo "<td class='edit'><a  href='books.php?id=" . $book['id_book'] . "'><img class='picto' src ='img/icons8-poubelle.svg' width='25px'></a>
        <a href='book-update.php?id=" . $book['id_book'] . "'><img class='picto' src ='img/icons8-modifier.svg' width='25px'></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    }

    else {
        echo "Aucun livre ici.";
    }
    
// phpinfo();

?>



</main>
