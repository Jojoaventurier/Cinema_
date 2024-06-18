<?php ob_start(); 
$titreFilm = $requeteTitre->fetch() ?>


<!-- lien vers la page formulaire de modification des informations d'un film -->
<a class='link bouton' href="index.php?action=modificationFilm&id=<?=$titreFilm['id_film']?>">MODIFIER LE FILM</a>
                
<?php
    foreach($requete->fetchAll() as $film) { ?>
        
            <p>Sortie le : <?= $film["sortie"] ?></p><!-- récupère la date de sortie du film -->
            <p>Réalisé par <a class='link' href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?= $film["prenom"] . " " . $film["nom"] ?></a></p><!-- génère un lien vers la page détail du réalisateur -->
            <p>Durée : <?= $film["durée"] ?></p><!-- récupère la durée du film -->
<?php } ?>

<p>
    <?php // affiche tous les genres associés au film
        foreach($requeteGenres->fetchAll() as $genre) { ?>

        <a class="link" href="index.php?action=detailGenre&id=<?= $genre['id_genre']?>"><?=$genre['libelle']?></a>
        
    <?php  }
    ?>
</p>

<?php // récupère les acteurs et leur rôle correspondant pour le film
foreach($requeteCasting->fetchAll() as $casting) { ?>
    
    <table>
        <tr><!-- génère un lien vers la page détail de chaque acteur -->
            <td><a class='link' href="index.php?action=detailActeur&id=<?=$casting['id_acteur']?>"><?= $casting["prenom"]. " ". $casting["nom"] ?></a></td>
            <td><?= " : ". $casting["nomRole"] ?></td> <!-- récupère le nom du rôle associé à l'acteur pour le film -->
        </tr>
<?php } ?>
    </table>

    <p id="synopsis"><?= $film["synopsis"] ?> <!-- affiche le synopsis du film enregistré en BDD -->

<?php
$titre = $titreFilm["titre"];
$titre_secondaire = $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";

















