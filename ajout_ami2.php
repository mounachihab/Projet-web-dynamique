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
// Récupérer les données
$id_ami = isset($_GET["id_ami"]) ? $mysqli->real_escape_string($_GET["id_ami"]) : "";
$amitie = isset($_GET["amitie"]) ? $mysqli->real_escape_string($_GET["amitie"]) : "";

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {

    // a supprimer
    if($amitie == 1){
        $sql = "DELETE FROM reseau_ami WHERE (ID=$id AND ID_ami=$id_ami) ";

        // Exécution de la requête
        if ($mysqli->query($sql) === TRUE) {
            echo "Données ajoutées avec succès";
            // Redirection vers
            header("Location: pp_ami.php?id=$id_ami");
            exit();
        } else {
            echo "Erreur lors de l'ajout des données : " . $mysqli->error;
            header("Location: pp_ami.php?id=$id_ami");
        }
    }
    // a ajouter
    if($amitie == 0){
        $sql = "INSERT INTO reseau_ami (ID,ID_ami) VALUES ($id,$id_ami) ";

        // Exécution de la requête
        if ($mysqli->query($sql) === TRUE) {
            echo "Données ajoutées avec succès";
            // Redirection vers
            header("Location: pp_ami.php?id=$id_ami");
            exit();
        } else {
            echo "Erreur lors de l'ajout des données : " . $mysqli->error;
            header("Location: pp_ami.php?id=$id_ami");
        }
    }

    $mysqli->close();
    exit();
}

?>