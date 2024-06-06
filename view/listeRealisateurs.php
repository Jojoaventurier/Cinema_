<?php ob_start(); ?>

<p> Il y a <?= $requete->rowCount() ?> réalisateurs et réalisatrices</p>

<table>
    <thead>
        <tr>
            <th>nom</th>
            <th></th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $realisateur) { ?>
                <tr>
                    <td><?= $realisateur["prenom"] ?></td>
                    <td><?= $realisateur["nom"] ?></td>
                    <td><?= $realisateur["dateNaissance"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des réalisateurs et réalisatrices";
$titre_secondaire = "Liste des réalisateurs et réalisatrices";
$contenu = ob_get_clean();
require "view/template.php";