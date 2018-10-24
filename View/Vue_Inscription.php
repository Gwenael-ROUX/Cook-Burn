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
<h1>Inscription d'un utilisateur</h1>
<?php echo $erreur?>
<form id="form" action="/Admin/inscription" method="post">
         <div class="<?php echo $couleur?>">
             <div class="card-panel white">
                <br><strong><label class ="flow-text" for="pseudo">Pseudo</label></strong>
                <input id="pseudo" type="text" name="pseudo" value=""/>

                <br><strong><label class ="flow-text"  for="email">Email</label></strong>
                <input id="email" type="email" name="email" value=""/>

            </div>
        </div><br>
        <div>
             <input type="submit" name="action" value="inscription"/>
             <input type="reset" name="action" value="annuler"/>
        </div>
</form>
