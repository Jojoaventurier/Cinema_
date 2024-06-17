<?php ob_start();

$genre = $requete->fetch() ?>


<form action="" method='post'>
    <p>
        <label for='libelle'>Libellé : </label>
            <input type='text' name='libelle' id='libelle' value="<?= $genre['libelle'] ?>">
    </p>
    

    <input type='submit' name='submit'>
</form>


<?php

$titre = ' MODIFIER : '. $genre['libelle'];
$titre_secondaire = ' MODIFIER : '. $genre['libelle'];
$contenu = ob_get_clean();
require "view/template.php";
