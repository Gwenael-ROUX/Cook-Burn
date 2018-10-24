<form id="form" action="/Utilisateur/nouveauMdp" method="post">
    <fieldset>
        <legend>Mot de passe oublié</legend>
        <div>
            <br><strong><label for="password">Email</label></strong>
            <input id="pseudo" type="email" name="email" value=""/>
        </div>
    </fieldset><br>
    <div>
        <input type="submit" name="action" value="Nouveau mot de passe"/>
        <input type="reset" name="action" value="Annuler"/>
    </div>
</form>