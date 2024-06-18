<?php ob_start();

$film = $requete->fetch() ?>


<!-- Confirmation de la suppression d'un film de la BDD' -->
<a class='link bouton' href="index.php?action=confirmerSuppressionFilm&id=<?= $film['id_film'] ?>">OUI</a>
<a class='link bouton' href="index.php?action=modificationFilm&id=<?= $film['id_film'] ?>">NON</a>



<?php
$titre = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $film['titre'] ;
$titre_secondaire = 'ETES VOUS SÛR DE VOULOIR SUPPRIMER : ' . $film['titre'] ;
$contenu = ob_get_clean();
require "view/template.php";
