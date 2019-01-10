<?php
    // ----------------------------------------------------------------------------

    function inscription_INSERT ($username, $password, $email, $picture)
    {
        $bdd = bdd();
        // INSCRIPTION
        $inscription = $bdd->prepare(
        'INSERT INTO user (id, username, password, email, picture) 
        VALUES (NULL , ?, ?, ?, ?);
        ');
        $inscription->execute(array($username, $password,$email, $picture));
        $id = $bdd -> lastInsertId();
        return($id);
    }

    // ----------------------------------------------------------------------------

    function inscription_insert_hobbies_one ($hobby)
    {
        $bdd = bdd();
        // INSCRIPTION HOBBY
        $inscription = $bdd->prepare(
                                    'INSERT INTO hobbies (hobby)
                                    VALUES (?);
                                    ');
        $inscription->execute(array($hobby));
    }

    // ----------------------------------------------------------------------------

    function inscription_insert_hobbies_two ($user_id, $id_hobby)
    {
        $bdd = bdd();
        // INSCRIPTION HOBBY TABLE INTERMEDIAIRE
        $inscription = $bdd->prepare(
                                    'INSERT INTO hobbies_has_user (user_id, hobbies_id)
                                    VALUES (?, LAST_INSERT_ID());
                                    ');
        $inscription->execute(array($user_id, $id_hobby));
        
    }

    // ----------------------------------------------------------------------------

    function create_topic_INSERT($title, $status, $content, $user_id)
    {
        $bdd = bdd();
        // INSCRIPTION
        $creer_sujet = $bdd->prepare(
            'INSERT INTO subject (title, date_posted, content, status, user_id)
            VALUES (?, NOW(), ?, ?, ?);
            ');
        $creer_sujet->execute(array($title, $content, $status, $user_id));
    }

    // ----------------------------------------------------------------------------

    function write_topic_INSERT($new_message, $autor_id, $subject_id)
    {
        $bdd = bdd();
        // INSCRIPTION
        $creer_sujet = $bdd->prepare(
            'INSERT INTO message (date, content_message, autor_id, subject_id)
            VALUES (NOW(), ?, ?, ?);
            ');
        $creer_sujet->execute( array( $new_message, intval($autor_id), intval($subject_id) ) );
    }

    // ----------------------------------------------------------------------------

    function new_passed_INSERT($user_id, $deck_id)
    {
        // INSERT LE NOUVEAU DECK CREE
        $bdd = bdd();
        $req = $bdd->prepare('  INSERT INTO passed (date_passed, number_game, score_user, user_id, deck_id)
                                VALUES (NULL, NULL, NULL, ?, ?);
                            ');
        $req-> execute(array(intval($user_id), intval($deck_id) ));
    }

    //--------------------------------------------------------------------------------

    function new_deck_INSERT($name, $description, $autor_id, $picture, $categorie_id)
    {
        // INSERT LE NOUVEAU DECK CREE
        $bdd = bdd();
        $req = $bdd->prepare('  INSERT INTO deck (name, description, autor_id, status, picture, date_creation, categorie_id)
                                VALUES (?, ?, ?, "privated", ?, NOW(), ?);
                            ');
        $req-> execute(array($name, $description, intval($autor_id), $picture, intval($categorie_id)));
    }
      
    //--------------------------------------------------------------------------------

    function new_question_INSERT($question_cards, $deck_id)
    {
        $bdd = bdd();
        $req = $bdd->prepare(
            'INSERT INTO recto (question_cards, deck_id)
             VALUES (?, ?);
            ');
        $req->execute(array($question_cards, intval($deck_id)));
    }

    //--------------------------------------------------------------------------------

    function new_answer_INSERT($answer_cards, $recto_id)
    {
        $bdd = bdd();
        $req = $bdd->prepare(
            'INSERT INTO verso (answer_cards, statut_cards, recto_id)
             VALUES (?, ?, ?);
            ');
        $req->execute(array($answer_cards, 'T', $recto_id));
    }

    //--------------------------------------------------------------------------------

    function succes_rate_INSERT($verso_id)
    {
        $bdd = bdd();
        $req = $bdd->prepare(
            'INSERT INTO succes_rate (level_cards, chain, played_cards, nb_succes, verso_id)
             VALUES (0, 0, NULL, 0, ?);
            ');
        $req->execute(array(intval($verso_id)));
    }

    //--------------------------------------------------------------------------------

    function newrdv_INSERT($a,$b,$c,$d,$pat)
    {
        $bdd = bdd();

        $query = " INSERT INTO `fiche_consult`(`id`, `resume`, `protocole`, `place`, `type`, `pathologie`, `resultat`) VALUES (NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
        
        $query_params = array();
        
        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        unset($query);
        unset($query_params);
       


        $idfiche = $bdd -> lastInsertId();

        $query = "INSERT INTO `rdv`(`id`, `date`, `time`, `patient_id`, `fiche_consult_id`, `description`) VALUES (NULL, :dt, :tm, :pat, :fich ,:de);";
        
        $query_params = array(
            ':dt' => $a,
            ':tm' => $b,
            ':de' => $c,
            ':fich' => $idfiche,
            ':pat' => $pat
            );
        
        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        
        unset($query);
        unset($query_params);
        
        $idrdv = $bdd -> lastInsertId();

        $query = "INSERT INTO `user_has_rdv`(`id`, `user_id`, `rdv_id`) VALUES (NULL,:id,:rdv);";
        
        $query_params = array(
            ':id' => $d,
            ':rdv' => $idrdv
            );
        
        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

        //------------------------------------------------

        function newpatient_INSERT($name,$prenom,$adress,$codepost,$mail,$birth,$tel,$statut,$id_resp) {

            $bdd = bdd();
            
            echo $id_resp;
            $query = "INSERT INTO `patient`(`id`, `name`, `prenom`, `adresse`, `code_postal`, `mail`, `datebirth`, `tel`, `statut`, `responsable_id`) 
            VALUES (NULL, :name, :prenom,:adress,:codepost,:mail,:birth,:tel,:statut,:id_resp)
            ;";
            
            $query_params = array(
                ':name' => $name,
                ':prenom' => $prenom,
                ':adress' => $adress,
                ':codepost' => $codepost,
                ':mail' => $mail,
                ':birth' => $birth,
                ':tel' => $tel,
                ':statut' => $statut,
                ':id_resp' => $id_resp
                );
            
            try {
                $stmt = $bdd->prepare($query);
                $stmt->execute($query_params);
            } catch(Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        }

        function new_representant_INSERT($name,$prenom,$adress,$codepost,$mail, $tel,$modevie,$alimentation) {

            $bdd = bdd();
            $query = "INSERT INTO `responsable`(`id`, `nom`, `prenom`, `numero`, `mail`, `adresse`, `code_postal` , `modevie` , `alimentation`) 
            VALUES (NULL,:name,:prenom,:tel,:mail,:adress,:codepost,:modevie,:alimentation)
            ;";
            
            $query_params = array(
                ':name' => htmlspecialchars($name),
                ':prenom' => htmlspecialchars($prenom),
                ':adress' => htmlspecialchars($adress),
                ':codepost' => htmlspecialchars($codepost),
                ':mail' => htmlspecialchars($mail),
                ':tel' => htmlspecialchars($tel),
                ':modevie' => htmlspecialchars($modevie),
                ':alimentation' => htmlspecialchars($alimentation)
                );
            
            try {
                $stmt = $bdd->prepare($query);
                $stmt->execute($query_params);
            } catch(Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

            $id_resp =  $bdd -> lastInsertId();
            return($id_resp);
        }

        function metier_INSERT($metier, $id)
        {
            $bdd = bdd();
            
            $query = "INSERT INTO `specialite_has_user`(`id`, `specialite_id`, `user_id`) VALUES (NULL,:spe,:id)
            ;";
            
            $query_params = array(
                ':spe' => $metier,
                ':id' => $id
                );
            
            try {
                $stmt = $bdd->prepare($query);
                $stmt->execute($query_params);
            } catch(Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
          
        }

        function picture_INSERT($pict, $id)
        {
            $bdd = bdd();
            
            $query = "INSERT INTO `photo`(`id`, `photo`, `fiche_consult_id`) VALUES (NULL,:picture,:id)
            ;";
            
            $query_params = array(
                ':picture' => $pict,
                ':id' => $id
                );
            
            try {
                $stmt = $bdd->prepare($query);
                $stmt->execute($query_params);
            } catch(Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
          
        }

        

    
?>