function afficherMessageIntro() {
    // Afficher la boîte de dialogue
    document.getElementById("overlayContainer").style.display = "flex";
}

function cacherMessageIntro() {
    // Cacher la boîte de dialogue
    document.getElementById("overlayContainer").style.display = "none";
}

let formations = []; // Liste pour stocker les formations

// Fonction pour charger les données depuis localStorage
function chargerFormations() {
    const donnees = localStorage.getItem('formations');
    if (donnees) {
        formations = JSON.parse(donnees);
    }
}

// Fonction pour sauvegarder les données dans localStorage
function sauvegarderFormations() {
    localStorage.setItem('formations', JSON.stringify(formations));
}



//fonction pr ajt une formation dans la liste
function ajouterformations(){
    const ecole = document.getElementById('ecole').value;
    const competence = document.getElementById('competence').value;
    const domaine = document.getElementById('domaine').value;
    const dateDebut = document.getElementById('dateDebut').value;
    const dateFin = document.getElementById('dateFin').value;

    // Créer un objet de formation
    const nouvelleFormation = {
        ecole: ecole,
        competence: competence,
        domaine: domaine,
        dateDebut: dateDebut,
        dateFin: dateFin,
    };

    // Ajouter la formation à la liste
    formations.push(nouvelleFormation);

    // Afficher la liste mise à jour
    afficherlisteformations(); // Correction de la casse ici
    sauvegarderFormations(); // Ajout de la sauvegarde des données
    // Masquer le formulaire
    const formulaire = document.getElementById('ajouterformationformulaire');
    formulaire.style.display = 'none';
}

//fonction pour supprimer une formation de la liste
function supprimerFormation(index) {
    formations.splice(index, 1);
    afficherlisteformations();
    sauvegarderFormations();
}

//fonction pr afficher chaque formation dans la liste une fois qu'elle est saisie
function afficherlisteformations() {
    const listeFormations = document.getElementById('listeFormations');

    // Effacer le contenu actuel de la liste
    listeFormations.innerHTML = '';

    // Parcourir toutes les formations
    for (let i = 0; i < formations.length; i++) {
        const formation = formations[i];

        // Créer un élément de liste pour chaque formation
        const item = document.createElement('div');
        item.innerHTML = `
            <strong>${formation.ecole}</strong><br>
            <small>${formation.domaine}</small><br>
            <small>${formation.dateDebut} - ${formation.dateFin}</small>
            <button onclick="supprimerFormation(${i})">Supprimer</button>
        `;

        // Ajouter l'élément de liste à la listeFormations
        listeFormations.appendChild(item);
    }
}

// Appeler chargerFormations au chargement de la page
window.onload = function () {
    chargerFormations();
    afficherlisteformations(); 
};

function afficherFormulaire() {
    console.log("Affichage du formulaire");
    const formulaire = document.getElementById('ajouterformationformulaire');
    formulaire.style.display = 'block';
}

function cacherFormulaire() {
    console.log("Masquage du formulaire");
    const formulaire = document.getElementById('ajouterformationformulaire');
    formulaire.style.display = 'none';
}

function toggleformulaire() {
    const formulaire = document.getElementById('ajouterformationformulaire');
    
    if (formulaire.style.display === 'none' || formulaire.style.display === '') {
        console.log("Toggle : Affichage du formulaire");
        afficherFormulaire();
    } else {
        console.log("Toggle : Masquage du formulaire");
        cacherFormulaire();
    }
}





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

// Fonction pour charger la liste des fichiers après le rechargement de la page
function chargerListeFichiers() {
    var listeFichiers = document.getElementById("listeFichiers");

    // Supprimer le contenu actuel de la liste
    listeFichiers.innerHTML = "";

    // Charger la liste depuis le stockage local
    var fichiersEnvoyes = JSON.parse(localStorage.getItem("fichiersEnvoyes")) || [];

    // Mettre à jour la liste
    for (var i = 0; i < fichiersEnvoyes.length; i++) {
        var fichier = fichiersEnvoyes[i];

        // Créer un conteneur pour chaque fichier avec un bouton de suppression
        var fichierContainer = document.createElement("div");

        // Contenu du fichier avec le nom
        fichierContainer.textContent = fichier;

        // Bouton de suppression
        var boutonSupprimer = document.createElement("button");
        boutonSupprimer.textContent = "Supprimer";
        boutonSupprimer.setAttribute("data-index", i); // Ajouter l'index comme attribut pour identifier le fichier

        // Ajouter un gestionnaire d'événements pour le bouton de suppression
        boutonSupprimer.addEventListener("click", function (event) {
            var index = event.target.getAttribute("data-index");
            // Appeler la fonction de suppression avec l'index du fichier
            supprimerFichier(index);
        });

        // Ajouter le bouton de suppression au conteneur du fichier
        fichierContainer.appendChild(boutonSupprimer);

        // Ajouter le conteneur du fichier à la liste
        listeFichiers.appendChild(fichierContainer);
    }
}

// Fonction pour supprimer un fichier de la liste
function supprimerFichier(index) {
    var fichiersEnvoyes = JSON.parse(localStorage.getItem("fichiersEnvoyes")) || [];

    // Supprimer le fichier à l'index spécifié
    fichiersEnvoyes.splice(index, 1);

    // Mettre à jour le stockage local
    localStorage.setItem("fichiersEnvoyes", JSON.stringify(fichiersEnvoyes));

    // Recharger la liste mise à jour
    chargerListeFichiers();
}

// Appeler la fonction de chargement lors du chargement de la page
window.onload = chargerListeFichiers;

// Fonction pour ajouter un projet dans la liste
    function ajouterProjet() {
        const lieu = document.getElementById('lieu').value;
        const domaine = document.getElementById('domaine').value;
        const competences = document.getElementById('competences').value;
        const dateDebut = document.getElementById('dateDebut').value;
        const dateFin = document.getElementById('dateFin').value;

        // Créer un objet de projet
        const nouveauProjet = {
            lieu: lieu,
            domaine: domaine,
            competences: competences,
            dateDebut: dateDebut,
            dateFin: dateFin,
        };

        // Ajouter le projet à la liste
        projets.push(nouveauProjet);

        // Afficher la liste mise à jour
        afficherListeProjets();
        sauvegarderProjets(); // Sauvegarde des données
        // Masquer le formulaire
        const formulaire = document.getElementById('ajouterProjetFormulaire');
        formulaire.style.display = 'none';
    }
        
// Fonction pour afficher chaque projet dans la liste
    function afficherListeProjets() {
        const listeProjets = document.getElementById('listeProjets');

        // Effacer le contenu actuel de la liste
        listeProjets.innerHTML = '';

        // Parcourir tous les projets
        for (let i = 0; i < projets.length; i++) {
            const projet = projets[i];

            // Créer un élément de liste pour chaque projet
            const item = document.createElement('div');
            item.innerHTML = `
                <strong>${projet.lieu}</strong><br>
                <small>${projet.domaine}</small><br>
                <small>${projet.dateDebut} - ${projet.dateFin}</small>
                <button onclick="supprimerProjet(${i})">Supprimer</button>
            `;

            // Ajouter l'élément de liste à la listeProjets
            listeProjets.appendChild(item);
        }
    }        


        
