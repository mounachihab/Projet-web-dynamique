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
if (isset($_POST['ID_event'])) {
// Récupérez l'ID de l'événement depuis le formulaire
    $ID_event = $_POST['ID_event'];

    // Supprimez l'événement de la base de données
    $sql = "DELETE FROM evenements WHERE ID_event = $ID_event";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        echo "Photo supprimée avec succès.";
        // Redirigez l'utilisateur vers la page précédente ou une autre page de votre choix
        header('Location: vous.php');
        exit;
    } else {
        echo "Erreur lors de la suppression de la photo : " . mysqli_error($db_handle);
    }

    // Fermez la connexion à la base de données
    mysqli_close($db_handle);
}  
elseif (isset($_POST['ID_publication'])) {
// Récupérez l'ID de l'événement depuis le formulaire
    $ID_publication = $_POST['ID_publication'];

    // Supprimez l'événement de la base de données
    $sql = "DELETE FROM publications WHERE ID_publication = $ID_publication";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        echo "Photo supprimée avec succès.";
        // Redirigez l'utilisateur vers la page précédente ou une autre page de votre choix
        header('Location: vous.php');
        exit;
    } else {
        echo "Erreur lors de la suppression de la photo : " . mysqli_error($db_handle);
    }

    // Fermez la connexion à la base de données
    mysqli_close($db_handle);
}   
else {
    echo "ID non spécifié.";
}

?>