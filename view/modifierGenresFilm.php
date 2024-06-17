<?php ob_start();

$film = $requete->fetch() ?>


<form action="index.php?action=confirmerModifierGenresFilm&id=<?=$film['id_film']?>" method='post'>


<?php




    foreach($listeGenres = $requeteListeGenres->fetchAll() as $genre) {
            echo '<input  type = "checkbox" value ="'.strtolower($genre['libelle']).'">' .$genre['libelle']. '</input><br>';
        }  
    
?>



    <input type='submit' name='submit'>

</form>


<?php

$titre = 'MODIFIER LES GENRES DE : '. $film['titre'];
$titre_secondaire = 'MODIFIER LES GENRES DE : '. $film['titre'];
$contenu = ob_get_clean();
require "view/template.php";
