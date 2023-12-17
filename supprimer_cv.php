<?php
error_reporting(E_ALL);

ini_set("display_errors", 1);
session_start(); // Démarre la session

// Identifier le nom de base de données
$database = "ece";
// Connectez-vous dans votre BDD
// Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect("localhost", "root", "root");
$db_found = mysqli_select_db($db_handle, $database);

// Vérifiez la connexion à la base de données
if (!$db_found) {
    echo "Database not found";
    // Fermer la connexion
    mysqli_close($db_handle);
    exit;
}
// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$id = $_SESSION['id'];
$photo = $_SESSION['photo'];
// recuperer les donners pour les afficher :
$resultat = mysqli_query($db_handle,"SELECT COUNT(ID) FROM utilisateurs"); //elise doit remplacer db_handle par mysqli
$data = mysqli_fetch_assoc($resultat);
$nbr_membres = $data['COUNT(ID)'] ;

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

if (isset($_POST['ID_CV'])) {
    $ID_CV = $_POST['ID_CV'];

    $sql = "DELETE FROM cv WHERE ID_CV = $ID_CV ";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        echo "CV supprimé avec succès.";
                header('Location: vous.php');

    } else {
        echo "Erreur lors de la suppression du CV : " . mysqli_error($db_handle);
    }
} else {
    echo "ID du CV non spécifié.";
}
?>

