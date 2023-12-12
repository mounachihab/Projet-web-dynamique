<?php
// Fonction pour récupérer tous les emplois
function TOUSlesemplois($mysqli) {
    $sql = "SELECT * FROM emplois";
    $result = $mysqli->query($sql);

    // Vérification
    if ($result->num_rows > 0) {
        // Renvoyer les données
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}


//Fonction pour filtrer tous les emplois
function filtrerEmplois($mysqli, $type, $lieu) {
    // Si les valeurs sont "Tous les emplois" et "Tous les lieux", afficher tous les emplois
    if ($type == "0" && $lieu == "0") {
        return TOUSlesemplois($mysqli);
    }

    $sql = "SELECT * FROM emplois WHERE";

    // Si le formulaire type est autre que "Tous les emplois" filtrer"
    if ($type != "0") {
        $sql .= " type = '$type'";
    }

    // Si le formulaire lieu est autre que "Tous les lieux" filtrer"
    if ($lieu != "0") {
        $sql .= ($type != "0" ? " AND" : "") . " lieu = '$lieu'";
    }

    $result = $mysqli->query($sql);

    // Vérification 
    if ($result->num_rows > 0) {
        // Renvoyer les données
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
?>
