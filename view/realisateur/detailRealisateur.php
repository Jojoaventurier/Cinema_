<?php ob_start();

$realisateur = $requete->fetch() ?>


<a class='link bouton' href="index.php?action=afficherFormulaireFilm">AJOUTER UN FILM</a>
<a class='link bouton' href="index.php?action=afficherModifierRealisateur&id=<?= $realisateur['id_realisateur'] ?>">MODIFIER LES INFORMATIONS</a>

<p>Né(e) le <?= $realisateur['dateNaissance'] ?>
<table>
    <tbody>
        <?php
            foreach($requeteFilms->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["sortie"] ?>)</td>
                </tr>
        <?php } ?>
    </tbody>
</table>



<?php
$titre = $realisateur['realisateur'];
$titre_secondaire = $realisateur['realisateur'];
$contenu = ob_get_clean();
require "view/template.php";