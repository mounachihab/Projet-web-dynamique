 <?php
error_reporting(E_ALL);

ini_set("display_errors", 1);
session_start(); // Démarre la session

// Identifier le nom de base de données
$database = "ece";
// Connectez-vous dans votre BDD
// Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect("localhost", "root", "root");
$db_found = mysqli_select_db($db_handle, $database);

// Vérifiez la connexion à la base de données
if (!$db_found) {
    echo "Database not found";
    // Fermer la connexion
    mysqli_close($db_handle);
    exit;
}

$id=3; //a modifier


//pr les utilisateurs
$sql="SELECT * FROM utilisateurs WHERE ID=$id";
$result = mysqli_query($db_handle, $sql);
// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result) {
    echo "Erreur lors de l'exécution de la requête utilisateurs : " . mysqli_error($db_handle);
    exit;
}

//pr le statut
$sql_statut="SELECT * FROM statut WHERE ID=$id";
$result_statut = mysqli_query($db_handle, $sql_statut);

// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result_statut) {
    echo "Erreur lors de l'exécution de la requête statut: " . mysqli_error($db_handle);
    exit;
}

//pr les formations

$sql_formations="SELECT * FROM formations WHERE ID=$id";
$result_formations = mysqli_query($db_handle, $sql_formations);

// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result_formations) {
    echo "Erreur lors de l'exécution de la requête formations: " . mysqli_error($db_handle);
    exit;
}

//pr les projets

$sql_projets="SELECT * FROM projets WHERE ID=$id";
$result_projets = mysqli_query($db_handle, $sql_projets);

// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result_projets) {
    echo "Erreur lors de l'exécution de la requête projets: " . mysqli_error($db_handle);
    exit;
}


if ($db_found) {  
    $utilisateur = mysqli_fetch_assoc($result);
    $nom = $utilisateur['nom'];
    $prenom = $utilisateur['prenom'];
    $email = $utilisateur['email'];
    $mdp = $utilisateur['mdp'];
    $photo = $utilisateur['photo'];

    $statut = mysqli_fetch_assoc($result_statut);
    $tonstatut = $statut['tonstatut'];

    // Vérifier si le formulaire des formations a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formation_form_submit'])) {
        // Récupérer les données du formulaire
        $ecole = isset($_POST['ecole']) ? mysqli_real_escape_string($db_handle, $_POST['ecole']) : '';
        $competence = isset($_POST['competence']) ? mysqli_real_escape_string($db_handle, $_POST['competence']) : '';
        $domaine = isset($_POST['domaine']) ? mysqli_real_escape_string($db_handle, $_POST['domaine']) : '';
        
        // Vérifier si les dates sont vides avant de les traiter
        $dateDebut = isset($_POST['dateDebut']) && !empty($_POST['dateDebut']) ? mysqli_real_escape_string($db_handle, $_POST['dateDebut']) : '2023-01-01';
        $dateFin = isset($_POST['dateFin']) && !empty($_POST['dateFin']) ? mysqli_real_escape_string($db_handle, $_POST['dateFin']) : '2023-01-01';

        // Insérer les informations dans la table formations
        $sql_insert_formation = "INSERT INTO formations (ID, ecole, competence, domaine, dateDebut, dateFin) 
                            VALUES ($id, '$ecole', '$competence', '$domaine', '$dateDebut', '$dateFin')";

        $result_insert_formation = mysqli_query($db_handle, $sql_insert_formation);

        if (!$result_insert_formation) {
            echo "Erreur lors de la mise à jour des informations des formations : " . mysqli_error($db_handle);
        }
    }

    // Vérifier si le formulaire des projets a été soumis
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet_form_submit'])) {
        // Récupérer les données du formulaire
        $Lieu = isset($_POST['Lieu']) ? mysqli_real_escape_string($db_handle, $_POST['Lieu']) : '';
        $competence = isset($_POST['competence']) ? mysqli_real_escape_string($db_handle, $_POST['competence']) : '';
        $domaine = isset($_POST['domaine']) ? mysqli_real_escape_string($db_handle, $_POST['domaine']) : '';
        
        // Vérifier si les dates sont vides avant de les traiter
        $dateDebut = isset($_POST['dateDebut']) && !empty($_POST['dateDebut']) ? mysqli_real_escape_string($db_handle, $_POST['dateDebut']) : '2023-01-01';
        $dateFin = isset($_POST['dateFin']) && !empty($_POST['dateFin']) ? mysqli_real_escape_string($db_handle, $_POST['dateFin']) : '2023-01-01';

        // Insérer les informations dans la table projets
        $sql_insert_projet = "INSERT INTO projets (ID, Lieu, competence, domaine, dateDebut, dateFin) 
                            VALUES ($id, '$Lieu', '$competence', '$domaine', '$dateDebut', '$dateFin')";

        $result_insert_projet = mysqli_query($db_handle, $sql_insert_projet);

        if (!$result_insert_projet) {
            echo "Erreur lors de la mise à jour des informations du projet : " . mysqli_error($db_handle);
        }
    }

    // Charger les projets depuis la base de données ou la session
    $projets_session = isset($_SESSION['projets']) ? $_SESSION['projets'] : [];
    if (empty($projets_session)) {
        $sql_projets = "SELECT * FROM projets WHERE ID=$id";
        $result_projets = mysqli_query($db_handle, $sql_projets);

        if (!$result_projets) {
            echo "Erreur lors de l'exécution de la requête projets: " . mysqli_error($db_handle);
            exit;
        }

        while ($row = mysqli_fetch_assoc($result_projets)) {
            $projets_session[] = $row;
        }

        $_SESSION['projets'] = $projets_session;
    }

    // Reste du code pour les projets
    if (!empty($projets_session)) {
        $dernier_projet = end($projets_session);
        $Lieu = isset($dernier_projet['Lieu']) ? $dernier_projet['Lieu'] : '';
        $competence = isset($dernier_projet['competence']) ? $dernier_projet['competence'] : '';
        $domaine = isset($dernier_projet['domaine']) ? $dernier_projet['domaine'] : '';
        $dateDebut = isset($dernier_projet['dateDebut']) ? $dernier_projet['dateDebut'] : '';
        $dateFin = isset($dernier_projet['dateFin']) ? $dernier_projet['dateFin'] : '';
    } else {
        // If no projet is found, initialize variables to default values
        $Lieu = '';
        $competence = '';
        $domaine = '';
        $dateDebut = '';
        $dateFin = '';
    }
} else {
    echo "Utilisateur non trouvé.";
    exit;
}



