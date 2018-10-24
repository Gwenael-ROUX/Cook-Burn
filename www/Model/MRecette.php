<?php
/**
 * Created by PhpStorm.
 * User: r16014083
 * Date: 11/10/2018
 * Time: 15:30
 */

include 'Base.php';
class MRecette extends Base
{
    public function getIngrRec($idr)
    {
        $query = mysqli_prepare($this->getDbLink(), "SELECT NOM, NB_I FROM INGREDIENT I, ASSO1 A WHERE I.IDR = A.IDR AND I.IDR = ?");
        mysqli_stmt_bind_param($query, "is", $idr);
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }

    public function getIdr($nomR, $idu)
    {
        $query = mysqli_prepare($this->getDbLink(), "SELECT ID_R FROM RECETTE WHERE IDU = ? AND  NOMR = ?");
        mysqli_stmt_bind_param($query, "is", $idu, $nomR);
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }

    public function ListeRecette()
    {
        $query = mysqli_prepare($this->getDbLink(), "SELECT * FROM RECETTE");
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }

    public function supprimerRecette($idr)
    {
        $query = mysqli_prepare($this->getDbLink(), "DELETE FROM RECETTE WHERE ID = ?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
    }

    public function ajouterRecette($nom_r, $nb_conviv, $descr_c, $descr_l, $etape)
    {
        $query = mysqli_prepare($this->getDbLink(), "INSERT INTO RECETTE VALUES (null,?,?,?,?,?,0,'prive')");
        mysqli_stmt_bind_param($query, "sisss", $nom_r, $nb_conviv, $descr_c, $descr_l, $etape);
        mysqli_stmt_execute($query);
        return mysqli_insert_id($this->getDbLink());
    }
}