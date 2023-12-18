<?php
if (isset($_GET['id'])) {
    $notificationId = $_GET['id'];

    // Connexion à la base de données
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ece";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    session_start();

    // Exécutez la requête de mise à jour de l'état
    $updateQuery = "UPDATE notifications SET etat = 'YES' WHERE ID_event = $notificationId OR ID_post = $notificationId OR ID_emplois = $notificationId";
    $mysqli->query($updateQuery);

    $id = $_SESSION['id'];

    $result = $mysqli->query("SELECT ID_event, ID_post, ID_emplois FROM notifications WHERE ID_event = $notificationId OR ID_post = $notificationId OR ID_emplois = $notificationId");
    if ($result && $row = $result->fetch_assoc()) {
        if (!empty($row['ID_event'])) {
            header("Location: afficher_event.php?id=ID_event" . $notificationId);

        }

        elseif (!empty($row['ID_post'])) {

            $coeur="" ;
            //On regarde si la publication à été like par l'ultilisateur :
            $resultat = $mysqli->query("SELECT * FROM likes WHERE (ID_likeur = $id AND ID_publication = $notificationId)");

            // si c'est le cas :
            if ($data = $resultat->fetch_assoc()){
                $coeur = 'boutons/coeur_1.png';
            }
            // sinon :
            else {
                $coeur = 'boutons/coeur_0.png';
            }

            echo "test";
            header("Location: afficher_publi.php?id=ID_post" . $notificationId."&coeur=$coeur");

        }

        elseif (!empty($row['ID_emplois'])) {
            header("Location: emplois.php?id=ID_emplois" . $notificationId);
        }
    }

    // Fermez la connexion à la base de données
    $mysqli->close();
    exit();

}
?>
