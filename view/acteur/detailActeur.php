<?php ob_start();

$acteur = $requete->fetch() ?>

<!-- lien vers la page de modification d'un acteur -->
<a class='link bouton' href="index.php?action=afficherModifierActeur&id=<?= $acteur['id_acteur'] ?>">MODIFIER LES INFORMATIONS</a>

<p>Né(e) le <?= $acteur['dateNaissance'] ?> <!-- récupère la date de naissance de l'acteur -->
<table>
    <tbody>
        <?php // récupère et affiche tous les rôles et le nom des films dans lesquels l'acteur a joué
            foreach($requeteRoles->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td> <!-- génère un lien vers le détail du film -->
                    <td>(<?= $film["sortie"] ?>)</td> <!-- récupère et affiche la date de sortie du film -->
                    <td><?= $film["nomRole"] ?></td> <!-- récupère et affiche le nom du rôle correspondant pour le film -->
                </tr>
        <?php } ?>
    </tbody>
</table>



<?php
$titre = $acteur['acteur'];
$titre_secondaire = $acteur['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
