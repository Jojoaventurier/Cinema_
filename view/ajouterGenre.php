<?php ob_start(); ?>

    
        <form action="index.php?action=afficherNouveaugenre" method="post">
        <label for="titre">Nom du film :</label><br>
            <input type="text" id="titre" name="titre" /><br>
        
    
        <input type='submit' name='submit'>
    </form>


<?php

$titre = "Ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu = ob_get_clean();
require "template.php";
?>



