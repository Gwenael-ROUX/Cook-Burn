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
    /* Fonction par defaut */
    public function index(){
        /* Definition du tableau comportant les informations necessaire aux vues */

        $data= [
            'titrePage'=>'Connexion',
        ];
        /*  Affichage du debut de page  */
        require_once  __DIR__."/../View/Vue_StartPage.php";
        /*  Affichage de l'inscription  */
        require_once  __DIR__."/../View/Vue_Connection.php";
        /*  Affichage de la fin de page  */
        require_once  __DIR__."/../View/Vue_EndPage.php";
    }
    /* Fonction qui permet la connection */
    public function seconnecter(){

        /* Recuperation des champs du formulaire */
        $pseudo = filter_input(INPUT_POST,'pseudo');
        $password = md5(filter_input(INPUT_POST,'password'));

        /* Verification de champs vide */
        if (isset($pseudo) && isset($password)){
            /* Contruction d'un utilisateur */
            $user = new MUtilisateur();
            /* Test de la connection */
            if($user->connection($pseudo,$password)){

                try {/* Recuperationd des informations de l'utilisateur */
                    $id = $user->getID($pseudo);
                    $role = $user->getRole($id);
                    $email= $user->getEmail($id);
                    /* Definition des variables de session de l'utilisateur */
                    $_SESSION['ID']= $id;
                    $_SESSION['ROLE']= $role;
                    $_SESSION['EMAIL']=$email;
                    $_SESSION['PSEUDO']= $pseudo;
                }/* Capture d'un message d'erreur */
                catch (Exception $e) {
                    echo $e->getMessage();
                }

                /* Redirection vers l'index */
                header('Location: /Index');
                exit();
            }else {
                /* Redirection vers l'index avec un message d'erreur*/
                header('Location: /Index/index/errorco');
                exit();
            }



        }else {
            /* Redirection vers l'index */
            header('Location: /Index');
            exit();
        }

    }
    /* Fonction de deconnexion */
    public function deconnexion(){
        /* Destruction de la session */
        session_destroy();
        /* Redirection vers l'index */
        header('Location: /Index');
        exit();
    }

    public function mdpOublie(){
        /* Definition du tableau comportant les informations necessaire aux vues */
        $data= [
            'titrePage'=>'Mot de passe oublié',
        ];
        /*  Affichage du debut de page  */
        require_once  __DIR__."/../View/Vue_StartPage.php";
        /*  Affichage du formulaire de mot de passe oublié  */
        require_once  __DIR__."/../View/Vue_MdpOublie.php";
        /*  Affichage de la fin de page  */
        require_once  __DIR__."/../View/Vue_EndPage.php";
    }
    /* Fonction de changement de mot de passe */
    public function nouveauMdp(){
        /* Recuperation des champs du formulaire */
        $email = filter_input(INPUT_POST,'email');
        /* Contruction d'un utilisateur */
        $user = new MUtilisateur();
        /* Verification du mail */
        if ($user->verifEmailUsed($email)) {
            /* Generation d'un mot de passe aleatoire */
            $password = rand();
            /* Initialisation des informations du mail */
            $from = 'petitrouxchauvygonand@alwaysdata.net';
            $reply = '';
            $bndary = md5(uniqid(mt_rand()));

            /* Initialisation des données de l'entete du mail */
            $headers = 'From: Cook & burn <' . $from . '>' . "\n";
            $headers .= 'Return-Path: <' . $reply . '>' . "\n";
            $headers .= 'Content-type: multipart/alternative; boundary="' . $bndary . '"';
            /* Definition du message du mail */
            $message = 'Bonjour ' . ',' . PHP_EOL;
            $message .= 'Password : ' . $password . PHP_EOL;
            /* Envoi du mail */
            mail($email, 'Nouveau mot de passe', $message, $headers);
            /* Mise a jour du mot de passe dans la base de données */
            $user->MAJmotdepasse($email, md5($password));
        }
    }
    /* Fonction d'affichage des informations du compte */
    public function profil(){
        /* Definition du tableau comportant les informations necessaire aux vues */
        $data= [
            'titrePage'=>'Mon compte',
        ];
        /*  Affichage du debut de page  */
        require_once  __DIR__."/../View/Vue_StartPage.php";
        /*  Affichage des informations du compte  */
        require_once  __DIR__."/../View/Vue_Compte.php";
        /*  Affichage de la fin de page  */
        require_once  __DIR__."/../View/Vue_EndPage.php";
    }
    /* Fonction de changement de mot de passe */
    public function changePwd(){
        /* Recuperation des champs du formulaire */
        $oldpwd = md5(filter_input(INPUT_POST,'oldPwd'));
        $newpwd = md5(filter_input(INPUT_POST,'newPwd'));
        $confirmpwd = md5(filter_input(INPUT_POST,'confirmNewPwd'));
        /* Contruction d'un utilisateur */
        $user = new MUtilisateur();
        /* Verification de l'ancien mot de passe */
        if ($user->connection($_SESSION['PSEUDO'],$oldpwd)) {
            /* Verification de la correspondance des mots de passe */
            if ($newpwd == $confirmpwd) {
                /* Mise a jour du mot de passe dans la base de données */
                $user->MAJmotdepasse($_SESSION['EMAIL'],$newpwd);
                /* Redirection vers la deconnexion */
                header('Location: /Utilisateur/deconnexion');
                exit();
                }
        }
    }
    /* Fonction de changement de pseudo2 */
    public function changePseudo(){
        /* Recuperation des champs du formulaire */
        $newPseudo = filter_input(INPUT_POST,'newPseudo');
        $confirmPseudo = filter_input(INPUT_POST,'confirmPseudo');
        /* Contruction d'un utilisateur */
        $user = new MUtilisateur();
        /* Verification de la correspondance des pseudo */
            if ($newPseudo == $confirmPseudo) {
                /* Mise a jour du pseudo dans la base de données */
                $user->majPseudo($_SESSION['ID'],$newPseudo);
                /* Redirection vers la deconnexion */
                header('Location: /Utilisateur/deconnexion');
                exit();
            }

    }
    /* Fonction de changement d'email */
    public function changeEmail(){
        /* Recuperation des champs du formulaire */
        $newEmail = filter_input(INPUT_POST,'newEmail');
        $confirmEmail = filter_input(INPUT_POST,'confirmEmail');
        /* Contruction d'un utilisateur */
        $user = new MUtilisateur();
        /* Verification de la correspondance des emails */
        if ($newEmail == $confirmEmail) {
            /* Mise a jour de l'email dans la base de données */
            $user->majEmail($_SESSION['ID'],$newEmail);
            /* Redirection vers la deconnexion */
            header('Location: /Utilisateur/deconnexion');
            exit();
        }

    }
}