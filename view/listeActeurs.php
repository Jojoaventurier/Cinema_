<?php ob_start(); ?>

<a class="link bouton" href="index.php?action=afficherFormulaireActeur">AJOUTER UN ACTEUR/ACTRICE</a>

<p> Il y a <?= $requete->rowCount() ?> acteurs et actrices</p>

<table>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $acteur) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailActeur&id=<?=$acteur['id_acteur']?>"><?= $acteur["nom"]. " ". $acteur["prenom"] ?></a></td>
                    <td><?= $acteur["dateNaissance"] ?></td>
                </tr>
        <?php }  ?>
    </tbody>
</table>

<?php
$titre = "Liste des acteurs et actrices";
$titre_secondaire = "Liste des acteurs et actrices";
$contenu = ob_get_clean();
require "template.php";