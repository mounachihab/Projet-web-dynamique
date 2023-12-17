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

if (isset($_POST['publications_form_submit'])) {
    $lieu_publications = mysqli_real_escape_string($db_handle, $_POST['lieu_publications']);
    
$commentaire_publications = mysqli_real_escape_string($db_handle, $_POST['commentaire_publications']);

    $ID_createur = $_SESSION['id'];
    $etat_publications = $_POST['etat_publications'];



    // Validation : Vérifier si le commentaire sont saisis


if (empty($commentaire_publications) ) {
    echo "Veuillez saisir un commentaire ";
    exit; // Arrêter l'exécution du script si la validation échoue
}



    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['photo_publications']) && $_FILES['photo_publications']['error'] == UPLOAD_ERR_OK) {
        // Gestion de l'upload de la photo
        
        $target_dir = __DIR__ . "/";
        $target_file = $target_dir . basename($_FILES["photo_publications"]["name"]);
        $filename = basename($_FILES["photo_publications"]["name"]); // Obtenez le nom du fichier

        // Modifier le chemin pour enregistrer seulement le nom du fichier
        $target_file = $target_dir . $filename;

        move_uploaded_file($_FILES["photo_publications"]["tmp_name"], $target_file);

                
    } else {
        $target_file = null; 

    }

// Ajouter l'événement à la table
    $sql = "INSERT INTO publications (lieu_publications, date_publications, heure_publications, commentaire_publications, photo_publications, etat_publications, ID_createur) VALUES ('$lieu_publications', CURRENT_DATE(), CURRENT_TIME(), '$commentaire_publications', '$filename', '$etat_publications', '$ID_createur')";
    $result = mysqli_query($db_handle, $sql);

        if ($result) {
            echo "Publication ajoutée avec succès.";
            header('Location: vous.php'); // Rediriger vers la page précédente après l'ajout

        } else {
            echo "Erreur lors de l'ajout de la publication : " . mysqli_error($db_handle);
            echo "<br>";
            echo "Requête SQL : " . $sql;
        }
    }

  
?>
