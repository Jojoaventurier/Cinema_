<?php ob_start();

$acteur = $requete->fetch() ?>


<form action="index.php?action=modifierActeur&id=<?= $acteur['id_acteur'] ?>" method='post'>
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
    <a class='link bouton' href="index.php?action=afficherFormulaireCasting">AJOUTER UN ROLE</a><br>
</p>

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

<p>
    <a class='link bouton rouge' href="index.php?action=afficherSupprimerActeur&id=<?= $acteur['id_acteur']?>">SUPPRIMER LA FICHE</a>
</p>

<?php

$titre = ' MODIFIER : '. $acteur['acteur'];
$titre_secondaire = ' MODIFIER : '. $acteur['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
