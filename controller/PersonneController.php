<?php

namespace Controller;
use Model\Connect;

class PersonneController {

    /**
     * Lister les acteurs
     */
    public function listeActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_acteur, prenom, nom, dateNaissance
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
            SELECT id_realisateur, prenom, nom, dateNaissance
            FROM realisateur re, personne p
            WHERE re.id_personne = p.id_personne
            ORDER BY nom
        ");

        require "view/listeRealisateurs.php";

        }

    /**
     * Détails d'un acteur
     */
    public function detailActeur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT a.id_acteur, CONCAT(prenom, ' ', nom) as 'acteur', prenom, nom, dateNaissance 
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

        require "view/acteur/detailActeur.php";
    }

    /**
     * Détails d'un réalisateur
     */
    public function detailRealisateur($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT re.id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur', dateNaissance
            FROM realisateur re, personne p
            WHERE re.id_personne = p.id_personne
            AND re.id_realisateur = :id
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

        require "view/realisateur/detailRealisateur.php";
    }



    public function afficherFormulaireActeur() {
        require "view/ajouterActeur.php";
    }

    public function ajouterNouvelActeur() {

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = $_POST['sexe'];
        $dateNaissance = $_POST['dateNaissance'];

        // var_dump($_POST);

        if ($_POST["submit"]) {
            
            $pdo = Connect::seConnecter();
            $requeteAjoutPersonne = $pdo->prepare("
                INSERT INTO personne (nom, prenom, sexe, dateNaissance)
                VALUES ('$nom', '$prenom', '$sexe', '$dateNaissance')
            ");
            $requeteAjoutPersonne->execute();
        }
    }


    public function afficherFormulaireRealisateur() {
        require "view/ajouterRealisateur.php";
    }

    public function ajouterNouveauRealisateur() {

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = $_POST['sexe'];
        $dateNaissance = $_POST['dateNaissance'];

        // var_dump($_POST);
        /*
        if ($_POST["submit"]) {
            
            $pdo = Connect::seConnecter();
            $requeteAjoutPersonne = $pdo->prepare("
                INSERT INTO personne (nom, prenom, sexe, dateNaissance)
                VALUES ('$nom', '$prenom', '$sexe', '$dateNaissance')
            ");
            $requeteAjoutPersonne->execute();
        }
        */
    }



}