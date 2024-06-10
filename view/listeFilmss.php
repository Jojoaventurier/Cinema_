<?php ob_start(); ?>

<!--<p> Il y a <?//= $requete->rowCount() ?> films</p>-->

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            <th>REALISATEUR</th>
            <th></th>
        </tr>
    </thead> 
    <tbody>
    <?php  $film = $requete->fetch();
     echo $film["titre"];

      ?>
    </tbody>
</table> 

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "template.php";
;