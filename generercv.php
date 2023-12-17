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

function genererCV($userID) {
    $xmlFilePath = 'cv' . $userID . '.xml';

    if (file_exists($xmlFilePath)) {
        echo "Fichier XML trouvé pour l'ID " . $userID;

        $xmlContent = file_get_contents($xmlFilePath);
        $xml = new SimpleXMLElement($xmlContent);

        require_once('tcpdf/tcpdf.php');
        $pdf = new TCPDF();

        // ... Personnalisez la génération du PDF en fonction des données XML
        // ...

        // Sauvegardez le PDF ou envoyez-le au navigateur
        $pdf->Output('CV_User_' . $userID . '.pdf', 'I');
        exit(); // Ajoutez cette ligne pour terminer le script après la sortie du PDF
    } else {
        echo "Fichier XML non trouvé pour l'ID " . $userID;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genererCV'])) {
    genererCV($id);
}
?>
