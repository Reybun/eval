<?php

    // VERIF EMAIL
    $email = ($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $valide_email = false;
    }
    else 
    {
        $valide_email = true;
    }
    if (strlen($email) > 255)
    {
        $lengt_email = false;
    }
    else 
    {
        $lengt_email = true;
    }
    
    // VERIF LONGUEUR PASSWORD
    $password = (trim($_POST["password"]));
    if (strlen($password) < 3 || strlen($password) > 255 ) 
    {
        $valide_password = false;
    }
    else 
    {
        $valide_password = true;
    }

    // VERIF LONGUEUR USERNAME
    $username = (trim($_POST["username"]));
    if (strlen($username) > 25 || strlen($username) < 3) 
    {
        $valide_username = false;
    }
    else 
    {
        $valide_username = true;
    }
   
   
    $conforme_password = true;
	
    
    // VERIFICATION MDP PAS TROP COMMUN

    // On ouvre le dictionnaire en lecture seule
    $handle = fopen(dirname(__FILE__).'/../../V/common_password.txt', 'r');

    // Variable qui enregistre les mots extraits du fichier
    $buffer = "";


    if ($handle)
    {
        // Tant que l'on est pas à la fin du fichier
        while (!feof($handle) AND ($buffer != $password))
        {
            $buffer = fgets($handle);
        }
        
        if ($buffer == $password) 
        {
            $common_password = true;
        }
        else 
        {
            $common_password = false;
        } 

        // On ferme le fichier
        fclose($handle);
    }
   
?>