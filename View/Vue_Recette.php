<h1>  <?php echo $result['NOMR'] ?></h1>
<h2>Nombres de convives :</h2>
<?= $result['NB_CONVIV'];?>
<h2>Ingrédients :</h2>

<h2>Description courte :</h2>
<?= $result['DESCR_C'];?>
<h2>Description longue :</h2>
<?= $result['DESCR_L'];?>
<h2>Etapes :</h2>
<?= $result['ETAPES'];?>
<a href="/Recette/burning" class="waves-effect waves-light btn">Ajouter un burn</a>

<a href="/Reseau" class="waves-effect waves-light btn">Partager</a>
<a href="/Compte" class="waves-effect waves-light btn">Ajouter à mes favoris</a>
<h2>Nom du créateur :</h2>
<p><? echo $mRecette->getAuthor($result['IDR']);?></p>
