<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

$database = "ece";
$db_handle = mysqli_connect("localhost", "root", "root");
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    echo "Database not found";
    mysqli_close($db_handle);
    exit;
}

$user_name = $_SESSION['user_name'];
$id = $_SESSION['id'];

if ($user_name == '') {
    header('Location: connexion.html');
    exit();
}

// Récupérer les données du formulaire
$description = mysqli_real_escape_string($db_handle, $_POST['nouvelleDescription']); // Assurez-vous que le nom du champ correspond au formulaire
$ID_publication = $_POST['ID_publication'];

// Effectuer la mise à jour dans la base de données
$sql = "UPDATE publications SET description = '$description' WHERE ID_publication = $ID_publication";
mysqli_query($db_handle, $sql);

// Rediriger vers la page d'origine 
header('Location: vous.php');
exit;
?>
