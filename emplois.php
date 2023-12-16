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







//PHP de l'accueil//


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







//PHP de emploi//

// Inclure le fichier.php de filtrage d'emplois
include('filtrer.php');




// Inclure le fichier.php de l'ajout d'emplois
include('ajouter.php');





// Récupérer toutes les emplois
$tousLesEmplois = TOUSlesemplois($mysqli);





//Traitement des formulaire d'ajout et de filtrage
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Traiter les formulaires de filtre SI celui-ci est remplis
    if (isset($_POST["Filtrer"])) {
        // Traitement du filtrage des emplois
        $type = $_POST["ChoixDuType"];
        $lieu = $_POST["ChoixDuLieu"];

        // Appeler la fonction pour filtrer les emplois
        $tousLesEmplois = filtrerEmplois($mysqli, $type, $lieu);



    // Traiter les formulaires d'ajout SI celui-ci est remplis
    } elseif (isset($_POST["Ajouter"])) {
        // Traitement de l'ajout d'un emploi
        $nouveauType = $_POST["NouveauType"];
        $nouveauLieu = $_POST["NouveauLieu"];
        $nouveauCommentaire = $_POST["NouveauCommentaire"];


        // Appeler la fonction pour ajouter un emploi
        $ajoutReussi = ajouterEmploi($mysqli, $nouveauType, $nouveauLieu, $nouveauCommentaire);


        // Rafraîchir la liste des emplois
        $tousLesEmplois = TOUSlesemplois($mysqli);
    }
}




// Fermer la connexion à la base de données
$mysqli->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="emplois.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
    <title> Emplois </title>
    <link rel="stylesheet" href="emplois.css">



    <!--Partie java script permettant de faire apparaitre une fenêtre lorsque l'on clique que un emploi-->
    <!--Source : https://www.youtube.com/watch?v=XeY0Vvid1VU&ab_channel=Believemy-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            var Elementmodal = document.getElementById("modal");
            var ElementmodalOverlay = document.getElementById("modal-overlay");


            // Sélectionnez tous les liens qui affichent les détails
            var LienafficherDetails = document.querySelectorAll(".offre-emploi a");


            // Associez un gestionnaire d'événements à chaque lien
            LienafficherDetails.forEach(function (link) {
                link.addEventListener("click", function (event) {
                    event.preventDefault();

                    // Affichez la modale avec le même message pour tous les emplois
                    afficherModale();
                });
            });

            document.addEventListener("DOMContentLoaded", () => {
                const boutonsSupprimer = document.querySelectorAll(".offre-emploi button");

                boutonsSupprimer.forEach(boutonSupprimer => {
                    boutonSupprimer.addEventListener("click", async event => {
                        event.preventDefault();

                        const emploiId = boutonSupprimer.getAttribute("data-id");

                        try {
                            const response = await fetch("supp_emploi.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: `emploi_id=${emploiId}&supprimer=1`
                            });

                            if (response.ok) {
                                window.location.href = 'emplois.php';
                            } else {
                                console.error('Erreur lors de la suppression de l\'emploi.');
                            }
                        } catch (error) {
                            console.error('Erreur lors de la suppression de l\'emploi.', error);
                        }
                    });
                });
            });


            function afficherModale() {
                console.log("Affichage de la modale");
                Elementmodal.style.display = "block";
                ElementmodalOverlay.style.display = "block";
            }

            //Fermeture de la boîte modale
            document.getElementById("modal-close").addEventListener("click", function () {
                // Fermez la boîte modale
                Elementmodal.style.display = "none";
                ElementmodalOverlay.style.display = "none";
            });
        });
    </script>
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

            <a href="vous.html" style='text-decoration: none;'> <!-- lien vers vous -->
                <img src="bouton_vous_0.png"
                     alt="vous"
                     width="150"
                     height=""/>
            </a>

            <a href="notification.php" style='text-decoration: none;'> <!-- lien vers notifications -->
                <img src="bouton_notification_0.png"
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
                <img src="bouton_emplois_1.png"
                     alt="emplois"
                     width="150"
                     height=""/>
            </a>

        </div>




