<?php ob_start(); ?>

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


<div>
        <h3>Ajouter un film</h3>
        <!-- form pour ajouter un film à la BDD (attention : le réalisateur doit faire partie de la BDD!) -->
        <form action="index.php?action=afficherFormulaire" method="POST">
            

            <input class="boutonAjouter" type="submit">
        </form> 
    </div>

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "template.php";