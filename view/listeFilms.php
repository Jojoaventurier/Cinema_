<?php ob_start(); ?>

<p> Il y a <?= $requete->rowCount() ?> films</p>

<table>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["year"] ?>)</td>
                    <td><a class='link' href="index.php?action=detailRealisateur&id=<?=$film['id_realisateur']?>"><?= $film["realisateur"] ?></td>
                </tr>
        <?php }   ?>
    </tbody>
</table><br> 

<div>
        <h3>Ajouter un film</h3>
        <form action="index.php?action=addFilm" method="POST">
            <label for="titre">Nom du film :</label><br>
                <input type="text" id="titre" name="titre" /><br>
            
            <label for="anneeSortieFrance">Année de sortie en France:</label><br>
                <input type="date" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            
            <label for="resume">Résumé du film :</label><br>
                <textarea id="resume" name="resume" rows="4" cols="50">Enter text here...</textarea><br>
            
            <label for="appt-time">Durée du film :</label><br>
                <input id="dureeTypeTime" type="time" name="dureeTypeTime" value="01:00" /><br>

            <label>
                boutons radios choix réalisateur
            </label>
            <input class="boutonAjouter" type="submit">
        </form> 
    </div>

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "template.php";