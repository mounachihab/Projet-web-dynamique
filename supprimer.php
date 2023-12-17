<?php



// -----------------------------------------------------------------------------------------------

ini_set("display_errors", 1);
// Identifier le nom de base de données
$database = "ece";
// Connectez-vous dans votre BDD
// Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect("localhost", "root", "root");
$db_found = mysqli_select_db($db_handle, $database);


// Vérifiez si la connexion a réussi
if (!$db_handle) {
    die('Connexion échouée : ' . mysqli_connect_error());
}


// Sélectionnez la base de données
if (!$db_found) {
    die('Sélection de base de données échouée : ' . mysqli_error($db_handle));
}


// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id = $_SESSION['id'];

//sinon
// -----------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------
// Suppression du compte de tt les tables de la base de données :


// -----------------------------------------------------------------------------------------------
// Table utilisateurs
$sql_delete = "DELETE FROM utilisateurs WHERE ID = '$id';";
//execution :
if (mysqli_query($db_handle, $sql_delete)) {
    echo "Données supprimées avec succès.";
} else {
    echo "Erreur lors de la suppression des données : " . mysqli_error($db_handle);
}

// -----------------------------------------------------------------------------------------------
// table information
$sql_delete = "DELETE FROM informations WHERE ID = '$id';";
//execution :
if (mysqli_query($db_handle, $sql_delete)) {
    echo "Données supprimées avec succès.";
} else {
    echo "Erreur lors de la suppression des données : " . mysqli_error($db_handle);
}

// -----------------------------------------------------------------------------------------------
// Redirection vers l'inscription
header('Location: inscription.html');
exit();

?>