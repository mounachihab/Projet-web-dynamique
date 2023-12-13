<?php

// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id =  $_SESSION['id'];


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
$id_publi = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";
$btn = isset($_GET["btn"]) ? $mysqli->real_escape_string($_GET["btn"]) : "";

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {

    // si c'est un event à supprimer
    if($btn === '0'){
        $sql = "DELETE FROM evenements WHERE ID_event=$id_publi" ;

        if (mysqli_query($mysqli, $sql)) {
            echo "Données supprimées avec succès.";
        } else {
            echo "Erreur lors de la suppression des données : " . mysqli_error($mysqli);
        }
        header('Location: accueil.php');
    }

    // si c'est une publication à supprimer
    elseif($btn === '1'){
        $sql = "DELETE FROM publications WHERE ID_publication=$id_publi" ;

        if (mysqli_query($mysqli, $sql)) {
            echo "Données supprimées avec succès.";
        } else {
            echo "Erreur lors de la suppression des données : " . mysqli_error($mysqli);
        }

        header('Location: accueil.php');
    }

    // si c'est un utilisateur à supprimer
    if($btn === '2'){
        // Supprimez les données de la table 'informations'
        $sql_delete_informations = "DELETE FROM utilisateur WHERE ID=$id_publi";
        $result_utilisateur = mysqli_query($mysqli, $sql_delete_informations);

        // Supprimez les données de la table 'informations'
        $sql_delete_informations = "DELETE FROM informations WHERE ID=$id_publi";
        $result_informations = mysqli_query($mysqli, $sql_delete_informations);

        // Supprimez les données de la table 'reseau_ami'
        $sql_delete_reseau_ami = "DELETE FROM reseau_ami WHERE ID_ami=$id OR ID=$id_publi";
        $result_reseau_ami = mysqli_query($mysqli, $sql_delete_reseau_ami);

        // Supprimez les données de la table 'publications'
        $sql_delete_publications = "DELETE FROM publications WHERE ID_createur=$id_publi";
        $result_publications = mysqli_query($mysqli, $sql_delete_publications);

        // Supprimez les données de la table 'likes'
        $sql_delete_likes = "DELETE FROM likes WHERE ID_likeur=$id_publi";
        $result_likes = mysqli_query($mysqli, $sql_delete_likes);

        // Supprimez les données de la table 'evenements'
        $sql_delete_evenements = "DELETE FROM evenements WHERE ID_createur=$id_publi";
        $result_evenements = mysqli_query($mysqli, $sql_delete_evenements);

        // Supprimez les données de la table 'commentaires'
        $sql_delete_commentaires = "DELETE FROM commentaires WHERE ID=$id_publi";
        $result_commentaires = mysqli_query($mysqli, $sql_delete_commentaires);

        // verif de l'execution :
        if ($result_utilisateur && $result_informations && $result_reseau_ami && $result_publications && $result_likes && $result_evenements && $result_commentaires) {
            echo "Données supprimées avec succès.";
        } else {
            echo "Erreur lors de la suppression des données : " . mysqli_error($mysqli);
        }
        header('Location: accueil.php');
    }

    $mysqli -> close();
    exit();
}

?>