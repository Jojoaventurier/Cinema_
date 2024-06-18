<?php ob_start();

?>


<!-- Confirmation de la suppression de l'association acteur/role/film de la table casting, ou retour vers la page de modification d'un acteur --> 
<a class='link bouton' href="index.php?action=confirmerSuppressionCasting&id=<?= $_GET['id']?>&idRole=<?= $_GET['idRole']?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierActeur&id=<?= $_GET['id'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . '**' . ' DES RÔLES DE : ' .'**';
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . '**' . ' DES RÔLES DE : ' .'**';
$contenu = ob_get_clean();
require "view/template.php";
