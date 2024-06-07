<?php ob_start(); ?>

<h2><?= $genre = $requeteGenre->fetch(); echo $genre["libelle"]; ?></h2>

<p> Il y a <?= $requete->rowCount() ?> films du genre <?= $genre = $requeteGenre->fetch(); echo $genre["libelle"]; ?></p>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie FR</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <tr>
                    <td><?= $genre["titre"] ?></td>
                    <td><?= $genre["anneeSortieFrance"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films pour le genre " . $genre["libelle"];
$titre_secondaire = "Liste des films pour le genre" . $genre["libelle"];
$contenu = ob_get_clean();
require "view/template.php";