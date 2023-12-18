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
$id = $_SESSION['id'];

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
<div id="coul"></div>

<!-- Partie du wrapper, avec toutes les infos de la page -->
<div id="wrapper">
    <!-- Partie des boutons -->
    <div id="boutons">
        <a href="accueil.php" style='text-decoration: none;'> <!-- lien vers accueil -->
            <img src="bouton_accueil_0.png"
                 alt="accueil"
                 width="150"
                 height=""/>
        </a>

        <a href="mon_reseau.php" style='text-decoration: none;'> <!-- lien vers mon reseau -->
            <img src="bouton_mon_reseau_0.png"
                 alt="mon resau"
                 width="150"
                 height=""/>
        </a>

        <a href="vous.php" style='text-decoration: none;'> <!-- lien vers vous -->
            <img src="bouton_vous_0.png"
                 alt="vous"
                 width="150"
                 height=""/>
        </a>

        <a href="notification.php" style='text-decoration: none;'> <!-- lien vers notifications -->
            <img src="bouton_notifications_1.png"
                 alt="notifications"
                 width="150"
                 height=""/>
        </a>

        <a href="messagerie.php" style='text-decoration: none;'> <!-- lien vers messagerie -->
            <img src="bouton_messagerie_0.png"
                 alt="messagerie"
                 width="150"
                 height=""/>
        </a>

        <a href="emplois.php" style='text-decoration: none;'> <!-- lien vers emplois -->
            <img src="bouton_emplois_0.png"
                 alt="emplois"
                 width="150"
                 height=""/>
        </a>

    </div>




    <div id="BlocBlancc">

        <div class="Titre">
            <h1>Notification</h1>
            <img src="cloche.png" alt="image cloche" class="image">
        </div>

        <div id="Lesnotifications" class="scrollable-container">
            <ul id="ToutesLesNotifications">
                <?php
                $sql = "SELECT * FROM notifications ORDER BY date DESC";

                $resultat=mysqli_query($mysqli, $sql);

                while ($data = mysqli_fetch_assoc($resultat)) {
                    $ID_event = isset($data['ID_event'])? $data['ID_event'] : null; ;
                    $ID_post = isset($data['ID_post']) ? $data['ID_post'] : null;
                    $ID_emplois = isset($data['ID_emplois']) ? $data['ID_emplois'] : null;
                    $etat =$data['etat'];

                    // Appliquer un style différent en fonction de l'état
                    $style = ($etat === "YES") ? 'background-color: #FFF;' : '';

                    if ($ID_event !== NULL) {
                        echo '<a href="etat.php?id=' . $data['ID_event'] . '" style="text-decoration: none; color:inherit;">';

                        echo '<li class="notification" . style="' . $style . '">';

                        // Récupérer les informations de l'événement depuis la table evenements
                        $event_info_result = mysqli_query($mysqli, "SELECT e.descriptions, e.type, e.date, u.nom, u.prenom, u.photo FROM evenements e JOIN utilisateurs u ON e.ID_createur = u.ID WHERE e.ID_event='$ID_event' ORDER BY e.date DESC");
                        $event_info_data = mysqli_fetch_assoc($event_info_result);

                        if ($event_info_data !== null) {
                            // Partie gauche (texte)
                            echo '<div class="content-left">';
                            echo '<p><strong>Type d\'événement :</strong> ' . $event_info_data['type'] . '</p>';
                            echo '<p><strong>Événement :</strong> ' . $event_info_data['descriptions'] . '</p>';
                            echo '<p><strong>Publié par :</strong> ' . $event_info_data['prenom'] . ' ' . $event_info_data['nom'] . '<strong>  ----> Le : </strong>' . $event_info_data['date'] . '</p>';
                            echo '</div>';

                            // Partie droite (photo)
                            echo '<div class="content-right">';
                            echo '<img src="' . $event_info_data['photo'] . '" alt="Photo de l\'utilisateur" width="130" height="130">';
                            echo '</div>';
                        } else{

                        }

                        echo '</li>';

                        echo '</a>';

                    }


                    else if($ID_post!==NULL){
                        echo '<a href="etat.php?id=' . $data['ID_post'] . '" style="text-decoration: none; color:inherit;">';

                        echo '<li class="notification" . style="' . $style . '">';

                        // Récupérer les informations de la publication depuis la table publications
                        $post_info_result = mysqli_query($mysqli, "SELECT p.descriptions, p.lieu, p.date, u.nom, u.prenom, u.photo FROM publications p JOIN utilisateurs u ON p.ID_createur = u.ID WHERE p.ID_publication='$ID_post' ORDER BY p.date DESC");
                        $post_info_data = mysqli_fetch_assoc($post_info_result);

                        // Partie gauche (texte)
                        echo '<div class="content-left">';
                        if ($post_info_data !== null) {
                            echo '<p><strong>Lieu:</strong> ' . $post_info_data['lieu'] . '</p>';
                            echo '<p><strong>Événement :</strong> ' . $post_info_data['descriptions'] .  '</p>';
                            echo '<p><strong>Publié par :</strong> ' . $post_info_data['prenom'] . ' ' . $post_info_data['nom'] .' '.'<strong>  ----> Le : </strong>'. $post_info_data['date']. '</p>';
                        } else {

                        }

                        echo '</div>';

                        // Partie droite (photo)
                        echo '<div class="content-right">';
                        if ($post_info_data !== null) {
                            echo '<img src="' . $post_info_data['photo'] . '" alt="Photo de l\'utilisateur" width="130" height="130">';
                        }
                        echo '</div>';

                        echo '</li>';

                        echo '</a>';

                        }


                    else if($ID_emplois!==NULL){
                        echo '<a href="etat.php?id=' . $data['ID_emplois'] . '" style="text-decoration: none; color:inherit;">';

                        echo '<li class="notification" . style="' . $style . '">';

                        // Récupérer les informations de l'emploi' depuis la table emplois
                        $event_info_result = mysqli_query($mysqli, "SELECT type, commentaire, lieu, date FROM emplois WHERE ID_emplois='$ID_emplois'");
                        $event_info_data = mysqli_fetch_assoc($event_info_result);

                        // Partie gauche (texte)
                        echo '<div class="content-left">';
                        if ($event_info_data !== null) {
                            echo '<p><strong>Type : </strong>'. $event_info_data['type'].' '.'<strong> ----> Lieu: </strong> ' . $event_info_data['lieu'].'</p>';
                            echo '<p><strong>Emploi : :</strong> ' . $event_info_data['commentaire'] .  '</p>';
                            echo '<p><strong> Publié le : </strong>'. $event_info_data['date'].'</p>';
                            echo '</div>';
                        } else {
                            // Gérer le cas où $event_info_data est null (par exemple, afficher un message d'erreur)
                        }

                        // Partie gauche (photo)
                        echo '<div class="content-right">';
                        echo '<img src="cloche.png" alt="Photo de cloche" width="130" height="130">';
                        echo '</div>';

                        echo '</li>';

                        echo '</a>';

                    }

                }


                // Fermer la connexion à la base de données
                $mysqli->close();
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
