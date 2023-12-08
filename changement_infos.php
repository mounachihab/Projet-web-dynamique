<?php

// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id = $_SESSION['id'];


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

// -----------------------------------------------------------------------------------------------
//sinon
echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $mysqli->host_info;
echo '<br>';
echo 'Protocol version: ' . $mysqli->protocol_version;

// -----------------------------------------------------------------------------------------------
// Récupérer les données du formulaire
$new_nom = isset($_POST["nom"]) ? $mysqli->real_escape_string($_POST["nom"]) : "";
$new_name = isset($_POST["prenom"]) ? $mysqli->real_escape_string($_POST["prenom"]) : "";
$new_date = isset($_POST["date"]) ? $mysqli->real_escape_string($_POST["date"]) : "";
$new_civic = isset($_POST["civilite"]) ? $mysqli->real_escape_string($_POST["civilite"]) : "";
$sql= '';
// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {

    if($new_nom != '') {
        // Requête pour changer le nom à l'aide de l'ID
        $sql = "UPDATE utilisateurs SET nom = '$new_nom' WHERE ID = '$id'";
        $mysqli->query($sql);
    }
    if($new_name != '') {
        // Requête pour changer le nom à l'aide de l'ID
        $sql = "UPDATE utilisateurs SET prenom = '$new_name' WHERE ID = '$id'";
        $mysqli->query($sql);
    }
    if($new_date != '') {
        // Requête pour changer le nom à l'aide de l'ID
        $sql = "UPDATE informations SET date = '$new_date' WHERE ID = '$id'";
        $mysqli->query($sql) ;
    }
    if($new_civic != 'NULL') {
        // Requête pour changer le nom à l'aide de l'ID
        $sql = "UPDATE informations SET civilite = '$new_civic' WHERE ID = '$id'";
        $mysqli->query($sql) ;
    }


    // -----------------------------------------------------------------------------------------------
    if($sql != '') {
        if ($mysqli->query($sql) === TRUE) {
            echo "Données ajoutées avec succès";
            // Démarrer la session
            session_start();

            // Stocker des informations sur l'utilisateur dans la session
            if ($new_name != ''){
                $_SESSION['user_name'] = $new_name;
            }

            $_SESSION['id'] = $id;

            // Redirection vers la page d'accueil
            header('Location: reglages.php');
            exit();
        } else {
            header('Location: reglages.php');
            echo "Erreur lors de l'ajout des données : " . $mysqli->error;
        }
    }
    else {
        header('Location: reglages.php');
        echo "Erreur lors de l'ajout des données : " . $mysqli->error;
    }

    $mysqli->close();
}


