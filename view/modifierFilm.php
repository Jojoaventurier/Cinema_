<?php ob_start(); 
$titreFilm = $requeteTitre->fetch() ?>

<?php

    foreach($requete->fetchAll() as $film) { ?>
        
            <p>Sorti le : <br>
                <input required="required" type="date" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            </p>

            <p>
                <label for="realisateur">Réalisateur</label>
                    <select name="realisateur" id="realisateur">    
                        <?php
                            // alimenter la liste déroulante avec les réalisateurs
                            foreach($requeteListerealisateurs->fetchAll() as $realisateur) {
                                echo '<option value="'. $realisateur["id_realisateur"].'">' . $realisateur["realisateur"].'</option>';
                            }
                        ?>
                    </select><br>
            </p>
            <p> 
                <label for="dureeTypeTime">Durée : </label>
                <input required="required" id="dureeTypeTime" type="time" name="dureeTypeTime" value="durée" /><br>
            </p>
    
<?php } ?>


<p>
    <a class='link bouton' href="index.php?action=afficherFormulaireCasting">AJOUTER UN ACTEUR OU UNE ACTRICE AU CASTING</a>
</p>
<p> 
    <a class='link bouton'>SUPPRIMER UN ACTEUR OU UNE ACTRICE DU CASTING</a>
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

    <label for="synopsis">Résumé du film :</label><br>
        <textarea id="synopsis" name="synopsis" rows="4" cols="50"><?= $film["synopsis"] ?></textarea><br>
    

    

<?php
$titre = ' MODIFIER : '. $titreFilm["titre"];
$titre_secondaire = ' MODIFIER : '. $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";