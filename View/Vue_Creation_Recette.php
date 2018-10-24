<h1>Création Recette</h1>
<form id="form" action="/Recette/ajouterRecette" method="post">
         <fieldset >
             <div>
                <br><strong><label>Titre de votre recette : </label></strong>
                <input id="nomr" type="text" name="nomr" />

                <br><strong><label>Nombre de convives : </label></strong>
                <input id="nbconviv" type="number" min="0" name="nbconviv"/>

                 <br><strong><label >Ajoutez une desciption courte : </label></strong>
                 <input id="descrc" type="text" name="descrc" />

                 <br><strong><label>Ajoutez une desciption longue : </label></strong>
                 <input id="descrl" type="text" name="descrl" />

                 <br><strong><label>Etapes : </label></strong>
                 <textarea id="etape"  rows="4" cols="50" name="etape"></textarea>
            </div>
        </fieldset><br>
        <div>
             <input type="submit" name="action" value="ajouter"/>
             <input type="reset" name="action" value="annuler"/>
        </div>
</form>