<?php

use Controller\CinemaController;
use Controller\PersonneController;

spl_autoload_register(function ($class_name) {
    include  $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlPersonne = new PersonneController();


$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if (isset($_GET["action"])) {
    switch($_GET["action"]) {
        // 
        case "accueil" : $ctrlCinema->pageAccueil(); break;
        case "listeFilms" : $ctrlCinema->listeFilms(); break;
        case "listeActeurs" : $ctrlPersonne->listeActeurs(); break;
        case "listeRealisateurs" : $ctrlPersonne->listeRealisateurs(); break;
        case "listeGenres" : $ctrlCinema->listeGenres(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        case "detailActeur" : $ctrlPersonne->detailActeur($id); break;
        case "detailRealisateur" : $ctrlPersonne->detailRealisateur($id); break;
        case "detailGenre" : $ctrlCinema->detailGenre($id); break;
        

        case "detailGenre" : $ctrlCinema->detailGenre(); break;

        default: $ctrlCinema->pageAccueil(); break;
        
    }
}

