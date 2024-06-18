<?php ob_start();

$acteur = $requete->fetch() ?>


<!-- Formulaire pour modifier les informations d'un.e acteur.trice -->
<form action="index.php?action=modifierActeur&id=<?= $acteur['id_acteur'] ?>" method='post'>
    <p> <!-- Modifier le prénom -->
        <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' id='prenom' value="<?= $acteur['prenom'] ?>">
    </p>
    <p> <!-- Modifier le nom -->
        <label for='nom'>Nom : </label>
            <input type='text' name='nom' id='nom' value="<?= $acteur['nom'] ?>">
    </p>

    <p><!-- Modifier la date de naissance -->
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
        <?php // requête qui récupère tous les rôles joués par l'acteur (table casting)
            foreach($requeteRoles->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["sortie"] ?>)</td>
                    <td><?= $film["nomRole"] ?></td>
                    <td><a class='link' href="index.php?action=afficherSupprimerCasting&id=<?=$film['id_film']?>&idRole=<?= $film['id_role'] ?>">Supprimer le rôle</a></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<p> <!-- Lien qui fait appel à la requête de suppression de l'acteur de la table acteur (il reste toujours présent dans la table personne) -->
    <a class='link bouton rouge' href="index.php?action=afficherSupprimerActeur&id=<?= $acteur['id_acteur']?>">SUPPRIMER LA FICHE</a>
</p>

<?php

$titre = ' MODIFIER : '. $acteur['acteur'];
$titre_secondaire = ' MODIFIER : '. $acteur['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
