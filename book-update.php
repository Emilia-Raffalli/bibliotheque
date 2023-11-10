<?php
include('header.php');
//J'ai besoin de requêtes à ma base de données pour pouvoir créer un livre, au moment de la selection de la catégorie et du pays de l'auteur.
$pdo = connect_db();
//Je ne reprends pas la même fonction de requête car je souhaite ici ajouter un affichage par ordre alphabétique dans mon select
$tableCategories = selectAllOrderByName('categories', 'bookType');
// var_dump($tableCategories);
$tableAuthors = selectAllOrderByName('authors', 'lastNameAuthor');
// var_dump($tableAuthors);

// JE récupère les informations par l'id du livre selectionné
// var_dump($_GET);
$id = $_GET['id'];

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

if (isset($bookDetails) && !empty($bookDetails)) {
    $idBook = $bookDetails['id_book'];
    $bookTitle = $bookDetails['bookTitle'];
    $summary = $bookDetails['summary'];
    $price = $bookDetails['price'];
    $category = $bookDetails['bookType'];
    $idCategory = $bookDetails['category_id'];
    $releaseDate = $bookDetails['releaseDate'];
    $firstNameAuthor = $bookDetails['firstNameAuthor'];
    $lastNameAuthor = $bookDetails['lastNameAuthor'];
    $idAuthor = $bookDetails['author_id'];
    // $country = $bookDetails['country'];

}


//------ SCRIPT UPDATE SUR LA MEME PAGE ---------------//


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

        //J'effectue la mise à jour du livre (en fonction de son id) 
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
    




?>

<main>
<form class="create flex flex-column" action ="book-update.php?id=<?=$idBook?>" method="POST">
    <label for ="bookTitle">
        <p class="label">Titre du livre</p>
    </label>
    <input type="text" id="bookTitle" name="bookTitle" value ="<?=$bookTitle?>">


    <label for ="author">Auteur</label>
    <select id="author" name="author">
        <option value="<?=$idAuthor?>" selected> <?=$firstNameAuthor . " " .$lastNameAuthor?> </option>

        <?php
        if (isset($tableAuthors))
        {
            foreach($tableAuthors as $author)
            {
                echo "<option value='" . $idAuthor . "' > " .$author['lastNameAuthor'] . " " . $author['firstNameAuthor'] .  "</option>";
            }
        }
        else {
            echo "Erreur";
        }
        ?>
    </select>

    <label for ="summary">
        <p class="label">Description</p>
    </label>
    <textarea type="text" id="summary" name="summary" placeholder = "">
    <?=$summary?>
    </textarea>

    <label for ="category"></label>Genre littéraire</label>
    <select id="category" name="category">
        <option value="<?=$idCategory?>" selected><?=$category?></option>

        <?php
        if (isset($tableCategories))
        {
            foreach($tableCategories as $category)
            {
                echo "<option value='" . $idCategory . "' > " .$category['bookType'] . "</option>";
            }
        }
        else {
            echo "Erreur";
        }
        ?>
    </select>

    <label for ="price">
        <p class="label">Prix</p>
    </label>
    <input type="text" id="price" name="price" value="<?=$price?>">

    <button class='btn' type ="submit">Modifier</button>


</form>
</main>





