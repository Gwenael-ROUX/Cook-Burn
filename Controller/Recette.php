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

    public function creationRecette(){
        $data= [
            'titrePage'=>'Creation de Recette',
        ];

        require_once  __DIR__.'/../View/Vue_StartPage.php';

        require_once  __DIR__.'/../View/Vue_Creation_Recette.php';

        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function listeRecette(){
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

    public function afficherRecette ($idr){
        $mRecette = new MRecette();
        $result = $mRecette->afficherRecette($idr[0]);
        $result2 = $mRecette->getIngrRec($idr[0]);

        $data= [
            'titrePage' => $result['NOMR'],
        ];
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Recette.php';

        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function searchRecette()
    {
        $data= [
            'titrePage'=>'Recherche Recette',
        ];
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        $recherche = filter_input(INPUT_POST,'recherche');
        $mRecette = new MRecette();
        $result = $mRecette->searchRecette($recherche);
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
        $ingredient = filter_input(INPUT_POST, 'ingredient');
        $quantite = filter_input(INPUT_POST, 'quantite');

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
            $mRecette = new MRecette();
            $mRecette->ajouterRecette($idu, $nomr, $nbconviv, $descrc, $descrl, $etape);
            $idr = $mRecette->getIdr($idu, $nomr);
            $mRecette->ajouterAsso($ingredient, $quantite, $idr);
            header('Location: /Recette/listeRecette');
            exit();
        }
    }

    public function burning ($id)
    {
        $mRecette = new MRecette();
        if ($mRecette->verifBurn($id[0], $id[1])) {
            header("Location: ../../afficherRecette/$id[0]");
            exit;
        }
        else{
            $mRecette->ajouterBurn($id[0], $id[1]);
            header("Location: ../../afficherRecette/$id[0]");
            exit;
        }
    }

    public function deleteRecette ($idr)
    {
        $mRecette = new MRecette();
        $mRecette->supprimerRecette($idr[0]);
        $data= [
            'titrePage'=>'Accueil',
        ];
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Index.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function mesRecettes ()
    {
        $data= [
            'titrePage'=>'Mes recettes',
        ];
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        $mRecette = new MRecette();
        $result = $mRecette->mesRecettes($_SESSION['ID']);
        $total = mysqli_num_rows($result);
        require_once  __DIR__.'/../View/Vue_Liste_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function Ingredient()
    {
        $data=[
            'titrePage'=>'Ajouter Ingrédient'
        ];
        require_once __DIR__.'/../View/Vue_StartPage.php';
        require_once __DIR__.'/../View/Vue_AjouterIngredient.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function ajouterIngredient()
    {
        $idu = $_SESSION['ID'];
        $nomi = filter_input(INPUT_POST,'nomi');
        if (empty($nomi)){
            header('Location: ../Controller/admin.php?step=NOM_I');
            exit();
        }
        else {
            $mRecette = new MRecette();
            $mRecette->ajouterIngredient($idu, $nomi);
            header('Location: /Recette/creationRecette');
            exit();
        }
    }
}