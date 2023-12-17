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

//pr les utilisateurs
$sql="SELECT * FROM utilisateurs WHERE ID=$id";
$result = mysqli_query($db_handle, $sql);
// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result) {
    echo "Erreur lors de l'exécution de la requête utilisateurs : " . mysqli_error($db_handle);
    exit;
}

if (isset($_POST['evenements_form_submit'])) {
    $type_event = mysqli_real_escape_string($db_handle, $_POST['type_event']);
    $lieu_event = mysqli_real_escape_string($db_handle, $_POST['lieu_event']);
    $commentaire_event = mysqli_real_escape_string($db_handle, $_POST['commentaire_event']);
    $date_event = isset($_POST['date_event']) ? $_POST['date_event'] : null;
    $ID_createur = $_SESSION['id'];
    $etat_event = $_POST['etat_event'];
    var_dump($etat_event); 


    // Validation : Vérifier si la date et le commentaire sont saisis
if (empty($date_event) ) {
    echo "Veuillez saisir la date ";
    exit; // Arrêter l'exécution du script si la validation échoue
}

if (empty($commentaire_event) ) {
    echo "Veuillez saisir un commentaire ";
    exit; // Arrêter l'exécution du script si la validation échoue
}



    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['photo_event']) && $_FILES['photo_event']['error'] == UPLOAD_ERR_OK) {
        // Gestion de l'upload de la photo
        // Gestion de l'upload de la photo
        $target_dir = __DIR__ . "/";
        $target_file = $target_dir . basename($_FILES["photo_event"]["name"]);
        $filename = basename($_FILES["photo_event"]["name"]); // Obtenez le nom du fichier

        // Modifier le chemin pour enregistrer seulement le nom du fichier
        $target_file = $target_dir . $filename;

        move_uploaded_file($_FILES["photo_event"]["tmp_name"], $target_file);

                
    } else {
        $target_file = null; 

    }

// Ajouter l'événement à la table
    $sql = "INSERT INTO evenements (type_event, lieu_event, commentaire_event, photo_event, date_event, heure_irl_event, date_irl_event, etat_event, ID_createur) VALUES ('$type_event', '$lieu_event', '$commentaire_event', '$filename', '$date_event', CURRENT_TIME(), CURRENT_DATE(), '$etat_event',  '$ID_createur')";
    $result = mysqli_query($db_handle, $sql);

        if ($result) {
            echo "Événement ajouté avec succès.";
            header('Location: vous.php'); 

        } else {
            echo "Erreur lors de l'ajout de l'événement : " . mysqli_error($db_handle);
            echo "<br>";
            echo "Requête SQL : " . $sql;
        }
    }

  
?>