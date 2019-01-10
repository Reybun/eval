<?php

    $metier = metier_SELECT();

    if(isset($_POST['password']))
    {
        $passhache = password_hash($_POST['password'], PASSWORD_DEFAULT);

        require(dirname(__FILE__).'/../C/php/verif_inscription.php');
        $profile_picture = "https://cdn.drawception.com/images/panels/2016/9-24/z32LQzsxDH-2.png";

        if (
        $valide_email == true 
        && $valide_password == true 
        && $conforme_password == true 
        && $valide_username == true
        && $lengt_email == true
        && $common_password == false
        ){
            $_POST['email'] = strtolower($_POST['email']);
            // APPEL DE LA FONCTION SQL INSCRIPTION
            //var_dump($_POST);
            $idnew = inscription_INSERT($_POST['username'], $passhache, $_POST['email'], $profile_picture);
            metier_INSERT($_POST['metier'], $idnew);
            require(dirname(__FILE__).'/../V/js/create_account.js');
        }
        
        // VERIFICATION INSCRIPTION
        else if (isset($valide_email) && $valide_email == false)
        {
            require(dirname(__FILE__).'/../V/js/invalide_email.js');
        }
        else if (isset($valide_password) && $valide_password == false)
        {
            require(dirname(__FILE__).'/../V/js/invalide_password.js');
        }
        else if (isset($conforme_password) && $conforme_password == false)
        {
            require(dirname(__FILE__).'/../V/js/conforme_password.js');
        }
        else if (isset($valide_username) && $valide_username == false)
        {
            require(dirname(__FILE__).'/../V/js/username_length.js');
        }
        else if (isset($lengt_email) && $lengt_email == false)
        {
            require(dirname(__FILE__).'/../V/js/username_length.js');
        }
        else if (isset($common_password) && $common_password == true)
        {
            require(dirname(__FILE__).'/../V/js/common_password.js');
        }

    }

    require(dirname(__FILE__).'/../V/inscription_v.php');
?>