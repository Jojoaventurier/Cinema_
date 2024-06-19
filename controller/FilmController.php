<?php

namespace Controller;
use Model\Connect;

class FilmController {





//==========================LISTES============================//

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
        "); // requête qui récupère tous les films de la base de donnée

        require "view/listeFilms.php";
    }


//========================================DETAILS=====================================//
    /**
     * Détails d'un film
     */
    public function detailFilm($id) {

        $pdo = Connect::seConnecter();

        $requeteTitre = $pdo->prepare("
            SELECT titre, id_film
            FROM film
            WHERE id_film= :id");
        $requeteTitre->execute(["id" => $id]); // requête récupère le titre et l'id du film

        $requete = $pdo->prepare("
            SELECT f.id_film, titre, anneeSortieFrance as 'sortie', CONCAT(FLOOR(duree/60), ' heure(s) et ',ROUND((duree/60 - FLOOR(duree/60)) * 60), ' minute(s)') AS 'durée', prenom, nom, re.id_realisateur, synopsis 
            FROM film f, realisateur re, personne p
            WHERE f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne 
            AND id_film = :id
        ");
        $requete->execute(["id" => $id]); // requête qui récupère toutes les informations du film (titre, année de sortie, durée en h et min, prénom et nom du réalisateur)

        $requeteGenres = $pdo->prepare("
            SELECT libelle, g.id_genre
            FROM film f, genre g, film_genres fg
            WHERE f.id_film = fg.id_film
            AND g.id_genre = fg.id_genre
            AND f.id_film = :id 
        ");
        $requeteGenres->execute(["id" => $id]); // requête qui récupère les genres associés au film

        $requeteCasting = $pdo->prepare("
            SELECT f.id_film, c.id_acteur, prenom, nom, nomRole
            FROM personne p, film f, casting c, acteur a, role r
            WHERE p.id_personne = a.id_personne
            AND f.id_film = c.id_film
            AND c.id_acteur = a.id_acteur
            AND c.id_role = r.id_role
            AND f.id_film = :id 
        ");
        $requeteCasting->execute(["id" => $id]); // requête qui récupère tous les acteurs associés au film et le nom du rôle correspondant

        require "view/film/detailFilm.php";
    }




//========================================FORMULAIRES D'AJOUT=====================================//


    // fonction pour afficher le formulaire de modification
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

    // fonction qui ajoute les valeurs saisies dans le formulaire à la BDD
    public function ajouterNouveauFilm() {

            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et filtre le titre saisi par l'utilisateur
            $anneeSortieFrance = ($_POST['anneeSortieFrance']); // récupère la date de sortie choisie par l'utilisateur
            $duree = ($_POST['dureeTypeTime']); // récupère la durée saisie (en type time)
            $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère la synopsis saisi par l'utilisateur
            $minutes = date('h',strtotime($duree))*60+date('i',strtotime($duree)); // convertit la durée en minutes et la stocke dans la variable $minutes
            $idRealisateur = $_POST['realisateur']; // récupère le réalisateur de la liste déroulante choisi par l'utilisateur 

            if ($_POST["submit"]) {

                $pdo = Connect::seConnecter(); // requête qui insère dans la table film en utilisant les valeurs saisies par l'utilisateur récupérées
                $requeteAjoutFilm = $pdo->prepare("
                    INSERT INTO film (titre, anneeSortieFrance, duree, synopsis, id_realisateur)
                    VALUES ('$titre', '$anneeSortieFrance', '$minutes', '$synopsis', '$idRealisateur')
                    ");
                $requeteAjoutFilm->execute();
            }
    }

    // fonction pour afficher le formulaire d'ajout de casting pour un film
    public function afficherFormulaireCasting() {

            $pdo = Connect::seConnecter();
    
            $requeteListeFilms = $pdo->query("
                SELECT titre, id_film
                FROM film
                ");
            // récupère la liste des films pour le premier menu déroulant

            $requeteListeActeurs = $pdo->query("
                SELECT a.id_personne, a.id_acteur, CONCAT(nom, ' ', prenom) as 'acteur'
                FROM personne p, acteur a
                WHERE p.id_personne = a.id_personne
                ORDER BY nom
            ");
            // récupère la liste des acteurs pour le second menu déroulant

            $requeteListeRoles = $pdo->query("
                SELECT id_role, nomRole
                FROM role
                ORDER BY nomRole
            ");
            // récupère la liste de tous les rôles présents en BDD pour le troisième menu déroulant

        require "view\ajouterCasting.php";
    }

    // fonction qui ajoute les associations saisies grâce aux menus déroulants à la table casting de la BDD
    public function ajouterNouveauCasting() {

        $film = filter_input(INPUT_POST, 'film'); // récupère le film choisi par l'utilisateur sur la page de modification de casting
        $acteur = filter_input(INPUT_POST, 'acteur'); // récupère l'acteur choisi par l'utilisateur à associer au film et au rôle
        $role = filter_input(INPUT_POST, 'role'); // récupère le rôle choisi par l'utilisateur à associer au film et à l'acteur

        if($_POST["submit"]) {

            $pdo = Connect::seConnecter(); 

            $requeteAjoutCasting = $pdo->query("
                INSERT INTO casting (id_film, id_acteur, id_role)
                VALUES ('$film', '$acteur', '$role')
            "); // requête qui ajoute l'association des trois valeurs à la table casting
        }
    }

    // fonction pour afficher le formulaire d'ajout de rôle à la BDD
    public function afficherFormulaireRole() {
        require 'view\ajouterRole.php';
    }

    // fonction qui permet d'ajouter le rôle que l'on souhaite créer à la BDD 
    public function ajouterNouveauRole() {

        $pdo = Connect::seConnecter();

        $role = filter_input(INPUT_POST, 'nomRole', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et filtre la valeur saisie par l'utilisateur

        if ($_POST['submit']) { 

            $requeteAjoutRole = $pdo->query("
                INSERT INTO role (nomRole)
                VALUES ('$role')
            "); // requete qui ajoute le nouveau rôle à la BDD
        }
    }

    // fonction qui permet d'afficher la confirmation de la suppression d'un rôle pour un acteur
    public function afficherSupprimerCasting($id) {

        $pdo = Connect::seConnecter();
    
        $requete = $pdo->prepare("
        SELECT a.id_acteur, CONCAT(prenom, ' ', nom) as 'acteur', prenom, nom, dateNaissance 
        FROM acteur a, personne p
        WHERE a.id_personne = p.id_personne
        AND id_acteur= :id
        ");
        $requete->execute(["id" => $id]); // requête qui permet de récupérer les infos d'un acteur

        $requeteRoles = $pdo->prepare("
            SELECT a.id_acteur, titre, nomRole, YEAR(anneeSortieFrance) AS sortie, f.id_film, r.id_role
            FROM personne p, acteur a, film f, casting c, role r
            WHERE p.id_personne = a.id_personne
            AND a.id_acteur = c.id_acteur
            AND f.id_film = c.id_film
            AND c.id_role = r.id_role
            AND a.id_acteur = :id
            ORDER BY sortie
        ");
        $requeteRoles->execute(["id" => $id]); // requête qui récupère tous les rôles de l'acteur

        require "view/supprimerCasting.php";
    }
    // fonction qui effectye la suppression du rôle associé à un acteur et à un film de la table casting
    public function confirmerSuppressionCasting($id,$idRole) {

       
        $pdo = Connect::seConnecter();
        
        $requeteSuppressionCasting = $pdo->prepare("
            DELETE FROM casting
            WHERE id_film = :id
            AND id_role = :id_role
        ");
        $requeteSuppressionCasting->execute(["id" => $id, "id_role" => $idRole]);
    }


    //  fonction qui permet d'afficher le formulaire de modification des genres !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function afficherModifierGenresFilm($id) {

        $pdo = Connect::seConnecter(); 

        $requete = $pdo->prepare("
            SELECT titre, id_film
            FROM film
            WHERE id_film = :id
        ");
        $requete->execute(["id" => $id]);

        $requeteListeGenres = $pdo->query("
            SELECT libelle, id_genre
            FROM genre
        ");

        $requeteListeGenresDuFilm = $pdo->prepare("
            SELECT libelle, g.id_genre
            FROM genre g, film_genres fg
            WHERE g.id_genre = fg.id_genre
            AND fg.id_film = :id
        ");
        $requeteListeGenresDuFilm->execute(["id" => $id]);

        require "view/modifierGenresFilm.php";
    }

    // permet d'ajouter plusieurs genres à un film (attention si un genre est déjà enregistré il sera enregistré plusieurs fois)
    public function confirmerModificationGenresFilm($id, $idGenre) {

        $idGenres = $_POST['filmGenres'];

        
        var_dump($idGenres);
        $pdo = Connect::seConnecter();

        foreach ($idGenres as $idGenre) {

            $requeteAjoutGenres = $pdo->prepare("
                INSERT INTO film_genres 
                VALUES ( :id, :id_genre )
            ");
            $requeteAjoutGenres->execute(["id" => $id, "id_genre" => $idGenre]);
            
        } 
        
    }
}