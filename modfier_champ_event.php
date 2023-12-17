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
// Récupérer les données du formulaire
$champ = $_POST['champ'];
$ID_event = $_POST['ID_event'];
$nouvelle_valeur = mysqli_real_escape_string($db_handle, $_POST['nouvelle_valeur']);

// Effectuer la mise à jour dans la base de données
$sql = "UPDATE evenements SET $champ = '$nouvelle_valeur' WHERE ID_event = $ID_event";
mysqli_query($db_handle, $sql);

// Rediriger vers la page d'origine 
header('Location: vous.php');
exit;
?>
