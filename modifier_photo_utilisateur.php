<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

// Identifier le nom de la base de données
$database = "ece";

// Connectez-vous à la base de données
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

if ($user_name == '') {
    header('Location: connexion.html');
    exit();
}

// Traitement du fichier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['nouvelle_photo']) && $_FILES['nouvelle_photo']['error'] === UPLOAD_ERR_OK) {
        // Vérifier si le fichier est une image JPEG
        $extensions_permittees = array('jpg', 'jpeg');
        $extension_upload = strtolower(pathinfo($_FILES['nouvelle_photo']['name'], PATHINFO_EXTENSION));

        if (in_array($extension_upload, $extensions_permittees)) {
            // Déplacer le fichier téléchargé vers le même répertoire que le script
            $nouveau_nom_fichier = 'nouvelle_photo_utilisateur_' . $id . '.' . $extension_upload;
            $chemin_destination = __DIR__ . '/' . $nouveau_nom_fichier;

            move_uploaded_file($_FILES['nouvelle_photo']['tmp_name'], $chemin_destination);

            // Mettre à jour la base de données avec le nouveau nom de fichier
            $sql = "UPDATE utilisateurs SET photo = '$nouveau_nom_fichier' WHERE ID = $id";

            if ($db_handle->query($sql) === TRUE) {
                $message = "La photo a été modifiée avec succès.";
                header('Location: vous.php');

            } else {
                $message = "Erreur lors de la mise à jour de la base de données : " . $db_handle->error;
            }
        } else {
            $message = "Seuls les fichiers JPEG ou JPG sont autorisés.";
        }
    } else {
        $message = "Une erreur s'est produite lors du téléchargement du fichier.";
    }
}
?>

