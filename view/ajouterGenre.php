<?php ob_start(); ?>

    
        <form action="index.php?action=afficherNouveaugenre" method="post">
        <label for="nomGenre">Nom du genre :</label><br>
            <input type="text" id="nomGenre" name="nomGenre" /><br>
        
    
        <input type='submit' name='submit'>
    </form>


<?php

$titre = "Ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu = ob_get_clean();
require "template.php";
?>