<!--------------------------------------------------------------------------------------------------------------------->



        <!-- Partie pour la page emploi -->


        <div id="Blocblanc">
            <div id="BLOCRECHERCHE">
                <div id="Blocfiltre">
                    <h2 class="cadreTitre"> Filtrer :</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <!-- Différent type d'emploi-->
                        <label for="TypeDeEmplois"> Type d'emploi : </label>
                        <select id="TypeDeEmplois" name="ChoixDuType">
                            <option value="0"> Tous les emplois</option>
                            <option value="Stage"> Stage</option>
                            <option value="CDD"> CDD</option>
                            <option value="CDI"> CDI</option>
                            <option value="Apprentissage"> Apprentissage</option>
                        </select>

                        <br><br>


                        <!-- Différent lieux -->
                        <label for="LieuDeEmplois"> Localisation : </label>
                        <select id="LieuDeEmplois" name="ChoixDuLieu">
                            <option value="0">Tous les lieux</option>
                            <option value="ECE Paris">ECE Paris</option>
                            <option value="Omnes Education">Omnes Education</option>
                            <option value="Londre">Londre</option>
                            <option value="Genève">Genève</option>
                            <option value="Monaco">Monaco</option>
                            <option value="San Francisco">San Francisco</option>
                            <option value="Abidjan">Abidjan</option>
                            <option value="Barcelone">Barcelone</option>
                            <option value="Entreprises Françaises">Entreprises Françaises</option>
                            <option value="Entreprises de l'Union européenne">Entreprises de l'Union européenne</option>
                        </select>

                        <br><br>

                        <button type="submit" name="Filtrer">Filtrer</button>
                    </form>
                </div>


                <br> <br> <br> <br> <br> <br><br>


                <div id="BlocAjoute">
                    <!-- Laisser à l'utilisateur le choix d'ajouter un emploi -->
                    <form id="AjouterUnEmploi" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h2 class="cadreTitre"> Ajouter un emploi :</h2>
                        <label for="NouveauType">Nouveau Type d'emploi :</label>
                        <select id="NouveauType" name="NouveauType">
                            <option value="Stage">Stage</option>
                            <option value="Apprentissage">Apprentissage</option>
                            <option value="CDD">CDD</option>
                            <option value="CDI">CDI</option>
                        </select>

                        <br> <br>

                        <label for="NouveauLieu">Nouvelle Localisation :</label>
                        <select id="NouveauLieu" name="NouveauLieu">
                            <option value="ECE Paris">ECE Paris</option>
                            <option value="Omnes Education">Omnes Education</option>
                            <option value="Londre">Londre</option>
                            <option value="Genève">Genève</option>
                            <option value="Monaco">Monaco</option>
                            <option value="San Francisco">San Francisco</option>
                            <option value="Abidjan">Abidjan</option>
                            <option value="Barcelone">Barcelone</option>
                            <option value="Entreprises Françaises">Entreprises Françaises</option>
                            <option value="Entreprises de l'Union européenne">Entreprises de l'Union européenne</option>
                        </select>

                        <br> <br>

                        <label for="NouveauCommentaire">Commentaire :</label>
                        <input type="text" id="NouveauCommentaire" name="NouveauCommentaire">

                        <br> <br>

                        <button type="submit" name="Ajouter">Ajouter un emploi</button>
                    </form>
                </div>
            </div>

            <!-- Emplois déjà ajoutés -->
            <div id="TousLesEmploisContainer" class="scrollable-container">
                <ul id="TousLesEmplois">
                    <!--La fonction foreach va permettre de parcourir les emplois de "tousLesEmplois" et l'affecte à la variable "emploi" à chaque itération-->
                    <?php foreach ($tousLesEmplois as $emploi): ?>
                        <div class="offre-emploi">
                            <h3>
                                <!--On affiche le titre de l'emploi qui représente un lien vers la fenêtre modal-->
                                <a href="#" id="<?php echo isset($emploi["id"]) ? $emploi["id"] : ''; ?>">
                                    <?php echo isset($emploi["commentaire"]) ? $emploi["commentaire"] : ''; ?>
                                </a>
                            </h3>
                            <p>
                                <strong>Type:</strong>
                                <?php echo isset($emploi["type"]) ? $emploi["type"] : ''; ?> -
                                <strong>Lieu:</strong>
                                <?php echo isset($emploi["lieu"]) ? $emploi["lieu"] : ''; ?>
                            </p>
                            <?php
                            $emploi_id = $emploi["ID_emplois"];
                            if($admin === 'YES'){
                                echo "<button onclick='openPopup()'>Supprimer l'emploi</button>

                            <div id='overlay'></div>
                
                            <div id='popup'>
                                <p>Voulez-vous vraiment supprimer votre compte ?</p>
                                <button id='yesBtn' onclick='redirectToPage($emploi_id)'>Supprimer</button>
                                <button id='noBtn' onclick='closePopup()'>Non</button></div>";
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>



    <!--Faire apparaitre la fenêtre lorsque l'emplois est appuyé-->
    <div id="modal" class="modal">
        <span id="modal-close" class="modal-close">&times;</span>
        <h3>Détails de l'emploi</h3>
        <h3>Vous êtes intéressé par cet emploi ?</h3>
        <p>Appellez au : 02 45 96 87 **</p>
    </div>

    <div id="modal-overlay" class="modal-overlay"></div>


    
    <!-- Copyright -->
    <div id="copy">
        <p>
            &copy; 2023 ECE In. Tous droits réservés.
        </p>
    </div>
</body>
</html>
