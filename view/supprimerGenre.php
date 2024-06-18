<?php ob_start();

$genre = $requete->fetch() ?>


<!-- Confirmation de la suppression d'un genre de la BDD ou retour vers la page de modification d'un genre -->
<a class='link bouton' href="index.php?action=confirmerSuppressionGenre&id=<?= $genre['id_genre'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierGenre&id=<?= $genre['id_genre'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $genre['libelle'] ;
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $genre['libelle'] ;
$contenu = ob_get_clean();
require "view/template.php";
