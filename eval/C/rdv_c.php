<?php
date_default_timezone_set('Europe/Paris');

if (!isset($_GET['action'])) {
    header('Location: index.php?page=home');
}

if ($_GET["action"] === "new") {
    
    $currentdt = date('Y-m-d');
    $listpatient = patient_SELECT();

    if (isset($_POST['descript'])) {
        $_SESSION['description'] = htmlspecialchars($_POST['descript']); 
        $_SESSION['patient'] = htmlspecialchars($_POST['patient']); 
    } 
    
    if (isset($_POST['cancelh'])) {
        unset($_SESSION['hrdv']);
        unset($_SESSION['description']);
    }
    
    if (isset($_POST['backdt'])) {
        unset($_SESSION['dtrdv']);
        unset($_SESSION['hrdv']);
        unset($_SESSION['description']);
    }
    if (isset($_SESSION['dtrdv']) && isset($_SESSION['hrdv']) && isset($_SESSION['description']) && isset($_SESSION['patient'])) {
        newrdv_INSERT($_SESSION['dtrdv'], $_SESSION['hrdv'], $_SESSION['description'], $_SESSION['id'], $_SESSION['patient']);
        foreach ($_SESSION as $key => $value) {
            if ($key === 'id' || $key === 'username' || $key === 'picture' || $key === 'email' || $key === 'ip') {
            } else {
                unset($_SESSION[$key]);
            }
        }
        header('Location: index.php?page=rdv&action=voir');
        exit();
    }
    if (isset($_POST['dt'])) {
        unset($_SESSION['hrdv']);
        unset($_SESSION['description']);
        if ($_POST['dt'] < $currentdt) {
        $errordt = 0;
        } else {
            $_SESSION['dtrdv'] = $_POST['dt']; 
        }
    } 

    if (isset($_SESSION['dtrdv'])) {
        $rdvday = checkrdv2_SELECT($_SESSION["id"], $_SESSION['dtrdv']);
        //var_dump($rdvday);
    }

    if (isset($_POST['hour']) && isset($_POST['min'])) {
        $h = intval($_POST['hour']);
        
        if($h < 10){
            $h = "0".$h;
        }
        
        $min = intval($_POST['min']);
        if($min < 10){
            $min = "0".$min;
        }
        $start_time = $h.':'.$min.':00';
        
        $_SESSION['hrdv'] = $start_time;
        
    }

    if (isset($_SESSION['hrdv'])) {

        $rdv = checkrdv_SELECT($_SESSION["id"], $_SESSION['hrdv'], $_SESSION['dtrdv']);

        if (!isset($_POST['continueh'])) {
            if (isset($rdv['0'])) {
                $alreadyrdv = 0;
            }
        }
    }



} elseif ($_GET["action"] === "voir") {
    
    $currentdt = date('Y-m-d');
    //var_dump($currentdt);
    $currenttime = date("H:i:s");
    //var_dump($currenttime);
    if (isset($_GET['date'])) {
        $arrayrdv = checkrdv2_SELECT($_SESSION['id'], $_GET['date']);
    } else {
        unset($_SESSION['dtrdv']);
        unset($_SESSION['hrdv']);
        unset($_SESSION['description']);
        $arrayrdv = voirrdv_SELECT($_SESSION['id']);
    }
} elseif ($_GET["action"] === "old") {
    $arrayrdv = voiroldrdv_SELECT($_SESSION['id']);
} else if ($_GET["action"] === "modify") {

    if (isset($_POST['cancelmodif'])) {
        foreach ($_SESSION as $key => $value) {
            if ($key === 'id' || $key === 'username' || $key === 'picture' || $key === 'email' || $key === 'ip') {
            } else {
                unset($_SESSION[$key]);
            }
        }
        
    }

    if (isset($_POST['modifrdv'])) {
        $_SESSION['modifh'] = $_POST['newhour'];
        $_SESSION['modifrdv'] = $_POST['idrdv'];
        $_SESSION['modifdat'] = $_POST['date'];
        $_SESSION['modifd'] = $_POST['description'];

    }


    if (isset($_SESSION['modifh'])) {
        echo $_SESSION['modifh'];
        $check = checkmodifrdv_SELECT($_SESSION['modifrdv'], $_SESSION['modifdat'], $_SESSION['modifh']);

        var_dump($check);
        if (isset($check['0'])) {
            $alreadyrdv = 0;
        } else {
            rdv_UPDATE($_SESSION['modifrdv'],$_SESSION['modifh'], $_SESSION['modifd']);
            foreach ($_SESSION as $key => $value) {
                if ($key === 'id' || $key === 'username' || $key === 'picture' || $key === 'email' || $key === 'ip') {
                } else {
                    unset($_SESSION[$key]);
                }
            }
            $_SESSION['successmodif'] = 1; 
            header('Location: index.php?page=home');
            exit();
        }
        
        if (isset($_POST['continuemodif'])) {
            rdv_UPDATE($_SESSION['modifrdv'],$_SESSION['modifh'], $_SESSION['modifd']);
            foreach ($_SESSION as $key => $value) {
                if ($key === 'id' || $key === 'username' || $key === 'picture' || $key === 'email' || $key === 'ip') {
                } else {
                    unset($_SESSION[$key]);
                }
            }
            $_SESSION['successmodif'] = 1; 
            header('Location: index.php?page=home');
            exit();
        }
    }

    
    if (isset($_POST['date'])) {
        $arrayrdv = checkrdv2_SELECT($_SESSION['id'], $_POST['date']);
    }

    if (!isset($_POST['date'])) {
        $arrayrdv = voirrdv_SELECT($_SESSION['id']);
    }
}
else if ($_GET['action'] === "supp") {
    rdv_DELETE($_GET['num']);
    header('Location: index.php?page=rdv&action=voir');
    exit();
    
}

include('./V/rdv_v.php');
require_once('./V/template.php');
?>