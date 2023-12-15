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


function toggleformevenement(){
    const evenformulaire = document.getElementById('ajouterevenementform');

        if (evenformulaire.style.display === 'none' || evenformulaire.style.display === '') {
            console.log("Toggle : Affichage des evenements");
            afficherevenformulaire();
        } else {
            console.log("Toggle : Masquage des evenements");
            cacherevenformulaire();
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

function soumettreformevenement(){
        const type= document.getElementById('type').value;
        const lieu= document.getElementById('lieu').value;
        const commentaire= document.getElementById('commentaire').value;
        const photo= document.getElementById('photo').value;
        const date= document.getElementById('date').value;

        // Cacher le formulaire après la soumission
        cacherevenformulaire();

        document.getElementById('evenformulaire').submit();

}



function toggleformpost(){
    const postformulaire = document.getElementById('ajouterphotovideoform');

        if (postformulaire.style.display === 'none' || postformulaire.style.display === '') {
            console.log("Toggle : Affichage des post");
            afficherpostformulaire();
        } else {
            console.log("Toggle : Masquage des post");
            cacherpostformulaire();
        }

} 

function afficherpostformulaire(){
    const postformulaire = document.getElementById('ajouterphotovideoform');
    postformulaire.style.display = 'block';

}  

function cacherpostformulaire(){
    const postformulaire = document.getElementById('ajouterphotovideoform');
    postformulaire.style.display = 'none';

}

function soumettreformpost(){
        const type= document.getElementById('type').value;
        const lieu= document.getElementById('lieu').value;
        const commentaire= document.getElementById('commentaire').value;
        const photo= document.getElementById('photo').value;
        const date= document.getElementById('date').value;

        // Cacher le formulaire après la soumission
        cacherpostformulaire();

        document.getElementById('postformulaire').submit();

}
