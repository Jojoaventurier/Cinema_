<?php ob_start();
$titreFilm = $requeteTitre->fetch() ?>

<?php

    foreach($requete->fetchAll() as $film) { ?>
        
        <!-- Formulaire de modification des informations d'un film -->
        <form id="formulaireModification" action="index.php?action=modifierFilm&id=<?= $film['id_film'] ?>" method="post">
            
        <!-- Modifier le titre du film -->
        <label for='titre'>Titre du film :</label>
            <input required type='text' name='titre' value='<?= $film['titre'] ?>'><br>

        <!-- Modifier la date de sortie -->
        <label for="anneeSortieFrance">Sortie française le :</label>
                <input required="required" type="date" value="<?= $film['sortie'] ?>" id="anneeSortieFrance" name="anneeSortieFrance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
            
        

        
            <p><!-- Modifier le réalisateur associé au film -->
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
        
            <p> <!-- Modifier la durée -->
                <label for="duree">Durée (en minutes) : </label>
                <input required="required" id="duree" type="text" name="duree" value="<?=$film['duree']?>" /><br>
            </p>
    
            <?php } ?>

            <p><!-- Modifier le résumé du film -->
                <label for="synopsis">Résumé du film :</label><br>  
                <textarea id="synopsis" name="synopsis" rows="4" cols="50"><?= $film["synopsis"] ?></textarea><br>      
            </p>

            <input type='submit' name='submit'>

        </form>


        <p><!-- affiche les différents genre associés au film -->
            <?php 
                foreach($requeteGenres->fetchAll() as $genre) { ?>

                <a class="link" href="index.php?action=detailGenre&id=<?= $genre['id_genre']?>"><?=$genre['libelle']?></a>
                
            <?php  }
            ?><!-- lien pour accéder à la page de modification des genres d'un film -->
            <a class='link bouton' href="index.php?action=afficherModifierGenresFilm&id=<?= $film['id_film']?>" >Modifier le(s) genre(s)</a>
        </p>

        <?php 
            foreach($requeteCasting->fetchAll() as $casting) { ?>
            
                <table> <!-- affiche le casting du film (acteurs associés à un rôle) -->
                    <tr>
                        <td><a class='link' href="index.php?action=detailActeur&id=<?=$casting['id_acteur']?>"><?= $casting["prenom"]. " ". $casting["nom"] ?></a></td>
                        <td><?= " : ". $casting["nomRole"] ?></td>
                    </tr>
        <?php } ?>
                </table>

        <p>  <!-- lien vers le formulaire  -->
            <a class='link bouton' href="index.php?action=afficherFormulaireCasting">AJOUTER UN ACTEUR OU UNE ACTRICE AU CASTING</a>
        </p>

            

<p> <!-- lien pour supprimer la fiche du film de la BDD -->
    <a class='link bouton rouge' href="index.php?action=afficherSupprimerFilm&id=<?= $titreFilm['id_film']?>">SUPPRIMER LA FICHE</a>
</p>

    
    

    

<?php
$titre = ' MODIFIER : '. $titreFilm["titre"];
$titre_secondaire = ' MODIFIER : '. $titreFilm["titre"];
$contenu = ob_get_clean();
require "view/template.php";