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
//sino


// Accéder aux informations sur l'utilisateur
$id = $_SESSION['id'];


// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {
    // Requête pour récupérer les photos des eveneements
    $sql = "SELECT photo FROM evenements WHERE DATEDIFF(NOW(), evenements.date) <= 7";
    $result = $mysqli->query($sql);


    // Affichage des événements
    while ($row = $result->fetch_assoc()) {
        echo "<li><img src=" . htmlspecialchars($row['photo']) . " alt='Image 1' width='' height='250'/></li>";
    }

    // Requête pour récupérer les photos des utilisateurs suivi
    $sql2 = "SELECT publications.photo 
            FROM publications
            JOIN utilisateurs ON publications.ID_createur = utilisateurs.ID
             JOIN reseau_ami ON utilisateurs.ID = reseau_ami.ID_ami 
             WHERE (reseau_ami.ID = $id OR publications.ID_createur = '16') AND (DATEDIFF(NOW(), publications.date) <= 7)";
    $result2 = $mysqli->query($sql2);

    // Affichage des événements
    while ($row2 = $result2->fetch_assoc()) {
        echo "<li><img src=" . htmlspecialchars($row2['photo']) . " alt='Image 1' width='' height='250'/></li>";
    }

    $mysqli->close();
}

?>