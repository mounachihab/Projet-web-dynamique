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
    // on récupère la date du jour
    $date_actuelle = date("Y-m-d");

    // Requête pour récupérer les infos des evenements (ordre chrono et limite de 7 evenements)
    $sql = "SELECT * FROM evenements WHERE date >= '$date_actuelle' ORDER BY date ASC LIMIT 7";
    $result = $mysqli->query($sql);

    // Affichage des événements
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bloc_semaine'>";
        echo  htmlspecialchars($row['type']) ;
        echo "<br>";
        echo "<a href='afficher_even.php'>
                        <img style='border: 1px solid black;' src=" . htmlspecialchars($row['photo']) . "
                             alt='evenement'
                             width=''
                             height='230'/>
                    </a>";
        echo "<br>";

        echo "<img src='boutons/lieu_0.png'
                 alt='lieu'
                 width=''
                 height='30'/>";
        echo htmlspecialchars($row['lieu']);

        echo "<img src='boutons/calandar_0.png'
                 alt='calandar'
                 width=''
                 height='30'/>";
        echo htmlspecialchars($row['date']);
        echo "</div>";
    }


    $mysqli->close();
}

?>