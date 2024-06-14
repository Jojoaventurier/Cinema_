<?php ob_start(); 
?>


<a class='link bouton' href="index.php?action=afficherFormulaireRole">AJOUTER UN ROLE A LA BASE DE DONNEE</a>

<?php
    $titre = "Ajouter un acteur ou actrice au casting d'un film";
    $titre_secondaire = "Ajouter un acteur ou une actrice au casting d'un film";
    $contenu = ob_get_clean();
    require "template.php";
?>