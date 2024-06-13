<?php ob_start(); ?>

    <form>
        <label for="titre">Nom du film :</label><br>
            <input type="text" id="titre" name="titre" /><br>
        
        <!-- choisir l'année de sortie du film-->
        <label for="anneeSortieFrance">Année de sortie en France:</label><br>
            <input type="date" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
        
        <!--Insérer le résumé du film (texte) -->
        <label for="resume">Résumé du film :</label><br>
            <textarea id="resume" name="resume" rows="4" cols="50">Enter text here...</textarea><br>
        
        <!--choisir la durée du film -->
        <label for="dureeTypeTime">Durée du film :</label><br>
            <input id="dureeTypeTime" type="time" name="dureeTypeTime" value="01:00" /><br>
        
        <!--choisir un réalisateur pour le film à ajouter-->
        <label for="realisateur">Réalisateur</label>
            <select name="realisateur" id="realisateur">    
                <?php
                    // alimenter la liste déroulante avec les réalisateurs
                    foreach($requeteListe->fetchAll() as $realisateur) {
                        echo '<option value="'. $realisateur["id_realisateur"].'">' . $realisateur["realisateur"].'</option>';
                    }
                ?>
            </select><br>
        <input type="submit">
    </form>


<?php

$titre = "Ajouter un acteur/actrice";
$titre_secondaire = "Ajouter un acteur/actrice";
$contenu = ob_get_clean();
require "template.php";
?>



