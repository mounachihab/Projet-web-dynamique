function afficherMessageIntro() {
    // Afficher la boîte de dialogue
    document.getElementById("overlayContainer").style.display = "flex";
}

function cacherMessageIntro() {
    // Cacher la boîte de dialogue
    document.getElementById("overlayContainer").style.display = "none";
}




let formations=[]; //liste pr stocker les formations

//fonction pr ajt une formation dans la liste
function ajouterformations(){
    const ecole = document.getElementById('ecole').value;
    const competence = document.getElementById('competence').value;
    const diplome = document.getElementById('diplome').value;
    const domaine = document.getElementById('domaine').value;
    const dateDebut = document.getElementById('dateDebut').value;
    const dateFin = document.getElementById('dateFin').value;
    const description = document.getElementById('description').value;

    // Créer un objet de formation
    const nouvelleFormation = {
        ecole: ecole,
        competence: competence,
        diplome: diplome,
        domaine: domaine,
        dateDebut: dateDebut,
        dateFin: dateFin,
        description: description
    };

    // Ajouter la formation à la liste
    formations.push(nouvelleFormation);

    // Afficher la liste mise à jour
    afficherlisteformations(); // Correction de la casse ici

    // Masquer le formulaire
    const formulaire = document.getElementById('ajouterformationformulaire');
    formulaire.style.display = 'none';
}

//fonction pr afficher chaque formation dans la listeune fois qu elle est saisie
function afficherlisteformations(){

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
        `;

        // Ajouter l'élément de liste à la listeFormations
        listeFormations.appendChild(item);
    }


}

//fonction qui fait apparaitre les champs a remplir lorsque l on cliquer sur ajouter une formation
function toggleformulaire(){
	const formulaire = document.getElementById('ajouterformationformulaire');
    formulaire.style.display = (formulaire.style.display === 'none' || formulaire.style.display === '') ? 'block' : 'none';
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

      
function afficherNomFichier() {
            var fileInput = document.getElementById("fileInput");
            var nomFichier = fileInput.files[0].name;

            // Mettre à jour le texte de l'élément existant pour afficher le nom du fichier
            var listeFichiers = document.getElementById("listeFichiers");
            listeFichiers.innerHTML = "Fichier sélectionné : " + nomFichier;
        }

      
