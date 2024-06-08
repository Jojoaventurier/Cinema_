<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if (isset($_GET["action"])) {
    switch($_GET["action"]) {
        // Films
        case "listeFilms" : $ctrlCinema->listeFilms(); break;
        case "listeActeurs" : $ctrlCinema->listeActeurs(); break;
        case "listeRealisateurs" : $ctrlCinema->listeRealisateurs(); break;
        case "listeGenres" : $ctrlCinema->listeGenres(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
        case "detailGenre" : $ctrlCinema->detailGenre($id); break;
    }
}

