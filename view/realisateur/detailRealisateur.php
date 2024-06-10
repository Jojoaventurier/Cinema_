<?php ob_start();

$realisateur = $requete->fetch() ?>


<p>Né(e) le <?= $realisateur['dateNaissance'] ?>
<table>
    <tbody>
        <?php
            foreach($requeteFilms->fetchAll() as $film) { ?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
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