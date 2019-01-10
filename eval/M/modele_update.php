<?php
  
    // ----------------------------------------------------------------------------

     //Permet d'UPDATE une information dans la BDD 
     function username_UPDATE($username, $id)
     {
         $bdd = bdd();
         $req = $bdd->prepare(' UPDATE user
                             SET username = ? 
                             WHERE id = ? 
                             LIMIT 1
                             ');
         $req->execute(array($username, $id));
     }
     
     //--------------------------------------------------------------------------------
 
     //Permet d'UPDATE une information dans la BDD 
     function password_UPDATE( $value_attribut, $id)
     {
         $bdd = bdd();
         $req = $bdd->prepare(' UPDATE user
                             SET password = ? 
                             WHERE id = ? 
                             LIMIT 1
                             ');
         $req->execute(array($value_attribut, $id));
     }
     
     //--------------------------------------------------------------------------------
 
     //Permet d'UPDATE une information dans la BDD 
     function picture_UPDATE( $value_attribut, $id)
     {
         $bdd = bdd();
         $req = $bdd->prepare(' UPDATE user
                             SET picture = ? 
                             WHERE id = ? 
                             LIMIT 1
                             ');
         $req->execute(array($value_attribut, $id));
     }
 
     //--------------------------------------------------------------------------------
    //changement de la fiche 
    function fichconsult_UPDATE($id,$re,$pro,$pat,$typ,$place,$resu)
    {
        $bdd = bdd();
        $query = "UPDATE `fiche_consult` 
        SET `resume`= :re,`protocole`= :pro,`pathologie`= :pat,`type`= :typ,`place`= :place,`resultat`= :resu WHERE id = :id;";

        $query_params = array(
            ':id' => trim(htmlspecialchars($id)),
            ':re' => trim(htmlspecialchars($re)),
            ':pro' => trim(htmlspecialchars($pro)),
            ':pat' => trim(htmlspecialchars($pat)),
            ':typ' => trim(htmlspecialchars($typ)),
            ':place' => trim(htmlspecialchars($place)),
            ':resu' => trim(htmlspecialchars($resu))
        );

        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // ----------------------------------------------------------------------------
 
    function rdv_UPDATE($id,$tim,$de)
    {
        $bdd = bdd();
        $query = "UPDATE `rdv` SET `time`= :tim ,`description`= :de WHERE id = :id
        ;";

        $query_params = array(
            ':id' => $id,
            ':tim' => $tim,
            ':de' => htmlspecialchars($de)
        );

        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    function patient_UPDATE($iid,$id,$re,$pro,$pat,$typ,$place)
    {
        $bdd = bdd();
        $query = "UPDATE `patient` 
        SET `name`=:name,`prenom`=:pre,`adresse`=:ad,`code_postal`=:post,`mail`=:mail,`tel`=:tel
        WHERE id = :id;";

        $query_params = array(
            ':id' => $iid,
            ':name' => trim(htmlspecialchars($id)),
            ':pre' => trim(htmlspecialchars($re)),
            ':ad' => trim(htmlspecialchars($pro)),
            ':post' => trim(htmlspecialchars($pat)),
            ':mail' => trim(htmlspecialchars($typ)),
            ':tel' => trim(htmlspecialchars($place))
        );

        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

?>  