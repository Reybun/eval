<?php
//var_dump($_POST);
if(!isset($_GET['menu']) || empty($_GET['menu'])) header('Location: index.php?page=profile&menu=username');


if(isset($_GET['menu']) && $_GET['menu'] === "dc") {
    session_unset();
    session_destroy();
    session_write_close();
    header('Location: index.php');
    exit;
}

if(isset($_GET['menu']) && $_GET['menu'] === "horaires") {
    
}


//Changer son pseudo 
if(isset($_POST['menu']) && $_POST['menu'] === "username")
{
    if(isset($_POST['username']))
    {
        trim($_POST['username']);
        if (!empty($_POST['username']))
        {

            // VERIF LONGUEUR USERNAME
            $username = ($_POST["username"]);
            if (strlen($username) > 25 || strlen($username) < 4) 
            {
                $valide_username = false;
            }
            else 
            {
                $valide_username = true;
            }


            if ($valide_username === true)
            {
                //UPDATE dans la BDD le nouveau pseudo de l'user
                $_SESSION['username'] = htmlspecialchars($_POST['username']);
                username_UPDATE($_SESSION['username'], intval($_SESSION['id']));
                
                header('Location: index.php?page=profile&menu=username');
                exit();
            }
            else 
            {
                include('./V/js/length_username.js');
            }
        }
        else 
        {
            include('./V/js/empty_form.js');
        }
    }
}


//Changer son password :
if (isset($_SESSION['error']))
{
    header('Location: index.php?page=profile&menu=password');
}

if(isset($_POST['menu']) && $_POST['menu'] === "password")
{
    
    if(isset($_POST['old_password']))
    { 
        echo'ok';
        // ENLEVE LES ESPACES DEBUT ET FIN
        $_POST['old_password'] = trim($_POST['old_password']);
        if (!empty($_POST['old_password']))
        {
            
            // VERIF LONGUEUR PASSWORD
            if (strlen($_POST['new_password1']) > 4 && strlen($_POST['new_password1']) < 255 
            && strlen($_POST['new_password2']) > 4 && strlen($_POST['new_password2']) < 255) 
            {
                $valide_password = true;
            }
            else 
            {
                $valide_password = false;
            }

            // VERIFICATION CARACTERE PASSWORD
            $password1 = $_POST['new_password1'];
            $password2 = $_POST['new_password2'];

            $conforme_password = true;
            
    

            if ($valide_password === true && $conforme_password === true)
            {
                
                //Vérifie si le password actuel entré est correcte
                $password = password_SELECT($_SESSION['id']);
                $password = $password['password'];
                $test_old_password = false;
                $error = '';
                password_verify(htmlspecialchars($_POST['old_password']), $password)? $test_old_password = true : $_SESSION['error'] = 'Le mot de passe actuel entré n\'est pas le bon.';

                //Vérifie si les 2 new_password entrés sont semblabes
                $test_new_password = false;
                ($_POST['new_password1']===$_POST['new_password2'])? $test_new_password = true : $_SESSION['error'] = 'Les nouveaux mots de passe ne sont pas identique.' ;

                //Si tout est bon : change le mot de passe
                if($test_old_password===true && $test_new_password===true)
                {
                    
                    $new_password = password_hash(htmlspecialchars($_POST['new_password1']), PASSWORD_BCRYPT);
                    password_UPDATE($new_password, intval($_SESSION['id']));
                    $_SESSION['error'] = "Votre mot de passe à été modifier avec succès.";
                }
            }
            else if ($valide_password === false || ($conforme_password === false))
            {
                include('./V/js/conforme_password.js');
                
            }
        }
        else 
        {
            include('./V/js/empty_form.js');
            
        }
    }
}


//Changer son avatar :
if(isset($_POST['profile_picture']))
{

    // ENLEVE LES ESPACES DEBUT ET FIN
    $_POST['profile_picture'] = trim($_POST['profile_picture']);
    if (!empty($_POST['profile_picture']))
    {
        if (strlen($_POST['profile_picture']) < 255) 
        {
            picture_UPDATE(htmlspecialchars($_POST['profile_picture']), intval($_SESSION['id']));
            $_SESSION['picture'] = htmlspecialchars($_POST['profile_picture']);
            header('Location: index.php?page=profile&menu=picture');
            exit;
        }
        else 
        {
            include('./V/js/pp_length.js');
        }
    }
    else 
    {
        include('./V/js/empty_form.js');
    }
}



$title = 'Mon profile';
require_once('./V/profile_menu_v.php');
require_once('./V/template.php');


?>