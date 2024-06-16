<?php ob_start();

$realisateur = $requete->fetch() ?>


<form action="index.php?action=modifierActeur&id=<?= $realisateur['id_personne'] ?>" method='post'>
    <p>
        <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' id='prenom' value="<?= $acteur['prenom'] ?>">
    </p>
    <p>
        <label for='nom'>Nom : </label>
            <input type='text' name='nom' id='nom' value="<?= $acteur['nom'] ?>">
    </p>

    <p>
    <label for="dateNaissance">Date de naissance :</label>
        <input required="required" type="date" value="<?= $acteur['dateNaissance'] ?>" id="dateNaissance" name="dateNaissance" min='1895-01-01' max="<?= date('Y-m-d');?>" value='<?= $acteur['dateNaissance'] ?>' />
    </p>

    <input type='submit' name='submit'>
</form>


<p>
    <a class='link bouton' href="index.php?action=afficherFormulaireFilm">AJOUTER UN FILM</a><br>
</p>
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
$titre = ' MODIFIER : '. $realisateur['realisateur'];
$titre_secondaire = ' MODIFIER : '. $realisateur['realisateur'];
$contenu = ob_get_clean();
require "view/template.php";