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
            SELECT titre, YEAR(anneeSortieFrance) as 'year', prenom, nom
            FROM film f, realisateur re, personne p
            WHERE f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne
        ");

        require "view/listeFilms.php";
    }


    /**
     * Lister les acteurs
     */
    public function listeActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom, dateNaissance
            FROM acteur a, personne p
            WHERE a.id_personne = p.id_personne
            ORDER BY nom
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
            FROM realisateur re, personne p
            WHERE re.id_personne = p.id_personne
            ORDER BY nom
        ");

        require "view/listeRealisateurs.php";

    }
    /**
     * Lister les genres
     */
    public function listeGenres() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_genre, libelle
            FROM genre
        ");

        require "view/listeGenres.php";

    }


    //========================================DETAIL=====================================//

    /**
     * Détails d'un film
     */
    public function detailFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT titre, anneeSortieFrance, duree, prenom, nom 
            FROM film f, realisateur re
            WHERE f.id_realisateur = re.id_realisateur 
            AND id_film = :id
        ");
        $requete->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
            SELECT prenom, nom, nomRole
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
     * Détails d'un acteur
     */
    public function detailActeur($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT prenom, nom, dateNaissance
            FROM personne p, acteur a
            WHERE p.id_personne = a.id_personne
            AND a.id_acteur = :id
        ");
        $requete->execute(["id" => $id]);

        $requeteRoles = $pdo->prepare("
            SELECT  titre, nomRole, YEAR(anneeSortieFrance) AS sortie
            FROM personne p, acteur a, film f, casting c, role r
            WHERE p.id_personne = a.id_personne
            AND a.id_acteur = c.id_acteur
            AND f.id_film = c.id_film
            AND c.id_role = r.id_role
            AND a.id_acteur = :id
            ORDER BY sortie
        ");
        $requeteRoles->execute(["id" => $id]);

        require "view/acteur/detailActeur.php";
    }


    /**
     * Détails d'un réalisateur
     */
    public function detailRealisateur($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT prenom, nom, dateNaissance
            FROM realisateur re, personne p
            WHERE re.id_personne = p.id_personne
            AND re.id_realisateur = :id
        ");
        $requete->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("
            SELECT titre, YEAR(anneeSortieFrance) AS sortie
            FROM film f, realisateur re
            WHERE f.id_realisateur = :id
            GROUP BY f.id_film
            ORDER BY sortie
        ");
        $requeteFilms->execute(["id" => $id]);

        require "view/realisateur/detailRealisateur.php";
    }

    /**
     * Détails d'un genre
     */
    public function detailGenre($id) {

        $pdo = Connect::seConnecter();

        $requeteGenre = $pdo->prepare("SELECT libelle FROM genre WHERE id_genre= :id");
        $requeteGenre->execute(["id" => $id]);

        $requete = $pdo->prepare("
            SELECT titre, YEAR(anneeSortieFrance) AS 'sortie', prenom, nom
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