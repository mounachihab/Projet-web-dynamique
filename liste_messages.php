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
    echo 'Errno : ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error : ' . $mysqli->connect_error;
    exit();
}

// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$photo = $_SESSION['photo'];
$id = $_SESSION['id'];

$id_conv1 = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

if ($mysqli) {
    $sql = "SELECT conv.ID_conv, conv.nom,
               u1.prenom AS name_id1,
               u2.prenom AS name_id2,
               u3.prenom AS name_id3,
               u4.prenom AS name_id4
        FROM conversations AS conv
        LEFT JOIN utilisateurs AS u1 ON conv.ID1 = u1.id
        LEFT JOIN utilisateurs AS u2 ON conv.ID2 = u2.id
        LEFT JOIN utilisateurs AS u3 ON conv.ID3 = u3.id
        LEFT JOIN utilisateurs AS u4 ON conv.ID4 = u4.id
        WHERE (conv.ID1 = $id OR conv.ID2 = $id OR conv.ID3 = $id OR conv.ID4 = $id)
        ORDER BY date ASC";
    $result = $mysqli->query($sql);

    // Affichage des événements
    while ($row = $result->fetch_assoc()) {
        $nom=$row['nom'];
        $nom1=$row['name_id1'];
        $nom2=$row['name_id2'];
        $nom3=$row['name_id3'];
        $nom4=$row['name_id4'];
        $id_conv = $row['ID_conv'];

        if($id_conv1===$id_conv){
            echo "<div id='bloc' style='background-color: #d7d7d7'>";
        }
        else {
            echo "<div id='bloc'>";
        }

        echo "<div id='bloc_conv'>
            <a href = 'messagerie.php?id=$id_conv' style='color:black;text-decoration: none;'><div id='cliquable'>";
        echo "<b>";
        echo $nom;
        echo"</b>";
        echo "<hr style='margin-right: 5px;color: black;'/>";
        if($nom3==""){
            echo "$nom1 - $nom2" ;
        }
        elseif ($nom4 == ""){
            echo "$nom1 - $nom2 - $nom3" ;
        }
        else {
            echo "$nom1 - $nom2 - $nom3 - $nom4" ;
        }

        echo "</div></a>";

        echo "<div id='btn_sup'>";
        echo "<button onclick='openPopupA()'>Supprimer</button>

            <div id='overlay'></div>

            <div id='popup'>
                <p>Voulez-vous vraiment supprimer la conversation ? (Elle sera supprimée pour tout le monde)</p>
                <button id='yesBtn' onclick='redirectToPageA(".$id_conv.")'>Supprimer</button>
                <button id='noBtn' onclick='closePopupA()'>Non</button> </div>";
        echo "</div>
            </div>
            </div>";
    }

    $mysqli->close();
}
?>