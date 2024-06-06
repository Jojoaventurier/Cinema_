<?php

use Controller\CinemaCOntroller;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if (isset($GET["action"])) {
    switch($_GET["action"]) {
        // Films
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
    }
}

