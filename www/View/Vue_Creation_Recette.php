<h1>Création Recette</h1>
<form id="form" action="/Recette/ajouterRecette" method="post">
         <fieldset >
             <div>
                <br><strong><label class ="flow-text" for="nom_r">Titre de votre recette : </label></strong>
                <input id="nom_r" type="text" name="nom_r" value=""/>

                <br><strong><label class ="flow-text"  for="nb_conviv">Nombre de convives : </label></strong>
                <input id="nb_conviv" type="text" name="nb_conviv" value=""/>

                 <br><strong><label class ="flow-text"  for="descr_c">Ajoutez une desciption courte : </label></strong>
                 <input id="descr_c" type="text" name="descr_c" value=""/>

                 <br><strong><label class ="flow-text"  for="descr_l">Ajoutez une desciption longue : </label></strong>
                 <input id="descr_l" type="text" name="descr_l" value=""/>

                 <br><strong><label class ="flow-text"  for="etape">Etapes : </label></strong>
                 <textarea id="etape"  rows="4" cols="50" name="etape"></textarea>
            </div>
        </fieldset><br>
        <div>
             <input type="submit" name="action" value="ajouter"/>
             <input type="reset" name="action" value="annuler"/>
        </div>
</form>