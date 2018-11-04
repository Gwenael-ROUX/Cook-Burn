<?php
include  __DIR__."/../Model/MRecette.php";
Class Index {
    /**
     * Fonction par defaut
     */
    public function index($param = ''){
        $data= [
            'titrePage'=>'Accueil',
        ];
        if ($param == 'errorco'){
            $error = 'Erreur lors de la connexion';
        }else{
            $error='';
        }

        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Index.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }
}