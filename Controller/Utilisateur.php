<?php
/**
 * Created by PhpStorm.
 * User: Yvan Chauvy
 * Date: 11/10/2018
 * Time: 15:14
 */

include_once __DIR__.'/../Model/MUtilisateur.php';

class Utilisateur
{
    public function index(){
        $data= [
            'titrePage'=>'Connexion',
        ];
        require_once  __DIR__."/../View/Vue_StartPage.php";
        require_once  __DIR__."/../View/Vue_Connection.php";
        require_once  __DIR__."/../View/Vue_EndPage.php";
    }

    public function seconnecter(){


        $pseudo = filter_input(INPUT_POST,'pseudo');
        $password = md5(filter_input(INPUT_POST,'password'));


        if (isset($pseudo) && isset($password)){

            $user = new MUtilisateur();
            if($user->connection($pseudo,$password)){

                try {
                    $id = $user->getIDFromLastQuery();
                    $role = $user->getRole($pseudo);

                    $_SESSION['ROLE']= $role;
                    $_SESSION['PSEUDO']= $pseudo;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }


                header('Location: /Index');
                exit();
            }else {

                echo 'foobar';
                header('Location: /Index/index/errorco');
                exit();
            }



        }else {

            header('Location: /Index');
            exit();
        }

    }
    public function deconnexion(){
        session_destroy();
        header('Location: /Index');
    }

    public function mdpOublie(){
        $data= [
            'titrePage'=>'Mot de passe oublié',
        ];
        require_once  __DIR__."/../View/Vue_StartPage.php";
        require_once  __DIR__."/../View/Vue_MdpOublie.php";
        require_once  __DIR__."/../View/Vue_EndPage.php";
    }

    public function nouveauMdp(){
        $email = filter_input(INPUT_POST,'email');
        $user = new MUtilisateur();
        if ($user->verifEmailUsed($email)) {
            $password = rand();
            $from = 'petitrouxchauvygonand@alwaysdata.net';
            $reply = '';
            $bndary = md5(uniqid(mt_rand()));

            $headers = 'From: Cook & burn <' . $from . '>' . "\n";
            $headers .= 'Return-Path: <' . $reply . '>' . "\n";
            $headers .= 'Content-type: multipart/alternative; boundary="' . $bndary . '"';

            $message = 'Bonjour ' . ',' . PHP_EOL;
            $message .= 'Password : ' . $password . PHP_EOL;
            mail($email, 'Nouveau mot de passe', $message, $headers);
            $user->MAJmotdepasse($email, $password);
        }
    }

    public function profil(){

    }
}