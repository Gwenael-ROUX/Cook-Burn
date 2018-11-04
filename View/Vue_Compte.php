<h1 class="h1 mb-4 font-weight-bold">Mon compte</h1>
<div>
    <p class=" mb-2 font-weight-normal">Pseudo : <?= $_SESSION['PSEUDO']?></p>
    <form action="/Utilisateur/changePseudo" method="post">
        <div class="container">
            <div class="col-4 mx-auto">
                <input type="text" id="newPseudo" name="newPseudo" class="form-control" placeholder="Nouveau pseudo" required autofocus>
                <input type="text" id="newPseudo" name="confirmPseudo" class="form-control" placeholder="Confirmer pseudo" required>
                <input class="btn btn-lg btn-danger btn-block" type="submit" name="action" value="Changer de pseudo"/>
                <input class="btn btn-lg btn-danger btn-block" type="reset" name="action" value="Réinitialiser"/>
            </div>
        </div>
    </form>
    <h2 class="h4 mb-2 font-weight-normal">Email : </h2>
    <p class=" mb-2 font-weight-normal"><?= $_SESSION['EMAIL']?></p>
    <form action="/Utilisateur/changeEmail" method="post">
        <div class="container">
            <div class="col-4 mx-auto">
                <input type="text" id="newEmail" name="newEmail" class="form-control" placeholder="Nouvelle adresse email" required autofocus>
                <input type="text" id="newEmail" name="confirmEmail" class="form-control" placeholder="Confirmer  adresse email" required>
                <input class="btn btn-lg btn-danger btn-block" type="submit" name="action" value="Changer de mail"/>
                <input class="btn btn-lg btn-danger btn-block" type="reset" name="action" value="Réinitialiser"/>
            </div>
        </div>
    </form>
    <h2 class="h4 mb-2 font-weight-normal">Modification du Mot de passe : </h2>
        <form action="/Utilisateur/changePwd" method="post">
            <div class="container">
                <div class="col-4 mx-auto">
                    <input type="text" id="oldPwd" name="oldPwd" class="form-control" placeholder="Ancien mot de passe" required autofocus>
                    <input type="text" id="newPwd" name="newPwd" class="form-control" placeholder="Nouveau mot de passe" required>
                    <input type="text" id="confirmNewPwd" name="confirmNewPwd" class="form-control" placeholder="Confirmer mot de passe" required><br/>
                    <input class="btn btn-lg btn-danger btn-block" type="submit" name="action" value="Changer de mot de passe"/>
                    <input class="btn btn-lg btn-danger btn-block" type="reset" name="action" value="Réinitialiser"/>
                </div>
            </div>
        </form>
    <br/>
    <h2 class="h4 mb-2 font-weight-normal">Mes Favoris : </h2><br/>
    <h2 class="h4 mb-2 font-weight-normal">Mes recettes : </h2>
</div>