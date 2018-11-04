<div class="carousel slide" data-ride="carousel">
    <div class="carousel-inner w-100">
        <div class="carousel-item active">
            <img src="/View/bootstrap-4.1.3-dist/image/background1.jpg" class="first-slide" alt="slide">
        </div>
        <div class="carousel-item">
            <img class="second-slide" src="/View/bootstrap-4.1.3-dist/image/background2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="third-slide " src="/View/bootstrap-4.1.3-dist/image/background3.jpg" alt="Third slide">
        </div>
    </div>
</div>
<div>
    <h1>Index</h1>
    <?php echo $error;
    if ($_SESSION['ID'] && $_SESSION['ROLE']=='ADMIN')
        echo '<a href="/Admin" class="btn btn-outline-danger my-2 my-sm-0">Inscription</a>'
    ?>
    <h2>Description de notre service</h2>
    <p class="flow-text">Bienvenue sur notre site Cook & Burn !<br>Merci de nous avoir fait confiance pour la qualité de nous barbecue,
    vous pouvez maintenant vous connecter à ce site pour accéder à toutes les recettes que nos clients postent</p>
    <?php
        $mRecette = new MRecette();
        $alaUne = $mRecette->getALaUne();
        $nomALaUne = $mRecette->getNom($alaUne);
    ?>
    <h2>La Une</h2>
    <a href="/Recette/afficherRecette/<?=$alaUne?>" class="btn btn-outline-danger my-2 my-sm-0"><?= $nomALaUne ?></a>
    <h2>Liste des recettes</h2>
    <div>
        <?php
        if ($total > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <label> Auteur : <?php echo $mRecette->getAuthor($row['IDR'])?> </label><br/>
                <a href="/Recette/afficherRecette/<?php echo $row['IDR']?>"><input type="button" class="waves-effect waves-light btn" value="<?php echo $row['NOMR']?> "/></a><br/><br/>
            <?php }
        } ?>
    </div>
</div>

