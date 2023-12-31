// Pour l'intro dans le logo
function afficher_message_intro() {
    // Afficher la boîte de dialogue
    document.getElementById("container").style.display = "flex";
}

function cacher_message_intro() {
    // Cacher la boîte de dialogue
    document.getElementById("container").style.display = "none";
}

// fonction pour afficher en decembre
// Fonction pour afficher l'image en fonction de la date
function affiche_image_date() {
    //  On regarde la date actuelle
    var dateActuelle = new Date();

    // Vérifier si c'est decembre (va de 0 à 11)
    if (dateActuelle.getMonth() === 11) {
        // Si le mois est décembre, afficher l'image
        document.getElementById('image_dec_1').src = "dec_sapins.png";
        document.getElementById('image_dec_2').src = "dec_sapin.png";
    } else {
        // Sinon on n'affiche pas
        document.getElementById('image_dec').src = '';
    }
}

// Appeler la fonction au chargement de la page
window.onload = affiche_image_date;





//pr le statut

   function afficherStatutForm() {
        const statutForm = document.getElementById('champ_statut');
        statutForm.style.display = 'block';
    }

    function cacherStatutForm() {
        const statutForm = document.getElementById('champ_statut');
        statutForm.style.display = 'none';
    }

    function toggleStatutForm() {
        const statutForm = document.getElementById('champ_statut');

        if (statutForm.style.display === 'none' || statutForm.style.display === '') {
            console.log("Toggle : Affichage du statut");
            afficherStatutForm();
        } else {
            console.log("Toggle : Masquage du statut");
            cacherStatutForm();
        }
    }

    function soumettreStatutForm() {
        
        // Si le formulaire est soumis, le nouveau statut sera envoyé à votre script PHP pour mise à jour dans la base de données
        const nouveauStatut = document.getElementById('nouveau_statut').value;
        console.log("Nouveau statut à envoyer à la base de données : " + nouveauStatut);

        // Cacher le formulaire après la soumission
        cacherStatutForm();

        // Vous pouvez ajouter ici la logique pour soumettre le formulaire avec AJAX ou une redirection si nécessaire
        document.getElementById('form_statut').submit();
    }




//pr les formations
function toggleformationformulaire() {
        const formationformulaire = document.getElementById('ajouterformationformulaire');

        if (formationformulaire.style.display === 'none' || formationformulaire.style.display === '') {
            console.log("Toggle : Affichage des formations");
            afficherformationformulaire();
        } else {
            console.log("Toggle : Masquage des formations");
            cacherformationformulaire();
        }
    }



    function soumettreformationformulaire() {

        
        const ecole= document.getElementById('ecole').value;
        const competence= document.getElementById('competence').value;
        const domaine= document.getElementById('domaine').value;
        const dateDebut= document.getElementById('dateDebut').value;
        const dateFin= document.getElementById('dateFin').value;

        // Cacher le formulaire après la soumission
        cacherformationformulaire();

        document.getElementById('formationformulaire').submit();
    }


    function cacherformationformulaire() {
        const formationformulaire = document.getElementById('ajouterformationformulaire');
        formationformulaire.style.display = 'none';
    }

    function afficherformationformulaire() {
        const formationformulaire = document.getElementById('ajouterformationformulaire');
        formationformulaire.style.display = 'block';
    }


//pr les projets
function toggleFormulaireProjet() {
        const projetformulaire = document.getElementById('ajouterProjetFormulaire');

        if (projetformulaire.style.display === 'none' || projetformulaire.style.display === '') {
            console.log("Toggle : Affichage des projets");
            afficherprojetformulaire();
        } else {
            console.log("Toggle : Masquage des projets");
            cacherprojetformulaire();
        }
    }
    function soumettreprojetformulaire() {
        
        const Lieu= document.getElementById('Lieu').value;
        const competence= document.getElementById('competence').value;
        const domaine= document.getElementById('domaine').value;
        const dateDebut= document.getElementById('dateDebut').value;
        const dateFin= document.getElementById('dateFin').value;

        // Cacher le formulaire après la soumission
        cacherprojetformulaire();

        document.getElementById('projetformulaire').submit();
    }

    function cacherprojetformulaire() {
        const projetformulaire = document.getElementById('ajouterProjetFormulaire');
        projetformulaire.style.display = 'none';
    }

    function afficherprojetformulaire() {
        const projetformulaire = document.getElementById('ajouterProjetFormulaire');
        projetformulaire.style.display = 'block';
    }    
