<?php ob_start();

$genre = $requete->fetch() ?>

<!-- formulaire pour éditer le libellé d'un genre -->
<form action="index.php?action=modifierGenre&id=<?= $genre['id_genre'] ?>" method='post'>
    <p>
        <label for='libelle'>Libellé : </label>
            <input type='text' name='libelle' id='libelle' value="<?= $genre['libelle'] ?>">
    </p>
    

    <input type='submit' name='submit'>
</form>

<p> <!-- lien pour la suppression du genre de la BDD -->
    <a class='link bouton rouge' href="index.php?action=afficherSupprimerGenre&id=<?= $genre['id_genre']?>">SUPPRIMER LA FICHE</a>
</p>

<?php

$titre = ' MODIFIER : '. $genre['libelle'];
$titre_secondaire = ' MODIFIER : '. $genre['libelle'];
$contenu = ob_get_clean();
require "view/template.php";