// Vérifier si le formulaire du statut a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le formulaire du statut a été soumis
    if (isset($_POST['statut_form_submit'])) {
        // Récupérer la nouvelle valeur du statut depuis le formulaire
        $nouveau_statut = mysqli_real_escape_string($db_handle, $_POST['nouveau_statut']);

        // Mettre à jour la table statut avec le nouveau statut
        $sql_update_statut = "UPDATE statut SET tonstatut = '$nouveau_statut' WHERE ID = $id";
        $result_update_statut = mysqli_query($db_handle, $sql_update_statut);

        if (!$result_update_statut) {
            echo "Erreur lors de la mise à jour du statut : " . mysqli_error($db_handle);
        } else {
            // Rafraîchir la page pour afficher le nouveau statut
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    }

     // Vérifier si le formulaire des formations a été soumis
    elseif (isset($_POST['formation_form_submit'])) {
        // Récupérer les données du formulaire
        $ecole = isset($_POST['ecole']) ? mysqli_real_escape_string($db_handle, $_POST['ecole']) : '';
        $competence = isset($_POST['competence']) ? mysqli_real_escape_string($db_handle, $_POST['competence']) : '';
        $domaine = isset($_POST['domaine']) ? mysqli_real_escape_string($db_handle, $_POST['domaine']) : '';
        

        // Vérifier si les dates sont vides avant de les traiter
        $dateDebut = isset($_POST['dateDebut']) && !empty($_POST['dateDebut']) ? mysqli_real_escape_string($db_handle, $_POST['dateDebut']) : '2023-01-01';
        $dateFin = isset($_POST['dateFin']) && !empty($_POST['dateFin']) ? mysqli_real_escape_string($db_handle, $_POST['dateFin']) : '2023-01-01';

        // Insérer les informations dans la table formations
        $sql_insert_formation = "INSERT INTO formations (ID, ecole, competence, domaine, dateDebut, dateFin) 
                            VALUES ($id, '$ecole', '$competence', '$domaine', '$dateDebut', '$dateFin')";

        $result_insert_formation = mysqli_query($db_handle, $sql_insert_formation);

        if (!$result_insert_formation) {
            echo "Erreur lors de la mise à jour des informations des formations : " . mysqli_error($db_handle);
        }
    }    
        // Vérifier si le formulaire des projets a été soumis
    elseif (isset($_POST['projet_form_submit'])) {
        // Récupérer les données du formulaire
        $Lieu = isset($_POST['Lieu']) ? mysqli_real_escape_string($db_handle, $_POST['Lieu']) : '';
        $competence = isset($_POST['competence']) ? mysqli_real_escape_string($db_handle, $_POST['competence']) : '';
        $domaine = isset($_POST['domaine']) ? mysqli_real_escape_string($db_handle, $_POST['domaine']) : '';
        
        // Vérifier si les dates sont vides avant de les traiter
        $dateDebut = isset($_POST['dateDebut']) && !empty($_POST['dateDebut']) ? mysqli_real_escape_string($db_handle, $_POST['dateDebut']) : '2023-01-01';
        $dateFin = isset($_POST['dateFin']) && !empty($_POST['dateFin']) ? mysqli_real_escape_string($db_handle, $_POST['dateFin']) : '2023-01-01';

        // Insérer les informations dans la table projets
        $sql_insert_projet = "INSERT INTO projets (ID, Lieu, competence, domaine, dateDebut, dateFin) 
                            VALUES ($id, '$Lieu', '$competence', '$domaine', '$dateDebut', '$dateFin')";

        $result_insert_projet = mysqli_query($db_handle, $sql_insert_projet);

        if (!$result_insert_projet) {
            echo "Erreur lors de la mise à jour des informations du projet : " . mysqli_error($db_handle);
        }
    }
        
    
}
/*
// Chemin du fichier SQL de création de table
$sql_file = "vous.sql";

// Lire le contenu du fichier SQL
$sql_content = file_get_contents($sql_file);


// Exécuter la requête SQL
$result_create_table = mysqli_multi_query($db_handle, $sql_content);

// Vérifier si la requête a réussi
if (!$result_create_table) {
    echo "Erreur lors de la création de la table formations : " . mysqli_error($db_handle);
    exit;
}
*/


