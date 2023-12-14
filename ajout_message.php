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
$id_conv = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";
$messages = isset($_POST["mess"]) ? $mysqli->real_escape_string($_POST["mess"]) : "";

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");
$heure = date("H:i");

if ($mysqli) {
    $sql = "INSERT INTO messages (ID_envoyeur, messages, ID_conv, date, heure) VALUES ('$id', '$messages', '$id_conv', '$date', '$heure')";
    $sql1 = "UPDATE conversations SET date='$date', heure='$heure' WHERE ID_conv='$id_conv'";
    $mysqli->query($sql1);

    // Exécution de la requête
    if ($mysqli->query($sql) === TRUE) {
        echo "Données ajoutées avec succès";
        // l'ID de la nouvelle conv :
        $id_new_conv = $mysqli->insert_id;

        // Redirection vers
        header("Location: messagerie.php?id=$id_conv");
    } else {
        echo "Erreur : ID_conv est vide, ou problème de connexion à la base";
        header("Location: messagerie.php?id=$id_conv");
    }

    $mysqli->close();
    exit();
}
?>