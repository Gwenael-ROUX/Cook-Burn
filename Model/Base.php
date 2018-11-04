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
        /* Definition des variables de connection a la base de donnée */
        $host = 'mysql-petitrouxchauvygonand.alwaysdata.net';
        $user = '167749_user';
        $pwd = '123';
        $dbname = 'petitrouxchauvygonand_php';
        /* Essaie de la connection au serveur de la base de données */
        $dbLink = mysqli_connect($host, $user, $pwd)
        or die('Echec lors de la connection au server : ' . mysqli_connect_error());
        /* Selection de la base de données */
        mysqli_select_db($dbLink, $dbname)
        or die('Echec lors de la selection de la base de donnnee : ' . mysqli_error($dbLink));
        /* Affiche l'erreur si il y en a une */
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        /* Affectation de dblink msqli a l'atribut */
        $this->dbLink = $dbLink;
    }
}