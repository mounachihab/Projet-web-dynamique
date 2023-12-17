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
// récupérer les données pour les afficher
$sql = "SELECT * FROM utilisateurs WHERE ID=$id";
$result = mysqli_query($db_handle, $sql);

// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result) {
    echo "Erreur lors de l'exécution de la requête utilisateurs : " . mysqli_error($db_handle);
    exit;
}

// Ajout de formation si le formulaire est soumis
if (isset($_POST['projet_form_submit'])) {
    $Lieu = mysqli_real_escape_string($db_handle, $_POST['Lieu']);
    $competence = mysqli_real_escape_string($db_handle, $_POST['competence']);
    $domaine = mysqli_real_escape_string($db_handle, $_POST['domaine']);
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];

    // Exemple d'insertion dans la base de données
    $sql = "INSERT INTO projets (ID, Lieu, competence, domaine, dateDebut, dateFin) VALUES ('$id', '$Lieu', '$competence', '$domaine', '$dateDebut', '$dateFin')";
    $result = mysqli_query($db_handle, $sql);

    // Affichage des messages et redirection
    if ($result) {
        echo "Porjet ajoutée avec succès.";
        header('Location: vous.php');
        exit();
    } else {
        echo "Erreur lors de l'ajout du projet : " . mysqli_error($db_handle);
        echo "Requête SQL : " . $sql;
    }
}
?>
