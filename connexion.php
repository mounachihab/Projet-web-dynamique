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


// verification d'ouverture
if ($mysqli->connect_error) { //si c'est pas le cas :
    echo 'Errno : ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error : ' . $mysqli->connect_error;
    exit();
}


//sinon
echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $mysqli->host_info;
echo '<br>';
echo 'Protocol version: ' . $mysqli->protocol_version;




// Récupérer les données du formulaire
$email = isset($_POST["email"]) ? $mysqli->real_escape_string($_POST["email"]) : "";
$password = isset($_POST["password"]) ? $mysqli->real_escape_string($_POST["password"]) : "";
echo "mdp : $password";
echo "email : $email" ;

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


    if ($mdp_test == $password) {
        echo "Mot de passe correct. Redirection vers la page d'accueil...";
        header('Location: accueil.html');
    } else {
        echo "<h3>Erreur de mot de passe !</h3>";
        echo "$mdp_test" ;
        echo "$email" ;
    }

    // Affichage des autres données (ID, nom, prénom, etc.)
    $sql = "SELECT * FROM utilisateurs";
    $result = $mysqli->query($sql);

    if (!$result) {
        die('Erreur dans la requête SQL : ' . $mysqli->error);
    }
    $mysqli->close();
}

?>