<?php ob_start();

$acteur = $requete->fetch() ?>

<p>Né(e) le <?= $acteur['dateNaissance'] ?>

<a class='link bouton' href="index.php?action=afficherFormulaireCasting">AJOUTER UN ROLE</a>

<table>
    <tbody>
        <?php
            foreach($requeteRoles->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["sortie"] ?>)</td>
                    <td><?= $film["nomRole"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>



<?php
$titre = ' MODIFIER : '. $acteur['acteur'];
$titre_secondaire = ' MODIFIER : '. $acteur['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
