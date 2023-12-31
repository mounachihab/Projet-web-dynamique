

// Pour l'intro dans le logo
function afficher_message_intro() {
    // Afficher l'intro
    document.getElementById("container").style.display = "flex";
}

function cacher_message_intro() {
    // Cacher l'intro
    document.getElementById("container").style.display = "none";
}


// Pour le carousel
$(document).ready(function(){
    var $carrousel = $('#carrousel'), // on cible le bloc du carrousel
        $img = $('#carrousel img'), // on cible les images contenues dans le carrousel
        indexImg = $img.length - 1, // on définit l'index du dernier élément
        i = 0, // on initialise un compteur
        $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)

    $img.css('display', 'none'); // on cache les images
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante

    $("#prev").click(function () {
        $currentImg.css('display', 'none');
        if (i > 0) {
            i--;
        }
        else {
            i = indexImg;
        }
        $currentImg = $img.eq(i);
        $currentImg.css('display', 'block');
    });

    $("#next").click(function () {
        i++; // on incrémente le compteur
        if(i <= indexImg) {
            $img.css('display', 'none'); // on cache les images
            $currentImg = $img.eq(i); // on définit la nouvelle image
            $currentImg.css('display', 'block'); // puis on l'affiche
        }
        else {
            i = indexImg;
        }
    });

    //fonction java défilement auto
    function maBoucle(){
        setTimeout(function(){
            $currentImg.css('display', 'none');
            if (i < indexImg) {
                i++;
            } else {
                i = 0;
            }

            $currentImg = $img.eq(i);
            $currentImg.css('display', 'block');

            maBoucle();
        }, 4000);
    }

    maBoucle(); // lance la fonction une première fois

});


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


// Pour revenir a la position du like
var position = document.getElementById('positionElement');
var position2 = position.getBoundingClientRect().top;

// Rediriger
window.location.href = 'accueil.php#position' + position2;
position.scrollIntoView({ behavior: 'smooth', block: 'start' });




// Fonctions pour verifictaion de supprimer :
function openPopup() {
    document.getElementById('popup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function redirectToPage(id_publi,btn) {
    // Remplacez "URL_DE_REDIRECTION" par l'URL réelle vers laquelle vous souhaitez rediriger l'utilisateur.
    window.location.href = `supp_admin.php?id=${id_publi}&btn=${btn}`;
}



function openPopup2() {
    document.getElementById('popup2').style.display = 'block';
    document.getElementById('overlay2').style.display = 'block';
}

function closePopup2() {
    document.getElementById('popup2').style.display = 'none';
    document.getElementById('overlay2').style.display = 'none';
}

function redirectToPage2(id_publi,btn) {
    // Remplacez "URL_DE_REDIRECTION" par l'URL réelle vers laquelle vous souhaitez rediriger l'utilisateur.
    window.location.href = `supp_admin.php?id=${id_publi}&btn=${btn}`;
}




function openPopup3() {
    document.getElementById('popup3').style.display = 'block';
    document.getElementById('overlay3').style.display = 'block';
}

function closePopup3() {
    document.getElementById('popup3').style.display = 'none';
    document.getElementById('overlay3').style.display = 'none';
}
function redirectToPage(id_publi,btn) {
    // Remplacez "URL_DE_REDIRECTION" par l'URL réelle vers laquelle vous souhaitez rediriger l'utilisateur.
    window.location.href = `supp_admin.php?id=${id_publi}&btn=${btn}`;
}

