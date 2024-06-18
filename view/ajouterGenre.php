<?php ob_start(); ?>

        <!-- Formulaire d'ajout d'un genre -->
        <form action="index.php?action=ajouterNouveauGenre" method="post">

        <label for="nomGenre">Nom du genre :</label><br>
            <input required="required" type="text" id="nomNouveauGenre" name="nomNouveauGenre" /><br>

        <input type='submit' name='submit'>
    </form>


<?php

$titre = "Ajouter un genre";
$titre_secondaire = "Ajouter un genre";
$contenu = ob_get_clean();
require "template.php";
?>



