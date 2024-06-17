<?php ob_start();

$Casting = $requeteRole->fetch() ?>



<a class='link bouton' href="index.php?action=confirmerSuppressionActeur&id=<?= $casting['id_acteur'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierActeur&id=<?= $casting['id_acteur'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $casting['nomRole'] . ' DES RÔLES DE : ' .$casting['acteur'];
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $casting['nomRole'] . ' DES RÔLES DE : ' .$casting['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
