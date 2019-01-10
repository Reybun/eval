<?php

    if(isset($_POST['username']) && isset($_POST['password'])) 
    {            
        //RECUPERE LES DONNEES DE L'USER
        $data = connection_SELECT($_POST['username']);
        sleep(1);

        if (password_verify($_POST['password'], $data['password']))
        { 
            // ON DETRUIT LE POST PASSWORD
            unset($_POST['password']);

            // STOCKAGE VARIABLE SESSION
            $_SESSION['id'] = intval($data['id']);
            $_SESSION['username'] = $data['username'];
            $_SESSION['picture'] = $data['picture'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

            header('Location: index.php?page=home');
            exit;
        } 
        else if (!password_verify($_POST['password'], $data['password']))
        {
            require(dirname(__FILE__).'/../V/js/erreur_auth.js');
        }
    }  
    require(dirname(__FILE__).'/../V/connection_v.php');
?>