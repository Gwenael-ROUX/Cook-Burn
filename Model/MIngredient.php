<?php

include 'Base.php';

class Ingredient extends base
{
    public function ajout ($util, $nom)
    {
        $query = mysqli_prepare($this->getDbLink(), 'INSERT INTO INGREDIENT VALUES (null,?, ?)');
        if ($query){
            mysqli_stmt_bind_param($query, "is",$util,$nom);
            mysqli_stmt_execute($query);
        }
    }

    public function supprimer ($idI)
    {
        $query = mysqli_prepare($this->getDbLink(), 'DELETE FROM INGREDIENT WHERE IDI=?');
        if ($query){
            mysqli_stmt_bind_param($query, "i",$idI);
            mysqli_stmt_execute($query);
        }
    }

    public function ListeIngredient ()
    {
        $query = mysqli_prepare($this->getDbLink(), 'SELECT IDI FROM INGREDIENT');
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }
}