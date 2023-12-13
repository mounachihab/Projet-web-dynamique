<?php


//identifier le nom de base de données
$database = "ece";
//connectez-vous dans votre BDD
$db_handle = mysqli_connect('localhost', 'root', '' );
$mysqli = mysqli_select_db($db_handle, $database);



//session_start();
//$identifiant = $_SESSION['ID'];
?>


<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="monreseau.css">
    <form action="monreseau.php" method="post">
    <title>ECE In - Mon réseau </title>
</head>

<body>
    <!-- Partie du logo -->
    <div id="banderole">
        <div id="logo">
            <img src="logo.png"
                 alt="Logo"
                 width="260"
                 height=""/>
        </div>

        <div id="titre">
            <h2>ECE In - Mon Réseau: Retrouvez tous vos amis de l'ECE! </h2>
        </div>

        <!-- Partie du boutons de deconnexion -->
        <div id="deco">
            <img src="bouton_deconnection.png"
                            alt="Logo"
                            width="50"
                            height=""/>
        </div>

    </div>

    <div id="couleur"></div>


<!---------------------------------------------------------------------------------------->
    <div id="wrapper">
    <!-- Partie des boutons -->
    <div id="boutons">
        <img src="bouton_accueil_0.png"
             alt="accueil.html"
             width="170"
             height=""/>
        <img src="bouton_mon_reseau_1.png"
             alt=".html"
             width="170"
             height=""/>
        <img src="bouton_vous_0.png"
             alt=".html"
             width="170"
             height=""/>
        <img src="bouton_notification_0.png"
             alt=".html"
             width="170"
             height=""/>
        <a href="messagerie.html"><img src="bouton_messagerie_0.png"
             alt="messagerie.html"
             width="170"
             height=""/><a>
        <img src="bouton_emplois_0.png"
             alt=".html"
             width="170"
             height=""/>

    	</div>

     	<!-- ANCIEN CODE choix affichage -->
    <!--<div id="affichage">-->
<!-- 
    	 <p>
    	 <form action="monreseau.php" method="post" style= "display: inline-block; margin-right: 10px;">
 		 <label for="choix">Affichage de mes amis</label>
 		 <select id="choix" name="choix">
   		 		<option value="1">classés par Nom (A-Z)</option>
   		 		<option value="2">classés par Prénom (A-Z)</option>
    			<option value="3">classés par numéro d'identifiant</option> 
    			<option value="4">uniquement professeurs</option>
    			<option value="5">uniquement collègues</option> 
  		</select>
  		<input type="submit" name="button1" value="Soumettre">
		</form>

    	<form action="monreseau.php" method="post" style="display: inline-block;">
 		<label for="choix">Rencontrer</label>
 		<select id="choix" name="choix">
   		 		<option value="1">tout type d'ami</option>
    			<option value="2">uniquement des professeurs</option>
    			<option value="3">uniquement des collègues</option> 
  		</select>
  		<input type="submit" name="button1" value="Soumettre">
		</form>
		
		</p>

    </div>
    -->

   		 <!-- l'esapce amis -->
   		 <div id="amis">
   		 	<div class="scrollable-container">
   		     <p>Mes amis</p>
 
   		     <?php include 'monreseau.php';?>

   		     </div>
   		 </div>

    	<!-- l'espace amis d'amis -->
    	<div id="reseau">
    		<div class="scrollable-container2">
   		     <p>Rencontrez des amis!</p>

   		     <?php include 'monreseau2.php';?>
 
   		     </div>
   	     
   		 </div>

    </div>

    <!-- Copyright -->
    <div id="copy">
        <p>&copy; 2023 ECE In. Tous droits réservés.</p>
    </div>

</body>
</html>
