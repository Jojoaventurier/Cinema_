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

    public function detailFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");
        $requete->execute(["id" => $id]);
        require "view/film/detailFilm.php";
    }

    public function detailActeur($id) {
        
    }
}