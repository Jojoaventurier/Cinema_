<?php ob_start(); ?>

<a href="index.php?action=afficherFormulaireGenre" class='link bouton'>AJOUTER UN GENRE</a>

<p> Il y a <?= $requete->rowCount() ?> genres</p>

<table>
    <thead>
        <tr>
            <th>Genres</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $genre) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailGenre&id=<?=$genre['id_genre']?>"><?= $genre["libelle"] ?></a></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "template.php";