<?php ob_start(); ?>

<p> Il y a <?= $requete->rowCount() ?> genres</p>

<table>
    <thead>
        <tr>
            <th>Libellé</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <tr>
                    <td><?= $genre["libelle"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "template.php";