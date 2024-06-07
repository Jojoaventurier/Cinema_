<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    //==========================LISTES============================//
    /**
     * Lister les films
     */
    public function listeFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, anneeSortieFrance, prenom, nom
            FROM film f, realisateur re, personne p
            WHERE f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne 
        ");

        require "view/listeFilms.php";
    }


  /**
     * Lister les acteurs
     */
    public function listeActeur() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom, dateNaissance
            FROM acteur
        ");

        require "view/listeActeurs.php";

    }


  /**
     * Lister les réalisateurs
     */
    public function listeRealisateurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom, dateNaissance
            FROM realisateur
        ");

        require "view/listeRealisateurs.php";

    }
  /**
     * Lister les genres
     */
    public function listeGenres() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT libelle
            FROM genres
        ");

        require "view/listeGenres.php";

    }


    //========================================DETAIL=====================================//

  /**
     * Détails d'un film
     */
    public function detailFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");
        $requete->execute(["id" => $id]);
        require "view/film/detailFilm.php";
    }


     /**
     * Détails d'un acteur
     */
    public function detailActeur($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM acteur WHERE id_acteur = :id");
        $requete->execute(["id" => $id]);
        require "view/acteur/detailActeur.php";
    }


    /**
     * Détails d'un réalisateur
     */
    public function detailRealisateur($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM realisateur WHERE id_realisateur = :id");
        $requete->execute(["id" => $id]);
        require "view/realisateur/detailRealisateur.php";
    }

    /**
     * Détails d'un genre
     */
    public function detailGenre($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("SELECT titre, anneeSortieFrance FROM film WHERE id_genre = :id");
        $requete->execute(["id" => $id]);

        $requeteGenre = $pdo->prepare("SELECT libelle FROM genre WHERE id_genre= :id");
        $requeteGenre->execute(["id" => $id]);

        require "view/genre/detailGenre.php";
    }
    // ajouter fonction pour classer les films par réalisateur?
}