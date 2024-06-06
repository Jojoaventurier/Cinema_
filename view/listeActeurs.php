<?php ob_start(); ?>

<p> Il y a <?= $requete->rowCount() ?> acteurs et actrices</p>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th></th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $acteur["prenom"] ?></td>
                    <td><?= $acteur["nom"] ?></td>
                    <td><?= $acteur["dateNaissance"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";