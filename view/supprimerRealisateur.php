<?php ob_start();

$realisateur = $requete->fetch() ?>


<!-- Confirmation de la suppression d'un réalisateur de la BDD (attention, supprime les films de la BDD) -->
<a class='link bouton' href="index.php?action=confirmerSuppressionRealisateur&id=<?= $realisateur['id_realisateur'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierRealisateur&id=<?= $realisateur['id_realisateur'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $realisateur['realisateur'] ;
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $realisateur['realisateur'] ;
$contenu = ob_get_clean();
require "view/template.php";
