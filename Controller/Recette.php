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
            'titrePage'=>'CreationRecette',
        ];

        require_once  __DIR__.'/../View/Vue_StartPage.php';

        require_once  __DIR__.'/../View/Vue_Creation_Recette.php';

        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }


    public function ajouterRecette(){
        $nom_r = filter_input(INPUT_POST,'nom_r');
        $nb_conviv = filter_input(INPUT_POST,'nb_conviv');
        $descr_c = filter_input(INPUT_POST,'descr_c');
        $descr_l = filter_input(INPUT_POST,'descr_l');
        $etape = filter_input(INPUT_POST,'etape');

        if (!empty($nom_r)){
            header('Location: ../Controller/admin.php?step=NOM_R_I');
            exit();
        }
        elseif (!empty($nb_conviv)){
            header('Location: ../Controller/admin.php?step=NB_CONVIV_I');
            exit();
        }
        elseif (!empty($descr_c)){
            header('Location: ../Controller/admin.php?step=DESCR_C_I');
            exit();
        }
        elseif (!empty($descr_l)){
            header('Location: ../Controller/admin.php?step=DESCR_L_I');
            exit();
        }
        elseif (!empty($etape)){
            header('Location: ../Controller/admin.php?step=ETAPE_I');
            exit();
        }
        else {
            $recette = new MRecette();
            $recette->ajouterRecette($nom_r,$nb_conviv,$descr_c,$descr_l,$etape);
        }
    }

}