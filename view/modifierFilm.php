<?php ob_start(); 
$titreFilm = $requeteTitre->fetch() ?>

<?php

    foreach($requete->fetchAll() as $film) { ?>
        
        <form id="formulaireModification" action="index.php?action=modifierFilm&id=<?= $film['id_film'] ?>" method="post">
            <label for="anneeSortieFrance">Sortie française le :</label>
                <input required="required" type="date" value="<?= $film['sortie'] ?>" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            </p>
        

        
            <p>
                <label for="realisateur">Réalisateur</label>
                    <select name="realisateur" id="realisateur" value="<?=$film['id_realisateur']?>">    
                            <option value="<?=$film['id_realisateur']?>"><?=$film['realisateur']?></option>;
                        <?php
                            foreach($requeteListerealisateurs->fetchAll() as $realisateur) {
                                echo '<option value="'. $realisateur["id_realisateur"].'">' . $realisateur["realisateur"].'</option>';
                            }
                        ?>
                    </select><br>
            </p>
        


            <p> 
                <label for="dureeTypeTime">Durée (en minutes) : </label>
                <input required="required" id="dureeTypeTime" type="text" name="dureeTypeTime" value="<?=$film['duree']?>" /><br>
            </p>
    
            <?php } ?>

            <p>
                <label for="synopsis">Résumé du film :</label><br>  
                <textarea id="synopsis" name="synopsis" rows="4" cols="50"><?= $film["synopsis"] ?></textarea><br>      
            </p>

            <input type='submit' name='submit'>

        </form>

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

            

    
    

    

<?php
$titre = ' MODIFIER : '. $titreFilm["titre"];
$titre_secondaire = ' MODIFIER : '. $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";