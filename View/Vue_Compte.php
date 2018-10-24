<h1>Mon compte</h1>
<div>
    <h2>Nom (pseudo) : </h2>
    <?= $_SESSION['PSEUDO']?>
    <h2>Email : </h2>
    <?= $_SESSION['EMAIL']?>
    <div class="text-center">
        <form class="form-control" action="/Utilisateur/changePwd" method="post">
            <label for="oldPwd">Email address</label>
            <input type="text" id="oldPwd" class="form-control" placeholder="Ancien Mot de passe" required autofocus>

            <label for="newPwd">Email address</label>
            <input type="text" id="newPwd" class="form-control" placeholder="Nouveau Mot de passe" required autofocus>

            <div class =text-center>
                <input class="btn btn-lg btn-danger btn-block" type="submit" name="action" value="Changer de mot de passe"/>
                <input class="btn btn-lg btn-danger btn-block" type="reset" name="action" value="Réinitialiser"/>
            </div>
        </form>
    </div>
    <h2>Mes Favoris : </h2><br/>
    <h2>Mes recettes : </h2>
</div>