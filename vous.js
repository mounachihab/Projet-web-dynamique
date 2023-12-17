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

//fonction pr generer le cv en pdf ou html

function genererCV(){

}


var fichiersEnvoyes = []; // Tableau pour stocker les noms des fichiers

function deposerCV() {
            // Récupérer l'élément input de type "file"
            const cvInput = document.getElementById('fileInput');

            // Vérifier si un fichier a été sélectionné
            if (cvInput.files.length > 0) {
                const cvFile = cvInput.files[0];

                // Vérifier si le fichier est au format PDF
                if (cvFile.type === 'application/pdf') {
                    // Ajouter le nom du fichier au tableau
                    fichiersEnvoyes.push(cvFile.name);

                    // Mettre à jour la liste des fichiers
                    var listeFichiers = document.getElementById("listeFichiers");
                    listeFichiers.innerHTML = "Liste des CV déposés :<br>";

                    for (var i = 0; i < fichiersEnvoyes.length; i++) {
                        var fichier = fichiersEnvoyes[i];
                        var nouveauFichier = document.createElement("div");
                        nouveauFichier.textContent = fichier;
                        listeFichiers.appendChild(nouveauFichier);
                    }

                    // Réinitialiser le champ de fichier et masquer le bouton "Envoyer"
                    cvInput.value = ""; // Efface le fichier sélectionné
                    document.getElementById("envoyerBtn").style.display = "none";
                    document.getElementById("deposerCvBtn").style.display = "inline-block";
                    document.getElementById("fileInput").style.display = "none"; // Cacher le champ de fichier


                                    // Ajouter le bouton "Supprimer" et "Paramètres" pour chaque CV déposé
                    for (var i = 0; i < fichiersEnvoyes.length; i++) {
                        var fichier = fichiersEnvoyes[i];
                        var nouveauFichier = document.createElement("div");
                        nouveauFichier.textContent = fichier;

                        // Ajouter le bouton "Supprimer"
                        var boutonSupprimer = document.createElement("button");
                        boutonSupprimer.textContent = "Supprimer le CV";
                        nouveauFichier.appendChild(boutonSupprimer);

                        // Ajouter le bouton "Paramètres"
                        var boutonParametres = document.createElement("button");
                        boutonParametres.textContent = "Paramètres du CV ";
                        nouveauFichier.appendChild(boutonParametres);

                        listeFichiers.appendChild(nouveauFichier);
                    }
                } else {
                    alert('Veuillez sélectionner un fichier PDF.');
                }
            } else {
                alert('Veuillez sélectionner un fichier.');
            }
        }

function afficherInput() {
            var btnDeposerCv = document.getElementById("deposerCvBtn");
            var fileInput = document.getElementById("fileInput");
            var envoyerBtn = document.getElementById("envoyerBtn");

            // Cacher le bouton "Déposer mon CV"
            btnDeposerCv.style.display = "none";

            // Afficher le champ de fichier et le bouton "Envoyer"
            fileInput.style.display = "block";
            envoyerBtn.style.display = "inline-block";
        }

 

// Fonction pour mettre à jour l'affichage du fichier sélectionné
function afficherNomFichier() {
    var fileInput = document.getElementById("fileInput");
    var nomFichier = fileInput.files[0].name;

    // Mettre à jour le texte de l'élément existant pour afficher le nom du fichier
    var listeFichiers = document.getElementById("listeFichiers");
    listeFichiers.innerHTML = "Fichier sélectionné : " + nomFichier;

    // Ajouter le fichier au tableau de fichiers dans le stockage local
    var fichiersEnvoyes = JSON.parse(localStorage.getItem("fichiersEnvoyes")) || [];
    fichiersEnvoyes.push(nomFichier);
    localStorage.setItem("fichiersEnvoyes", JSON.stringify(fichiersEnvoyes));

    // Mettre à jour la liste des fichiers
    chargerListeFichiers();
}




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
        statutForm.style.display = 'none';
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

    // Mettre à jour les champs de date et d'heure avec la date et l'heure actuelles
        var dateActuelle = new Date();
        var date_irl_event = dateActuelle.toISOString().split('T')[0]; // Format 'YYYY-MM-DD'
        var heure_irl_event = dateActuelle.toTimeString().split(' ')[0]; // Format 'HH:mm:ss'
        // Cacher le formulaire après la soumission
        cacherpublicationsformulaire();
        document.getElementById('date_irl_event').value = dateEvent;
        document.getElementById('heure_irl_event').value = heureEvent;

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
