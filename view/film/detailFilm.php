<?php ob_start(); 
$titreFilm = $requeteTitre->fetch() ?>




<?php

    foreach($requete->fetchAll() as $film) { ?>
        
            <p>Sortie le : <?= $film["sortie"] ?></p>
            <p>Réalisé par <a class='link' href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?= $film["prenom"] . " " . $film["nom"] ?></a></p>
    
<?php } 


foreach($requeteCasting->fetchAll() as $casting) { ?>
    
    <table>
        <tr>
            <td><a class='link' href="index.php?action=detailActeur&id=<?=$casting['id_acteur']?>"><?= $casting["prenom"]. " ". $casting["nom"] ?></a></td>
            <td><?= " : ". $casting["nomRole"] ?></td>
        </tr>
<?php } ?>
    </table>

    <p id="resume"><?= $film["resume"] ?>

    <div>
        <form action="index.php?action=addFilm" method="POST">
            <label for="titre">Nom du film :</label><br>
                <input type="text" id="titre" name="titre" /><br>
            
            <label for="anneeSortieFrance">Année de sortie en France:</label><br>
                <input type="date" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            
            <label for="resume">Résumé du film :</label><br>
                <textarea id="resume" name="resume" rows="4" cols="50">Enter text here...</textarea><br>

            <label>
                boutons radios choix réalisateur
            </label>
            <input class="boutonAjouter" type="submit">
        </form> 
    </div>

<?php
$titre = $titreFilm["titre"];
$titre_secondaire = $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";



















