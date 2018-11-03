<h1>  <?php echo $result['NOMR'] ?></h1>
<h2>Nombres de convives :</h2>
<?= $result['NB_CONVIV'];?>
<h2>Ingrédients :</h2>

<h2>Description courte :</h2>
<?= $result['DESCR_C'];?>
<h2>Description longue :</h2>
<?= $result['DESCR_L'];?>
<h2>Etapes :</h2>
<?= $result['ETAPES'];?> <br/><br/>
<?php if (! $_SESSION['PSEUDO'])
          echo '<a href="../../Utilisateur" class="waves-effect waves-light btn">Ajouter un burn</a>';
      else
          echo '<a href="/Recette/burning/'.$result['IDR'].'/'.$_SESSION['ID'].'" class="waves-effect waves-light btn">Ajouter un burn</a>';
      ?>
<?= $mRecette->getNbBurn($result['IDR']); ?><br/>
<a href="/Reseau" class="waves-effect waves-light btn">Partager</a>
<a href="/Compte" class="waves-effect waves-light btn">Ajouter à mes favoris</a>
<h2>Nom du créateur :</h2>
<p><? echo $mRecette->getAuthor($result['IDR']);?></p>
