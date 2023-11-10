<?php
include ('header.php');
$title = "Catégories";



// $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root', '');
 
$pdo = connect_db();

$categories = selectAllFrom('categories');
?>
 
<main>

<?php 

echo "<table><tr>><th>Catégorie</th></tr>";

foreach ($categories as $category)
{
    echo "<tr><td>" . $category['bookType'] . "</td></tr>";
    }

    echo "</table>";
?>
</main>



