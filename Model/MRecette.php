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
        $query = mysqli_prepare($this->getDbLink(), "SELECT NOM, QUANTITE FROM INGREDIENT I, ASSO1 A WHERE I.IDR = A.IDR AND I.IDR = ?");
        mysqli_stmt_bind_param($query, "is", $idr);
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }

    public function getIdr($nomR, $idu)
    {
        $query = mysqli_prepare($this->getDbLink(), "SELECT IDR FROM RECETTE WHERE IDU = ? AND  NOMR = ?");
        mysqli_stmt_bind_param($query, "is", $idu, $nomR);
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }

    public function getAutor($idr)
    {
        $query = mysqli_prepare($this->getDbLink(),"SELECT PSEUDO FROM RECETTE R, USER U WHERE R.IDR=? AND R.IDU=U.IDU");
        mysqli_stmt_bind_param($query, "s", $idr);
        mysqli_stmt_execute($query);
        $result= mysqli_stmt_get_result($query);
        $resultarray= mysqli_fetch_assoc($result);
        return $resultarray['PSEUDO'];
    }

    public function ListeRecette()
    {
        $query = mysqli_prepare($this->getDbLink(), "SELECT * FROM RECETTE");
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        return $result;
    }

    public function searchRecette($recherche)
    {
        $query = mysqli_prepare($this->getDbLink(), 'SELECT IDR FROM RECETTE ORDER BY IDR DESC');
        if(isset($recherche) AND !empty($recherche))
        {
            $query = mysqli_prepare($this->getDbLink(), 'SELECT R.IDR FROM RECETTE R, ASSO1 A, INGREDIENT I WHERE 
                                                                R.IDR = A.IDR AND A.IDI = I.IDI AND CONCAT(R.NOMR, R.DESCR_C, R.DESCR_L,I.NOM) LIKE %.?.% ORDER BY id DESC');
        }
        mysqli_stmt_bind_param($query, "i", $recherche);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        return $result;
    }

    public function afficherRecette($idr)
    {
        $query = mysqli_prepare($this->getDbLink(), "SELECT * FROM RECETTE WHERE IDR = ?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
        $result= mysqli_stmt_get_result($query);
        return mysqli_fetch_assoc($result);
    }

    public function supprimerRecette($idr)
    {
        $query = mysqli_prepare($this->getDbLink(), "DELETE FROM RECETTE WHERE IDR = ?");
        mysqli_stmt_bind_param($query, "s", $idr);
        mysqli_stmt_execute($query);
    }

    public function ajouterRecette($idu, $nomr, $nbconviv, $descrc, $descrl, $etape)
    {
        $query = mysqli_prepare($this->getDbLink(), "INSERT INTO RECETTE VALUES (null,?,?,?,?,?,?,'PRIVE')");
        mysqli_stmt_bind_param($query, "isisss", $idu,$nomr, $nbconviv, $descrc, $descrl, $etape);
        mysqli_stmt_execute($query);
        return mysqli_insert_id($this->getDbLink());
    }
}