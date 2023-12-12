<?php

ini_set("display_errors", 1);
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

$id=3;
$sql="SELECT * FROM utilisateurs WHERE ID=$id";
$result = mysqli_query($db_handle, $sql);
// Vérifier s'il y a une erreur lors de l'exécution de la requête SQL
if (!$result) {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($db_handle);
    exit;
}


if ($db_found) {  //verifie si le nombre de lignes est superieur à 0, cela veu dire qu il ya au moins une ligne de resultats
    $utilisateur = mysqli_fetch_assoc($result);
    $nom = $utilisateur['nom'];
    $prenom = $utilisateur['prenom'];
    $email = $utilisateur['email'];
    $mdp = $utilisateur['mdp'];
    $photo = $utilisateur['photo'];
} else {
    echo "Utilisateur non trouvé.";
    exit;
}



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
                    
                    <img id="profilphoto" src="<?php echo $photo; ?>" alt="Photo de profil"  >
                    <div id="infos">
                        <div class="prenom"><?php echo $prenom  ?></div> 
                        <div class="nom"><?php echo $nom  ?></div> 
                        <div class="email"><?php echo $email ; ?></div>  
                    </div>




                </div>
                <div id="statut"><h3>Votre statut :</h3></div>
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
                        <div id="listeFormations"></div>
                </div>

                <div id="ssbloc_milieu">
                    
                        <h3>Liste des projets :</h3>
                        <div id="listeProjets"></div>
                </div>
                
                <div id="ssbloc_bas">    
                    <button onclick="toggleformulaire()">Ajouter une Formation</button>

                     <form id="ajouterformationformulaire" style="display: none;">
                          <table>
                               <tr>
                                    <td><label for="ecole">École:</label></td>
                                    <td><input type="text" id="ecole" required></td>
                               </tr>
                               <tr>
                                    <td><label for="competence">Compétences acquises:</label></td>
                                    <td><input type="text" id="competence" required></td>
                               </tr>
                               
                               <tr>
                                    <td><label for="domaine">Domaine d'étude:</label></td>
                                    <td><input type="text" id="domaine" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateDebut">Date de début:</label></td>
                                    <td><input type="date" id="dateDebut" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateFin">Date de fin:</label></td>
                                    <td><input type="date" id="dateFin" required></td>
                               </tr>
                               <!--<tr>
                                    <td><label for="description">Description:</label></td>
                                    <td><textarea id="description" rows="4"></textarea></td>
                               </tr> -->  
                          </table>
                          <button type="button" onclick="ajouterformations()">Envoyer </button>
                     </form> 
                    <button onclick="toggleFormulaireProjet('ajouterProjetFormulaire')">Ajouter un Projet</button>

                    <form id="ajouterProjetFormulaire" style="display: none;"onsubmit="ajouterProjet(event);">
                          <table>
                               <tr>
                                    <td><label for="lieu">Lieu:</label></td>
                                    <td><select id="lieu">
                                            <option value="ecoleEce">Ecole ECE</option>
                                            <option value="etranger">A l'étranger</option>
                                            <option value="entreprise">En entreprise</option>
                                        </select></td>
                               </tr>
                               <tr>
                                    <td><label for="competence">Compétences acquises:</label></td>
                                    <td><input type="text" id="competence" required></td>
                               </tr>
                               
                               <tr>
                                    <td><label for="domaine">Domaine d'études:</label></td>
                                    <td><input type="text" id="domaine" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateDebut">Date de début:</label></td>
                                    <td><input type="date" id="dateDebut" required></td>
                               </tr>
                               <tr>
                                    <td><label for="dateFin">Date de fin:</label></td>
                                    <td><input type="date" id="dateFin" required></td>
                               </tr>
                                  
                          </table>
                          <button type="button" id="envoyerProjetBtn" onclick="ajouterProjet()">Envoyer</button>

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