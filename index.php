<?php 
    session_start();

    

use Controller\CinemaController;
use Controller\PersonneController;
use Controller\FilmController;
use Controller\ModificationController;

spl_autoload_register(function ($class_name) {
    include  $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlPersonne = new PersonneController();
$ctrlFilm = new FilmController();
$ctrlModification = new ModificationController();


$id = (isset($_GET["id"])) ? $_GET["id"] : null;
$idRole = (isset($_GET["idRole"])) ? $_GET["idRole"] : null;
$idGenre = (isset($_POST['filmGenre'])) ? $_POST['filmGenre'] : array(); 


// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if (isset($_GET["action"])) {
    switch($_GET["action"]) {

        // LISTES ET DETAILS
        case "accueil" : $ctrlCinema->pageAccueil(); break; // affiche la page d'accueil
        case "listeGenres" : $ctrlCinema->listeGenres(); break; // affiche la page genre avec la liste des genres
        case "detailGenre" : $ctrlCinema->detailGenre($id); break; // affiche la page détail genre (liste des films du genre)
        

        case "listeFilms" : $ctrlFilm->listeFilms(); break;  // affiche la page FILMS avec la liste des films
        case "detailFilm" : $ctrlFilm->detailFilm($id); break;  // affiche la page détail film du film sur lequel on a cliqué
        
        case "listeActeurs" : $ctrlPersonne->listeActeurs(); break;  // affiche la page ACTEURS qui liste et affiche tous les acteurs et actrices de la BDD
        case "detailActeur" : $ctrlPersonne->detailActeur($id); break;
        
        case "listeRealisateurs" : $ctrlPersonne->listeRealisateurs(); break; // affiche la page réalisateurs et affiche tous les réalisateurs de la BDD
        case "detailRealisateur" : $ctrlPersonne->detailRealisateur($id); break;  // affiche la page détail réalisateur sur lequel on a cliqué

        
        // AJOUTS à LA BDD
        case "afficherFormulaireGenre" :
            $ctrlCinema->afficherFormulaireGenre(); break; // formulaire d'ajout d'un genre
        case "ajouterNouveauGenre":
            $ctrlCinema->ajouterNouveauGenre();  // ajoute le genre saisi à la BDD
            $ctrlCinema->afficherFormulaireGenre(); break;

        case "afficherFormulaireFilm" :
            $ctrlFilm->afficherFormulaireFilm(); break; // formulaire d'ajout d'un film
        case "ajouterNouveauFilm":
            $ctrlFilm->ajouterNouveauFilm();  // ajoute le film saisi à la BDD
            $ctrlFilm->afficherFormulaireFilm();break; 

        case "afficherFormulaireActeur" :
            $ctrlPersonne->afficherFormulaireActeur(); break;  // formulaire d'ajout d'un acteur
        case "ajouterNouvelActeur" :
            $ctrlPersonne->ajouterNouvelActeur(); // ajoute l'acteur à la BDD
            $ctrlPersonne->afficherFormulaireActeur(); break;

        case "afficherFormulaireRealisateur" :
            $ctrlPersonne->afficherFormulaireRealisateur(); break; // formulaire d'un ajout de réalisateur
        case "ajouterNouveauRealisateur" :
            $ctrlPersonne->ajouterNouveauRealisateur(); // ajoute le réalisateur à la BDD
            $ctrlPersonne->afficherFormulaireRealisateur(); break;

        case "afficherFormulaireCasting" :
            $ctrlFilm->afficherFormulaireCasting(); break;  // affiche le formulaire d'ajout d'un casting à la table casting (association acteur/role/film)
        case "ajouterNouveauCasting" :
            $ctrlFilm->ajouterNouveauCasting(); // ajoute le casting à la BDD
            $ctrlFilm->afficherFormulaireCasting(); break;

        case "afficherFormulaireRole" :
            $ctrlFilm->afficherFormulaireRole(); break;  // affiche le formulair d'ajout d'un rôle à la BDD
        case "ajouterNouveauRole" :
            $ctrlFilm->ajouterNouveauRole(); //  ajoute le rôle à la BDD
            $ctrlFilm->afficherFormulaireRole(); break;



        // MODIFICATION DE LA BDD
        case "modificationFilm" :
            $ctrlModification->formulaireModifierFilm($id); break;  //  affiche le formulaire de modification d'un film
        case "modifierFilm" : 
            $ctrlModification->modifierFilm($id);  //  effectue les modifications dans la BDD    
            $ctrlModification->formulaireModifierFilm($id); break;

        case "afficherModifierActeur" : //  affiche le formulaire de modification d'un acteur
            $ctrlModification->afficherModifierActeur($id); break;
        case "modifierActeur" :
            $ctrlModification->modifierActeur($id); // effectue les modifications en BDD
            $ctrlModification->afficherModifierActeur($id); break;

        case "afficherModifierRealisateur" : //  affiche le formulaire de modification d'un réalisateur
            $ctrlModification->afficherModifierRealisateur($id); break;
        case "modifierRealisateur" :
            $ctrlModification->modifierRealisateur($id); // effectue les modifications en BDD
            $ctrlModification->afficherModifierRealisateur($id); break;
        
        case "afficherModifierGenre" : //  affiche le formulaire de modification d'un genre (éditer le libellé)
            $ctrlModification->afficherModifierGenre($id); break;
        case "modifierGenre" :
            $ctrlModification->modifierGenre($id); // effectue la modificatio en BDD
            $ctrlModification->afficherModifierGenre($id); break;
   

            // SUPPRESSION EN BDD
        case "afficherSupprimerActeur" :
            $ctrlModification->afficherSupprimerActeur($id); break; // affiche le formulaire de confirmation de suppression d'un acteur
        case "confirmerSuppressionActeur" :
            $ctrlModification->confirmerSuppressionActeur($id); // effectue la suppression de l'acteur de la table acteur (personne reste en BDD)
            $ctrlPersonne->listeActeurs(); break;

        case "afficherSupprimerRealisateur" :
            $ctrlModification->afficherSupprimerRealisateur($id); break; // affiche le formulaire de confirmation de suppression d'un réalisateur (!! attention supprime tous les films associés au réalisateur !!)
        case "confirmerSuppressionRealisateur" :
            $ctrlModification->confirmerSuppressionRealisateur($id); // effectue la suppression de l'acteur de la table réalisateur (personne reste en BDD)
            $ctrlPersonne->listeRealisateurs(); break;
        
        case "afficherSupprimerGenre" :
            $ctrlModification->afficherSupprimerGenre($id); break; // affiche le formulaire de confirmation de suppression d'un genre
        case "confirmerSuppressionGenre" :
            $ctrlModification->confirmerSuppressionGenre($id); // effectue la suppression du genre de la BDD (irreversible)
            $ctrlCinema->listeGenres(); break;

        case "afficherSupprimerFilm" :
            $ctrlModification->afficherSupprimerFilm($id); break; // affiche le formulaire de confirmation de suppression d'un film (irreversible)
        case "confirmerSuppressionFilm" :
            $ctrlModification->confirmerSuppressionFilm($id); // effectue la suppression du film en BDD
            $ctrlFilm->listeFilms(); break;

            
        case "afficherSupprimerCasting":
            $ctrlFilm->afficherSupprimerCasting($id, $idRole); break; // affiche le formulaire de confirmation de suppression d'une association de la table casting (acteur/role/film)
        case "confirmerSuppressionCasting":
            $ctrlFilm->confirmerSuppressionCasting($id, $idRole); // effectue la suppression de l'association acteur/role/film de la table casting
            $ctrlModification->formulaireModifierFilm($id); break;

        
        case "afficherModifierGenresFilm" :
            $ctrlFilm->afficherModifierGenresFilm($id); break; // permet d'afficher le formulaire d'ajout des genres à un film
        case "confirmerModifierGenresFilm" :
            $ctrlFilm->confirmerModificationGenresFilm($id, $idGenre); // associe les genres sélectionnés au film choisi à la BDD (table film_genres)
            $ctrlFilm->afficherModifierGenresFilm($id); break;


        default: $ctrlCinema->pageAccueil(); break; // affiche la page d'accueil
        
    }
}
// (manque la fonction pour supprimer des genres associés à un film)



