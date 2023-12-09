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
//sinon
echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $mysqli->host_info;
echo '<br>';
echo 'Protocol version: ' . $mysqli->protocol_version;

// -----------------------------------------------------------------------------------------------
// Récupérer les données du formulaire
$email = isset($_POST["email"]) ? $mysqli->real_escape_string($_POST["email"]) : "";
$password = isset($_POST["password"]) ? $mysqli->real_escape_string($_POST["password"]) : "";

// -----------------------------------------------------------------------------------------------
//Si la BDD existe
if ($mysqli) {
    // Requête pour récupérer le mot de passe associé à l'email
    $sql = "SELECT mdp FROM utilisateurs WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if (!$result) {
        die('Erreur dans la requête SQL : ' . $mysqli->error);
    }

    $data = $result->fetch_assoc();
    $mdp_test = $data['mdp'];


    // -----------------------------------------------------------------------------------------------
    // Pour pouvoir envoyer l'ID aux autres pages
    $res = $mysqli->query("SELECT ID FROM utilisateurs WHERE email = '$email'");
    $data_res = $res->fetch_assoc();
    $id = $data_res['ID'] ;

    // -----------------------------------------------------------------------------------------------
    // Pour pouvoir avoir le nom grace à l'ID
    $resultat1 = $mysqli->query("SELECT prenom FROM utilisateurs WHERE ID = '$id'");
    $data1 = $resultat1->fetch_assoc();
    $user_name = $data1['prenom'] ;

    $result = $mysqli->query("SELECT photo FROM utilisateurs WHERE email = '$email'");
    $data_result = $result->fetch_assoc();
    $photo = $data_result['photo'] ;

    // -----------------------------------------------------------------------------------------------
    if ($mdp_test === $password) {
        echo "Mot de passe correct. Redirection vers la page d'accueil...";

        // Démarrer la session
        session_start();

        // Stocker des informations sur l'utilisateur dans la session
        $_SESSION['user_name'] = $user_name;
        $_SESSION['id'] = $id;
        $_SESSION['photo'] = $photo;
        // Redirection vers la page d'accueil
        header('Location: accueil.php');
        exit();

    } else {
        echo "<h3>Erreur de mot de passe !</h3>";
        header('Location: connexion.html');
    }

    $mysqli->close();
}

?>