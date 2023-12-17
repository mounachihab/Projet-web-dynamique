 <?php
error_reporting(E_ALL);

ini_set("display_errors", 1);
session_start(); // Démarre la session

// Identifier le nom de base de données
$database = "ece";
//connexion bdd
$db_handle = mysqli_connect("localhost", "root", "root");
$db_found = mysqli_select_db($db_handle, $database);

// Vérifiez la connexion à la base de données
if (!$db_found) {
    echo "Database not found";
    // Fermer la connexion
    mysqli_close($db_handle);
    exit;
}


// Accéder aux informations sur l'utilisateur
$user_name = $_SESSION['user_name'];
$id = $_SESSION['id'];
$photo = $_SESSION['photo'];
// recuperer les donners pour les afficher :
$resultat = mysqli_query($db_handle,"SELECT COUNT(ID) FROM utilisateurs"); //elise doit remplacer db_handle par mysqli
$data = mysqli_fetch_assoc($resultat);
$nbr_membres = $data['COUNT(ID)'] ;

if ($user_name == '') {
    header('Location: connexion.html');
    exit() ;
}

//pr les utilisateurs
$sql="SELECT * FROM utilisateurs WHERE ID=$id";
$result = mysqli_query($db_handle, $sql);
// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result) {
    echo "Erreur lors de l'exécution de la requête utilisateurs : " . mysqli_error($db_handle);
    exit;
}


$utilisateur = mysqli_fetch_assoc($result);
$nom = $utilisateur['nom'];
$prenom = $utilisateur['prenom'];
$email = $utilisateur['email'];
$mdp = $utilisateur['mdp'];
$photo = $utilisateur['photo'];
$description=$utilisateur['description'];


//pr le statut
$sql_statut="SELECT * FROM statut WHERE ID=$id";
$result_statut = mysqli_query($db_handle, $sql_statut);
$statut = mysqli_fetch_assoc($result_statut);
$tonstatut = $statut['tonstatut'];

// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result_statut) {
    echo "Erreur lors de l'exécution de la requête statut: " . mysqli_error($db_handle);
    exit;
}

//pr les evenements 
$sql_evenements="SELECT * FROM evenements where ID_createur=$id";
$result_evenements = mysqli_query($db_handle, $sql_evenements);
$evenements = mysqli_fetch_assoc($result_evenements);
// Accéder aux informations de l'événement en vérifiant si la clé existe
$type_event = isset($evenements['type_event']) ? $evenements['type_event'] : null;
$lieu_event = isset($evenements['lieu_event']) ? $evenements['lieu_event'] : null;
$commentaire_event = isset($evenements['commentaire_event']) ? $evenements['commentaire_event'] : null;
$photo_event = isset($evenements['photo_event']) ? $evenements['photo_event'] : null;
$date_event = isset($evenements['date_event']) ? $evenements['date_event'] : null;
$date_irl_event = isset($evenements['date_irl_event']) ? $evenements['date_irl_event'] : null;
$etat_event = isset($evenements['etat_event']) ? $evenements['etat_event'] : null;


//pr les publications
 
$sql_publications="SELECT * FROM publications where ID_createur=$id";
$result_publications = mysqli_query($db_handle, $sql_publications);
// Accéder aux informations de la publication en vérifiant si la clé existe
$lieu_publications = isset($row_publications['lieu_publications']) ? $row_publications['lieu_publications'] : null;
$date_publications = isset($row_publications['date_publications']) ? $row_publications['date_publications'] : null;
$heure_publications = isset($row_publications['heure_publications']) ? $row_publications['heure_publications'] : null;
$commentaire_publications = isset($row_publications['commentaire_publications']) ? $row_publications['commentaire_publications'] : null;
$photo_publications = isset($row_publications['photo_publications']) ? $row_publications['photo_publications'] : null;
//$pv_public_publications=$publications['pv_public_publications'];




/*    $sql_file = "mouna.sql";

// Lire le contenu du fichier SQL
$sql_content = file_get_contents($sql_file);


// Exécuter la requête SQL
$result_create_table = mysqli_multi_query($db_handle, $sql_content);

// Vérifier si la requête a réussi
if (!$result_create_table) {
    echo "Erreur lors de la création de la table formations : " . mysqli_error($db_handle);
    exit;
}*/


?>

