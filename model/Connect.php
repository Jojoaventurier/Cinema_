<?php
 
namespace Model;
 
// Définition d'une classe abstraite Connect dans l'espace de noms Model
abstract class Connect
{
 
    // Définition des constantes pour les paramètres de connexion à la base de données
    const HOST = "localhost"; // Nom d'hôte de la base de données
    const DB = "cinema"; // Nom de la base de données
    const USER = "root"; // Nom d'utilisateur de la base de données
    const PASS = ""; // Mot de passe de la base de données (vide dans ce cas)
 
    // Méthode statique pour établir une connexion à la base de données
    public static function seConnecter()
    {
        try {
            // Création et retour d'un objet PDO pour la connexion à la base de données
            return new \PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DB . ";charset=utf8", // Chaîne de connexion PDO
                self::USER, // Nom d'utilisateur de la base de données
                self::PASS // Mot de passe de la base de données
            );
        } catch (\PDOException $ex) {
            // En cas d'erreur lors de la connexion, retourne le message d'erreur
            return $ex->getMessage();
        }
    }
}
?>


