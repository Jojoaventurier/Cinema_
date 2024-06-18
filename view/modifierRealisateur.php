<?php ob_start();

$realisateur = $requete->fetch() ?>

<!-- Formulaire de modification des informations d'un réalisateur -->
<form action="index.php?action=modifierRealisateur&id=<?= $realisateur['id_realisateur'] ?>" method='post'>
    <p><!-- Editer le nom -->
        <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' id='prenom' value="<?= $realisateur['prenom'] ?>">
    </p>
    <p> <!-- Editer le prénom -->
        <label for='nom'>Nom : </label>
            <input type='text' name='nom' id='nom' value="<?= $realisateur['nom'] ?>">
    </p>

    <p><!-- Editer la date de naissance -->
        <label for="dateNaissance">Date de naissance :</label>
            <input required="required" type="date" value="<?= $realisateur['dateNaissance'] ?>" id="dateNaissance" name="dateNaissance" min='1895-01-01' max="<?= date('Y-m-d');?>" value='<?= $realisateur['dateNaissance'] ?>' />
    </p>

    <input type='submit' name='submit'>
</form>


<p> <!-- lien vers le formulaire d'ajout de film -->
    <a class='link bouton' href="index.php?action=afficherFormulaireFilm">AJOUTER UN FILM</a><br>
</p>
<table> <!-- Récupère tous les films réalisés par le réalisateur -->
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

<p><!-- lien pour la suppression du réalisateur de la BDD (attention la suppression d'un réalisateur supprime automatiquement tous ses films) -->
    <a class='link bouton rouge' href="index.php?action=afficherSupprimerRealisateur&id=<?= $realisateur['id_realisateur']?>">SUPPRIMER LA FICHE</a>
</p>



<?php
$titre = ' MODIFIER : '. $realisateur['realisateur'];
$titre_secondaire = ' MODIFIER : '. $realisateur['realisateur'];
$contenu = ob_get_clean();
require "view/template.php";