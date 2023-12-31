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
    exit();
}

// -----------------------------------------------------------------------------------------------
//sinon
session_start() ;
$ID_publication = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";
$etat = isset($_GET["etat"]) ? $mysqli->real_escape_string($_GET["etat"]) : "";
$id = $_SESSION['id'] ;

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {

    if($etat === '1'){
        // si c'est deja like, on supprime le like
        // Requête
        $sql = "DELETE FROM likes WHERE (ID_likeur = '$id' AND ID_publication = $ID_publication);";
    }
    else {
        //sinon on en ajoute un
        // Requête
        $sql = "INSERT INTO likes (ID_likeur,ID_publication) VALUES ($id,$ID_publication);";
    }


    // -----------------------------------------------------------------------------------------------
    if ($mysqli->query($sql) === TRUE) {
        // Redirection vers la page d'accueil
        header('Location: accueil.php#position' . $position2);

    } else {
        header('Location: accueil.php');
        echo "Erreur lors de l'ajout des données : " . $mysqli->error;
    }


    $mysqli->close();
    exit();
}

?>