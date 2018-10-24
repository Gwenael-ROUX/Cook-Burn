<div class="text-center">
    <img class="mb-4" src="/View/bootstrap-4.1.3-dist/image/Logo.png" alt="Logo" width="100" height="100">
    <h1 class="h3 mb-3 font-weight-normal">Inscription d'un utilisateur</h1>
    <form id="form" class="form-signin" action="/Admin/inscription" method="post">
        <div class="col-4 mx-auto">
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus/>
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required/>
            <br/>
            <input class="btn btn-lg btn-danger btn-block" type="submit" name="action" value="inscription"/>
            <input class="btn btn-lg btn-danger btn-block" type="reset" name="action" value="annuler"/>
        </div>
    </form>
</div>
