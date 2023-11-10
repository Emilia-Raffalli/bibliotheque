<?php
include ('header.php');
$title ="Auteurs";



// $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root','');
// var_dump($pdo);

$pdo = connect_db();

$authors = selectAllFrom('authors');
// var_dump($authors);


//------ AUTHOIR DELETE ----- CONDITION -------//

if (isset($_GET['id']))
{

    $id = $_GET['id'];

    $pdo =connect_db();
    deleteRow('authors', 'id_authors', $id);
    // $query = 'DELETE FROM authors WHERE id_author=:id';
    // $statement = $pdo ->prepare($query);
    // $statement ->bindValue(':id', $id , \PDO::PARAM_INT);
    // $statement->execute();
    
    //redirection
    header('location:authors.php?message=success');
    exit();
    
    //UNE CONTRAINTE DE CLE ETRANGERE EMPECHE LA SUPPRESSION DES LIGNES

}




?>

<main class="flex flex-column align-end">
    <a href ="author-create.php"><button class="btn-author">Nouvel auteur</button></a>
    <!-- <a href='author-create.php'><button class='btn-new-author'>Nouvel auteur</button></a></p> -->


    <table><tr><th>Auteurs</th></tr>
    <?php

    foreach ($authors as $author) 
    {
        echo "<tr>
        <td>
        <a href='author-detail.php?id=" . $author['id_authors'] . "'>". $author['firstNameAuthor'] ." ". $author['lastNameAuthor'] . "</a></td>";
        echo "<td class='edit'><a href='authors.php?id=" . $author['id_authors'] . "'</a><button class='btn'>Delete</button></a></td>";

        echo "</tr>";
    }

    ?>
    </table>

</main>