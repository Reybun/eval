<?php
    session_start();

    // REQUIRE LES MODELES DE BDD
    require('db_connect.php');
    require('M/modele_delete.php');
    require('M/modele_insert.php');
    require('M/modele_select.php');
    require('M/modele_update.php');

    if ($_GET['page'] !== 'rdv')
    {
        unset($_SESSION['dtrdv']);
        unset($_SESSION['hrdv']);
        unset($_SESSION['description']);
        
    }

    if ($_GET['page'] == 'connection')
    {
        if(isset($_SESSION['username']))  header('Location: index.php?page=home');
        //connection();
        else require_once('C/connection_C.php');
    }
    else if ($_GET['page'] == 'inscription')
    {
        //inscription();
        require_once('C/inscription_c.php');
    }
    else if (isset($_GET['page']) && !empty($_GET['page']) && isset($_SESSION['id'])) 
    {
        if ($_GET['page'] == 'dc')
        {
            require_once('C/php/disconnect.php');
        }
        else if ($_GET['page'] == 'home') 
        {
          
            require_once('C/home_c.php');
        }
        else if ($_GET['page'] == 'profile')
        {
            
            require_once('C/profile_c.php');
        }        
        else if ($_GET['page'] == 'calendar')
        {
            
            require_once('C/calendar_c.php');
        }
        else if ($_GET['page'] == 'rdv')
        {
            
            require_once('C/rdv_c.php');
        }
        else if ($_GET['page'] == 'fiche')
        {
            
            require_once('C/fiche_c.php');
        }
        
        else if ($_GET['page'] == 'patient')
        {
            
            require_once('C/patient_c.php');
        }
        else
        {
            require_once('V/404.php');
            
        }
    }
    else 
    {
        header('Location: index.php?page=connection');
        exit();
    }
?>