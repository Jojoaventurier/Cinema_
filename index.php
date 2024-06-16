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
$param = (isset($_GET["param"])) ? $_GET["param"] : null;


// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if (isset($_GET["action"])) {
    switch($_GET["action"]) {
        // 
        case "accueil" : $ctrlCinema->pageAccueil(); break;
        case "listeGenres" : $ctrlCinema->listeGenres(); break;
        case "detailGenre" : $ctrlCinema->detailGenre($id); break;
        

        case "listeFilms" : $ctrlFilm->listeFilms(); break;
        case "detailFilm" : $ctrlFilm->detailFilm($id); break;
        case "suppFilm" : $ctrlFilm->supprimerFilm($id); break;
        
        case "listeActeurs" : $ctrlPersonne->listeActeurs(); break;
        case "detailActeur" : $ctrlPersonne->detailActeur($id); break;
        
        case "listeRealisateurs" : $ctrlPersonne->listeRealisateurs(); break;
        case "detailRealisateur" : $ctrlPersonne->detailRealisateur($id); break;
        

        case "afficherFormulaireGenre" :
            $ctrlCinema->afficherFormulaireGenre(); break;
        case "ajouterNouveauGenre":
            $ctrlCinema->ajouterNouveauGenre(); 
            $ctrlCinema->afficherFormulaireGenre(); break;

        case "afficherFormulaireFilm" :
            $ctrlFilm->afficherFormulaireFilm(); break;
        case "ajouterNouveauFilm":
            $ctrlFilm->ajouterNouveauFilm(); 
            $ctrlFilm->afficherFormulaireFilm();break; 

        case "afficherFormulaireActeur" :
            $ctrlPersonne->afficherFormulaireActeur(); break;
        case "ajouterNouvelActeur" :
            $ctrlPersonne->ajouterNouvelActeur();
            $ctrlPersonne->afficherFormulaireActeur(); break;

        case "afficherFormulaireRealisateur" :
            $ctrlPersonne->afficherFormulaireRealisateur(); break;
        case "ajouterNouveauRealisateur" :
            $ctrlPersonne->ajouterNouveauRealisateur();
            $ctrlPersonne->afficherFormulaireRealisateur(); break;

        case "afficherFormulaireCasting" :
            $ctrlFilm->afficherFormulaireCasting(); break;
        case "ajouterNouveauCasting" :
            $ctrlFilm->ajouterNouveauCasting();
            $ctrlFilm->afficherFormulaireCasting(); break;

        case "afficherFormulaireRole" :
            $ctrlFilm->afficherFormulaireRole(); break;
        case "ajouterNouveauRole" :
            $ctrlFilm->ajouterNouveauRole();
            $ctrlFilm->afficherFormulaireRole(); break;

        case "modificationFilm" :
            $ctrlModification->formulaireModifierFilm($id); break;
        case "modifierFilm" : 
            $ctrlModification->modifierFilm($id);     
            $ctrlModification->formulaireModifierFilm($id); break;
                
            
    
        default: $ctrlCinema->pageAccueil(); break;
        
    }
}




