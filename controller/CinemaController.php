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

    public function afficherNouveauFilm() {

        if (isset($_POST['submit'])){

            $titreFilm = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie = filter_input(INPUT_POST, 'anneeSortieFrance');
            $duree = filter_input(INPUT_POST, 'duree');
            $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $realisateur = filter_input(INPUT_POST, 'realisateur');

            var_dump($titreFilm, $anneeSortie, $duree, $resume, $realisateur);
        } else {
            echo "l/'ajout n'a pas fonctionné";
        }
        require "view/listeFilms.php";
    }
}