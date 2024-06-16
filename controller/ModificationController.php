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

        $requeteListeActeurs = $pdo->query("
                SELECT a.id_personne, a.id_acteur, CONCAT(nom, ' ', prenom) as 'acteur'
                FROM personne p, acteur a
                WHERE p.id_personne = a.id_personne
                ORDER BY nom
            ");

        $requeteListeRoles = $pdo->query("
            SELECT id_role, nomRole
            FROM role
            ORDER BY nomRole
        ");

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

        var_dump($_POST);
        
        $pdo = Connect::seConnecter();

        $requeteModifierFilm = $pdo->prepare("
            UPDATE film f
            SET anneeSortieFrance = '$dateSortie', titre='$titre', duree='$duree', id_realisateur='$realisateur', synopsis='$synopsis' 
            WHERE id_film = :id
        ");
        $requeteModifierFilm->execute(["id" => $id]);
    }
}