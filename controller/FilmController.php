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
        FROM film f, realisateur re, personne p
        WHERE f.id_realisateur = re.id_realisateur
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
        SELECT f.id_film, titre, anneeSortieFrance as 'sortie', duree, prenom, nom, re.id_realisateur, resume 
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

// creer fonction 
// recupeère les donées de formulaire et on les sanityze
// puis fonction d'insertion grave à une requete prépaprée
public function ajouterFilm() {

    $pdo= Connect::seConnecter();
    $requeteAjoutFilm = $pdo->prepare( "
    
    ");
}



}