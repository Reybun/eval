<?php

if ($_GET['action'] === 'new') {

    $currentdt = date('Y-m-d');

    if (isset($_POST['ref'])) {
        
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $first_name = htmlspecialchars(trim($_POST['first_name']), ENT_QUOTES, 'UTF-8');
        $date = $_POST['date'];
        $last_name = htmlspecialchars(trim($_POST['last_name']), ENT_QUOTES, 'UTF-8');
        $address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
        $postal_code = htmlspecialchars(trim($_POST['postal_code']), ENT_QUOTES, 'UTF-8');
        $city = htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8');
        $phone_number = htmlspecialchars(trim($_POST['phone_number']), ENT_QUOTES, 'UTF-8');
        $statu = htmlspecialchars(trim($_POST['statu']), ENT_QUOTES, 'UTF-8');
        $ref = htmlspecialchars(trim($_POST['ref']), ENT_QUOTES, 'UTF-8');
        

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $email_error = "Entrez une addresse email valide";
        }

        if (!isset($error)) {
            $_SESSION['pat_email'] = $email ;
            $_SESSION['pat_first_name'] = $first_name;
            $_SESSION['pat_last_name'] = $last_name;
            $_SESSION['pat_date'] = $date;
            $_SESSION['pat_address'] = $address;
            $_SESSION['pat_postal_code'] = $postal_code;
            $_SESSION['pat_city'] = $city;
            $_SESSION['pat_phone_number'] = $phone_number;
            $_SESSION['pat_statu'] = $statu;
            $_SESSION['ref'] = $ref;

            foreach ($_POST as $key => $value) {
                unset($_POST[$key]);
            }
            header('Location: index.php?page=patient&action=new');
            exit();
            
        }
    }
    
    else if (isset($_SESSION['ref'])) {

        if ($_SESSION['ref'] === 'new' && isset($_POST['modevie'])) {
            
            if (!empty($_POST['remail'])) {
                $email = htmlspecialchars(trim($_POST['remail']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $email = $_SESSION['pat_email'];
            }

            if (!empty($_POST['rfirst_name'])) {
                $first_name = htmlspecialchars(trim($_POST['rfirst_name']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $first_name = $_SESSION['pat_first_name'];
            }

            if (!empty($_POST['rlast_name'])) {
                $last_name = htmlspecialchars(trim($_POST['rlast_name']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $last_name = $_SESSION['pat_last_name'];
            }

            if (!empty($_POST['raddress'])) {
                $address = htmlspecialchars(trim($_POST['raddress']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $address = $_SESSION['pat_address'];
            }

            if (!empty($_POST['rpostal_code'])) {
                $postal_code = htmlspecialchars(trim($_POST['rpostal_code']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $postal_code = $_SESSION['pat_postal_code'];
            }

            if (!empty($_POST['rphone_number'])) {
                $phone_number = htmlspecialchars(trim($_POST['rphone_number']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $phone_number = $_SESSION['pat_phone_number'];
            }

            if (isset($_POST['modevie'])) {
                $modevie= htmlspecialchars(trim($_POST['modevie']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $modevie = "";
            }

            if (isset($_POST['alimentation'])) {
                $alimentation= htmlspecialchars(trim($_POST['alimentation']), ENT_QUOTES, 'UTF-8');
            }
            else {
                $alimentation = "";
            }


            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $email_error = "Entrez une addresse email valide";
            }

            if (!isset($error)) {
                $_SESSION['ref_email'] = $email ;
                $_SESSION['ref_first_name'] = $first_name;
                $_SESSION['ref_last_name'] = $last_name;
                $_SESSION['ref_address'] = $address;
                $_SESSION['ref_postal_code'] = $postal_code;
                $_SESSION['ref_modevie'] = $modevie;
                $_SESSION['ref_alimentation'] = $alimentation;
                //$_SESSION['ref_city'] = $city;
                $_SESSION['ref_phone_number'] = $phone_number;
                
                $idresp = new_representant_INSERT($_SESSION['ref_last_name'], $_SESSION['ref_first_name'], $_SESSION['ref_address'], $_SESSION['ref_postal_code'], $_SESSION['ref_email'], $_SESSION['ref_phone_number'], $_SESSION['ref_modevie'], $_SESSION['ref_alimentation']);
                //var_dump($idref);
                newpatient_INSERT($_SESSION['pat_last_name'], $_SESSION['pat_first_name'], $_SESSION['pat_address'], $_SESSION['pat_postal_code'], $_SESSION['pat_email'], $_SESSION['pat_date'], $_SESSION['pat_phone_number'], $_SESSION['pat_statu'], $idresp);
                foreach ($_SESSION as $key => $value) {
                    if ($key === 'id' || $key === 'username' || $key === 'picture' || $key === 'email' || $key === 'ip') {
                    } else {
                        unset($_SESSION[$key]);
                    }
                }
                header('Location: index.php?page=home');
                exit();
            }
        } 
        else if ($_SESSION['ref'] === 'exist') {

            if (isset($_POST['respons'])) {
                //insertnewpatient
                newpatient_INSERT($_SESSION['pat_last_name'], $_SESSION['pat_first_name'], $_SESSION['pat_address'], $_SESSION['pat_postal_code'], $_SESSION['pat_email'], $_SESSION['pat_date'], $_SESSION['pat_phone_number'], $_SESSION['pat_statu'], $_POST['respons']);
                foreach ($_SESSION as $key => $value) {
                    if ($key === 'id' || $key === 'username' || $key === 'picture' || $key === 'email' || $key === 'ip') {
                    } else {
                        unset($_SESSION[$key]);
                    }
                }
                header('Location: index.php?page=home');
                exit();
            } else {
                $listrespon = responsable_SELECT();
            }
            
            //var_dump($listrespon);
        }

    }
    
}
else if ($_GET['action'] = 'voir' ) {
    //clean session
    $listpatient = patient_SELECT();



    if (isset($_POST['recherchetel'])) {
        //var_dump($_POST);
        $tel = recherchetel_SELECT($_POST['telrech']);
        //var_dump($tel);
    }
    
    if (isset($_POST['modifpatform'])) {
        //var_dump($_POST);
        patient_UPDATE($_POST['idpatmodif'],$_POST['name'],$_POST['prenom'],$_POST['adresse'],$_POST['code_postal'],$_POST['mail'],$_POST['tel']);
    }
    if (isset($_POST['modifpatient'])) {
        $fiche = fiche_SELECT($_POST['idpatmodif']);
        //var_dump($fiche);
    }

    else if (isset($_POST['recherchenom'])) {
        $tel = recherchename_SELECT($_POST['namerech']);
    }

    else if (isset($_POST['delpatient'])) {
        //working
        $listfiche = ficheconsultodel_SELECT($_POST['idpatient']);
        rdv2_DELETE($_POST['idpatient']);
        //var_dump($listfiche);
        if (isset($listfiche['0'])) {
            foreach ($listfiche as $key => $value) {
                photo_DELETE($value['fiche_consult_id']);
                ficheconsult_DELETE($value['fiche_consult_id']);
            }
        }
        patient_DELETE($_POST['idpatient']);
        unset($_POST['delpatient']);
        header('Location: index.php?page=patient&action=voir');
        exit();
    }

    else if (isset($_POST['idfiche'])) {
        $fiche = fiche_SELECT($_POST['idfiche']);
        $pictures = picture_SELECT($_POST['idfiche']);
    }

    else if (isset($_POST['patientvoir'])) {
        $patient = patient2_SELECT($_POST['patientvoir']);
        //var_dump($patient);
        $fiche = ficheconsult_SELECT($_POST['patientvoir']);
        $pictures = pictureprofile_SELECT($patient[0]['idp']);
        //var_dump($patient);
    }
}



include('./V/patient_v.php');
require_once('./V/template.php');

?>