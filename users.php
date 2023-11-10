<?php
include ('header.php');
$title = "Utilisateurs";



// $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root', '');
$pdo = connect_db();

$users = selectAllFrom('subscribers');

// var_dump($users);
?>

<main>
<?php
echo "<table><tr><th>Nom/Prénom</th><th>Numéro de téphone</th><th>Date de naissance</th></tr>";

foreach($users as $user)
{
    echo "<td><a href='user-detail.php?id=" . $user['id_sub'] . "'>" . $user['lastNameSub'] ." ". $user['firstNameSub'] ."</a></td>";
    echo "<td>" . $user['phoneNumberSub'] . "</td>
          <td>" . $user['birthDateSub'] . "</td>
          <td><a href ='user-delete.php?id=" . $user['id_sub'] . "'><button type='submit' class='btn'>Delete</button></td>";
    echo "</tr>";
}
    echo "</table>";
?>

</main>
