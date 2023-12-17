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

if (isset($_FILES['lienCV']) && $_FILES['lienCV']['error'] == UPLOAD_ERR_OK) {
   


    // Gestion de l'upload de la photo
        $target_dir = __DIR__ . "/";
        $target_file = $target_dir . basename($_FILES["lienCV"]["name"]);
        $filename = basename($_FILES["lienCV"]["name"]); // Obtenez le nom du fichier

        // Modifier le chemin pour enregistrer seulement le nom du fichier
        $target_file = $target_dir . $filename;

        move_uploaded_file($_FILES["lienCV"]["tmp_name"], $target_file);

  
        
        $sql = "INSERT INTO cv (ID, lienCV) VALUES ('$id', '$filename')";
        $result = mysqli_query($db_handle, $sql);

        if ($result) {
            echo "CV ajouté avec succès.";
                    header('Location: vous.php');

        } else {
            echo "Erreur lors de l'ajout du CV à la base de données : " . mysqli_error($db_handle);
        }
    } else {
        echo "Erreur lors du déplacement du fichier vers le dossier de destination.";
    }


?>

