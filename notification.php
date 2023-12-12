<?php
// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ece";

$mysqli = new mysqli($servername, $username, $password, $dbname);




// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}




//accueil

// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$photo = $_SESSION['photo'];

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

// recuperer les donners pour les afficher :
$resultat = $mysqli->query("SELECT COUNT(ID) FROM utilisateurs");
$data = $resultat->fetch_assoc();
$nbr_membres = $data['COUNT(ID)'] ;



// Fermer la connexion à la base de données
$mysqli->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="emplois.js"></script>
    <title> Notification </title>
    <link rel="stylesheet" href="notification.css">
</head>
<body>



<!-- Partie commune à toutes les pages -->
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
        <h2 style >ECE In - Social Media Professionnel de l'ECE Paris</h2>
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


    <!-- Faite attention si les variables non pas le meme nom !! (ces variable $ on ete recupéré par partage d'info - voir plus bas) -->
    <div id="nbr_membre">
        <b>Membres</b>
        <?php echo $nbr_membres?>
    </div>

    <div id="nomCompte">
        <?php echo "<img src='$photo' height='50' width=''>";?>
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
<div id="coul"></div>

<!-- Partie du wrapper, avec toutes les infos de la page -->
<div id="wrapper">
    <!-- Partie des boutons -->
    <div id="boutons">
        <a href="accueil.php"> <!-- lien vers accueil -->
            <img src="bouton_accueil_0.png"
                 alt="accueil"
                 width="150"
                 height=""/>
        </a>

        <a href=""> <!-- lien vers mon reseau -->
            <img src="bouton_mon_reseau_0.png"
                 alt="mon resau"
                 width="150"
                 height=""/>
        </a>

        <a href="vous.html"> <!-- lien vers vous -->
            <img src="bouton_vous_0.png"
                 alt="vous"
                 width="150"
                 height=""/>
        </a>

        <a href=""> <!-- lien vers notifications -->
            <img src="bouton_notifications_1.png"
                 alt="notifications"
                 width="150"
                 height=""/>
        </a>

        <a href=""> <!-- lien vers messagerie -->
            <img src="bouton_messagerie_0.png"
                 alt="messagerie"
                 width="150"
                 height=""/>
        </a>

        <a href=""> <!-- lien vers emplois -->
            <img src="bouton_emplois_0.png"
                 alt="emplois"
                 width="150"
                 height=""/>
        </a>

    </div>




    <div id="BlocBlancc">

        <div class="Titre">
            <h1>Notifi<span class="half-bar"></span>cation</h1>
            <img src="cloche.png" alt="image cloche" class="image">
        </div>

        <div id="Lesnotifications" class="scrollable-container">
            <ul id="ToutesLesNotifications">
                <?php

                ?>
            </ul>
        </div>
    </div>





</div>

    <!-- Copyright -->
    <div id="copy">
        <p>
            &copy; 2023 ECE In. Tous droits réservés.
        </p>
    </div>
</body>
</html>
