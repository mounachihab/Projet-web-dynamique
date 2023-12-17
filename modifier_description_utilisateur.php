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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouvelleDescription = mysqli_real_escape_string($db_handle, $_POST['nouvelleDescription']);

    // Mise à jour de la description dans la base de données
    $sql = "UPDATE utilisateurs SET description = '$nouvelleDescription' WHERE ID = $id";

    if (mysqli_query($db_handle, $sql)) {
        echo "La description a été modifiée avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la base de données : " . mysqli_error($db_handle);
    }

    // Rediriger vers la page d'origine
    header('Location: vous.php');
    exit;
}
?>
