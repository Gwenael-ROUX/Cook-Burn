<h1>  <?php echo $data['NomRecette'] ?></h1>
<h2>Nombres de convives :</h2>
<?= $data['nb_i'];?>
<h2>Ingrédients :</h2>
<?php
for ($i = 0; $i < sizeof($data['Ingredient']); ++$i)
{
    echo $data['Ingredient'][$i].'<br>';
}
?>
<h2>Description courte :</h2>
<?= $data['desc_c'];?>
<h2>Description longue :</h2>
<?= $data['desc_l'];?>
<h2>Etapes :</h2>
<?= $data['etape'];?>
<a href="/Recette/burning" class="waves-effect waves-light btn">Ajouter un burn</a>
<?= $data['burn'];?>
<a href="/Reseau" class="waves-effect waves-light btn">Partager</a>
<a href="/Compte" class="waves-effect waves-light btn">Ajouter à mes favoris</a>
<h2>Nom du créateur :</h2>
<?= $data['nomU'];?>
