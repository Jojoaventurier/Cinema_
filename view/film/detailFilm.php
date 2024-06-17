<?php ob_start(); 
$titreFilm = $requeteTitre->fetch() ?>



<a class='link bouton' href="index.php?action=modificationFilm&id=<?=$titreFilm['id_film']?>">MODIFIER LE FILM</a>
                
<?php
    foreach($requete->fetchAll() as $film) { ?>
        
            <p>Sortie le : <?= $film["sortie"] ?></p>
            <p>Réalisé par <a class='link' href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?= $film["prenom"] . " " . $film["nom"] ?></a></p>
            <p>Durée : <?= $film["durée"] ?></p>
<?php } ?>

<p>
    <?php 
        foreach($requeteGenres->fetchAll() as $genre) { ?>

        <a class="link" href="index.php?action=detailGenre&id=<?= $genre['id_genre']?>"><?=$genre['libelle']?></a>
        
    <?php  }
    ?>
</p>
<?php
foreach($requeteCasting->fetchAll() as $casting) { ?>
    
    <table>
        <tr>
            <td><a class='link' href="index.php?action=detailActeur&id=<?=$casting['id_acteur']?>"><?= $casting["prenom"]. " ". $casting["nom"] ?></a></td>
            <td><?= " : ". $casting["nomRole"] ?></td>
        </tr>
<?php } ?>
    </table>

    <p id="synopsis"><?= $film["synopsis"] ?>

<?php
$titre = $titreFilm["titre"];
$titre_secondaire = $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";

















