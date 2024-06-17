<?php ob_start();

$realisateur = $requete->fetch() ?>



<a class='link bouton' href="index.php?action=confirmerSuppressionFilm&id=<?= $film['id_film'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=afficherModifierFilm&id=<?= $film['id_film'] ?>">NON</a>





<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $film['titre'] ;
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $film['titre'] ;
$contenu = ob_get_clean();
require "view/template.php";
