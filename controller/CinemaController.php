<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public function ListFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, anneeSortieFrance
            FROM film
        ");

        require "view/listFilms.php";
    }
}