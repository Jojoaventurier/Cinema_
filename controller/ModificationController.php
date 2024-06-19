<?php

namespace Controller;
use Model\Connect;

class ModificationController {


//========================================FORMULAIRES DE MODIFICATION=====================================//

    // affiche le formulaire d'édition des infos d'un film
    public function formulaireModifierFilm($id) {

        $pdo = Connect::seConnecter();

        $requeteTitre = $pdo->prepare("
            SELECT titre, id_film
            FROM film
            WHERE id_film= :id");
        $requeteTitre->execute(["id" => $id]); // requête qui récupère l'id et le nom du film

        $requete = $pdo->prepare("
            SELECT f.id_film, titre, anneeSortieFrance as 'sortie', CONCAT(FLOOR(duree/60), ' heure(s) et ',ROUND((duree/60 - FLOOR(duree/60)) * 60), ' minute(s)') AS 'durée', CONCAT(prenom, ' ', nom) as 'realisateur', re.id_realisateur, synopsis, duree 
            FROM film f, realisateur re, personne p
            WHERE f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne 
            AND id_film = :id
        ");
        $requete->execute(["id" => $id]); // requête qui récupère année de sortie, le réalisateur, le synopsis convertit la durée de minutes en H et Min, 

        $requeteCasting = $pdo->prepare("
            SELECT f.id_film, c.id_acteur, prenom, nom, nomRole
            FROM personne p, film f, casting c, acteur a, role r
            WHERE p.id_personne = a.id_personne
            AND f.id_film = c.id_film
            AND c.id_acteur = a.id_acteur
            AND c.id_role = r.id_role
            AND f.id_film = :id
        ");
        $requeteCasting->execute(["id" => $id]); // requête qui récupère tout le casting d'un film

        $requeteGenres = $pdo->prepare("
            SELECT libelle, g.id_genre
            FROM film f, genre g, film_genres fg
            WHERE f.id_film = fg.id_film
            AND g.id_genre = fg.id_genre
            AND f.id_film = :id
        ");
        $requeteGenres->execute(["id" => $id]);


        $requeteListerealisateurs = $pdo->query("
        SELECT id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur'
        FROM personne p, realisateur re
        WHERE p.id_personne = re.id_personne
        ");
    
        require "view\modifierFilm.php";  // requête qui récupère la liste des réalisateurs(liste déroulante pour modification)
    }

    // fonction qui récupère les informations de modification du film saisies par l'utilisateur
    public function modifierFilm($id) {

        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et filtre le titre saisi
        $dateSortie = filter_input(INPUT_POST, 'anneeSortieFrance'); // récupère la date de sortie saisie
        $realisateur = filter_input(INPUT_POST, 'realisateur' ); // récupère le réalisateur choisi
        $duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT); // récupère et filtre la durée saisie
        $synopsis = filter_input(INPUT_POST,'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et filtre le résumé saisi

        if ($_POST["submit"]) {
        
            $pdo = Connect::seConnecter();

            $requeteModifierFilm = $pdo->prepare("
                UPDATE film f
                SET anneeSortieFrance = '$dateSortie', titre='$titre', duree='$duree', id_realisateur='$realisateur', synopsis='$synopsis' 
                WHERE id_film = :id
            ");
            $requeteModifierFilm->execute(["id" => $id]); // requête qui rend les modifications effectives (modification directe de la BDD)
        }
    }



    // affiche le formulaire de modification des informations d'un acteur
    public function afficherModifierActeur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT a.id_acteur, CONCAT(prenom, ' ', nom) as 'acteur', prenom, nom, dateNaissance, p.id_personne 
            FROM acteur a, personne p
            WHERE a.id_personne = p.id_personne
            AND a.id_acteur = :id
        ");
        $requete->execute(["id" => $id]); // requête qui récupère les infos de l'acteur à modifier

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
        $requeteRoles->execute(["id" => $id]); // récupère les rôles joués par l'acteur

        require "view/modifierActeur.php";
    }

    // fonction qui récupère les informations de l'acteur saisies par l'utilisateur et modifie la BDD
    public function modifierActeur($id) {

        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère le prénom saisi
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère le nom saisi
        $dateNaissance = filter_input(INPUT_POST, 'dateNaissance'); // récupère la date de naissance saisie

        if ($_POST["submit"]) {
            $pdo = Connect::seConnecter();

        $requeteModificationActeur = $pdo->prepare("
            UPDATE personne p, acteur a
            SET p.nom = '$nom', p.prenom ='$prenom', p.dateNaissance='$dateNaissance'
            WHERE p.id_personne = a.id_personne
            AND a.id_acteur = :id
        ");
        $requeteModificationActeur->execute(["id" => $id]); // requête qui effectue la modification de la BDD
        }
    }



    // affiche le formulaire de modification des informations d'un réalisateur
    public function afficherModifierRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT re.id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur', prenom, nom, dateNaissance, p.id_personne 
            FROM realisateur re, personne p
            WHERE re.id_personne = p.id_personne
            AND id_realisateur = :id
        ");
        $requete->execute(["id" => $id]); // récupère les infos du réalisateur

        $requeteFilms = $pdo->prepare("
            SELECT titre, YEAR(anneeSortieFrance) AS sortie, id_film
            FROM film f, realisateur re
            WHERE f.id_realisateur = :id
            GROUP BY f.id_film
            ORDER BY sortie DESC
        ");
        $requeteFilms->execute(["id" => $id]); // récupère les films réalisés par le réalisateur

        require "view/modifierRealisateur.php";
    }

    // récupère les inforations saisies pour la modification du réalisateur et modifie la base de donnée
    public function modifierRealisateur($id) {

        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère le prénom saisi
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère le nom saisi
        $dateNaissance = filter_input(INPUT_POST, 'dateNaissance'); // récupère la date de naissance saisie

        if ($_POST["submit"]) {
            $pdo = Connect::seConnecter();

        $requeteModificationRealisateur = $pdo->prepare("
            UPDATE personne p, realisateur re
            SET p.nom = '$nom', p.prenom ='$prenom', p.dateNaissance='$dateNaissance'
            WHERE p.id_personne = re.id_personne
            AND re.id_realisateur = :id
        ");
        $requeteModificationRealisateur->execute(["id" => $id]); // requête qui modifie la BDD
        }
    }

    

    // affiche le formulaire de modification de genre (édition du libellé)
    public function afficherModifierGenre($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT libelle, id_genre
            FROM genre
            WHERE id_genre = :id
        ");
        $requete->execute(["id" => $id]);

        require "view/modifierGenre.php";
    }
    // effectue la modification du libellé dans la BDD selon les infos saisies par l'utilisateur
    public function modifierGenre($id) {

        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et filtre la valeur saisie par l'utilisateur

        if ($_POST['submit']) {

            $pdo = Connect::seConnecter();

            $requeteModificationGenre = $pdo->prepare("
                UPDATE genre
                SET libelle = '$libelle'
                WHERE id_genre = :id
            ");
            $requeteModificationGenre->execute(["id" => $id]); // modification de la BDD
        }
    }


//========================================FORMULAIRES DE SUPPRESSION =====================================//

    // affiche la page de confirmation de suppression d'un acteur (après avoir cliqué sur 'supprimer la fiche')
    public function afficherSupprimerActeur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT CONCAT(prenom, ' ', nom) as 'acteur', a.id_acteur, p.id_personne
            FROM personne p, acteur a
            WHERE a.id_personne = p.id_personne
            AND a.id_acteur = :id
            ");
        $requete->execute(["id" => $id]);

        require "view/supprimerActeur.php";
    }

    // supprime l'acteur de la table acteur si l'utilisateur clique sur 'oui'
    public function confirmerSuppressionActeur($id) {

        $pdo = Connect::seConnecter();

        $requeteSuppressionActeur = $pdo->prepare("
            DELETE FROM acteur
            WHERE id_acteur = :id
        ");
        $requeteSuppressionActeur->execute(["id" => $id]);
    }


    // affiche la page de confirmation de suppression d'un réalisateur (après avoir cliqué sur 'supprimer la fiche')
    public function afficherSupprimerRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT CONCAT(prenom, ' ', nom) as 'realisateur', re.id_realisateur, p.id_personne
            FROM personne p, realisateur re
            WHERE re.id_personne = p.id_personne
            AND re.id_Realisateur = :id
            ");
        $requete->execute(["id" => $id]);

        require "view/supprimerRealisateur.php";
    }
    // effectue la suppression du réalisateur de la table réalisateur
    public function confirmerSuppressionRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requeteSuppressionRealisateur = $pdo->prepare("
            DELETE FROM realisateur
            WHERE id_realisateur = :id
        ");
        $requeteSuppressionRealisateur->execute(["id" => $id]); //Utilisation du DELETE ON CASCADE dans la configuration des tables, qui permet de gérer automatiquement les suppressions de données relatives entre plusieurs tables reliées par une contrainte de clé étrangère (Foreign Key) en cascade.
    }


    // affiche la page de confirmation de suppression d'un genre
    public function afficherSupprimerGenre($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT libelle, id_genre
            FROM genre
            WHERE id_genre = :id
        ");
        $requete->execute(["id" => $id]);

        require "view/supprimerGenre.php";
    }

    // effectue la suppression du genre de la BDD (irreversible)
    public function confirmerSuppressionGenre ($id) {

        $pdo = Connect::seConnecter();
        $requeteSuppressionGenre = $pdo->prepare("
            DELETE FROM genre
            WHERE id_genre = :id
        ");
        $requeteSuppressionGenre->execute(['id' => $id]);

    }

    //  affiche la page de confirmation de suppression d'un film (après avoir cliqué sur 'supprimer la fiche')
    public function afficherSupprimerFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT titre, id_film
            FROM film
            WHERE id_film = :id
        ");
        $requete->execute(["id" => $id]);

        require "view/supprimerFilm.php";
    }
    // effectue la suppression du film de la BDD
    public function confirmerSuppressionFilm ($id) {

        $pdo = Connect::seConnecter();
        $requeteSuppressionGenre = $pdo->prepare("
            DELETE FROM film
            WHERE id_film = :id
        ");
        $requeteSuppressionGenre->execute(['id' => $id]);

    }

}

    