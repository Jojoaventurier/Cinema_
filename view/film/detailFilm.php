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
            <p>Nom du film :
                <input type="text" name="titre" /><br>
            </p>
            <p>Année de sortie :
                <input type="text" name="anneeSortieFrance" /><br>
            </p>
            <p>Résumé :
                <input class="resume" type="text" name="resume" /><br>
            </p>
            <p>
                boutons radios choix réalisateur
            </p>
            <input class="ajouter" type="submit">AJOUTER</input>
        </form> 
    </div>

<?php
$titre = $titreFilm["titre"];
$titre_secondaire = $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";



















