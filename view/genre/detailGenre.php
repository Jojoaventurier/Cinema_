<?php ob_start(); 
 $libelleGenre = $requeteGenre->fetch(); 
?>

<!-- lien vers la page formulaire de modification d'un genre (édition du libellé) -->
<a class='link bouton' href="index.php?action=afficherModifierGenre&id=<?=$libelleGenre['id_genre']?>">MODIFIER LE GENRE</a>

<h2><?= $libelleGenre["libelle"]; ?></h2>


<table>
    
    <tbody>
        <?php // récupère la liste de tous les films associés au genre
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td><!-- génère un lien vers la page détail du film -->
                    <td>(<?= $film["sortie"] ?>)</td> <!-- affiche la date de sortie du film -->
                    <td><a class='link' href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?= $film["realisateur"] ?></td> <!-- génère un lien qui renvoie vers la page détail du réalisateur -->
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films pour le genre :" ;
$titre_secondaire = "Liste des films pour le genre :";
$contenu = ob_get_clean();
require "view/template.php";