<?php

namespace Controller;
use Model\Connect;

class ModificationController {

    public function formulaireModifierFilm($id) {

        $pdo = Connect::seConnecter();

        $requeteTitre = $pdo->prepare("
            SELECT titre, id_film
            FROM film
            WHERE id_film= :id");
        $requeteTitre->execute(["id" => $id]);

        $requete = $pdo->prepare("
            SELECT f.id_film, titre, anneeSortieFrance as 'sortie', CONCAT(FLOOR(duree/60), ' heure(s) et ',ROUND((duree/60 - FLOOR(duree/60)) * 60), ' minute(s)') AS 'durée', CONCAT(prenom, ' ', nom) as 'realisateur', re.id_realisateur, synopsis, duree 
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


        $requeteListerealisateurs = $pdo->query("
        SELECT id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur'
        FROM personne p, realisateur re
        WHERE p.id_personne = re.id_personne
        ");
    
        require "view\modifierFilm.php";
    }

    public function modifierFilm($id) {

        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $dateSortie = filter_input(INPUT_POST, 'anneeSortieFrance');
        $realisateur = filter_input(INPUT_POST, 'realisateur' );
        $duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
        $synopsis = filter_input(INPUT_POST,'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //var_dump($_POST);

        if ($_POST["submit"]) {
        
            $pdo = Connect::seConnecter();

            $requeteModifierFilm = $pdo->prepare("
                UPDATE film f
                SET anneeSortieFrance = '$dateSortie', titre='$titre', duree='$duree', id_realisateur='$realisateur', synopsis='$synopsis' 
                WHERE id_film = :id
            ");
            $requeteModifierFilm->execute(["id" => $id]);
        }
    }




    public function afficherModifierActeur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT a.id_acteur, CONCAT(prenom, ' ', nom) as 'acteur', prenom, nom, dateNaissance, p.id_personne 
            FROM acteur a, personne p
            WHERE a.id_personne = p.id_personne
            AND id_acteur= :id
        ");
        $requete->execute(["id" => $id]);

        $requeteRoles = $pdo->prepare("
            SELECT a.id_acteur, titre, nomRole, YEAR(anneeSortieFrance) AS sortie, f.id_film
            FROM personne p, acteur a, film f, casting c, role r
            WHERE p.id_personne = a.id_personne
            AND a.id_acteur = c.id_acteur
            AND f.id_film = c.id_film
            AND c.id_role = r.id_role
            AND a.id_acteur = :id
            ORDER BY sortie
        ");
        $requeteRoles->execute(["id" => $id]);

        require "view/modifierActeur.php";
    }



    public function modifierActeur($id) {

        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $dateNaissance = filter_input(INPUT_POST, 'dateNaissance');

        //var_dump($_POST);

        if ($_POST["submit"]) {
            $pdo = Connect::seConnecter();

        $requeteModificationActeur = $pdo->prepare("
            UPDATE personne p
            SET nom = '$nom', prenom ='$prenom', dateNaissance='$dateNaissance'
            WHERE p.id_personne = :id
        ");
        $requeteModificationActeur->execute(["id" => $id]);
        }
    }

    public function afficherModifierRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT re.id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur', prenom, nom, dateNaissance, p.id_personne 
            FROM realisateur re, personne p
            WHERE a.id_personne = p.id_personne
            AND id_realisateur = :id
        ");
        $requete->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("
            SELECT titre, YEAR(anneeSortieFrance) AS sortie, id_film
            FROM film f, realisateur re
            WHERE f.id_realisateur = :id
            GROUP BY f.id_film
            ORDER BY sortie DESC
        ");
        $requeteFilms->execute(["id" => $id]);

        require "view/modifierRealisateur.php";
    }


    public function modifierRealisateur($id) {

        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $dateNaissance = filter_input(INPUT_POST, 'dateNaissance');

        //var_dump($_POST);

        if ($_POST["submit"]) {
            $pdo = Connect::seConnecter();

        $requeteModificationActeur = $pdo->prepare("
            UPDATE personne p
            SET nom = '$nom', prenom ='$prenom', dateNaissance='$dateNaissance'
            WHERE p.id_personne = :id
        ");
        $requeteModificationActeur->execute(["id" => $id]);
        }
    }


}

    