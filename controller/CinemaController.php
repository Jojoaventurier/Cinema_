<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    //==========================LISTES============================//
    

    public function pageAccueil() {
        $pdo = Connect::seConnecter();

        require "view/accueil.php";
    }

    /**
     * Lister les films
     */
    public function listeFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT f.id_film, titre, YEAR(anneeSortieFrance) as 'year', CONCAT(prenom, ' ', nom) as 'realisateur', f.id_realisateur
            FROM film f, realisateur re, personne p
            WHERE f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne
        ");

        require "view/listeFilms.php";
    }


    /**
     * Lister les genres
     */
    public function listeGenres() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT g.id_genre, libelle, COUNT(fg.id_film) as compte 
            FROM genre g, film_genres fg
            WHERE g.id_genre = fg.id_genre
            GROUP BY g.id_genre
            ORDER BY libelle
            
        ");

        require "view/listeGenres.php";

    }


    //========================================DETAIL=====================================//

    /**
     * Détails d'un film
     */
    public function detailFilm($id) {

        $pdo = Connect::seConnecter();

        $requeteTitre = $pdo->prepare("
            SELECT titre
            FROM film
            WHERE id_film= :id");
        $requeteTitre->execute(["id" => $id]);

        $requete = $pdo->prepare("
            SELECT f.id_film, titre, anneeSortieFrance as 'sortie', duree, prenom, nom, re.id_realisateur, resume 
            FROM film f, realisateur re, personne p
            WHERE f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne 
            AND id_film = :id
        ");
        $requete->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
            SELECT f.id_film, c.id_acteur, prenom, nom, nomRole
            FROM personne p, film f, casting c, acteur a, role r
            WHERE p.id_personne = a.id_personne
            AND f.id_film = c.id_film
            AND c.id_acteur = a.id_acteur
            AND c.id_role = r.id_role
            AND f.id_film = :id
        ");
        $requeteCasting->execute(["id" => $id]);

        require "view/film/detailFilm.php";
    }


    /**
     * Détails d'un genre
     */
    public function detailGenre($id) {

        $pdo = Connect::seConnecter();

        $requeteGenre = $pdo->prepare("SELECT libelle FROM genre WHERE id_genre= :id");
        $requeteGenre->execute(["id" => $id]);

        $requete = $pdo->prepare("
            SELECT f.id_film, titre, YEAR(anneeSortieFrance) AS 'sortie', CONCAT(prenom, ' ', nom) as 'realisateur', f.id_realisateur
            FROM film f, film_genres fg, genre g, personne p, realisateur re
            WHERE f.id_film = fg.id_film 
            AND fg.id_genre = g.id_genre
            AND f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne
            AND g.id_genre = :id
            ORDER BY titre 
        ");
        $requete->execute(["id" => $id]);


        require "view/genre/detailGenre.php";
    }
    
}