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

//récupération des infos :
$id_conv = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}



if ($mysqli && $id_conv != '') {
    $sql = "SELECT * 
            FROM messages 
            WHERE ID_conv = $id_conv
            ORDER BY date DESC";

    $result = $mysqli->query($sql);

    $resultat = $mysqli->query("SELECT nom FROM conversations WHERE ID_conv =  $id_conv");
    $data = $resultat->fetch_assoc();
    $nom_conv= $data['nom'];

    echo "<div id='titre_conv'>
            <h3>";
    echo $nom_conv;
    echo "</h3>
            </div>";

    echo"<div class='scrollable-container_y2'>";
    echo "<div id='conversation'>";

    if($row = $result->fetch_assoc() != TRUE){
        echo" <p> CE GROUPE MANQUE DE CONVERSATION... <br> ENVOYEZ UN MESSAGE </p>";
    }
    // Affichage des événements
    while ($row = $result->fetch_assoc()) {

        $message = $row['messages'];
        $id_pp =$row['ID_envoyeur'];
        $date =$row['date'];
        $heure =$row['heure'];
        $date1 = new DateTime($date);
        $format = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
        $date = $format->format($date1->getTimestamp());


        $resultat = $mysqli->query("SELECT photo FROM utilisateurs WHERE ID =  $id_pp");
        $data = $resultat->fetch_assoc();
        $photo_pp = $data['photo'];

        if($id_pp != $id){
        echo "<div id='bulle_ami'>";
            echo "<a href='pp_ami.php?id=$id_pp'><img src=$photo_pp style='border-radius: 10px' width='60'></a>";
            echo "<div id='texte'style='background-color: #e7e4e4 ;'>";
            echo $message ;
            echo "</div>";
            echo "</div>";
            echo"<div id='bulle_info'>";
            echo "<div id='date'> <i>le $date à $heure</i></div>";
            echo "</div>";
        }
        else {
            echo "<div id='bulle_moi'>
        <div id='texte' style='background-color: #cccccc ;'>";
            echo $message;
            echo "</div>";
            echo "<a href='pp_ami.php?id=$id'><img src=$photo style='border-radius: 10px' width='60'></a>";
            echo "</div>";
            echo "<div id='bulle_info_moi'>";
            echo  "<div id='date_moi'> <i>le $date à $heure</i> </div>";
            echo "</div>";
        }

    }

    echo "</div></div>";

    echo "<div id='envoie_mess'>
        <div id='mon_comm'>";
    echo "<form action='ajout_message.php?id=$id_conv' method='post'>
        <input name='mess' placeholder='Votre commentaire' required maxlength='200'>
        </form>";
    echo "</div>";
    echo "<img src=$photo style='border-radius: 10px' width='60'>";
    echo "</div>";

    $mysqli->close();
}


?>