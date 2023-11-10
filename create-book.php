<?php
include('header.php');

//J'ai besoin de requêtes à ma base de données pour pouvoir créer un livre, au moment de la selection de la catégorie et du pays de l'auteur.
$pdo = connect_db();

//Je ne reprends pas la même fonction de requête car je souhaite ici ajouter un affichage par ordre alphabétique dans mon select
$tableCategories = selectAllOrderByName('categories', 'bookType');
// var_dump($tableCategories);

$tableAuthors = selectAllOrderByName('authors', 'lastNameAuthor');
// var_dump($tableAuthors);



//----------------inclusion du code sur la même page ----------------------//


//Si l'utilisateur à cliqué sur le bouton du formulaire
if((isset($_POST)) && (!empty($_POST)))
{
    $bookTitle = trim($_POST['bookTitle']);
    $summary = trim($_POST['summary']);
    $price = trim($_POST['price']);
    $idAuthor = trim($_POST['author']);
    $idCategory = trim($_POST['category']);

    //on lance la requête d'insertion:
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

//-----------------------------

?>


<main>
<form class="create flex flex-column" action ="create-book.php" method="POST">
    <label for ="bookTitle">
        <p class="label">Titre du livre</p>
    </label>
    <input type="text" id="bookTitle" name="bookTitle">


    <label for ="author"></label></label>
    <select id="author" name="author">
        <option value="" selected disabled hidden>Auteur</option>

        <?php
        if (isset($tableAuthors))
        {
            foreach($tableAuthors as $author)
            {
                echo "<option value=" . $author['id_authors'] . " > " .$author['lastNameAuthor'] . " " . $author['firstNameAuthor'] .  "</option>";
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
    <textarea type="text" id="summary" name="summary"></textarea>

    <label for ="category"></label></label>
    <select id="category" name="category">
        <option value="" selected disabled hidden>Genre littéraire</option>

        <?php
        if (isset($tableCategories))
        {
            foreach($tableCategories as $category)
            {
                echo "<option value=" . $category['id_category'] . " > " .$category['bookType'] . "</option>";
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
    <input type="text" id="price" name="price">

    <button class='btn' type ="submit">Sauvegarder</button>


</form>
</main>





