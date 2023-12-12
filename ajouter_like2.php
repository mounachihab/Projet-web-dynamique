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
$coeur = isset($_GET["etat"]) ? $mysqli->real_escape_string($_GET["etat"]) : "";
$id = $_SESSION['id'] ;

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {

    echo "coeur $coeur";

    if($coeur === 'boutons/coeur_1.png'){
        // si c'est deja like, on supprime le like
        // Requête
        $sql = "DELETE FROM likes WHERE (ID_likeur = '$id' AND ID_publication = $ID_publication);";
        $coeur = "boutons/coeur_0.png";
        echo "test test";
    }
    else {
        //sinon on en ajoute un
        // Requête
        $sql = "INSERT INTO likes (ID_likeur,ID_publication) VALUES ($id,$ID_publication);";
        $coeur = "boutons/coeur_1.png";
    }

    echo "deux $coeur";

    // -----------------------------------------------------------------------------------------------
    if ($mysqli->query($sql) === TRUE) {
        // Redirection
        header("Location: afficher_publi.php?id=$ID_publication&coeur=$coeur");

    } else {
        echo "Erreur lors de l'ajout des données : " . $mysqli->error;
        header("Location: afficher_publi.php?id=$ID_publication&coeur=$coeur");
    }


    $mysqli->close();
    exit();
}

?>