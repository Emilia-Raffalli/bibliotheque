<?php
include ('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php $title ?> </title>
    <link rel="stylesheet" href ="styles.css">
</head>
<body>

<header class="flex flex-column">
        <nav class = "flex space-between align-center">
            <a href ="index.php"><img src ="img/logo-mylibrary.svg" width="150px"></a>

            <div>
                <a href ="books.php">Livres</a>
                <a href ="authors.php">Auteurs</a>
                <a href ="users.php">Utilisateurs</a>
                <a href ="categories.php">Categories</a> 
            </div>
            <a href ="create-book.php"><button class="btn">Ajouter un livre</button></a>
        </nav>

        <form action="search.php" method="POST" class="flex justify-center">
            <div>
                <label for="bookTitle"></label>
                <input type="text" name="bookTitle" id="bookTitle" placeholder ="Titre du livre">
            </div>
            <div>
                <button class="btn" type="submit">Rechercher</button>
            </div>
        </form>

</header>