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
    public $ALaUne = 25;

    /**
     * @param $idr
     * @return bool|mysqli_result
     * retourne les ingredients d'une recette
     */
    public function getIngrRec($idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT NOM, QUANTITE FROM INGREDIENT I, ASSO1 A WHERE I.IDI = A.IDI AND A.IDR = ?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
        /* retourne le resultat */
        return mysqli_stmt_get_result($query);;
    }

    /**
     * @param $idi
     * @return mixed
     * etourne le nom de l'ingredient
     */
    public function getNomIngr($idi)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT NOM FROM INGREDIENT WHERE IDI=?");
        mysqli_stmt_bind_param($query, "i", $idi);
        mysqli_stmt_execute($query);
        /* met le resultat dans un tableau associatif*/
        $result = mysqli_stmt_get_result($query);
        $resultarray= mysqli_fetch_assoc($result);
        /* retourne le nom de l'ingredient */
        return $resultarray['NOM'];
    }

    /**
     * @param $idu
     * @param $nomR
     * @return mixed
     * retourne l'id d'une recette
     */
    public function getIdr($idu, $nomR)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT IDR FROM RECETTE WHERE IDU = ? AND  NOMR = ?");
        mysqli_stmt_bind_param($query, "is", $idu, $nomR);
        mysqli_stmt_execute($query);
        /* met le resultat dans un tableau associatif*/
        $result = mysqli_stmt_get_result($query);
        $resultarray = mysqli_fetch_assoc($result);
        /* retourne l'id de la recette */
        return $resultarray['IDR'];
    }

    /**
     * @param $idr
     * @return mixed
     * retourne le nom de la recette
     */
    public function getNom ($idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(),"SELECT NOMR FROM RECETTE R WHERE R.IDR=?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
        /* met le resultat dans un tableau associatif*/
        $result= mysqli_stmt_get_result($query);
        $resultarray= mysqli_fetch_assoc($result);
        /* retourne le nom de la recette */
        return $resultarray['NOMR'];
    }

    /**
     * @param $idr
     * met une recette a la une
     */
    public function setALaUne($idr)
    {
        $this->ALaUne = $idr;
    }

    /**
     * @return int
     * renvoie recette a la une
     */
    public function getALaUne()
    {
        return $this->ALaUne;
    }

    /**
     * @param $idr
     * @return mixed
     * renvoie l'auteur de la recette
     */
    public function getAuthor($idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(),"SELECT PSEUDO FROM RECETTE R, USER U WHERE R.IDR=? AND R.IDU=U.IDU");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
        /* met le resultat dans un tableau associatif*/
        $result= mysqli_stmt_get_result($query);
        $resultarray= mysqli_fetch_assoc($result);
        /* retourne le nom de la recette */
        return $resultarray['PSEUDO'];
    }

    /**
     * @param $idr
     * @return int
     * renvoie le nombre de burn d'une recette
     */
    public function getNbBurn($idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT * FROM BURN WHERE IDR=?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
        /* renvoie le nombre de tuple */
        $result = mysqli_stmt_get_result($query);
        $total = mysqli_num_rows($result);
        return $total;
    }

    /**
     * @return bool|mysqli_result
     * retourne la liste de toute les recettes
     */
    public function ListeRecette()
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT IDR, NOMR FROM RECETTE ORDER BY IDR DESC");
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        /* retourne le resultat */
        return $result;
    }

    /**
     * @param $idu
     * @return bool|mysqli_result
     * retourne la liste des recettes de l'utilisateur
     */
    public function mesRecettes($idu)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT IDR, NOMR FROM RECETTE WHERE IDU = ? ORDER BY IDR DESC");
        mysqli_stmt_bind_param($query, "i", $idu);
        mysqli_stmt_execute($query);
        /* retourne le resultat */
        $result = mysqli_stmt_get_result($query);
        return $result;
    }

    /**
     * @param $recherche
     * @return bool|mysqli_result
     * recherche une recette avec un string entrer en parametre
     */
    public function searchRecette($recherche)
    {
        /* si la recherche est vide affiche toute les recettes */
        if (empty($recherche))
        {
            /* execution de la requete preparer */
            $query = mysqli_prepare($this->getDbLink(), 'SELECT IDR,NOMR FROM RECETTE ORDER BY IDR DESC');
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
        }
        /* sinon recherche avec les mots clefs */
        else
        {
            /* execution de la requete preparer */
            $query = mysqli_prepare($this->getDbLink(), "SELECT * FROM RECETTE R, ASSO1 A, INGREDIENT I WHERE 
                                                                R.IDR = A.IDR AND A.IDI = I.IDI AND CONCAT(R.NOMR, R.DESCR_C, R.DESCR_L,I.NOM) LIKE '%".$recherche."%'ORDER BY R.IDR DESC");
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
        }
        /* retourne le resultat */
        return $result;
    }

    /**
     * @param $idr
     * @return array|null
     * affiche une recette
     */
    public function afficherRecette($idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT * FROM RECETTE WHERE IDR = ?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
        /* retourne le resultat dans un tableau associatif */
        $result= mysqli_stmt_get_result($query);
        return mysqli_fetch_assoc($result);
    }

    /**
     * @param $idr
     * supptimr une recette
     */
    public function supprimerRecette($idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "DELETE FROM RECETTE WHERE IDR = ?");
        mysqli_stmt_bind_param($query, "i", $idr);
        mysqli_stmt_execute($query);
    }

    /**
     * @param $idu
     * @param $nomr
     * @param $nbconviv
     * @param $descrc
     * @param $descrl
     * @param $etape
     * @return int|string
     * ajoute une recette dans la base de données
     */
    public function ajouterRecette($idu, $nomr, $nbconviv, $descrc, $descrl, $etape)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "INSERT INTO RECETTE VALUES (null,?,?,?,?,?,?,'PRIVE')");
        mysqli_stmt_bind_param($query, "isisss", $idu,$nomr, $nbconviv, $descrc, $descrl, $etape);
        mysqli_stmt_execute($query);
    }

    /**
     * @param $idr
     * @param $idu
     * @return bool
     * verifie si un burn a deja etait ajouté ou non
     */
    public function verifBurn ($idr, $idu)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), "SELECT IDB FROM BURN WHERE IDR=? AND IDU=?");
        mysqli_stmt_bind_param($query, "ii", $idr, $idu);
        mysqli_stmt_execute($query);
        /* stocke le resultat de la requete dans $result */
        $result = mysqli_stmt_get_result($query);
        $total = mysqli_num_rows($result);
        /* retourne vrai si burn deja ajouter faux si l'inverse */
        if ($total == 0)
            $bool = false;
        else
            $bool = true;
        return $bool;
    }

    /**
     * @param $idr
     * @param $idu
     * ajoute un burn a une recette
     */
    public function ajouterBurn ($idr, $idu)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare ($this->getDbLink(), 'INSERT INTO BURN VALUES (null, ?, ?)');
        mysqli_stmt_bind_param($query, 'ii', $idu,$idr);
        mysqli_stmt_execute($query);
        /* si une recette a 15 burn elle passe a la une */
        if ($this->getNbBurn($idr) == 15)
            $this->setALaUne($idr);
    }

    /**
     * @param $idu
     * @param $nomi
     * ajoute un ingredient dans la base de données
     */
    public function ajouterIngredient($idu, $nomi)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare ($this->getDbLink(), 'INSERT INTO INGREDIENT VALUES (null, ?, ?)');
        mysqli_stmt_bind_param($query, 'is', $idu,$nomi);
        mysqli_stmt_execute($query);
    }

    /**
     * @param $idi
     * @param $quantite
     * @param $idr
     * lie un ingredient et une quantite a une recette
     */
    public function ajouterAsso($idi, $quantite, $idr)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare ($this->getDbLink(), "INSERT INTO ASSO1 VALUES (null, ?, ?, ?)");
        mysqli_stmt_bind_param($query, 'iis', $idi, $idr, $quantite);
        mysqli_stmt_execute($query);
    }
}