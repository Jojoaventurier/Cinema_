<?php ob_start();

$film = $requete->fetch() ?>

<!-- Formulaire pour ajouter des genres à un film -->
<form action="index.php?action=confirmerModifierGenresFilm&id=<?=$film['id_film']?>" method='post'>


<?php
$ListeGenresDuFilm = $requeteListeGenresDuFilm->fetchAll();
//var_dump($ListeGenresDuFilm);


    foreach($listeGenres = $requeteListeGenres->fetchAll() as $genre) {

        // name = 'array[]' permet que si plusieurs input ont le même noms, toutes les valeurs renseignées seront accessibles depuis $_POST['array']
        echo '<input name="filmGenres[]"  type="checkbox" value ="'.strtolower($genre['id_genre']).'">' .$genre['libelle']. '</input><br>';
    }     
?>



    <input type='submit' name='submit'>

</form>


<?php

$titre = 'MODIFIER LES GENRES DE : '. $film['titre'];
$titre_secondaire = 'MODIFIER LES GENRES DE : '. $film['titre'];
$contenu = ob_get_clean();
require "view/template.php";
