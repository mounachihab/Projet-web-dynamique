<?php

// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id =  $_SESSION['id'];


//info pour la connection
$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'ece';
$db_port = 8889;

// on se connecte
$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);

// -----------------------------------------------------------------------------------------------
// verification d'ouverture
if ($mysqli->connect_error) { //si c'est pas le cas :
    echo 'Errno : ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error : ' . $mysqli->connect_error;
    exit();
}

// -----------------------------------------------------------------------------------------------
//sinon
echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $mysqli->host_info;
echo '<br>';
echo 'Protocol version: ' . $mysqli->protocol_version;

// -----------------------------------------------------------------------------------------------
// Récupérer les données du formulaire
$new_email = isset($_POST["email"]) ? $mysqli->real_escape_string($_POST["email"]) : "";

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {
    // Requête pour changer le mail à l'aide de l'ID
    $sql = "UPDATE utilisateurs SET email = '$new_email' WHERE ID = '$id'";

    // -----------------------------------------------------------------------------------------------
    if ($mysqli->query($sql) === TRUE) {
        echo "Données ajoutées avec succès";
        // Redirection vers la page d'accueil
        header('Location: reglages.php');
        exit();
    } else {
        header('Location: reglages.php');
        echo "Erreur lors de l'ajout des données : " . $mysqli->error;
    }

    $mysqli->close();
}

?>