//pr la description des events


function afficherDescriptionPhoto() {
    document.getElementById("descriptionphoto").style.display = 'block';
}

function cacherDescriptionPhoto() {
    document.getElementById("descriptionphoto").style.display = 'none';
}
//pr les cv
function toggleformulairecv(){
    const cvformulaire = document.getElementById('uploadForm');

    if (cvformulaire.style.display === 'none' || cvformulaire.style.display === '') {
        console.log("Toggle : Affichage des cv");
        affichercvformulaire();
    } else {
        console.log("Toggle : Masquage des cv");
        cachercvformulaire();
        
    }
}

function affichercvformulaire(){
    const cvformulaire = document.getElementById('uploadForm');
    cvformulaire.style.display = 'block';

}

function cachercvformulaire(){
    const cvformulaire = document.getElementById('uploadForm');
    cvformulaire.style.display = 'none';
}



function soumettreformcv() {

    const lienCV = document.getElementById('lienCV').value;
    
    // Cacher le formulaire après la soumission
        cachercvformulaire();

        document.getElementById('cvformulaire').submit();
}
    

//pr les events

function toggleformevenement(){
    const evenformulaire = document.getElementById('ajouterevenementform');

    if (evenformulaire.style.display === 'none' || evenformulaire.style.display === '') {
        console.log("Toggle : Affichage des evenements");
        afficherevenformulaire();
        cacherDescriptionPhoto();
    } else {
        console.log("Toggle : Masquage des evenements");
        cacherevenformulaire();
        afficherDescriptionPhoto();
    }
}

function afficherevenformulaire(){
    const evenformulaire = document.getElementById('ajouterevenementform');
    evenformulaire.style.display = 'block';

}  

function cacherevenformulaire(){
    const evenformulaire = document.getElementById('ajouterevenementform');
    evenformulaire.style.display = 'none';

}




function soumettreformevenement() {
    const type_event = document.getElementById('type_event').value;
    const lieu_event = document.getElementById('lieu_event').value;
    const commentaire_event = document.getElementById('commentaire_event').value;
    const photo_event = document.getElementById('photo_event').value;
    const date_event = document.getElementById('date_event').value;


    const etat_event = document.querySelector('input[name="etat_event"]:checked').value;

    // Mettre à jour les champs de date et d'heure avec la date et l'heure actuelles
        var dateActuelle = new Date();
        var date_irl_event = dateActuelle.toISOString().split('T')[0]; // Format 'YYYY-MM-DD'
        var heure_irl_event = dateActuelle.toTimeString().split(' ')[0]; // Format 'HH:mm:ss'
        // Cacher le formulaire après la soumission
        cacherpublicationsformulaire();
        document.getElementById('date_irl_event').value = dateEvent;
        document.getElementById('heure_irl_event').value = heureEvent;
        document.getElementById('etat_event').value = etat_event;

        document.getElementById('evenformulaire').submit();

    
}

//pr les publis

function toggleformpublications(){
    const publicationsformulaire = document.getElementById('ajouterpublicationsform');

        if (publicationsformulaire.style.display === 'none' || publicationsformulaire.style.display === '') {
            console.log("Toggle : Affichage des publications");
            afficherpublicationsformulaire();
            cacherDescriptionPubli();
        } else {
            console.log("Toggle : Masquage des publications");
            cacherpublicationsformulaire();
            afficherDescriptionPubli();
        }

} 

function afficherpublicationsformulaire(){
    const publicationsformulaire = document.getElementById('ajouterpublicationsform');
    publicationsformulaire.style.display = 'block';

}  

function cacherpublicationsformulaire(){
    const publicationsformulaire = document.getElementById('ajouterpublicationsform');
    publicationsformulaire.style.display = 'none';

}

