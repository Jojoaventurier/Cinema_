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
        

        case "addFilm" :
            if (isset($_POST['submit'])){
                $titreFilm = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $anneeSortie = filter_input(INPUT_POST, 'anneeSortieFrance', FILTER_VALIDATE_INT);
                $duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
                $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                

            };

        default: $ctrlCinema->pageAccueil(); break;
        
    }
}

