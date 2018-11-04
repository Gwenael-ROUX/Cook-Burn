<h1>Liste des recettes</h1>
<div>
    <?php
    if ($total > 0) {
        /* Parcourir toutes les recettes de $result et les afficher */
        while ($row = mysqli_fetch_assoc($result)) { ?>
    <label> Auteur : <?php echo $mRecette->getAuthor($row['IDR'])?> </label><br/>
            <a href="/Recette/afficherRecette/<?php echo $row['IDR']?>"><input type="button" class="waves-effect waves-light btn" value="<?php echo $row['NOMR']?> "/></a><br/><br/>
  <?php }
    } ?>
</div>
<div>
    <footer aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </footer>
</div>