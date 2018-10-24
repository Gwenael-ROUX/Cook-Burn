<h1>Recette</h1>
<form id="form" action="../Model/Model_AddRecette.php" method="post">
         <fieldset class="card-panel red accent-4">
             <div class="card-panel white">
                <br><strong><label class ="flow-text" for="nom_r">Titre de votre recette : </label></strong>
                <input id="nom_r" type="text" name="nom_r" value=""/>

                <br><strong><label class ="flow-text"  for="nb_conviv">Nombre de convives : </label></strong>
                <input id="nb_conviv" type="text" name="nb_conviv" value=""/>

                 <br><strong><label class ="flow-text"  for="descr_c">Ajoutez une desciption courte : </label></strong>
                 <input id="descr_c" type="text" name="descr_c" value=""/>

                 <br><strong><label class ="flow-text"  for="descr_l">Ajoutez une desciption longue : </label></strong>
                 <input id="descr_l" type="text" name="descr_l" value=""/>

                 <br><strong><label class ="flow-text"  for="ingr">Ingrédients : </label></strong>
                 <input id="ingr" type="text" name="ingr" value=""/>

                 <br><strong><label class ="flow-text"  for="etape">Etapes : </label></strong>
                 <input id="etape" type="text" name="etape" value=""/>

            </div>
        </fieldset><br>
        <div>
             <input type="submit" name="action" value="Ajouter"/>
             <input type="reset" name="action" value="annuler"/>
        </div>
</form>

/**
 * Created by PhpStorm.
 * User: p17011450
 * Date: 10/10/2018
 * Time: 11:27
 */

