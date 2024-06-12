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
        <!-- form pour ajouter un film à la BDD (attention : le réalisateur doit faire partie de la BDD!) -->
        <form action="index.php?action=addFilm" method="POST">
            <label for="titre">Nom du film :</label><br>
                <input type="text" id="titre" name="titre" /><br>
            
            <!-- choisir l'année de sortie du film-->
            <label for="anneeSortieFrance">Année de sortie en France:</label><br>
                <input type="date" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            
            <!--Insérer le résumé du film (texte) -->
            <label for="resume">Résumé du film :</label><br>
                <textarea id="resume" name="resume" rows="4" cols="50">Enter text here...</textarea><br>
            
            <!--choisir la durée du film -->
            <label for="dureeTypeTime">Durée du film :</label><br>
                <input id="dureeTypeTime" type="time" name="dureeTypeTime" value="01:00" /><br>
            
            <!--choisir un réalisateur pour le film à ajouter-->
            <label for="realisateur">Réalisateur</label>
                <select name="realisateur" id="realisateur">    
                    <?php
                        // alimenter la liste déroulante avec les réalisateurs
                        foreach($requeteListe->fetchAll() as $realisateur) {
                            echo '<option value="'. $realisateur["id_realisateur"].'">' . $realisateur["realisateur"].'</option>';
                        }
                    ?>
                </select><br>

            <input class="boutonAjouter" type="submit">
        </form> 
    </div>

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "template.php";