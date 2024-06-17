<?php ob_start();

$acteur = $requete->fetch() ?>

<a class='link bouton' href="index.php?action=afficherModifierActeur&id=<?= $acteur['id_acteur'] ?>">MODIFIER LES INFORMATIONS</a>

<p>Né(e) le <?= $acteur['dateNaissance'] ?>
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
$titre = $acteur['acteur'];
$titre_secondaire = $acteur['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