// Fermer la connexion
mysqli_close($db_handle);

?>

<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vous.css">
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
                 onclick="afficherMessageIntro()"/>
        </div>

        <!-- L'intro de l'ece in si on appuie sur le logo -->
        <div id="overlayContainer">
            <div id="messageOverlay">
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
                <button onclick="cacherMessageIntro()">Fermer</button>
            </div>
        </div>

        <div id="titre">
            <h2>ECE In - Social Media Professionnel de l'ECE Paris</h2>
        </div>

        <div id="nomCompte">
            Nom compte
        </div>

        <!-- Partie du boutons de déconnexion -->
        <div id="deco">
            <a href="connexion.html">
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
            <a href="accueil.html">
                <img src="bouton_accueil_0.png"
                                 alt="accueil"
                                 width="150"
                                 height=""/>
            </a>

            <a href="monreseau.html">
                <img src="bouton_mon_reseau_0.png"
                     alt="mon resau"
                     width="150"
                     height=""/>
            </a>

            <a href="vous.html">
                <img src="bouton_vous_1.png"
                     alt="vous"
                     width="150"
                     height=""/>
            </a>

            <a href="notification.html">
                <img src="bouton_notification_0.png"
                     alt="notifications"
                     width="150"
                     height=""/>
            </a>

            <a href="messagerie.html">
                <img src="bouton_messagerie_0.png"
                     alt="messagerie"
                     width="150"
                     height=""/>
            </a>

            <a href="emplois.html">
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
                    </div>

                </div>
                <div id="statut">
                    <h3>Votre statut :</h3><br>
                    <?php echo $tonstatut  ?>
                    <button onclick="toggleStatutForm()">Modifier votre statut </button>
                    <!-- Formulaire de modification du statut -->
                    <form id="champ_statut" name="form_statut" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: none;">
                        <input type="hidden" name="statut_form_submit" value="1">
                        
                            <label for="nouveau_statut"></label>
                            <input type="text" name="nouveau_statut" id="nouveau_statut" placeholder="Nouveau statut">
                            <button type="submit" onclick="soumettreStatutForm()">Soumettre</button>

                    </form>     
                            
                    
                </div>



                <div id="publication"><h3>Vos publications :</h3></div>
            </div>    
        </div>


        <!--pr la page a droite avec la liste des formations etc -->
        <div id ="formations">
            <div id="conteneurFormations"><!--les fomations ajoutées s ajoutent ici -->
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
