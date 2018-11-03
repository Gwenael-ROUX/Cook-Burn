<?php
/**
 * Created by PhpStorm.
 * User: Chyva
 * Date: 17/10/2018
 * Time: 14:36
 */

class Erreur
{
    public function index(){

    }
    public function role ($role){
        echo $role[0];
    }
    public function erreur404(){
        require_once __DIR__. '/../View/Vue_Error404.php';
        require_once __DIR__. '/../View/Vue_EndPage.php';
    }
}