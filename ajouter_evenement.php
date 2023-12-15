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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = mysqli_real_escape_string($db_handle, $_POST['type']);
    $lieu = mysqli_real_escape_string($db_handle, $_POST['lieu']);
    $commentaire = mysqli_real_escape_string($db_handle, $_POST['commentaire']);
    $date = $_POST['date'];
    $id_createur = $_SESSION['id'];

    // Gestion de l'upload de la photo
    $target_dir = __DIR__ . "/"; // Répertoire actuel du script
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

// Obtenez l'URL complète du fichier
    //$photo_url = "http://" . $_SERVER['SERVER_NAME'] . "/".$target_file;

// Ajouter l'événement à la table
    $sql = "INSERT INTO evenements (type, lieu, commentaire, photo, date, ID_createur) VALUES ('$type', '$lieu', '$commentaire', '$target_file', '$date', '$id_createur')";
    $result = mysqli_query($db_handle, $sql);

        if ($result) {
            echo "Événement ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'événement : " . mysqli_error($db_handle);
        }
    }

header('Location: ' . $_SERVER['HTTP_REFERER']); // Rediriger vers la page précédente après l'ajout
exit();

?>
