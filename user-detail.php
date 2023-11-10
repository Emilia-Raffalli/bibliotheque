<?php
include('header.php');
$title = "Détails";

// var_dump($_GET);

// echo $_GET['id'];


if (isset($_GET['id']))
{
    $id = $_GET['id'];
}

var_dump(selectFromId('subscribers', 'id_sub', $id));

$userDetails = selectFromId('subscribers', 'id_sub', $id);


if (!empty($userDetails))
{
    echo "<table><tr><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>email</th><th>Téléphone</th><th>adresse</th><th>Date d'inscription</th></tr>";
    echo "<tr>";
    echo "<td>" . $userDetails['lastNameSub'] . "</td>";
    echo "<td>" . $userDetails['firstNameSub'] . "</td>";
    echo "<td>" . $userDetails['birthDateSub'] . "</td>";
    echo "<td>" . $userDetails['emailSub'] . "</td>";
    echo "<td>" . $userDetails['phoneNumberSub'] . "</td>";
    echo "<td>" . $userDetails['adStreetSub'] . "<br>" . $userDetails['citySub'] ." " . "</td>";
    echo "<td>" . $userDetails['dateSub'] . "</td>";
    echo"</tr>";
    echo "</table>";
}

else {
    echo "Aucun livre ici.";
}


?>