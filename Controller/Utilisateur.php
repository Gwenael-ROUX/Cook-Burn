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
                    $id = $user->getID($pseudo);
                    $role = $user->getRole($id);
                    $email= $user->getEmail($id);
                    $_SESSION['ID']= $id;
                    $_SESSION['ROLE']= $role;
                    $_SESSION['EMAIL']=$email;
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
        exit();
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
            $user->MAJmotdepasse($email, md5($password));
        }
    }

    public function profil(){
        $data= [
            'titrePage'=>'Mon compte',
        ];
        require_once  __DIR__."/../View/Vue_StartPage.php";
        require_once  __DIR__."/../View/Vue_Compte.php";
        require_once  __DIR__."/../View/Vue_EndPage.php";
    }
    public function changePwd(){
        $oldpwd = md5(filter_input(INPUT_POST,'oldPwd'));
        $newpwd = md5(filter_input(INPUT_POST,'newPwd'));
        $confirmpwd = md5(filter_input(INPUT_POST,'confirmNewPwd'));
        $user = new MUtilisateur();
        if ($user->connection($_SESSION['PSEUDO'],$oldpwd)) {
            if ($newpwd == $confirmpwd) {
                    $user->MAJmotdepasse($_SESSION['EMAIL'],$newpwd);
                    header('Location: /Utilisateur/deconnexion');
                    exit();
                }
        }
    }
    public function changePseudo(){

        $newPseudo = md5(filter_input(INPUT_POST,'newEmail'));
        $confirmPseudo = md5(filter_input(INPUT_POST,'confirmEmail'));
        $user = new MUtilisateur();
            if ($newPseudo == $confirmPseudo) {
                $user->majPseudo($_SESSION['id'],$newPseudo);
                header('Location: /Utilisateur/deconnexion');
                exit();
            }

    }
}