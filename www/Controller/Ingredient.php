<?php
/**
 * Created by PhpStorm.
 * User: r16014083
 * Date: 11/10/2018
 * Time: 15:26
 */

class Ingredient
{
    public function index(){
        $data= [
            'titrePage'=>'Ingredient',
        ];

        require_once  __DIR__.'/../View/Vue_StartPage.php';

        require_once __DIR__.'/../View/Vue_EndPage.php';
    }
}