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

// -----------------------------------------------------------------------------------------------
// Démarrer la session


// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$photo = $_SESSION['photo'];
$id = $_SESSION['id'];
$id_pp = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";

// recup des données à afficher :
$resultat = $mysqli->query("SELECT prenom FROM utilisateurs WHERE ID=$id_pp");
$data = $resultat->fetch_assoc();
$pp_prenom = $data['prenom'] ;

$resultat = $mysqli->query("SELECT nom FROM utilisateurs WHERE ID=$id_pp");
$data = $resultat->fetch_assoc();
$pp_nom = $data['nom'] ;

$resultat = $mysqli->query("SELECT photo FROM utilisateurs WHERE ID=$id_pp");
$data = $resultat->fetch_assoc();
$pp_photo = $data['photo'] ;

$resultat = $mysqli->query("SELECT admin FROM informations where ID='$id'");
$data = $resultat->fetch_assoc();
$admin = $data['admin'] ;


if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

$sql = "SELECT ID_publication FROM publications WHERE ID_createur=$id_pp ORDER BY date DESC";
$result = $mysqli->query($sql);

// Affichage des événements
while ($row = $result->fetch_assoc()) {

    echo "<div class='publication'>";
    echo "<div id='personne'>";
    echo "<a href='pp_ami.php?id=$id_pp'>";
    echo "<img style='border: 1px solid black;border-radius: 10px;' src='$pp_photo' width='50' alt='publication'/>";
    echo "</a>";


    echo "<div id='info'>";

    echo $pp_prenom;
    echo "&nbsp" ;
    echo $pp_nom;


    $id_publication = $row['ID_publication'];

    $resultat = $mysqli->query("SELECT date FROM publications where ID_publication=$id_publication");
    $data = $resultat->fetch_assoc();
    $date_publication = $data['date'] ;

    $resultat = $mysqli->query("SELECT lieu FROM publications where ID_publication=$id_publication");
    $data = $resultat->fetch_assoc();
    $lieu_publication = $data['lieu'] ;

    $resultat = $mysqli->query("SELECT photo FROM publications where ID_publication=$id_publication");
    $data = $resultat->fetch_assoc();
    $photo_publication = $data['photo'] ;

    $resultat = $mysqli->query("SELECT descriptions FROM publications where ID_publication=$id_publication");
    $data = $resultat->fetch_assoc();
    $description = $data['descriptions'] ;

    $resultat = $mysqli->query("SELECT COUNT(ID_likeur) FROM likes WHERE ID_publication = $id_publication");
    $data = $resultat->fetch_assoc();
    $like = $data['COUNT(ID_likeur)'] ;

    $coeur = 'boutons/coeur_0.png';
    //On regarde si la publication à été like par l'ultilisateur :
    $resultat = $mysqli->query("SELECT * FROM likes WHERE (ID_likeur='$id' AND ID_publication='$id_publication')");

    // si c'est le cas :
    if ($data = $resultat->fetch_assoc()){
        $coeur = 'boutons/coeur_1.png';
    }
    // sinon :
    else {
        $coeur = 'boutons/coeur_0.png';
    }


    echo "<br>";

    echo "<i style='font-size: 13px'>";
    echo "Le ";

    $date = new DateTime($date_publication);
    $format = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $date_affich = $format->format($date->getTimestamp());

    echo $date_affich;
    echo " à ";
    echo $lieu_publication;
    echo "</i>";


    if ($admin === 'YES') {
        echo "<button onclick='openPopup3()'>Supprimer la pulication</button>

                        <div id='overlay3'></div>
                        
                        <div id='popup3'>
                            <p>Voulez-vous vraiment supprimer cette pulication ?</p>
                            <button id='yesBtn3' onclick='redirectToPage3($id_publication,1)'>Supprimer</button>
                            <button id='noBtn3' onclick='closePopup3()'>Non</button>
                        </div>";
    }


    echo "</div>";

    echo "</div>";

    echo "<hr/>";

    echo "<div id='photo'>
                <a href='afficher_publi.php?id=$id_publication&coeur=$coeur'><img src='$photo_publication' height='450' alt='publication'/></a>
                <br>";
    echo $description;
    echo "</div>";




    echo "</div>";
}
?>