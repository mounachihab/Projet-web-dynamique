
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
session_start();

// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$photo = $_SESSION['photo'];
$id = $_SESSION['id'];

$id_conv = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

// recuperer les donners pour les afficher :
$resultat = $mysqli->query("SELECT COUNT(ID) FROM utilisateurs");
$data = $resultat->fetch_assoc();
$nbr_membres = $data['COUNT(ID)'] ;

?>

<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="messagerie.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
    <script type="text/javascript" src="messagerie.js"></script>
    <title>ECE In - Home</title>
</head>

<body>
<!-- Partie du logo -->
<div id="banderole">
    <div id="logo">
        <img src="boutons/logo.png"
             alt="logo ECE in"
             width="260"
             height=""
             onclick="afficher_message_intro()"/>
    </div>

    <!-- si on appuie sur le logo : -->
    <div id="container">
        <div id="message_intro">
            <h3 style="color: #0a7677">
                <u>Qu'est ce qu'ECE in ?</u>
            </h3>
            <p style="text-align: left">
                Bienvenue sur le réseau social professionnel dédié à la communauté ECE Paris ! <br><br>

                Que vous soyez étudiant/e de licence, master ou doctorat, apprenti/e dans une entreprise, en quête d'un
                stage ou peut-être un/e enseignant/e ou employé/e de l’école à la recherche de partenaires pour un projet
                de recherche, ce site web est conçu pour répondre aux besoins de chacun. Notre plate-forme sociale offre
                une approche professionnelle, permettant à chacun de prendre en main sa vie professionnelle, de découvrir
                de nouvelles opportunités, et de se connecter avec d'autres passionnés partageant des objectifs similaires. <br><br>

                Votre espace personnel sur le site vous permettra de publier des statuts, des évènements, des photos,
                des vidéos, et même votre curriculum vitae.
            </p>
            <button onclick="cacher_message_intro()">Fermer</button>

        </div>
    </div>

    <div id="titre">
        <h2>ECE In - Social Media Professionnel de l'ECE Paris</h2>
    </div>

    <div id="image_decembre_1">
        <img id="image_dec_1"
             src=""
             width="250"
             height=""/>
    </div>
    <div id="image_decembre_2">
        <img id="image_dec_2"
             src=""
             width="150"
             height=""/>
    </div>

    <div id="nbr_membre">
        <b>Membres</b>
        <?php echo $nbr_membres?>
    </div>

    <div id="nomCompte">
        <?php echo "<img style='border-radius: 10px;' src='$photo' height='50' width=''>";?>
        <p> </p>
        <?php echo $user_name; ?>
    </div>

    <!-- Partie du boutons de reglage et du boutons de déconnexion -->
    <div id="deco">

        <a href="reglages.php">
            <img src="boutons/bouton_reglages.png"
                 alt="reglages"
                 width="54"
                 height=""/>
        </a>

        <a href="connexion.html">
            <img src="boutons/bouton_deconnexion.png"
                 alt="deconnexion"
                 width="50"
                 height=""/>
        </a>
    </div>

</div>

<!-- Partie du bandeau de couleur -->
<div id="couleur"></div>

<!-- Partie du wrapper, avec toutes les infos de la page -->
<div id="wrapper">
    <!-- Partie des boutons -->
    <div id="boutons">
        <a href="accueil.php"> <!-- lien vers accueil -->
            <img src="boutons/bouton_accueil_0.png"
                 alt="accueil"
                 width="150"
                 height=""/>
        </a>

        <a href="mon_reseau.php"> <!-- lien vers mon reseau -->
            <img src="boutons/bouton_mon_reseau_0.png"
                 alt="mon resau"
                 width="150"
                 height=""/>
        </a>

        <a href="vous.php"> <!-- lien vers vous -->
            <img src="boutons/bouton_vous_0.png"
                 alt="vous"
                 width="150"
                 height=""/>
        </a>

        <a href="notifications.php"> <!-- lien vers notifications -->
            <img src="boutons/bouton_notification_0.png"
                 alt="notifications"
                 width="150"
                 height=""/>
        </a>

        <a href="messagerie.php"> <!-- lien vers messagerie -->
            <img src="boutons/bouton_messagerie_1.png"
                 alt="messagerie"
                 width="150"
                 height=""/>
        </a>

        <a href="emplois.php"> <!-- lien vers emplois -->
            <img src="boutons/bouton_emplois_0.png"
                 alt="emplois"
                 width="150"
                 height=""/>
        </a>
    </div>

    <div id="blocA">
        <a href="ajout_conv.php">
            <img src="boutons/bouton_plus_0.png" width="50" alt="ajout">
        </a>
    </div>

    <div id="blocB">
        <div id="titre_conv1">
            <h3>
                Vos Conversation
            </h3>
        </div>
        <div class="scrollable-container_y">
        <?php include "liste_messages.php"; ?>
        </div>

    </div>

    <div id="blocC">

        <?php include "messages.php"; ?>
    </div>

</div>


<div id="retour_haut">
    <img src="boutons/fleche_haut.png"
         alt="retour en haut"
         width="70"
         height=""
         style="cursor: pointer;"
         onclick="retour_en_haut()"/>
</div>

<!-- Copyright -->
<div id="copy">
    <p>
        &copy; 2023 ECE In. Tous droits réservés.
    </p>
</div>

</body>
</html>


