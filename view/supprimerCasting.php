<?php ob_start();

$acteur = $requete->fetch() ?>



<a class='link bouton' href="index.php?action=confirmerSuppressionActeur&id=<?= $acteur['id_acteur'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierActeur&id=<?= $acteur['id_acteur'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $acteur['acteur'] ;
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $acteur['acteur'] ;
$contenu = ob_get_clean();
require "view/template.php";
