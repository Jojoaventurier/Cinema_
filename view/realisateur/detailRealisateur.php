<?php ob_start();

$realisateur = $requete->fetch() ?>

<!--lien vers la page d'ajout d'un film à la BDD -->
<a class='link bouton' href="index.php?action=afficherFormulaireFilm">AJOUTER UN FILM</a>
<!-- lien vers la page formulaire de modification des informations du réalisateur -->
<a class='link bouton' href="index.php?action=afficherModifierRealisateur&id=<?= $realisateur['id_realisateur'] ?>">MODIFIER LES INFORMATIONS</a>

<!-- affiche la date de naissance du réalisateur -->
<p>Né(e) le <?= $realisateur['dateNaissance'] ?>
<table>
    <tbody>
        <?php // permet d'afficher tous les films réalisés pr le réalisateur
            foreach($requeteFilms->fetchAll() as $film) { ?>
                <tr> <!-- génère un lien pour chaque film, qui renvoie vers la page détail d'un film -->
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["sortie"] ?>)</td> <!-- affiche l'année correspondant à la sortie du film -->
                </tr>
        <?php } ?>
    </tbody>
</table>



<?php
$titre = $realisateur['realisateur'];
$titre_secondaire = $realisateur['realisateur'];
$contenu = ob_get_clean();
require "view/template.php";