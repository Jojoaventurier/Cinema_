<?php ob_start(); ?>

<p> Il y a <?= $requete->rowCount() ?> films</p>

<table>

    <tbody>
        <?php 
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["year"] ?>)</td>
                    <td><?= $film["prenom"] ?></td>
                    <td><?= $film["nom"] ?></td>
                </tr>
        <?php }   ?>
    </tbody>
</table> 

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "template.php";