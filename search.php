<?php
include('header.php');

// Je m'assure que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Je récupère le titre du livre depuis le formulaire
    $bookTitle = $_POST['bookTitle'];

    // J'affiche le titre du livre
    echo "Résultats de la recherche : " . $bookTitle;

    // Je me connecte à la base de données
    $pdo = connect_db();

    // Je prépare et exécute la requête SQL
    $query = "SELECT * FROM books WHERE bookTitle LIKE :bookTitle";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':bookTitle', '%' . $bookTitle . '%', PDO::PARAM_STR);
    $statement->execute();

    // Je récupère les résultats de la requête
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // J'affiche les résultats
    var_dump($results);
} else {
    // Si le formulaire n'a pas été soumis, afficher un message ou rediriger l'utilisateur
    echo "Le formulaire n'a pas été soumis.";
}
?>




