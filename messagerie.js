

// Pour l'intro dans le logo
function afficher_message_intro() {
    // Afficher l'intro
    document.getElementById("container").style.display = "flex";
}

function cacher_message_intro() {
    // Cacher l'intro
    document.getElementById("container").style.display = "none";
}






// Fonction pour remonter au début de la page
function retour_en_haut() {
    document.documentElement.scrollTop = 0; //remonte vers le haut, en 0
}




// fonction pour afficher en decembre
// Fonction pour afficher l'image en fonction de la date
function affiche_image_date() {
    //  On regarde la date actuelle
    var dateActuelle = new Date();

    // Vérifier si c'est decembre (va de 0 à 11)
    if (dateActuelle.getMonth() === 11) {
        // Si le mois est décembre, afficher l'image
        document.getElementById('image_dec_1').src = "dec/dec_sapins.png";
        document.getElementById('image_dec_2').src = "dec/dec_sapin.png";
    } else {
        // Sinon on n'affiche pas
        document.getElementById('image_dec').src = '';
    }
}

// Appeler la fonction au chargement de la page
window.onload = affiche_image_date;


