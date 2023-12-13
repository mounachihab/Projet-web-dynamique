
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
$id_publication = isset($_GET["id"]) ? $mysqli->real_escape_string($_GET["id"]) : "";
$coeur = isset($_GET["coeur"]) ? $mysqli->real_escape_string($_GET["coeur"]) : "";

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

// recuperer les donners pour les afficher :
$resultat = $mysqli->query("SELECT COUNT(ID) FROM utilisateurs");
$data = $resultat->fetch_assoc();
$nbr_membres = $data['COUNT(ID)'] ;

$resultat = $mysqli->query("SELECT ID_createur FROM publications WHERE ID_publication=$id_publication");
$data = $resultat->fetch_assoc();
$id_publieur = $data['ID_createur'] ;

// Les infos lié à la publication :
$resultat1 = $mysqli->query("SELECT photo FROM utilisateurs where ID='$id_publieur'");
$data1 = $resultat1->fetch_assoc();
$photo_publieur = $data1['photo'] ;

// Les infos lié à la publication :
$resultat = $mysqli->query("SELECT prenom FROM utilisateurs where ID='$id_publieur'");
$data = $resultat->fetch_assoc();
$prenom_publieur = $data['prenom'] ;

// Les infos lié à la publication :
$resultat = $mysqli->query("SELECT nom FROM utilisateurs where ID='$id_publieur'");
$data = $resultat->fetch_assoc();
$nom_publieur = $data['nom'] ;

// Les infos lié à la publication :
$resultat = $mysqli->query("SELECT date FROM publications where ID_publication=$id_publication");
$data = $resultat->fetch_assoc();
$date_publication= $data['date'] ;

// Les infos lié à la publication :
$resultat = $mysqli->query("SELECT lieu FROM publications where ID_publication=$id_publication");
$data = $resultat->fetch_assoc();
$lieu_publication = $data['lieu'] ;

// Les infos lié à la publication :
$resultat = $mysqli->query("SELECT photo FROM publications where ID_publication=$id_publication");
$data = $resultat->fetch_assoc();
$photo_publication = $data['photo'] ;

// Les infos lié à la publication :
$resultat = $mysqli->query("SELECT COUNT(ID_likeur) FROM likes WHERE ID_publication = $id_publication");
$data = $resultat->fetch_assoc();
$like = $data['COUNT(ID_likeur)'] ;

$resultat = $mysqli->query("SELECT descriptions FROM publications where ID_publication=$id_publication");
$data = $resultat->fetch_assoc();
$description = $data['descriptions'] ;

$resultat = $mysqli->query("SELECT admin FROM informations where ID='$id'");
$data = $resultat->fetch_assoc();
$admin = $data['admin'] ;


?>

<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publication.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
    <script type="text/javascript" src="accueil.js"></script>
    <title>ECE In - Publication</title>
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
        <h2>ECE In - Publication</h2>
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
            <img src="boutons/bouton_messagerie_0.png"
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

    <div id="bloc">
        <div id="personne">
            <a href="pp_ami.php?id=<?php echo $id_publieur; ?>">
                <img style="border: 1px solid black;border-radius: 10px;" src="<?php echo $photo_publieur; ?>" width="50" alt="publication"/>
            </a>


            <div id="info">
                <?php
                echo $prenom_publieur;
                echo "&nbsp" ;
                echo $nom_publieur;
                ?>

                <br>
                <?php
                echo "<i style='font-size: 13px'>" ;
                echo "Le " ;

                $date = new DateTime($date_publication);
                $format = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                $date_affich = $format->format($date->getTimestamp());

                echo $date_affich;
                echo " à " ;
                echo $lieu_publication;
                echo "</i>" ;
                ?>

                <?php
                if($admin === 'YES'){
                    echo "<button onclick='openPopup()'>Supprimer la pulication</button>

                        <div id='overlay'></div>
                        
                        <div id='popup'>
                            <p>Voulez-vous vraiment supprimer cette pulication ?</p>
                            <button id='yesBtn' onclick='redirectToPage($id_publication,1)'>Supprimer</button>
                            <button id='noBtn' onclick='closePopup()'>Non</button>
                        </div>";
                }
                ?>

            </div>

        </div>

        <hr/>

        <div id="photo">
            <img src="<?php echo $photo_publication; ?>" height="450" alt="publication"/>
            <br>
            <?php echo $description; ?>
        </div>

        <hr/>

        <div id="action">

            <a href="ajouter_like2.php?id=<?php echo $id_publication; ?>&etat=<?php echo $coeur; ?>">
                <img id="position" src="<?php echo $coeur; ?>" height="60" alt="coeur"/>
            </a>
            &nbsp
            <?php echo $like ?>

            <div id="mon_comm">
                <a href="pp_ami.php?id=<?php echo $id; ?>"> <img style="border: 1px solid black;border-radius: 10px;" src="<?php echo $photo; ?>" height="40" alt="publication"/> </a>

            </div>
            <?php
            echo "<form action='ajout_commentaire.php?publi=" . $id_publication . "&id=" . $id_publication . "&coeur=" . $coeur . "' method='post'>
        <input name='commentaire' placeholder='Votre commentaire' required maxlength='200'>  
      </form>";
            ?>

        </div>

    <hr/>
        <div id="commentaire">
            <?php
            $sql = "SELECT comm,ID FROM commentaires WHERE ID_publication = $id_publication GROUP BY ID_comm DESC";
            $result = $mysqli->query($sql);

            // Affichage des événements
            while ($row = $result->fetch_assoc()) {
                echo "<div id='comm2'>";
                $id_commentateur = $row['ID'] ;
                $resultat = $mysqli->query("SELECT photo FROM utilisateurs where ID= $id_commentateur");
                $data = $resultat->fetch_assoc();
                $pp_profil_comm = $data['photo'] ;

                echo "<a href='pp_ami.php?id=$id_commentateur'> <img style='border: 1px solid black;border-radius: 10px;' src='" . $pp_profil_comm . "' height='50' alt='photo de prfl'/> </a>";
                echo "<div id='encadrement'>";
                echo $row['comm'] ;

                echo "<br>";

                $resultat = $mysqli->query("SELECT ID_comm FROM commentaires where ID=$id_commentateur AND ID_publication=$id_publication");
                $data = $resultat->fetch_assoc();
                $id_comm = $data['ID_comm'] ;


                echo "</div>";
                if($admin === 'YES'){
                    echo "<button onclick='openPopup2()'>Supprimer le commentaire</button>

                        <div id='overlay2'></div>
                        
                        <div id='popup2'>
                            <p>Voulez-vous vraiment supprimer ce commentaire ?</p>
                            <button id='yesBtn2' onclick='redirectToPage2($id_comm,4)'>Supprimer</button>
                            <button id='noBtn2' onclick='closePopup2()'>Non</button>
                        </div>";
                }


                echo "</div>";
                echo "<br>";
            }
            ?>
        </div>
    </div>

</div>

<div id="test">

</div>

<!-- Copyright -->
<div id="copy">
    <p>
        &copy; 2023 ECE In. Tous droits réservés.
    </p>
</div>
</body>
</html>
<?php