<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vous.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>

    <script type="text/javascript" src="vous.js" defer></script>
    <title>ECE In - Votre profil</title>
</head>


<body>
    <!-- Partie du logo -->
    <div id="banderole">
        <div id="logo">
            <img src="logo.png"
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
                <img src="bouton_reglages.png"
                     alt="reglages"
                     width="54"
                     height=""/>
            </a>

            <a href="connexion.php">
                <img src="bouton_deconnexion.png"
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
            <a href="accueil.php">
                <img src="bouton_accueil_0.png"
                                 alt="accueil"
                                 width="150"
                                 height=""/>
            </a>

            <a href="monreseau.php">
                <img src="bouton_mon_reseau_0.png"
                     alt="mon resau"
                     width="150"
                     height=""/>
            </a>

            <a href="vous.php">
                <img src="bouton_vous_1.png"
                     alt="vous"
                     width="150"
                     height=""/>
            </a>

            <a href="notification.php">
                <img src="bouton_notification_0.png"
                     alt="notifications"
                     width="150"
                     height=""/>
            </a>

            <a href="messagerie.php">
                <img src="bouton_messagerie_0.png"
                     alt="messagerie"
                     width="150"
                     height=""/>
            </a>

            <a href="emplois.php">
                <img src="bouton_emplois_0.png"
                                 alt="emplois"
                                 width="150"
                                 height=""/>
            </a>


        </div>
        <!--pr la page avec photo nom prenom etc -->
        <div id="pagephoto" >
            <div id="conteneurPhotos">
                <h2> Votre profil :</h2>
                <div id="hautpagephoto">
                    
                    <img id="profilphoto" src="<?php echo $photo; ?>" alt="Photo de profil"  style="border-radius: 10px;">
                    <div id="infos">
                        <div class="prenom"><?php echo $prenom  ?></div> 
                        <div class="nom"><?php echo $nom  ?></div> 
                        <div class="email"><?php echo $email ; ?></div>
                        <div class="description"><?php echo $description ; ?>
                            <button onclick="afficherFormulaire()">Modifier</button>

                        <form id="formulaireModification" method="post" action="modifier_description_utilisateur.php" style="display: none;">
                            <label for="nouvelleDescription">Nouvelle description :</label>
                            <input type="text" id="nouvelleDescription" name="nouvelleDescription" required>
                            <button type="submit">Envoyer</button>
                        </form>
                        </div>


                        <button onclick="afficherFormulaire()">Modifier votre photo</button>

                        <form id="formulaireModification" method="post" action="modifier_photo_utilisateur.php" enctype="multipart/form-data" style="display: none;">
                            <input type="file" name="nouvelle_photo" accept=".jpg, .jpeg">
                            <button type="submit">Envoyer</button>
                        </form>
                    </div>

                </div>
                <div id="statut">
                    <h3>Votre statut :</h3><br>
                    <?php echo $tonstatut  ?>
                    <button onclick="toggleStatutForm()">Modifier votre statut </button>
                    <!-- Formulaire de modification du statut -->
                    <form id="champ_statut" name="form_statut" method="post" action="ajouter_statut.php" style="display: none;">
                        <input type="hidden" name="statut_form_submit" value="1">
                        
                            <label for="nouveau_statut"></label>
                            <input type="text" name="nouveau_statut" id="nouveau_statut" placeholder="Nouveau statut">
                            <button type="submit" onclick="soumettreStatutForm()">Soumettre</button>

                    </form>     
                            
                    
                </div>



                <div id="publication">
                    <h3>Vos publications :</h3>
                    <div id="blocsPub">
                        <div id ="blocpubligauche">
                            Vos évènements :
                            <button onclick="toggleformevenement()">Ajouter un événement</button>

                                <form id="ajouterevenementform"  name="evenformulaire" method="post" action="ajouter_evenement.php" style="display: none;" enctype="multipart/form-data" >
                                    <input type="hidden" name="evenements_form_submit" value="1">
                                    <table>
                                        <tr>
                                            <td><label for="type_event">Type: </label></td>
                                            <td><input type="text" id="type_event" name="type_event"></td>
                                        </tr>    

                                        <tr>
                                            <td><label for="lieu_event">Lieu: </label></td>
                                            <td><input type="text" id="lieu_event" name="lieu_event"></td>
                                        </tr>    

                                        <tr>

                                            <td><label for="commentaire_event">Commentaire: </label></td>
                                            <td><textarea id="commentaire_event" name="commentaire_event"></textarea></td>


                                        </tr>    

                                        <tr>
                                            <td><label for="photo_event">Photo: </label></td>
                                            <td><input type="file" id="photo_event" name="photo_event" ></td>
                                        </tr> 

                                        <tr>    
                                            <td><label for="date_event">Date: </label></td>
                                            <td><input type="date" id="date_event" name="date_event"></td>

                                        </tr> 

                                        <tr>
                                            <td>Visibilité:</td>
                                            <td>
                                                <div id="visibilite">
                                                    <input type="hidden" id="etat_event" name="etat_event" value="PUBLIC">

                                                    <label><input type="radio" name="etat_event" value="public" onclick="choisirVisibilite('public')">Public</label>
                                                    <label><input type="radio" name="etat_event" value="prive" onclick="choisirVisibilite('prive')">Privé</label>

                                                    <!-- Boutons radio masqués -->
                                                    <!--<label style="display: none;"><input type="radio" name="etat_event" value="public" id="publicBtn_' . $row['ID_event'] . '">Public</label>
                                                    <label style="display: none;"><input type="radio" name="etat_event" value="prive" id="priveBtn_' . $row['ID_event'] . '">Privé</label>-->
                                                </div>
                                            </td>
                                        </tr>        
                                        

                                        </table>   
                                        <button type="submit" onclick="soumettreformevenement()">Poster</button>
                                    </form>
                            <div id="descriptionphoto">
                                <br>
                                 <?php
                                    // Affichage des événements existants si le bouton "Ajouter un événement" n'est pas cliqué
                                    if (!isset($_POST['ajouterevenementform'])) {
                                        $resultats = mysqli_query($db_handle, "SELECT * FROM evenements WHERE ID_createur = '$id'");
                                        while ($row = mysqli_fetch_assoc($resultats)) {
                                            echo '<div class="evenement">';
                                            echo '<img src="' . $row['photo_event'] . '" alt="Événement" width="300">';
                                            // Affichage du lieu avec le bouton "Modifier"
                                            echo '<p class="info"><strong>Lieu:</strong> ' . $row['lieu_event'];
                                            echo '<button onclick="afficherFormulaire(\'lieu_event\', ' . $row['ID_event'] . ')">Modifier</button>';
                                            echo '<form id="form_lieu_event_' . $row['ID_event'] . '" method="post" action="modifier_champ_event.php" style="display: none;">';
                                            echo '<input type="hidden" name="champ" value="lieu_event">';
                                            echo '<input type="hidden" name="ID_event" value="' . $row['ID_event'] . '">';
                                            echo '<input type="text" name="nouvelle_valeur" placeholder="Nouveau lieu">';
                                            echo '<button type="submit">Envoyer</button>';
                                            echo '</form>';

                                            // Affichage de la date avec le bouton "Modifier"
                                            echo '<p class="info"><strong>Date de l évènement:</strong> ' . $row['date_event'];
                                            echo '<button onclick="afficherFormulaire(\'date_event\', ' . $row['ID_event'] . ')">Modifier Date</button>';
                                            echo '<form id="form_date_event_' . $row['ID_event'] . '" method="post" action="modifier_champ_event.php" style="display: none;">';
                                            echo '<input type="hidden" name="champ" value="date_event">';
                                            echo '<input type="hidden" name="ID_event" value="' . $row['ID_event'] . '">';
                                            echo '<input type="date" name="nouvelle_valeur">';
                                            echo '<button type="submit">Envoyer</button>';
                                            echo '</form>';

                                            // Affichage du type avec le bouton "Modifier"
                                            echo '<p class="info"><strong>Type:</strong> ' . $row['type_event'];
                                            echo '<button onclick="afficherFormulaire(\'type_event\', ' . $row['ID_event'] . ')">Modifier Type</button>';
                                            echo '<form id="form_type_event_' . $row['ID_event'] . '" method="post" action="modifier_champ_event.php" style="display: none;">';
                                            echo '<input type="hidden" name="champ" value="type_event">';
                                            echo '<input type="hidden" name="ID_event" value="' . $row['ID_event'] . '">';
                                            echo '<input type="text" name="nouvelle_valeur" placeholder="Nouveau type">';
                                            echo '<button type="submit">Envoyer</button>';
                                            echo '</form>';

                                            // Affichage commentaire avec le bouton "Modifier"
                                            echo '<p class="info"><strong>Commentaire:</strong> ' . $row['commentaire_event'];
                                            echo '<button onclick="afficherFormulaire(\'commentaire_event\', ' . $row['ID_event'] . ')">Modifier Commentaire</button>';
                                            echo '<form id="form_commentaire_event_' . $row['ID_event'] . '" method="post" action="modifier_champ_event.php" style="display: none;">';
                                            echo '<input type="hidden" name="champ" value="commentaire_event">';
                                            echo '<input type="hidden" name="ID_event" value="' . $row['ID_event'] . '">';
                                            echo '<textarea name="nouvelle_valeur" placeholder="Nouveau commentaire"></textarea>';
                                            echo '<button type="submit">Envoyer</button>';
                                            echo '</form>';

                                            //affichage de la date et l heure de l event
                                            echo '<p class="info"><strong>Publié le :</strong> ' . date("d/m/Y", strtotime($row['date_irl_event'])) . ' à ' . date("H:i", strtotime($row['heure_irl_event'])) . '</p>';

                                            
                                            
                                            echo '<form method="post" action="supprimer_photo.php">';
                                            echo '<input type="hidden" name="ID_event" value="' . $row['ID_event'] . '">';
                                            echo '<button type="submit" class="supprimer-button">Supprimer l évènement</button>';
                                            echo '</form>';
                                            echo '<form>';
                                            echo '<input type="hidden" name="ID_event" value="' . $row['ID_event'] . '">';
                                           
                                            //echo '<button class="parametres-button" onclick="afficherParametres(' . $row['ID_event'] . ')" type="button">Paramètres de l évènement</button>';

                                            echo '</form>';
                                            
                                            echo '</div>';

                                        }
                                    }
                                    ?>
                            </div>
                                

                        </div>
                        <div id ="blocpublidroite">
                            Vos posts:
                            <button onclick="toggleformpublications()">Ajouter une photo/video</button>

                            <form id="ajouterpublicationsform" name="publicationsformulaire" method="post" action="ajouter_publications.php" style="display: none;" enctype="multipart/form-data" >
                                <input type="hidden" name="publications_form_submit" value="1">
                            <table>
                                <tr>
                                    <td><label for="lieu_publications">Lieu: </label></td>
                                    <td><input type="text" id="lieu_publications" name="lieu_publications"></td>
                                </tr>

                                
                                <tr>
                                    <td><label for="commentaire_publications">Commentaire: </label></td>
                                    <td><textarea id="commentaire_publications" name="commentaire_publications"></textarea></td>
                                </tr>

                                <tr>
                                    <td><label for="photo_publications">Photo/Video: </label></td>
                                    <td><input type="file" id="photo_publications" name="photo_publications"></td>
                                </tr>

                                
                            </table>
                            <input type="hidden" id="date_publication" name="date_publication" value="">
                            <input type="hidden" id="heure_publication" name="heure_publication" value="">
                            <tr>
                                            <td>Visibilité:</td>
                                            <td>
                                                <div id="visibilite">
                                                    <input type="hidden" id="etat_publications" name="etat_publications" value="PUBLIC">

                                                    <label><input type="radio" name="etat_publications" value="public" onclick="choisirVisibilite('public')">Public</label>
                                                    <label><input type="radio" name="etat_publications" value="prive" onclick="choisirVisibilite('prive')">Privé</label>

                                                    
                                                </div>
                                            </td>
                                        </tr> 

                        </table>
                            <button type="submit" onclick="soumettreformpublications()">Poster</button>
                        </form>


                        <div id="descriptionphoto2">
                            <br>
                            <?php
                            $resultats = mysqli_query($db_handle, "SELECT * FROM publications WHERE ID_createur = '$id'");
                            while ($row = mysqli_fetch_assoc($resultats)) {
                                echo '<div class="publications">';
                                echo '<img src="' . $row['photo_publications'] . '" alt="Photo/Video" width="150">';
                                // Affichage du lieu avec le bouton "Modifier"
                                echo '<p class="info"><strong>Lieu:</strong> ' . $row['lieu_publications'];
                                echo '<button onclick="afficherFormulaire(\'lieu_publications\', ' . $row['ID_publication'] . ')">Modifier</button>';
                                echo '<form id="form_lieu_publications_' . $row['ID_publication'] . '" method="post" action="modifier_champ_publications.php" style="display: none;">';
                                echo '<input type="hidden" name="champ" value="lieu_publications">';
                                echo '<input type="hidden" name="ID_publication" value="' . $row['ID_publication'] . '">';
                                echo '<input type="text" name="nouvelle_valeur" placeholder="Nouveau lieu">';
                                echo '<button type="submit">Envoyer</button>';
                                echo '</form>';

                                
                                

                                // Affichage du commentaire avec le bouton "Modifier"
                                echo '<p class="info"><strong>Commentaire:</strong> ' . $row['commentaire_publications'];
                                echo '<button onclick="afficherFormulaire(\'commentaire_publications\', ' . $row['ID_publication'] . ')">Modifier Commentaire</button>';
                                echo '<form id="form_commentaire_publications_' . $row['ID_publication'] . '" method="post" action="modifier_champ_publications.php" style="display: none;">';
                                echo '<input type="hidden" name="champ" value="commentaire_publications">';
                                echo '<input type="hidden" name="ID_publication" value="' . $row['ID_publication'] . '">';
                                echo '<textarea name="nouvelle_valeur" placeholder="Nouveau commentaire"></textarea>';
                                echo '<button type="submit">Envoyer</button>';
                                echo '</form>';

                                //affichage de la date et l heure de publication
                                echo '<p class="info"><strong>Publié le :</strong> ' . date("d/m/Y", strtotime($row['date_publications'])) . ' à ' . date("H:i", strtotime($row['heure_publications'])) . '</p>';


                                echo '<form method="post" action="supprimer_photo.php">';
                                echo '<input type="hidden" name="ID_publication" value="' . $row['ID_publication'] . '">';
                                echo '<button type="submit" class="supprimer-button">Supprimer le post</button>';
                                echo '</form>';
                                
                                //echo '<button class="parametres-button">Paramètres de la photo</button>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                        </div>
                    </div>    
                </div>
            </div>    
        </div>
        <!-- Formulaire d'ajout d'événement (initiallement caché) -->
        <div id="formulaireEvenement" style="display:none;">
            
        </div>


        <!--pr la page a droite avec la liste des formations etc -->
        <div id ="formations">
            <div id="conteneurFormations" ><!--les fomations ajoutées s ajoutent ici -->
                <h2>
                    Vos formations/projets :
                </h2>
            
                <div id="ssbloc_haut">
                    
                        <h3>Liste des formations :</h3>
                         <?php
            // Vérifier s'il y a des formations à afficher
            if (mysqli_num_rows($result_formations) > 0) {
                while ($formation = mysqli_fetch_assoc($result_formations)) {
                    echo '<div>';
                    echo '<strong style="text-align:left; display: block;">' . $formation['ecole'] . '</strong>';

                    echo ' <span style="text-align:left;  display: block;">' . $formation['domaine'] . '</span>';


                    echo '<span style="text-align:left; display: block;">' . $formation['dateDebut'] . ' / ' . $formation['dateFin'] . '<br>';


                    echo '</div>';
                    echo '<hr>';
                }
            } else {
                echo 'Aucune formation trouvée.';
            }
            ?>

                </div>

                <div id="ssbloc_milieu">
                    
                        <h3>Liste des projets :</h3>
                        <?php
                        // Vérifier s'il y a des formations à afficher
                        if (mysqli_num_rows($result_projets) > 0) {
                            while ($projets = mysqli_fetch_assoc($result_projets)) {
                                echo '<div>';
                                echo '<strong style="text-align:left; display: block;">' . $projets['Lieu'] . '</strong>';

                                echo ' <span style="text-align:left;  display: block;">' . $projets['domaine'] . '</span>';


                                echo '<span style="text-align:left; display: block;">' . $projets['dateDebut'] . ' / ' . $projets['dateFin'] . '<br>';


                                echo '</div>';
                                echo '<hr>';
                            }
                        } else {
                            echo 'Aucun projet trouvé.';
                        }
                        ?>
                        
                </div>
                
                <div id="ssbloc_bas">    
                    <button class="button-container" onclick="toggleformationformulaire()">Ajouter une Formation</button>

                     <form id="ajouterformationformulaire" name="formationformulaire" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: none;">
                          <table>
                                <input type="hidden" name="formation_form_submit" value="1">

                               <tr>
                                    <td><label for="ecole">École:</label></td>
                                    <td><input type="text" name="ecole" id="ecole" required></td>
                               </tr>
                               <tr>
                                    <td><label for="competence">Compétences acquises:</label></td>
                                    <td><input type="text" name="competence" id="competence" required></td>
                               </tr>
                               
                               <tr>
                                    <td><label for="domaine">Domaine d'étude:</label></td>
                                    <td><input type="text" name="domaine" id="domaine" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateDebut">Date de début:</label></td>
                                    <td><input type="date" name="dateDebut"id="dateDebut" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateFin">Date de fin:</label></td>
                                    <td><input type="date" name="dateFin"  id="dateFin" required></td>
                               </tr>
                               <!--<tr>
                                    <td><label for="description">Description:</label></td>
                                    <td><textarea id="description" rows="4"></textarea></td>
                               </tr> -->  
                          </table>
                          <button type="submit" onclick="soumettreformationformulaire()">Envoyer </button>
                     </form> 
                    <button class="button-container" onclick="toggleFormulaireProjet()">Ajouter un Projet</button>

                    <form id="ajouterProjetFormulaire" name="projetformulaire" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> " style="display: none;">
                          <table>
                            <input type="hidden" name="projet_form_submit" value="1">
                               <tr>
                                    <td><label for="lieu">Lieu:</label></td>
                                    <td><select name="Lieu" id="lieu"  >
                                            <option value="ecoleEce">Ecole ECE</option>
                                            <option value="etranger">A l'étranger</option>
                                            <option value="entreprise">En entreprise</option>
                                        </select></td>
                               </tr>
                               <tr>
                                    <td><label for="competence">Compétences acquises:</label></td>
                                    <td><input type="text" name="competence" id="competence" required></td>
                               </tr>
                               
                               <tr>
                                    <td><label for="domaine">Domaine d'études:</label></td>
                                    <td><input type="text" name="domaine" id="domaine" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateDebut">Date de début:</label></td>
                                    <td><input type="date" name="dateDebut" id="dateDebut" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateFin">Date de fin:</label></td>
                                    <td><input type="date" name="dateFin" id="dateFin" required></td>
                               </tr>
                                  
                          </table>
                          <button type="submit" onclick="soumettreprojetformulaire()">Envoyer</button>

                     </form>
                </div>      
            </div> 
          

        </div>
        <!--pr la page en bas avec les documents etc -->
        <div id="vosdocs">
            <h2>
                Vos documents :
            </h2>
            <div id="conteneurSousBlocs">    
                
                    <!-- Sous-bloc à gauche -->
                <div id="ssblocgauche">
                    <h3>Liste des CV  : </h3>
                        
                        <!--pr la liste des CV deposés-->
                        <div id="listeFichiers" ></div>
                         <!-- Nouveau div pour la liste des CV générés -->
                        <div id="listeCvGenere"></div>

                   
                </div>


                <!-- Sous-bloc à droite -->
                <div id="ssblocdroite">   
                    <form id="uploadForm" onsubmit="return false;">
                        <table>
                            
                            <tr>
                                <td class="button-container"><button type="button" id="deposerCvBtn" class="fixed-width-button" onclick="afficherInput()">Déposer mon CV</button></td>
                            </tr>
                            <tr>
                                <td><input type="file" id="fileInput" style="display: none;" onchange="afficherNomFichier()"></td>
                                <td><button type="button" id="envoyerBtn" onclick="deposerCV()" style="display: none;">Envoyer</button></td>
                            </tr>
                            
                        </table>
                    </form>
                    <form><table>
                        <tr>
                            <td class="button-container"><button id="genererCvBtn"  class="fixed-width-button" onclick="genererCV()">Générer mon CV</button>
                            </td>
                        </tr>
                        </table>
                    </form>
                </div>   
               
                                    
           
            
            </div>
        <!-- Copyright 
        <div id="copy">
            <footer>
            <p>
                &copy; 2023 ECE In. Tous droits réservés.
            </p>-->
        </footer>
        </div>
    </div>    



</body>
</html>
