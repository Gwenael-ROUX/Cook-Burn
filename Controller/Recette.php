<?php

include  __DIR__."/../Model/MRecette.php";
class Recette
{
    public function index($param){
        $data= [
            'titrePage'=>'Recette',
        ];

        require_once  __DIR__.'/../View/Vue_StartPage.php';

        require_once  __DIR__.'/../View/Vue_Recette.php';

        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function creationRecette($param){
        $data= [
            'titrePage'=>'Creation de Recette',
        ];

        require_once  __DIR__.'/../View/Vue_StartPage.php';

        require_once  __DIR__.'/../View/Vue_Creation_Recette.php';

        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function listeRecette($param){
        $data= [
            'titrePage'=>'Liste des Recettes',
        ];

        require_once  __DIR__.'/../View/Vue_StartPage.php';

        $mRecette = new MRecette();
        $result = $mRecette->ListeRecette();
        $total = mysqli_num_rows($result);
        require_once  __DIR__.'/../View/Vue_Liste_Recette.php';

        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }




    public function ajouterRecette(){
        $idu = $_SESSION['ID'];
        $nomr = filter_input(INPUT_POST,'nomr');
        $nbconviv = filter_input(INPUT_POST,'nbconviv');
        $descrc = filter_input(INPUT_POST,'descrc');
        $descrl = filter_input(INPUT_POST,'descrl');
        $etape = filter_input(INPUT_POST,'etape');


        if (empty($nomr)){
            header('Location: ../Controller/admin.php?step=NOM_R_I');
            exit();
        }
        elseif (empty($nbconviv)){
            header('Location: ../Controller/admin.php?step=NB_CONVIV_I');
            exit();
        }
        elseif (empty($descrc)){
            header('Location: ../Controller/admin.php?step=DESCR_C_I');
            exit();
        }
        elseif (empty($descrl)){
            header('Location: ../Controller/admin.php?step=DESCR_L_I');
            exit();
        }
        elseif (empty($etape)){
            header('Location: ../Controller/admin.php?step=ETAPE_I');
            exit();
        }
        else {
            $recette = new MRecette();
            $recette->ajouterRecette($idu,$nomr,$nbconviv,$descrc,$descrl,$etape);
        }
    }

}