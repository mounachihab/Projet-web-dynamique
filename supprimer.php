<?php
// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id = $_SESSION['id'];


// -----------------------------------------------------------------------------------------------
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

// verification d'ouverture
if ($mysqli->connect_error) { //si c'est pas le cas :
    echo 'Errno : ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error : ' . $mysqli->connect_error;
    exit();
}

//sinon
// -----------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------
// Suppression du compte de tt les tables de la base de données :


// -----------------------------------------------------------------------------------------------
// Table utilisateurs
$sql_delete = "DELETE FROM utilisateurs WHERE ID = '$id';";
//execution :
if (mysqli_query($mysqli, $sql_delete)) {
    echo "Données supprimées avec succès.";
} else {
    echo "Erreur lors de la suppression des données : " . mysqli_error($mysqli);
}

// -----------------------------------------------------------------------------------------------
// table information
$sql_delete = "DELETE FROM informations WHERE ID = '$id';";
//execution :
if (mysqli_query($mysqli, $sql_delete)) {
    echo "Données supprimées avec succès.";
} else {
    echo "Erreur lors de la suppression des données : " . mysqli_error($mysqli);
}

// -----------------------------------------------------------------------------------------------
// Redirection vers l'inscription
header('Location: inscription.html');
exit();

?>