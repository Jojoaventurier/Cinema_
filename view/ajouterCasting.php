<?php ob_start(); 
$titreFilm = $requeteTitre->fetch() ?>

<h3><a class='link' href="index.php?action=detailFilm&id=<?=$titreFilm['id_film']?>"><?= $titreFilm["titre"] ?></h3>


<?php
    $titre = "Ajouter un acteur ou actrice au casting";
    $titre_secondaire = "Ajouter un acteur ou une actrice au casting";
    $contenu = ob_get_clean();
    require "template.php";
?>