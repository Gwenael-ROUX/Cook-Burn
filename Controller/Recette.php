<?php

include  __DIR__."/../Model/MRecette.php";
class Recette
{
    /**
     * @param $param
     * Fonction par défaut
     */
    public function index($param){
        $data= [
            'titrePage'=>'Recette',
        ];

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * Charge la page création recette
     */
    public function creationRecette(){
        $data= [
            'titrePage'=>'Creation de Recette',
        ];

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Creation_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * Genere et charge la page liste recette
     */
    public function listeRecette(){
        $data= [
            'titrePage'=>'Liste des Recettes',
        ];

        /* Appelle la fonction ListeRecette de MRecette et stocke le resultat dans $result */
        $mRecette = new MRecette();
        $result = $mRecette->ListeRecette();

        /* stocke le nombre de tuple dans $total */
        $total = mysqli_num_rows($result);

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Liste_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * @param $idr
     * Genere et charge la page pour afficher une recette
     */
    public function afficherRecette ($idr){
        /* appelle les fonctions pour afficher les recettes et ingredient */
        $mRecette = new MRecette();
        $result = $mRecette->afficherRecette($idr[0]);
        $result2 = $mRecette->getIngrRec($idr[0]);

        $data= [
            'titrePage' => $result['NOMR'],
        ];
        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * Genere et charge la page de recherche d'une recette
     */
    public function searchRecette()
    {
        $data= [
            'titrePage'=>'Recherche Recette',
        ];

        /* recupere les données de la barre de recherche */
        $recherche = filter_input(INPUT_POST,'recherche');

        /* Appelle la fonction searchrecette de MRecette et stock le resultat dans $result */
        $mRecette = new MRecette();
        $result = $mRecette->searchRecette($recherche);

        /* stocke le nombre de tuple dans $total */
        $total = mysqli_num_rows($result);

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Liste_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * ajoute une recette
     */
    public function ajouterRecette(){
        /* recupere les données du formulaire  */
        $idu = $_SESSION['ID'];
        $nomr = filter_input(INPUT_POST,'nomr');
        $nbconviv = filter_input(INPUT_POST,'nbconviv');
        $descrc = filter_input(INPUT_POST,'descrc');
        $descrl = filter_input(INPUT_POST,'descrl');
        $etape = filter_input(INPUT_POST,'etape');
        $ingredient = filter_input(INPUT_POST, 'ingredient');
        $quantite = filter_input(INPUT_POST, 'quantite');

        /* verifie si les champs sont completés */
        if (empty($nomr)){
            header('Location: /Recette/creationRecette?step=NOM_R_I');
            exit();
        }
        elseif (empty($nbconviv)){
            header('Location: /Recette/creationRecette?step=NB_CONVIV_I');
            exit();
        }
        elseif (empty($descrc)){
            header('Location: /Recette/creationRecette?step=DESCR_C_I');
            exit();
        }
        elseif (empty($descrl)){
            header('Location: /Recette/creationRecette?step=DESCR_L_I');
            exit();
        }
        elseif (empty($etape)){
            header('Location: /Recette/creationRecette?step=ETAPE_I');
            exit();
        }

        /* si tous les champs sont completés*/
        else {
            /* appelle ajouter recette de MRecette */
            $mRecette = new MRecette();
            $mRecette->ajouterRecette($idu, $nomr, $nbconviv, $descrc, $descrl, $etape);

            /* appelle la fonction qui ajoute les ingredients dans la base de données*/
            $idr = $mRecette->getIdr($idu, $nomr);
            $mRecette->ajouterAsso($ingredient, $quantite, $idr);

            /* redirige vers la liste de recette */
            header('Location: /Recette/listeRecette');
            exit();
        }
    }

    /**
     * @param $id
     * ajoute un burn
     */
    public function burning ($id)
    {
        /* verifi si recette a deja reçu un burn de cette utilisateur */
        $mRecette = new MRecette();
        if ($mRecette->verifBurn($id[0], $id[1])) {
            header("Location: ../../afficherRecette/$id[0]");
            exit;
        }
        /* ajoute un burn */
        else{
            $mRecette->ajouterBurn($id[0], $id[1]);
            header("Location: ../../afficherRecette/$id[0]");
            exit;
        }
    }

    /**
     * @param $idrsupprime une recette
     * supprime la recette dont l'id est passé en parametre
     */
    public function deleteRecette ($idr)
    {
        $data= [
            'titrePage'=>'Accueil',
        ];

        /* appelle supprimerRecette de MRecette */
        $mRecette = new MRecette();
        $mRecette->supprimerRecette($idr[0]);

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Index.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    public function mesRecettes ()
    {
        $data= [
            'titrePage'=>'Mes recettes',
        ];

        /* appelle mesRecettes de MRecette */
        $mRecette = new MRecette();
        $result = $mRecette->mesRecettes($_SESSION['ID']);
        $total = mysqli_num_rows($result);

        /* Appelle des différentes vues */
        require_once  __DIR__.'/../View/Vue_StartPage.php';
        require_once  __DIR__.'/../View/Vue_Liste_Recette.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * charge la page ingredient
     */
    public function Ingredient()
    {
        $data=[
            'titrePage'=>'Ajouter Ingrédient'
        ];

        /* Appelle des différentes vues */
        require_once __DIR__.'/../View/Vue_StartPage.php';
        require_once __DIR__.'/../View/Vue_AjouterIngredient.php';
        require_once  __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * ajoute un ingredient
     */
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