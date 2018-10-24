<?php
$step = $param[0];

if ($step == 'PSEUDO'){
    $erreur = '<div class="card-panel"><legend class="red-text text-darken-2">Pseudo déja utilisé veuillez réésayer avec un autre pseudo </legend></div>';
    $couleur = 'card-panel red';
}
if ($step == 'PSEUDO_I'){
    $erreur = '<div class="card-panel"><legend class="red-text text-darken-2">Renseigner Pseudo </legend></div>';
    $couleur = 'card-panel red';
}
elseif ($step == 'MAIL'){
    $erreur = '<div class="card-panel"><legend class="red-text text-darken-2">Email déja utilisé veuillez réésayer avec un autre email </legend></div>';
    $couleur = 'card-panel red';
}
elseif ($step == 'MAIL_I'){
    $erreur = '<div class="card-panel"><legend class="red-text text-darken-2">Renseigner email </legend></div>';
    $couleur = 'card-panel red';
}
elseif ($step == 'SUCCESS'){
    $erreur = '<div class="card-panel"><legend class="green-text text-darken-2">Compte creer avec succes , un mail contenant le mot de passe temporaire a été envoyé  </legend></div>';
    $couleur = 'card-panel green';
}
?>
<div class="text-center">
    <img class="mb-4" src="/View/bootstrap-4.1.3-dist/image/Logo.png" alt="Logo" width="100" height="100">
    <h1 class="h3 mb-3 font-weight-normal">Inscription d'un utilisateur</h1>
    <form id="form" class="form-signin" action="/Admin/inscription" method="post">
        <div class="col-4 mx-auto">
            <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus/>
            <input type="text" id="pseudo" class="form-control" placeholder="Pseudo" required/>
            <br/>
            <input class="btn btn-lg btn-danger btn-block" type="submit" name="action" value="inscription"/>
            <input class="btn btn-lg btn-danger btn-block" type="reset" name="action" value="annuler"/>
        </div>
    </form>
</div>
