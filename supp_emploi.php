<?php

// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id =  $_SESSION['id'];


// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ece";

$mysqli = new mysqli($servername, $username, $password, $dbname);



//Requete pour supprimer un emploi lorsque le bouton "supprimer l'emploi" est appuyé
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer"])) {
    $emploi_id = $mysqli->real_escape_string($_POST["emploi_id"]);

    // Requête pour supprimer l'emploi
    $sql = "DELETE FROM emplois WHERE ID_emplois = $emploi_id";

    // Exécution de la requête
    if ($mysqli->query($sql) === TRUE) {
        header('Location: emplois.php');
    } else {
        echo "Erreur" . $mysqli->error;
    }

    $mysqli->close();
    exit();
}
?>
