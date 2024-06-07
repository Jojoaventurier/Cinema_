<?php ob_start(); ?>

<h2><?= $libelleGenre = $requeteGenre->fetch(); echo $libelleGenre["libelle"]; ?></h2>

<p> Il y a <?= $requete->rowCount() ?> films du genre <? echo $libelleGenre["libelle"]; ?></p>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie FR</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?= $film["anneeSortieFrance"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films pour le genre " . $libelleGenre["libelle"];
$titre_secondaire = "Liste des films pour le genre" . $libelleGenre["libelle"];
$contenu = ob_get_clean();
require "view/template.php";