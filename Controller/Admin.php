<?php

include_once __DIR__.'/../Model/MUtilisateur.php';
Class Admin {
    public function index (){
        $data= [
            'titrePage'=>'Administrateur',
        ];

        require_once __DIR__.'/../View/Vue_StartPage.php';
        if ($_SESSION['ROLE']== 'ADMIN'){
            require_once __DIR__.'/../View/Vue_Inscription.php';
        }else{
            header("Location: /Erreur/pasAdmin");
            exit();
        }

        require_once __DIR__.'/../View/Vue_EndPage.php';
    }
    public function inscription(){
        $data= [
            'titrePage'=>'Administrateur',
        ];

        require_once __DIR__.'/../View/Vue_StartPage.php';
        $pseudo = filter_input(INPUT_POST,'pseudo');
        $email = filter_input(INPUT_POST,'email');
        $password = rand();
        if (empty($pseudo)){
            header('Location: /Admin/index/PSEUDO_I');
            exit();
        }
        elseif (empty($email)) {
            header('Location: /Admin/index/MAIL_I');
            exit();
        }else {
            $user = new MUtilisateur();
            if ($user->verifEmailUsed($email)){
                header('Location: /Admin/index/PSEUDOUSED');
                exit();
            }
            elseif ($user->verifPseudoUsed($pseudo)){
                header('Location: /Admin/index/MAILUSED');
                exit();
            }else {
                $user->inscription($pseudo, $email, md5($password));
                $this->sendMail($pseudo, $email, $password);
                header('Location: /Index');
                exit();
            }
        }
    }
    public function sendMail($pseudo,$email,$password){

        $to = $email;
        $from = 'petitrouxchauvygonand@alwaysdata.net';
        $reply = '';
        $subject = "Compte Cook & burn";
        $bndary = md5(uniqid(mt_rand()));

        $headers = 'From: Cook & burn <' . $from . '>' . "\n";
        $headers .= 'Return-Path: <' . $reply . '>' . "\n";
        $headers .= 'Content-type: multipart/alternative; boundary="' . $bndary . '"';

        $message_text = 'Bonjour ' . $pseudo . ',' . PHP_EOL;
        $message_text .= 'Voici vos information de connection :' . PHP_EOL;
        $message_text .= 'Email : ' . $email . PHP_EOL;
        $message_text .= 'Password : ' . $password . PHP_EOL;

        $message_html = '<html><body><strong>' . str_replace(PHP_EOL, "<br/>", $message_text) . '</strong></body></html>';
        $message = '--' . $bndary . "\n";
        $message .= 'Content-Type: text/plain; charset=utf-8' . "\n\n";
        $message .= $message_text . "\n\n";
        $message .= '--' . $bndary . "\n";
        $message .= 'Content-Type: text/html; charset=utf-8' . "\n\n";
        $message .= $message_html . "\n\n";

        mail($to, $subject, $message, $headers);
    }
}