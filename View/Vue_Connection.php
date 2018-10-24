<form id="form" action="/Utilisateur/seconnecter" method="post">
    <fieldset>
        <legend>Remplissez les champs</legend>
        <div>
            <br><strong><label for="pseudo">Pseudo</label></strong>
            <input id="pseudo" type="text" name="pseudo" value=""/>

            <br><strong><label for="password">Mot de passe</label></strong>
            <input id="mdp" type="password" name="password" value=""/>
            <br><a href="/Utilisateur/mdpoublie">Mot de passe oublié ?</a>
        </div>
    </fieldset><br>
    <div>
        <input type="submit" name="action" value="Se connecter"/>
        <input type="reset" name="action" value="Annuler"/>
    </div>
</form>
