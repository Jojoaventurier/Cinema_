<?php ob_start(); ?>

    <!-- Formulaire d'ajout d'un réalisateur à la BDD -->
    <form action="index.php?action=ajouterNouveauRealisateur" method="post">
        <label for="nom">Nom :</label><br>
            <input required="required" type="text" id="nom" name="nom" /><br>

        <label for="prenom">Prénom :</label><br>
            <input required="required" type="text" id="prenom" name="prenom" /><br>
        
        <!-- choisir la date de naissance-->
        <label for="dateNaissance">Date de naissance:</label><br>
            <input required="required" type="date" id="dateNaissance" name="dateNaissance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
        
        <!--choisir le sexe -->
        <label for="realisateur">Sexe</label>
            <select name="sexe" id="sexe">
                <?php $el = array( "   ","homme", "femme");

                        alimenterListeDeroulante($el);

                        function alimenterListeDeroulante($array) {
                            foreach($array as $value) {
                            echo '<option value="'.strtolower($value).'">' .$value.'</option>';
                            }
                        }
                ?>
            </select><br>

            
        <input type="submit" name="submit">
    </form>


<?php
    $titre = "Ajouter un réalisateur ou une réalisatrice";
    $titre_secondaire = "Ajouter un réalisateur ou une réalisatrice";
    $contenu = ob_get_clean();
    require "template.php";
?>



