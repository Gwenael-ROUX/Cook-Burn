<h1>Liste des recettes</h1>
<div>
    <?php
        if ($total > 0) {
            while ($row = mysqli_fetch_array($result)) {
    ?><a href="/Recette/afficherRecette/<?= $row['IDR']?>"><input type="button" class="waves-effect waves-light btn" value="<?=$row['NOMR']?> Auteur : <?=$mRecette->getAuthor($row['IDR'])?>"</a>
            }
        }
    ?>
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