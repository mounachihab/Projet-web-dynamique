<?php

//identifier le nom de base de données
$database = "ece";
//connection dans la BDD
//votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement
    if ($db_found) {

//--------------------------------------------------------------------------------------------

//recupération de l'id apres la connection
        
//$id = $_SESSION['id'];
//WHERE ID != $id



//requete qui recupère les amis des amis de l'utilisateur mais qui ne sont pas encore ses amis

$sql = "SELECT DISTINCT u.*
FROM utilisateurs u
JOIN reseau_ami ra1 ON u.ID = ra1.ID_ami
WHERE ra1.ID IN (SELECT ID_ami FROM reseau_ami WHERE ID = 1)
  AND u.ID NOT IN (SELECT ID_ami FROM reseau_ami WHERE ID = 1)
  AND u.ID != 1";




// resultat de la requete 
 $result = mysqli_query($db_handle, $sql);

if (!$result) {
    die('Erreur dans la requête : ' . mysqli_error($db_handle));
}
        // tant qu'il y a des resultats, on va afficher:
        while ($data = mysqli_fetch_assoc($result)) {



//affichage des resultats 

echo "<div id='container'
    style='background-color: #a6cccc;
    height: 100px;
    width: 260px; 
    padding: 5px; 
    margin-top:5px;
    margin-left:10px; 
    border-radius: 10px; 
    text-align: left;'>";


// Photo 
$image = $data['photo'];
echo "<div style='float: left; margin-left: 5px; margin-top:5px'>"; // Ajustez le padding-top selon vos préférences
echo "<a href=\"https://www.ece.fr/\"><img src='$image' height='90' width='80'></a>";
echo "</div>";


//Boutons
echo "<div style='float: right; text-align: right; padding: 5px; margin-right: 10px;'>";
echo "<a href='supprimer_ami.php?id=" . $data['ID'] . "'><button>Supprimer</button></a>";
echo "<a href='messagerie.php'><button style='margin-left: 5px;'>Ajouter</button></a>";
echo "</div>";


// Nom 
echo "<div id='nom'
    style=' float: right;
    text-align: right;
    padding: 5px;
    '>";
echo "<p style='margin: 0;'>" . htmlspecialchars($data['nom']) . " " . htmlspecialchars($data['prenom']) . "</p>";
echo "</div>";

echo "</div>";

// affichage de l'ami en commun (si j'ai le temps)



    //on arrete d'afficher (fin du while)
    }

}//fin du 'si la base existe'



//si la BDD n'existe pas--------------------------------------------------------------------

else {
 echo "Database not found";
}

//fermer la connection
mysqli_close($db_handle);


?>
