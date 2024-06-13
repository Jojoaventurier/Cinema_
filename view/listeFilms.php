<?php ob_start(); ?>

<a class="link bouton" href="index.php?action=afficherFormulaireFilm">AJOUTER UN FILM</a>

<p> Il y a <?= $requete->rowCount() ?> films</p>

<table>
    <tbody>
        <?php // afficher tous les films présents dans la BDD
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["year"] ?>)</td>
                    <td><a class='link' href="index.php?action=detailRealisateur&id=<?=$film['id_realisateur']?>"><?= $film["realisateur"] ?></td>
                </tr>
        <?php }   ?>
    </tbody>
</table><br> 



<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "template.php";