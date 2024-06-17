<?php ob_start();

$realisateur = $requete->fetch() ?>



<a class='link bouton' href="index.php?action=confirmerSuppressionRealisateur&id=<?= $realisateur['id_realisateur'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierRealisateur&id=<?= $realisateur['id_realisateur'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $realisateur['realisateur'] ;
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $realisateur['realisateur'] ;
$contenu = ob_get_clean();
require "view/template.php";
