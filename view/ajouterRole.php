<?php ob_start(); ?>

    
        <form action="index.php?action=ajouterNouveauRole" method="post">
        <label for="nomRole">Nom du rôle :</label><br>
            <input required="required" type="text" id="nomRole" name="nomRole" /><br>
        <input type='submit' name='submit'>
    </form>


<?php

$titre = "Ajouter un rôle";
$titre_secondaire = "Ajouter un rôle";
$contenu = ob_get_clean();
require "template.php";
?>



