<?php
/**
 * Created by PhpStorm.
 * User: Chyva
 * Date: 17/10/2018
 * Time: 14:36
 */

class Erreur
{
    /**
     * Fonction qui traite l'erreur de la permission d'administrateru
     */
    public function pasAdmin (){
        /* Definition du tableau comportant les informations necessaire aux vues */
        $data= [
            'titrePage'=>'Pas Admin',
            'text'=>'Veuillez vous connectez en tant qu\'administateur',
        ];
        /* Affichage de la vue d'erreur */
        require_once __DIR__. '/../View/Vue_Error.php';
        /* Affichage de la vue de fin de page */
        require_once __DIR__. '/../View/Vue_EndPage.php';
    }
    /**
     * Fonction qui traite l'erreur de la permission d'administrateru
     */
    public function erreur404(){
        /* Definition du tableau comportant les informations necessaire aux vues */
        $data= [
            'titrePage'=>'Erreur 404',
            'text'=>'Page Introuvable',
        ];
        /* Affichage de la vue d'erreur */
        require_once __DIR__. '/../View/Vue_Error.php';
        /* Affichage de la vue de fin de page */
        require_once __DIR__. '/../View/Vue_EndPage.php';
    }
}