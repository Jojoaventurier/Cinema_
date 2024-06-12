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

    public function afficherFormulaire() {


        
        require "view/listeFilms.php";
    }
}


/*
<label for="titre">Nom du film :</label><br>
                <input type="text" id="titre" name="titre" /><br>
            
            <!-- choisir l'année de sortie du film-->
            <label for="anneeSortieFrance">Année de sortie en France:</label><br>
                <input type="date" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            
            <!--Insérer le résumé du film (texte) -->
            <label for="resume">Résumé du film :</label><br>
                <textarea id="resume" name="resume" rows="4" cols="50">Enter text here...</textarea><br>
            
            <!--choisir la durée du film -->
            <label for="dureeTypeTime">Durée du film :</label><br>
                <input id="dureeTypeTime" type="time" name="dureeTypeTime" value="01:00" /><br>
            
            <!--choisir un réalisateur pour le film à ajouter-->
            <label for="realisateur">Réalisateur</label>
                <select name="realisateur" id="realisateur">    
                    <?php
                        // alimenter la liste déroulante avec les réalisateurs
                        foreach($requeteListe->fetchAll() as $realisateur) {
                            echo '<option value="'. $realisateur["id_realisateur"].'">' . $realisateur["realisateur"].'</option>';
                        }
                    ?>
                </select><br>
            */



//une fonction dans le contrôleur qui créé la vue du formulaire
//une autre fonction qui valide le formulaire