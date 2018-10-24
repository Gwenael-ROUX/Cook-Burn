<?php
 //require_once 'Controller/index.php';
session_start();

$url = filter_input(INPUT_GET,'url');
if (empty($url)){
    header('Location: /Index');
}else {
    $urlExp = explode('/',$url);
    $ctrlFile = 'Controller/' .$urlExp[0] . '.php';
    if ( file_exists($ctrlFile)) {
        include $ctrlFile;
        if ( class_exists($urlExp[0])){
            $ctrl = new $urlExp[0]();
            $action = 'index';
            if (isset($urlExp[1])){
                $action = $urlExp[1];
            }
            if(method_exists($ctrl,$action)){
                $param = array_slice($urlExp,2);
                $ctrl->$action($param);
                exit;
            }

        }
    }
    header('Location: /Index');

}

//rediriger vers erreur