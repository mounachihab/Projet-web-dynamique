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
$nom = isset($_POST["lastname"]) ? $mysqli->real_escape_string($_POST["lastname"]) : "";
$prenom = isset($_POST["firstname"]) ? $mysqli->real_escape_string($_POST["firstname"]) : "";
$password = isset($_POST["password"]) ? $mysqli->real_escape_string($_POST["password"]) : "";


//Si la BDD existe
if ($mysqli) {
    // Requête pour récupérer le mot de passe associé à l'email
    $sql = "SELECT email FROM utilisateurs WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if (!$result) {
        die('Erreur dans la requête SQL : ' . $mysqli->error);
    }

    $data = $result->fetch_assoc();
    $mail_bdb = $data['email'];

    // si le mail existe deja
    if ($email != $mail_bdb) {
        echo "Nouvel untilisateur";

        // ajout dans la base de donnée
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mdp, photo) VALUES ('$nom','$prenom' ,'$email', '$password','inconnu.png')";


        // Exécution de la requête
        if ($mysqli->query($sql) === TRUE) {
            echo "Données ajoutées avec succès";
        } else {
            echo "Erreur lors de l'ajout des données : " . $mysqli->error;
        }

        $res = $mysqli->query("SELECT ID FROM utilisateurs WHERE email = '$email'");
        $data_res = $res->fetch_assoc();
        $id = $data_res['ID'] ;

        // Démarrer la session
        session_start();

        // Stocker des informations sur l'utilisateur dans la session
        $_SESSION['user_name'] = $prenom ;
        $_SESSION['id'] = $id;
        // Redirection vers la page d'accueil
        header('Location: accueil.php');
        exit();

    } else {
        echo "<h3>Erreur de l'inscription !</h3>";
        header('Location: inscription.html');
    }

    $mysqli->close();
}

?>