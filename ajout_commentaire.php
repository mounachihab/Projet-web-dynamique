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


// verification d'ouverture
if ($mysqli->connect_error) { //si c'est pas le cas :
    echo 'Errno : ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error : ' . $mysqli->connect_error;
    exit();
}


//sinon
echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $mysqli->host_info;
echo '<br>';
echo 'Protocol version: ' . $mysqli->protocol_version;

session_start();
$id = $_SESSION['id'];


// -----------------------------------------------------------------------------------------------
// Récupérer les données du formulaire
$commentaire = isset($_POST["commentaire"]) ? $mysqli->real_escape_string($_POST["commentaire"]) : "";
$ID_publication = isset($_GET["publi"]) ? $mysqli->real_escape_string($_GET["publi"]) : "";
$coeur = isset($_GET["coeur"]) ? $mysqli->real_escape_string($_GET["coeur"]) : "";

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {
     $sql = "INSERT INTO commentaires (ID_publication, ID, comm) VALUES ($ID_publication,$id, '$commentaire')";

    // Exécution de la requête
    if ($mysqli->query($sql) === TRUE) {
        echo "Données ajoutées avec succès";
        // Redirection vers
        header("Location: afficher_publi.php?id=$ID_publication&coeur=$coeur");
        exit();
    } else {
        echo "Erreur lors de l'ajout des données : " . $mysqli->error;
        header("Location: afficher_publi.php?id=$ID_publication&coeur=$coeur");
    }

    $mysqli->close();
    exit();
}

?>