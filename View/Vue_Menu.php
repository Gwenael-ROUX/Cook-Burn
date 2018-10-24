<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="media">
        <a class="navbar-brand" href="/Index"><img src="/View/bootstrap-4.1.3-dist/image/Logo100x100.png" class="img-fluid"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="/Index">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/Recette">Les Recettes</a>
            </li>
            <?php if (! $_SESSION['PSEUDO']) { ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="/Utilisateur">Connexion</a>
            </li>
            <?php } else {?>
            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Utilisateur
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Mon Compte</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/Utilisateur/deconnexion">Déconnexion</a>
                </div>
            </li>
            <?php } ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>