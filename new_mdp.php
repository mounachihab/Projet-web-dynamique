<?php
// Démarrer la session
session_start();

// Accéder aux informations sur l'utilisateur
$id = $_SESSION['id'];

?>


<!DOCTYPE html>
<html lang="fr">
<!-- -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mdp_perdu_form.css">
    <title>ECE In - Mot de passe lost</title>
</head>

<body>
<br>
<br>

<div id="wrapper">
    <div id="baniere">
        <h3>
            Récupération du mot de passe
        </h3>
    </div>

    <br>

    <form action="changement_mdp.php" method="post">
        <label for="password">Votre nouveau mot de passe (ne l'oubliez plus :) ) :</label>
        <input type="password" id="password" name="password" required>


        <br>
        <br>

        <input type="submit" value="Nouveau mot de passe">

    </form>
    <br>

</div>

<br>
<br>


<!-- Copyright -->
<div id="copy">
    <p>
        &copy; 2023 ECE In. Tous droits réservés.
    </p>
</div>
</body>
</html>

