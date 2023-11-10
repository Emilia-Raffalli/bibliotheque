<?php
include ('header.php');

$pdo = connect_db();


// var_dump($_POST);

if (isset($_POST) && !empty($_POST)) {
//Je récupère les id des tables à modifier et créé les variables

    $idgetBook = $_GET['id'];
    
    $idCategory = $_POST['category'];
    $idAuthor = $_POST['author'];

    $bookTitle = $_POST['bookTitle'];
    $summary = $_POST['summary'];
    $price = $_POST['price'];


    // Je fais une requête à ma base de données pour vérifier les informations du livre de ma base de données qui y sont présentes, avec l'id récupéré dans l'url:
    $query = ("SELECT books.*, authors.firstNameAuthor, authors.lastNameAuthor, categories.bookType, countries.country 
    FROM books 
    LEFT JOIN authors ON books.author_id=authors.id_authors 
    LEFT JOIN categories ON books.category_id = categories.id_category 
    LEFT JOIN countries ON authors.country_id= countries.id_country
    WHERE id_book =:id");
    $statement = $pdo -> prepare($query);
    $statement ->bindValue(':id', $idgetBook, PDO::PARAM_INT);
    $statement->execute();
    $bookDatabase = $statement -> fetch(PDO::FETCH_ASSOC);
    // var_dump($bookDatabase);


    //Je créé une condition : si les informations récupérées dans "POST" sont différentes de celles du livre $bookDatabse, je mets à jour par une requête UPDATE sql préparée :
    if (
        $bookTitle != $bookDatabase['bookTitle'] ||
        $idAuthor != $bookDatabase['author_id'] ||
        $summary != $bookDatabase['summary'] ||
        $idCategory != $bookDatabase['category_id'] ||
        $price != $bookDatabase['price']
    )
    {

    $query = ("UPDATE books 
                SET     bookTitle = :bookTitle,
                        author_id = :idAuthor,
                        summary = :summary,
                        category_id = :idCategory,
                        price = :price
                WHERE id_book= :id_book ;");
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id_book', $idgetBook, PDO::PARAM_INT);
    $statement ->bindValue(':bookTitle' , $bookTitle, PDO::PARAM_STR);
    $statement ->bindValue(':idAuthor', $idAuthor, PDO::PARAM_INT);
    $statement ->bindValue (':summary', $summary, PDO::PARAM_STR);
    $statement ->bindValue (':idCategory', $idCategory, PDO::PARAM_INT);
    $statement ->bindValue (':price', $price);
    $statement ->execute();
    // $newBook = $statement -> fetch(PDO::FETCH_ASSOC);

    header('location:books.php');

}

else {
    echo "<p>Les données saisies sont identiques.</p>";
}

}

else 
{
    echo "Veuillez renseigner les champs.";

}


?>