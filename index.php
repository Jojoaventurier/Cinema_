<?php 
    session_start();

    

use Controller\CinemaController;
use Controller\PersonneController;
use Controller\FilmController;

spl_autoload_register(function ($class_name) {
    include  $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlPersonne = new PersonneController();
$ctrlFilm = new FilmController();


$id = (isset($_GET["id"])) ? $_GET["id"] : null;


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
        

        case "ajouterFilm" :
            $ctrlCinema->afficherFormulaire(); break;

        default: $ctrlCinema->pageAccueil(); break;
        
    }
}