function soumettreformpublications(){
        const lieu_publications= document.getElementById('lieu_publications').value;
        const commentaire_publications= document.getElementById('commentaire_publications').value;
        const photo_publications= document.getElementById('photo_publications').value;

        // Mettre à jour les champs de date et d'heure avec la date et l'heure actuelles
        var dateActuelle = new Date();
        var date_publications = dateActuelle.toISOString().split('T')[0]; // Format 'YYYY-MM-DD'
        var heure_publications = dateActuelle.toTimeString().split(' ')[0]; // Format 'HH:mm:ss'
        // Cacher le formulaire après la soumission
        cacherpublicationsformulaire();
        document.getElementById('date_publications').value = datePublication;
        document.getElementById('heure_publications').value = heurePublication;

        document.getElementById('publicationsformulaire').submit();

}

//pr la description des publis


function afficherDescriptionPubli() {
    document.getElementById("descriptionphoto2").style.display = 'block';
}

function cacherDescriptionPubli() {
    document.getElementById("descriptionphoto2").style.display = 'none';
}
function afficherFormulaire(champ, id) {
    // Masquer tous les formulaires
    const tousLesFormulaires = document.querySelectorAll('form');
    tousLesFormulaires.forEach(formulaire => {
        formulaire.style.display = 'none';
    });

    // Afficher le formulaire spécifique
    const formulaireAafficher = document.getElementById('form_' + champ + '_' + id);
    formulaireAafficher.style.display = 'block';
}

function choisirVisibilite(visibilite) {
    // si la prsn choisit public la colonne etat_event est remplie par 'PUBLIC' sinon 'AMIS'
    var valeurEtatEvent = (visibilite === 'public') ? 'PUBLIC' : 'AMIS';
    console.log("Valeur de etat_event avant soumission :", document.getElementById('etat_event').value);
    document.getElementById('etat_event').value = valeurEtatEvent;
}/*function afficherParametres(ID_event) {
    console.log("Fonction afficherParametres appelée avec ID_event =", ID_event);

    // Afficher les options de visibilité (boutons radio "Public" et "Privé")
    var publicBtn = document.getElementById('publicBtn_' + ID_event);
    var priveBtn = document.getElementById('priveBtn_' + ID_event);

    if (publicBtn && priveBtn) {
        // Afficher les options de visibilité (boutons radio "Public" et "Privé")
        publicBtn.style.display = 'block';
        priveBtn.style.display = 'block';

        // Pré-remplir la valeur en fonction de la visibilité actuelle
        var etat_event = document.querySelector('input[name="etat_event"]:checked').value;

        if (etat_event === 'public') {
            document.querySelector('input[name="etat_event"][value="public"]').checked = true;
        } else if (etat_event === 'prive') {
            document.querySelector('input[name="etat_event"][value="prive"]').checked = true;
        }
    } else {
        console.error('Les éléments ne sont pas trouvés.');
    }
}*/

function choisirVisibilitepubli(visibilite) {
    // si la prsn choisit public la colonne etat_event est remplie par 'PUBLIC' sinon 'AMIS'
    var valeurEtatPubli = (visibilite === 'public') ? 'PUBLIC' : 'AMIS';
    console.log("Valeur de etat_event avant soumission :", document.getElementById('etat_event').value);
    document.getElementById('etat_publications').value = valeurEtatPubli;
}

function afficherFormulaire() {
    var formulaire = document.getElementById('formulaireModification');
    formulaire.style.display = 'block';
}



function genererCV() {
    // Soumettez le formulaire pour déclencher le script PHP
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'generercv.php'; // Assurez-vous que le chemin est correct

    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'genererCV';
    input.value = '1';
    form.appendChild(input);

    document.body.appendChild(form);

    // Soumettez le formulaire
    form.submit();

    // Retirez le formulaire du DOM après la soumission
    document.body.removeChild(form);
}

function configurerFormulaireGenererCV() {
    document.getElementById('genererCvForm').addEventListener('submit', function (event) {
        // Empêcher le formulaire de se soumettre normalement
        event.preventDefault();

        // Soumettre le formulaire
        this.submit();
    });
}

// Appeler la fonction au chargement de la page
document.addEventListener('DOMContentLoaded', function () {
    configurerFormulaireGenererCV();
});