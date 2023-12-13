
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

// recuperer les donners pour les afficher :
$resultat = $mysqli->query("SELECT nom FROM utilisateurs WHERE ID = '$id'");
$data = $resultat->fetch_assoc();
$nom = $data['nom'] ;

$resultat = $mysqli->query("SELECT prenom FROM utilisateurs WHERE ID = '$id'");
$data = $resultat->fetch_assoc();
$prenom = $data['prenom'] ;

$resultat = $mysqli->query("SELECT date FROM informations WHERE ID = '$id'");
$data = $resultat->fetch_assoc();
$date = $data['date'] ;

$resultat = $mysqli->query("SELECT civilite FROM informations WHERE ID = '$id'");
$data = $resultat->fetch_assoc();
$civic = $data['civilite'] ;

$resultat = $mysqli->query("SELECT email FROM utilisateurs WHERE ID = '$id'");
$data = $resultat->fetch_assoc();
$email = $data['email'] ;

// recuperer les donners pour les afficher :
$resultat = $mysqli->query("SELECT COUNT(ID) FROM utilisateurs");
$data = $resultat->fetch_assoc();
$nbr_membres = $data['COUNT(ID)'] ;

if($date === "NULL") {
    $date = 'YYYY';
}
?>

<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reglages.css">
    <script type="text/javascript" src="reglages.js"></script>
    <title>ECE In - Réglages</title>
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
            <h2>ECE In - Vos réglages</h2>
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

        <!-- Partie du bloc pour modifier les info de bases -->
        <div id="bloc_information">
            <h3>
                Informations de base
            </h3>

            <form action="changement_infos.php" method="post">

                <label for="nom">Nom :</label>
                <br>
                <input type="text" id="nom" name="nom" placeholder="<?php echo $nom;?>">

                <br>
                <br>

                <label for="prenom">Prénom :</label>
                <br>
                <input type="text" id="prenom" name="prenom" placeholder="<?php echo $prenom;?>">

                <br>
                <br>

                <label for="date">Année de naissance :</label>
                <br>
                <input type="number" id="date" name="date" placeholder="<?php echo $date;?>" min="1910" max="2023" maxlength="4">

                <br>
                <br>

                <label for="civilite">Civilité :</label>
                <br>
                <select name="civilite" id="civilite">
                    <option value="NULL"> <?php echo $civic; ?> </option>
                    <option value="Mme">Mme</option>
                    <option value="Mr">Mr</option>
                </select>

                <br>
                <br>

                <input type="submit" value="Enregistrer">
            </form>
        </div>

        <!-- Partie du bloc pour les questions -->
        <div id="bloc_question">
            <h3>
                Questions pour la récupération du mot de passe
            </h3>

            <form action="changement_question.php" method="post">

                <label for="question">Questions :</label>
                <br>
                <select name="question" id="question">
                    <option value="Q1">Le nom de jeune fille de votre mère ?</option>
                    <option value="Q2">Le nom de votre première peluche ?</option>
                    <option value="Q3">Le nom de votre premier animal de compagnie ?</option>
                </select>

                <br>
                <br>

                <label for="reponse">Réponse</label>
                <br>
                <input type="text" id="reponse" name="reponse" required>

                <br><br>

                <input type="submit" value="Enregistrer">
            </form>
        </div>

        <!-- Partie du bloc pour modifier l'email -->
        <div id="bloc_email">
            <h3>
                Modification de votre email
            </h3>

            <form action="changement_email.php" method="post">

                <input type="email" id="email" name="email" placeholder="<?php echo $email;?>" required>

                <br>
                <br>

                <input type="submit" value="Enregistrer">

            </form>

        </div>

        <!-- Partie du bloc pour modifier le mot de passe -->
        <div id="bloc_mdp">
            <h3>
                Modification de votre mot de passe
            </h3>

            <form action="changement_mdp.php" method="post">

                <input type="password" id="password" name="password" placeholder="Votre nouveau mot de passe" required>

                <br>
                <br>

                <input type="submit" value="Enregistrer">

            </form>
        </div>

        <!-- Partie du bloc pour supprimer à vie le compte -->
        <div id="bloc_supprimer">
            <h3>
                Supprimer votre compte
            </h3>
            <p>
                Si vous désirez supprimer votre compte de manière totale et définitive, appuyez sur le bouton qui suit.
            </p>

        <button onclick="redirigerVersPage()"> Supprimer mon compte </button>

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
