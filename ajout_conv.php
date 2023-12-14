<?php
//info pour la connection
$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'ece';
$db_port = 8889;

// on se connecte
$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);

// -----------------------------------------------------------------------------------------------
// verification d'ouverture
if ($mysqli->connect_error) { //si c'est pas le cas :
    echo 'Errno : ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error : ' . $mysqli->connect_error;
    exit();
}

session_start();
// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$photo = $_SESSION['photo'];
$id = $_SESSION['id'];

//récupération des infos :
$nom_conv = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";
$ID1 =isset($_POST["id1"]) ? ($_POST["id1"]) : "";
$ID2 = isset($_POST["id2"]) ? ($_POST["id2"]) : "";
$ID3 = isset($_POST["id3"]) ? ($_POST["id3"]) : "NULL";
$ID4 = isset($_POST["id4"]) ? ($_POST["id4"]) : "NULL";

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

$date = date("Y-m-d");
$heure = date("H:i");

if ($mysqli) {
    $sql = "INSERT INTO conversations (nom,ID_createur,ID1,ID2,ID3,ID4,date,heure) VALUES ('$nom_conv','$id','$ID1','$ID2','$ID3','$ID4','$date',$heure)";
    $result = $mysqli->query($sql);

    // Exécution de la requête
    if ($mysqli->query($sql) === TRUE) {
        echo "Données ajoutées avec succès";
        // l'ID de la nouvelle conv :
        $id_new_conv = $mysqli->insert_id;

        // Redirection vers
        header("Location: messagerie.php?id=$id_new_conv");
    } else {
        echo "Erreur lors de l'ajout des données : " . $mysqli->error;
        header("Location: messagerie.php?id=");
    }

    $mysqli->close();
    exit();
}
?>