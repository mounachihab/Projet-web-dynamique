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


    // Vérifier si le formulaire de modification du statut a été soumis
if (isset($_POST['statut_form_submit'])) {

    // Récupérer le nouveau statut depuis le formulaire
    $nouveauStatut = mysqli_real_escape_string($db_handle, $_POST['nouveau_statut']);

    // Mettez à jour le statut dans la base de données
    $requete = mysqli_query($db_handle, "UPDATE statut SET tonstatut = '$nouveauStatut' WHERE ID = $id");

    if ($requete) {
        // Mettez à jour la variable $tonstatut pour refléter le nouveau statut
        $tonstatut = $nouveauStatut;
        // Rediriger l'utilisateur vers la même page pour actualiser le contenu
    header('Location: vous.php');
        exit();

    } 
    else {
        echo "Erreur lors de la mise à jour du statut : " . mysqli_error($db_handle);
    }
}


?>
