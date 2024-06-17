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
            AND a.id_acteur = :id
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
            UPDATE personne p, acteur a
            SET p.nom = '$nom', p.prenom ='$prenom', p.dateNaissance='$dateNaissance'
            WHERE p.id_personne = a.id_personne
            AND a.id_acteur = :id
        ");
        $requeteModificationActeur->execute(["id" => $id]);
        }
    }



    public function afficherModifierRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT re.id_realisateur, CONCAT(prenom, ' ', nom) as 'realisateur', prenom, nom, dateNaissance, p.id_personne 
            FROM realisateur re, personne p
            WHERE re.id_personne = p.id_personne
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

        $requeteModificationRealisateur = $pdo->prepare("
            UPDATE personne p, realisateur re
            SET p.nom = '$nom', p.prenom ='$prenom', p.dateNaissance='$dateNaissance'
            WHERE p.id_personne = re.id_personne
            AND re.id_realisateur = :id
        ");
        $requeteModificationRealisateur->execute(["id" => $id]);
        }
    }

    
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

        public function modifierGenre($id) {

            $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($_POST['submit']) {

                $pdo = Connect::seConnecter();

                $requeteModificationGenre = $pdo->prepare("
                    UPDATE genre
                    SET libelle = '$libelle'
                    WHERE id_genre = :id
                ");
                $requeteModificationGenre->execute(["id" => $id]);
            }
        }






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

    public function confirmerSuppressionActeur($id) {

        $pdo = Connect::seConnecter();

        $requeteSupressionCasting = $pdo->prepare("
            DELETE FROM casting
            WHERE id_acteur = :id
        ");
        $requeteSupressionCasting->execute(["id" => $id]);

        $requeteSuppressionActeur = $pdo->prepare("
            DELETE FROM acteur
            WHERE id_acteur = :id
        ");
        $requeteSuppressionActeur->execute(["id" => $id]);
    }





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

    public function confirmerSuppressionRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requeteSupressionCasting = $pdo->prepare("
            DELETE c.*
            FROM casting c
            INNER JOIN film f ON c.id_film = f.id_film
            WHERE id_realisateur = :id
        ");
        $requeteSupressionCasting->execute(["id" => $id]); 

        $requeteSuppressionGenre = $pdo->prepare ("
            DELETE fg.* 
            FROM film_genres fg
            INNER JOIN film f ON f.id_film = fg.id_film
            WHERE id_realisateur = :id
        ");
        $requeteSuppressionGenre->execute(["id" => $id]);

        $requeteSuppressionFilm = $pdo->prepare("
            DELETE FROM film
            WHERE id_realisateur = :id
        ");
        $requeteSuppressionFilm->execute(["id" => $id]);

    
        $requeteSuppressionRealisateur = $pdo->prepare("
            DELETE FROM realisateur
            WHERE id_realisateur = :id
        ");
        $requeteSuppressionRealisateur->execute(["id" => $id]);
    }

}

    