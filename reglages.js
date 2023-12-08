// Pour l'intro dans le logo
function afficher_message_intro() {
    // Afficher la boîte de dialogue
    document.getElementById("container").style.display = "flex";
}

function cacher_message_intro() {
    // Cacher la boîte de dialogue
    document.getElementById("container").style.display = "none";
}




// Pour supprimer le compte :
function redirigerVersPage() {
    // Redirection vers supprimer
    window.location.href = "supprimer.php";
}

