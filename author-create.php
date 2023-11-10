<?php
include('header.php');
$title = "Créer un auteur";

$pdo = connect_db();
//Je ne reprends pas la même fonction de requête car je souhaite ici ajouter un affichage par ordre alphabétique

$tableCountries = selectAllOrderByName('countries', 'country');
$tableAuthors = selectAllFrom('authors');
// var_dump($tableAuthors);


// ------ SCRIPT CREATE AUTHOR --------- //


if ((isset($_POST)) && (!empty($_POST))) {
    $firstNameAuthor = trim($_POST['firstNameAuthor']);
    $lastNameAuthor = trim($_POST['lastNameAuthor']);
    $country = trim($_POST['country']);
    //$idCountry = trim($_POST['id_country']);

    // var_dump($_POST['firstNameAuthor']);
    // die();

    $pdo = connect_db();

    $query = ("INSERT INTO authors (firstNameAuthor, lastNameAuthor, country_id) VALUES (:firstNameAuthor , :lastNameAuthor, :country_id)");
    $statement = $pdo -> prepare ($query);
    $statement->bindValue(':firstNameAuthor', $firstNameAuthor , PDO::PARAM_STR);
    $statement->bindValue(':lastNameAuthor', $lastNameAuthor , PDO::PARAM_STR);
    $statement->bindValue(':country_id', $country , PDO::PARAM_INT);
    $statement->execute();

    // header('location:authors.php');


} elseif (empty($firstname) || empty($lastname)) {
    echo "Veuillez renseigner tous les champs";
}


//-------- FIN DU SCRIPT --------


?>


<main>
<form class="create flex flex-column" action ="author-create.php" method="POST">
   
    <p class="label">Auteur</p>
    <div>
        <label for ="firstNameAuthor"></label>
        <input type="text" id="firstNameAuthor" name="firstNameAuthor" placeholder ="Prénom de l'auteur">
        <label for ="lastNameAuthor"></label>
        <input type="text" id="lastNameAuthor" name="lastNameAuthor" placeholder ="Nom de l'auteur">
    
        <!-- Liste déroulante avec les pays  -->
        <label for ="country"></label></label>
        <select id="country" name="country">
            <option value="" selected disabled hidden>Pays de l'auteur</option>

            <?php
            if (isset($tableCountries))
            {
                foreach($tableCountries as $country)
                {
                    echo "<option value=".$country['id_country']."> " .$country['country'] . "</option>";
                }
            }
            else {
                echo "Erreur";
            }
            ?>
        </select>
    </div>

    <button class='btn' type ="submit">Sauvegarder</button>


</form>
</main>