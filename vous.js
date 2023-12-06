const formations=[]; //liste pr stocker les formations

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
    afficherListeFormations();

    // Masquer le formulaire
    const formulaire = document.getElementById('ajouterFormationForm');
    formulaire.style.display = 'none';

}

//fonction pr afficher chaque formation dans la liste 
function afficherlisteformations(){

}

//fonction qui fait apparaitre les champs a remplir lorsque l on cliquer sur ajouter une formation
function toggleformulaire(){
	const formulaire = document.getElementById('ajouterFormationForm');
    formulaire.style.display = (formulaire.style.display === 'none' || formulaire.style.display === '') ? 'block' : 'none';
}

//fonction pr generer le cv en pdf ou html

function genererCV(){

}