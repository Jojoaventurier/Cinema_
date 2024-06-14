<?php

namespace Controller;
use Model\Connect;

class FilmController {


    /**
     * Lister les films
     */
    public function listeFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT f.id_film, titre, YEAR(anneeSortieFrance) as 'year', CONCAT(prenom, ' ', nom) as 'realisateur', f.id_realisateur
            FROM film f
            LEFT JOIN realisateur re ON f.id_realisateur = re.id_realisateur
            LEFT JOIN personne p ON re.id_personne = p.id_personne
            AND re.id_personne = p.id_personne
        ");

        require "view/listeFilms.php";
    }

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
            SELECT f.id_film, titre, anneeSortieFrance as 'sortie', CONCAT(FLOOR(duree/60), ' heure(s) et ',ROUND((duree/60 - FLOOR(duree/60)) * 60), ' minute(s)') AS 'durée', prenom, nom, re.id_realisateur, synopsis 
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





    public function afficherFormulaireFilm() {
        $pdo= Connect::seConnecter();

        // requête pour la liste déroulante des réalisateurs du form "ajouter un film"
        $requeteListe = $pdo->prepare("
        SELECT id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur'
        FROM personne p, realisateur re
        WHERE p.id_personne = re.id_personne
        ");
        $requeteListe->execute();


        require "view/ajouterFilm.php";
    }

    public function ajouterNouveauFilm() {

            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortieFrance = ($_POST['anneeSortieFrance']);
            $duree = ($_POST['dureeTypeTime']);
            $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $minutes = date('h',strtotime($duree))*60+date('i',strtotime($duree));
            $idRealisateur = $_POST['realisateur'];


        /*  var_dump($titre);
            var_dump($anneeSortieFrance);
            var_dump($minutes);
            var_dump($synopsis);
            var_dump($idRealisateur);
            var_dump($_POST); */

            if ($_POST["submit"]) {

                $pdo = Connect::seConnecter();
                $requeteAjoutFilm = $pdo->prepare("
                    INSERT INTO film (titre, anneeSortieFrance, duree, synopsis, id_realisateur)
                    VALUES ('$titre', '$anneeSortieFrance', '$minutes', '$synopsis', '$idRealisateur')
                    ");
                $requeteAjoutFilm->execute();
            }
            //$confirmation = "Confirmez-vous l'ajout de l'élément à la base de donnée ?";
    }


    public function afficherFormulaireCasting($id) {

            $pdo = Connect::seConnecter();
    
            $requeteTitre = $pdo->prepare("
                SELECT titre
                FROM film
                WHERE id_film= :id");
            $requeteTitre->execute(["id" => $id]);
        require "view/ajouterCasting";
    }

}