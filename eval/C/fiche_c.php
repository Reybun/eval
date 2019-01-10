<?php
//var_dump($_POST);
//var_dump($_FILES);

if(isset($_POST['fichconfirm'])) {
    //var_dump($_POST);
    fichconsult_UPDATE($_GET['num'], $_POST['resume'],$_POST['protocole'],$_POST['pathologie'], $_POST['type'], $_POST['place'], $_POST['resultat']);
    
    ///STORE IMAGE IMPORTANT
    if (isset($_FILES['picture'])) {
        if ($_FILES['picture']['type'] == 'image/png' || $_FILES['picture']['type'] == 'image/jpg' || $_FILES['picture']['type'] == 'image/jpeg') {
            if (!is_file('./V/img/userimg/'.$_FILES['picture']['name'])) {

            $uploaddir = './V/img/userimg/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
            picture_INSERT($_FILES['picture']['name'],$_GET['num']);
            
            }
        }
    }
    
}
$fiche = fiche_SELECT($_GET['num']);
$pictures = picture_SELECT($_GET['num']);
include('./V/fiche_v.php');
require_once('./V/template.php');

?>