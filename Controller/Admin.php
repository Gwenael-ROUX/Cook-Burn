<?php

include_once __DIR__.'/../Model/MUtilisateur.php';
Class Admin {

    /**
     * Fonction par defaut
     */
    public function index (){

        /* Definition du tableau comportant les informations necessaire aux vues */
        $data= [
            'titrePage'=>'Administrateur',
        ];

        /*  Affichage du debut de page  */
        require_once __DIR__.'/../View/Vue_StartPage.php';

        /* Verification du role de l'utilisateur */
        if ($_SESSION['ROLE']== 'ADMIN'){
            /* Affichage de l'inscription*/
            require_once __DIR__.'/../View/Vue_Inscription.php';
        }else{
            header("Location: /Erreur/pasAdmin");
            exit();
        }

        /* affichage de la fin de page */
        require_once __DIR__.'/../View/Vue_EndPage.php';
    }

    /**
     * Fonction permettant l'inscription
     */
    public function inscription(){
        /* definition du tableau comportant les informations necessaire aux vues */
        $data= [
            'titrePage'=>'Administrateur',
        ];

        /*  Affichage du debut de page  */
        require_once __DIR__.'/../View/Vue_StartPage.php';

        /* Recuperation des champs du formulaire */
        $pseudo = filter_input(INPUT_POST,'pseudo');
        $email = filter_input(INPUT_POST,'email');
        $password = rand();

        /* Verification de champs vide */
        if (empty($pseudo)){
            /* Redirection avec message d'erreur */
            header('Location: /Admin/index/PSEUDO_I');
            exit();
        }elseif (empty($email)) {
            /* Redirection avec message d'erreur */
            header('Location: /Admin/index/MAIL_I');
            exit();
        }else {
            /* Contruction d'un utilisateur */
            $user = new MUtilisateur();
            /* Verification des informations afin de savoir si elle sont deja utilisé */
            if ($user->verifEmailUsed($email)){
                /* Redirection avec message d'erreur */
                header('Location: /Admin/index/PSEUDOUSED');
                exit();
            }elseif ($user->verifPseudoUsed($pseudo)){
                /* Redirection avec message d'erreur */
                header('Location: /Admin/index/MAILUSED');
                exit();

            }else {
                /* Inscription de l'utilisateur avec ses information */
                $user->inscription($pseudo, $email, md5($password));
                /* Envoi du mail avec ses information */
                $this->sendMail($pseudo, $email, $password);
                /* Redirection vers l'index */
                header('Location: /Index');
                exit();
            }
        }
    }

    /**
     * Fonction permettant l'envoi du mail d'inscription
     */
    public function sendMail($pseudo,$email,$password){
        /* Initialisation des informations du mail */
        $to = $email;
        $from = 'petitrouxchauvygonand@alwaysdata.net';
        $reply = '';
        $subject = "Compte Cook & burn";
        $bndary = md5(uniqid(mt_rand()));
        /* Initialisation des données de l'entete du mail */
        $headers = 'From: Cook & burn <' . $from . '>' . "\n";
        $headers .= 'Return-Path: <' . $reply . '>' . "\n";
        $headers .= 'Content-type: multipart/alternative; boundary="' . $bndary . '"';
        /* Definition du message du mail */
        $message_text = 'Bonjour ' . $pseudo . ',' . PHP_EOL;
        $message_text .= 'Voici vos information de connection :' . PHP_EOL;
        $message_text .= 'Email : ' . $email . PHP_EOL;
        $message_text .= 'Password : ' . $password . PHP_EOL;
        /* Ajout de contenue html dans le mail */
        $message_html = '<html><body><strong>' . str_replace(PHP_EOL, "<br/>", $message_text) . '</strong></body></html>';
        $message = '--' . $bndary . "\n";
        $message .= 'Content-Type: text/plain; charset=utf-8' . "\n\n";
        $message .= $message_text . "\n\n";
        $message .= '--' . $bndary . "\n";
        $message .= 'Content-Type: text/html; charset=utf-8' . "\n\n";
        $message .= $message_html . "\n\n";
        /* Envoi du mail */
        mail($to, $subject, $message, $headers);
    }
}