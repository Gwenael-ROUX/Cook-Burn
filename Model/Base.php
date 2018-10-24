<?php
/**
 * Created by PhpStorm.
 * User: Yvan Chauvy
 * Date: 09/10/2018
 * Time: 11:38
 */

class Base
{
    private $dbLink;

    /**
     * @return mysqli
     */
    public function getDbLink()
    {
        return $this->dbLink;
    }

    /**
     * base constructor.
    */
    public function __construct()
    {

        $host = 'mysql-petitrouxchauvygonand.alwaysdata.net';
        $user = '167749_user';
        $pwd = '123';
        $dbname = 'petitrouxchauvygonand_php';

        $dbLink = mysqli_connect($host, $user, $pwd)
        or die('Echec lors de la connection au server : ' . mysqli_connect_error());
        mysqli_select_db($dbLink, $dbname)
        or die('Echec lors de la selection de la base de donnnee : ' . mysqli_error($dbLink));
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->dbLink = $dbLink;
    }

    /*/**
     * @param $pseudo string
     * @param $email string
     * @param $password string

    public function putQueryAddUser($pseudo, $email, $password){
        $this->query = 'INSERT INTO USER (PSEUDO,EMAIL,PASSWORD,ROLE) VALUES (\'' . $pseudo . '\', \'' . $email . '\', \''
            . $password. '\', \''. 'MEMBER'  . '\'' . ')';
    }

    /**
     * @param $pseudo string
     * @param $nomR string
     * @param $nbConviv int
     * @param $descrC string
     * @param $descrL string
     * @param $ingred string
     * @param $etape string

    public function putQueryAddRecette($pseudo, $nomR, $nbConviv, $descrC, $descrL, $ingred, $etape){
        $this->query = "INSERT INTO RECETTE (CREATEUR,NOM_R,NB_CONVIV,DESCR_C,DESCR_L,INGREDIENTS,ETAPES, BURNS, STATUT) VALUES ('" . $pseudo . "','" . $nomR . "','"
            . $nbConviv . "','"  . $descrC. "','" . $descrL . "','"  . $ingred .  "','"  . $etape . "','0','ATTENTE')";
    }

    /**
     * @param $pseudo string
     * @param $password string

    public function putQueryChangePwd ($pseudo, $password){
        $this->query = "UPDATE USER SET PASSWORD = '".$password . "' WHERE PSEUDO = '". $pseudo ."'";

    }

    /**
     * @param $pseudo string
     * @param $email string

    public function putQueryChangeEmail ($pseudo, $email){
        $this->query = "UPDATE USER SET EMAIL = '".$email . "' WHERE PSEUDO = '". $pseudo ."'";
    }

    /**
     * @param $email string
     * @param $pseudo string
     public function putQueryChangePseudo ($email , $pseudo){
        $this->query = "UPDATE USER SET PSEUDO = '". $pseudo . "' WHERE EMAIL = '". $email ."'";
    }

    /*
     * insert () permet d'inserer la requete dans la base de donnée
     */

}