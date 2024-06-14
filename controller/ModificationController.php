<?php

namespace Controller;
use Model\Connect;

class ModificationController {

    public function formulaireModifierFilm($id) {

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


}