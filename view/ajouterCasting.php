<?php ob_start(); ?>

    <form action="index.php?action=ajouterNouveauCasting" method="post">
      

        
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
    $titre = "Ajouter un casting";
    $titre_secondaire = "Ajouter un casting";
    $contenu = ob_get_clean();
    require "template.php";
?>