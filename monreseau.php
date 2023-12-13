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



//requete qui recupère tous les amis de l'id concerné (à modifier en fonction de la connection)

$sql = "SELECT *
FROM utilisateurs u
JOIN reseau_ami r ON u.ID = r.ID_ami
WHERE r.ID = 1";



/* ANCIEN CODE pour afficher les amis selon des parametres 
$choice = isset($_POST["choix"])? $_POST["choix"] : "";
if (empty($choice)) {
$choice = 0;
}
$choice = (int)$choice;
$sql = "";

 //si le BDD existe, faire le traitement
if ($db_found) {
//code MySQL. $sql est basé sur le choix de l’utilisateur
switch ($choice) {
case 1:
$sql = "SELECT * FROM mes_amis ORDER BY Nom"; 
break;
case 2:
$sql = "SELECT * FROM mes_amis ORDER BY Prénom";
break;
case 3:
$sql = "SELECT * FROM mes_amis ORDER BY  ID";
break;
case 4:
    $sql = "SELECT DISTINCT mes_amis.* FROM mes_amis INNER JOIN reseau_ami ON mes_amis.ID = reseau_ami.ID WHERE reseau_ami.Lien = 'Professeurs'";
    break;
case 5:
    $sql = "SELECT DISTINCT mes_amis. * FROM mes_amis INNER JOIN reseau_ami ON mes_amis.ID = reseau_ami.IDami WHERE reseau_ami.Lien = 'Collègues'";
    break;
}
*/



// resultat de la requete 
 $result = mysqli_query($db_handle, $sql);

        // tant qu'il y a des resultats, on va afficher:
        while ($data = mysqli_fetch_assoc($result)) {

           

            //zone d'affichage d'un ami
            echo "<div id='container'
            style='background-color: #a6cccc;
            height: 200px;
            width: 820px; 
            padding: 5px; 
            margin-top:5px;
            margin-left:10px; 
            border-radius: 10px; 
            text-align: left';>";

            // bouttons
            echo "<div style='float: right; text-align: right; padding: 5px;'>
            <a href='supprimer_ami.php?id=" . $data['ID'] . "'><button>Supprimer</button></a>
            <a href='messagerie.php'><button>Envoyer un message</button></a>
            </div>";

            // nom & prénom
            echo "<div id='nom'
            style='height: 30px;
            width: 200px; 
            text-align: left;
            float: left;
            padding: 5px;'>
            <p style='margin: 0;'>" . htmlspecialchars($data['nom']) . " " . htmlspecialchars($data['prenom']) . "</p>
            </div>";

            // photo
            $image = $data['photo'];
            echo "<div style='clear: both; padding: 5px;'>
            <a href=\"https://www.ece.fr/\"><img src='$image' height='150' width='130'></a>
             </div>";

            echo "</div>";

        //on arrete d'afficher (fin du while)
        }

/*ANCIEN CODE affichage
        echo "<div id='container'>";
        echo"<table border=\"1\">";
        echo"<tr>";
        //echo"<th>"."ID"."</th>";
        echo"<th>"."Nom"."</th>";
        echo"<th>"."Prénom"."</th>";
        echo"<th>"."Description"."</th>";
        echo"<th>"."Photo"."</th>";
        echo"</tr>";


            
            echo"<tr>";
            //echo "<td>" . htmlspecialchars($data['ID'] ). "<br>"."</td>";
            echo "<td>" .htmlspecialchars( $data['Nom'] ). "<br>"."</td>";
            echo "<td>" . htmlspecialchars($data['Prénom']) . "<br>"."</td>";
            echo "<td>" .htmlspecialchars( $data['Description']) . "<br>"."</td>";
            $image = $data['Photo'];

    echo "<td><a href=\"https://www.ece.fr/\"><img src='$image' height='110' width='95'></a><br></td>";

    echo "<td>";
    echo "<input type='submit' name='button2' value='Supprimer'>";

    echo "<a href=\"messagerie.html\"> <input type='submit' name='button2' value='Envoyer un message'></a>";
    echo "</td>";
    echo"</tr>";


    }//end while
    echo"</table>";
    echo "</div>";
*/

}//fin du 'si la base existe'



//si la BDD n'existe pas--------------------------------------------------------------------

else {
 echo "Database not found";
}

//fermer la connection
mysqli_close($db_handle);


?>

