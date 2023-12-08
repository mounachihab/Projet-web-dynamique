// Pour l'intro dans le logo
function afficherMessageIntro() {
    // Afficher la boîte de dialogue
    document.getElementById("overlayContainer").style.display = "flex";
}

function cacherMessageIntro() {
    // Cacher la boîte de dialogue
    document.getElementById("overlayContainer").style.display = "none";
}


// Pour supprimer le compte :
function redirigerVersPage() {
    // Redirection vers supprimer
    window.location.href = "supprimer.php";
}