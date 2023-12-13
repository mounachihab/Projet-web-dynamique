// Pour l'intro dans le logo
function afficher_message_intro() {
    // Afficher la boîte de dialogue
    document.getElementById("container").style.display = "flex";
}

function cacher_message_intro() {
    // Cacher la boîte de dialogue
    document.getElementById("container").style.display = "none";
}






// Fonctions pour verifictaion de supprimer :
function openPopup() {
    document.getElementById('popup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function redirectToPage() {
    // Remplacez "URL_DE_REDIRECTION" par l'URL réelle vers laquelle vous souhaitez rediriger l'utilisateur.
    window.location.href = "supprimer.php";
}