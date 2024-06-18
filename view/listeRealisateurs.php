<?php ob_start(); ?>

<a class="link bouton" href="index.php?action=afficherFormulaireRealisateur">AJOUTER UN REALISATEUR/REALISATRICE</a>

<!-- Affiche le nb total de réalisateurs.trices enregistrés en BDD (table realisateur) -->
<p> Il y a <?= $requete->rowCount() ?> réalisateurs et réalisatrices</p>

<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php // Récupère et affiche tous les enregistrements de la table réalisateur
            foreach($requete->fetchAll() as $realisateur) { ?>
                <tr>
                <td><a class='link' href="index.php?action=detailRealisateur&id=<?=$realisateur['id_realisateur']?>"><?= $realisateur["nom"]. " ". $realisateur["prenom"] ?></a></td>
                <td><?= $realisateur["dateNaissance"] ?></td>
                </tr>
        <?php }          ?>
    </tbody>
</table>

<?php
$titre = "Liste des réalisateurs et réalisatrices";
$titre_secondaire = "Liste des réalisateurs et réalisatrices";
$contenu = ob_get_clean();
require "template.php";