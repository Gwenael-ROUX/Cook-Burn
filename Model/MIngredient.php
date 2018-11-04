<?php

include 'Base.php';

class Ingredient extends base
{
    /**
     * ajout d'un inggredient
     */
    public function ajout ($util, $nom)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), 'INSERT INTO INGREDIENT VALUES (null,?, ?)');
        if ($query){
            mysqli_stmt_bind_param($query, "is",$util,$nom);
            mysqli_stmt_execute($query);
        }
    }

    /**
     * supprimer un ingredient
     */
    public function supprimer ($idI)
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), 'DELETE FROM INGREDIENT WHERE IDI=?');
        if ($query){
            mysqli_stmt_bind_param($query, "i",$idI);
            mysqli_stmt_execute($query);
        }
    }

    public function ListeIngredient ()
    {
        /* execution de la requete preparer */
        $query = mysqli_prepare($this->getDbLink(), 'SELECT IDI FROM INGREDIENT');
        mysqli_stmt_execute($query);
        /* retourne le resultat */
        return mysqli_stmt_get_result($query);
    }
}