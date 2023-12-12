<?php
// Fonction pour ajouter un emploi
function ajouterEmploi($mysqli, $type, $lieu, $commentaire) {
    // On vérifie qu'aucun champ n'est vide
    if ($type === '' || $lieu === '' || $commentaire === '') {
        echo "Erreur : champs vide";
        exit();
    }

    // Requête SQL d'insertion
    $sql = "INSERT INTO emplois (type, lieu, commentaire) VALUES ('$type', '$lieu', '$commentaire')";

    // Exécuter la requête
    $result = $mysqli->query($sql);

    // Retourner le succès ou l'échec de l'opération (true ou false)
    return $result;
}
?>
