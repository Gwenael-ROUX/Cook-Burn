<div class="carousel slide" data-ride="carousel">
    <div class="carousel-inner w-100">
        <div class="carousel-item active">
            <img src="/View/bootstrap-4.1.3-dist/image/background1.jpg" class="first-slide">
        </div>
        <div class="carousel-item">
            <img class="second-slide" src="/View/bootstrap-4.1.3-dist/image/background2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="third-slide " src="/View/bootstrap-4.1.3-dist/image/background3.jpg" alt="Third slide">
        </div>
    </div>
</div>
<h1>Index</h1>
<?php echo $error;
if ($_SESSION['ID'])
    echo '<a href="/Admin" class="waves-effect waves-light btn">Inscription</a>'
?>
<div>
    <h2>Description de notre service</h2>
    <p class="flow-text">Bienvenue sur notre site Cook & Burn !</br>Merci de nous avoir fait confiance pour la qualité de nous barbecue,
    vous pouvez maintenant vous connecter à ce site pour accéder à toutes les recettes que nos clients postent</p>
    <h2>La Une</h2>
    <a href="/Recette/afficherRecette/" class="waves-effect waves-light btn">Un bon gros barbak des fafa</a>
    <h2>Liste des recettes</h2>
    <a href="/Recette/afficherRecette/" class="waves-effect waves-light btn">Un bon gros barbak des fafa</a></br>
    <a href="/Recette/afficherRecette/" class="waves-effect waves-light btn">viande a la plancha</a></br>
    <a href="/Recette/afficherRecette/" class="waves-effect waves-light btn">Poulet braisé</a></br>
    <a href="/Recette/creationRecette" class="waves-effect waves-light btn" >Creation recette</a>
</div>

