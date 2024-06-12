<?php ob_start(); ?>

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

<p><?= var_dump($_SESSION) ?>

<?php
$titre = "Liste des acteurs et actrices";
$titre_secondaire = "Liste des acteurs et actrices";
$contenu = ob_get_clean();
require "template.php";