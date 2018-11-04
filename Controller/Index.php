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

        /* Appelle la fonction ListeRecette de MRecette et stocke le resultat dans $result */
        $mRecette = new MRecette();
        $result = $mRecette->ListeRecette();

        /* stocke le nombre de tuple dans $total */
        $total = mysqli_num_rows($result);

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Index.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }
}