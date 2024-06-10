<?php ob_start(); 
 $libelleGenre = $requeteGenre->fetch(); 
?>



<h2><?= $libelleGenre["libelle"]; ?></h2>


<table>
    
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a class='link' href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></td>
                    <td>(<?= $film["sortie"] ?>)</td>
                    <td><a class='link' href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?= $film["realisateur"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films pour le genre :" ;
$titre_secondaire = "Liste des films pour le genre :";
$contenu = ob_get_clean();
require "view/template.php";