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
    // Requête pour récupérer les infos des evenements (ordre chrono et limite de 10 evenements)
    $sql = "SELECT publications.ID_publication,
               publications.*,
               utilisateurs.nom AS nom_utilisateur,
               utilisateurs.prenom,
               utilisateurs.photo AS photo_utilisateur,
               utilisateurs.ID AS ID_posteur,
               (SELECT COUNT(*) FROM likes WHERE likes.ID_publication = publications.ID_publication) AS nombre_likes
        FROM publications
        JOIN utilisateurs ON publications.ID_createur = utilisateurs.ID
        LEFT JOIN reseau_ami ON utilisateurs.ID = reseau_ami.ID_ami
        WHERE (reseau_ami.ID = $id OR utilisateurs.ID = $id OR utilisateurs.ID = 16)
        GROUP BY publications.ID_publication
        ORDER BY publications.date DESC, publications.heure DESC
        LIMIT 10";
    $result = $mysqli->query($sql);

    // Affichage des événements
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bloc_vous'>";

        $ID_posteur = $row['ID_posteur'] ;

        echo "<div id='bloc1'>";
        echo "<a href='pp_ami.php?id=$ID_posteur'>
                        <img style='border: 1px solid black;'
                             src=" . htmlspecialchars($row['photo_utilisateur']) . "
                             alt='utilisateur'
                             width=''
                             height='40'/>
                    </a>";
        echo "&nbsp";
        echo htmlspecialchars($row['prenom']);
        echo "&nbsp";
        echo htmlspecialchars($row['nom_utilisateur']);
        echo "<br>";
        echo "</div>";

        echo "<hr style='border: 1px solid #0a7677'/>";

        $id_publi = $row['ID_publication'] ;


        $coeur="" ;
        //On regarde si la publication à été like par l'ultilisateur :
        $resultat = $mysqli->query("SELECT * FROM likes WHERE (ID_likeur = $id AND ID_publication = $id_publi)");

        // si c'est le cas :
        if ($data = $resultat->fetch_assoc()){
            $coeur = 'boutons/coeur_1.png';
            $etat = '1' ;
        }
        // sinon :
        else {
            $coeur = 'boutons/coeur_0.png';
            $etat = '0' ;
        }

        $_SESSION['ID_publication'] = $row['ID_publication'];

        echo "<div id='bloc2'>";
        echo "<a href='afficher_publi.php?id=$id_publi&coeur=$coeur'>
                        <img style='border: 1px solid black;' 
                             src=" . htmlspecialchars($row['photo']) . "
                             alt='evenement'
                             width=''
                             height='210'/>
                    </a>";
        echo "<br>";
        echo "</div>";

        echo "<div id='bloc3'>";
        echo "<a href='ajouter_like.php?id=$id_publi&etat=$etat' > <img id='position' style='cursor: pointer;' src=$coeur
                 alt='evenement'
                 width=''
                 height='30'/></a>";
        echo htmlspecialchars($row['nombre_likes']);
        echo "</div>";
        echo "</div>";
    }


    $mysqli->close();
}

?>