<?php
    // ----------------------------------------------------------------------------

    function connection_SELECT($username)
    {
        $bdd = bdd();
        $pseudo = $bdd->prepare('SELECT *
                                FROM user
                                WHERE username = ?;
                                ');
        $pseudo->execute(array($username));
        $resultat = $pseudo->fetch();
        return $resultat;
    }

    //--------------------------------------------------------------------------------
    function password_SELECT($id)
    {
        $bdd = bdd();
        $req = $bdd->prepare(' SELECT password
                                FROM user
                                WHERE id = ?
                                LIMIT 1;
                            ');
        $req->execute(array($id));
        $donnees = $req->fetch();
        return $donnees;
    }  

  

    function checkrdv_SELECT($a,$b,$c)
    {
        $bdd = bdd();
        $query = " SELECT * FROM `rdv` JOIN user_has_rdv ON user_has_rdv.rdv_id = rdv.id AND user_has_rdv.user_id = :id AND rdv.time = :hour AND rdv.date = :dt;";
        
        $query_params = array(
            ':id' => $a,
            ':hour' => $b,
            ':dt' => $c
            );
        
        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $qu;
    }

    
    //--------------------------------------------------------------------------------

    function checkrdv2_SELECT($a,$b)
    {
        $bdd = bdd();
        $query = " SELECT * FROM `rdv` 
        JOIN user_has_rdv ON user_has_rdv.rdv_id = rdv.id AND user_has_rdv.user_id = :id AND rdv.date = :dt
        JOIN patient ON patient.id = rdv.patient_id
        ORDER BY rdv.date, rdv.time;";
        
        $query_params = array(
            ':id' => $a,
            ':dt' => $b
            );
        
        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $qu;
    }

//--------------------------------------------------------------------------------
   

    function actualDate()
	{
        $bdd = bdd();
		$query = 
			"SELECT 
			DAYNAME(CURRENT_TIMESTAMP()), 
			DAY(CURRENT_TIMESTAMP()), 
			MONTHNAME(CURRENT_TIMESTAMP()), 
			YEAR(CURRENT_TIMESTAMP())";
			try {
				$stmt = $bdd->prepare($query);
				$stmt->execute(Null);
			}catch(PDOException $ex){   
				die("Failed to run query: " . $ex->getMessage());
			}
			$dtttt = $stmt -> fetchAll();
			
			function pregu_replacu($dtttt)
			{
				$pattern = array(array("/^l/","/^j/","/^f/","/^m/","/^a/","/^s/","/^o/","/^n/","/^d/","/^v/"),array("L","J","F","M","A","S","O","N","D","V"));
				$dtttt[0]['MONTHNAME(CURRENT_TIMESTAMP())'] = preg_replace($pattern[0],$pattern[1],$dtttt[0]['MONTHNAME(CURRENT_TIMESTAMP())']);
				$dtttt[0]['DAYNAME(CURRENT_TIMESTAMP())'] =  preg_replace($pattern[0], $pattern[1], $dtttt[0]['DAYNAME(CURRENT_TIMESTAMP())']); 
				return $dtttt;
			}
			$dtttt = pregu_replacu($dtttt);
			$actual_date = implode(" ",$dtttt[0]);
            unset($dtttt,$pattern,$stmt,$bdd);
            var_dump($actual_date);
			return $actual_date;
    }

    //--------------------------------------------------------------------------------

    function voirrdv_SELECT($a)
    {
        $bdd = bdd();
        $query = "SELECT * FROM `rdv` 
        JOIN user_has_rdv ON user_has_rdv.rdv_id = rdv.id AND user_has_rdv.user_id = :id 
        AND rdv.date >= CURRENT_DATE 
        JOIN patient ON patient.id = rdv.patient_id
        ORDER BY rdv.date, rdv.time;";
        
        $query_params = array(
            ':id' => $a
            );
        
        try {
            $stmt = $bdd->prepare($query);
            $stmt->execute($query_params);
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $qu;
    }
    
     //--------------------------------------------------------------------------------

     function responsable_SELECT()
     {
         $bdd = bdd();
         $query = "SELECT * FROM `responsable`;";
         
         $query_params = array(
             );
         
         try {
             $stmt = $bdd->prepare($query);
             $stmt->execute($query_params);
         } catch(Exception $e) {
             die('Erreur : ' . $e->getMessage());
         }
         $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $qu;
     }


      //--------------------------------------------------------------------------------

     function patient_SELECT()
     {
         $bdd = bdd();
         $query = "SELECT * FROM `patient`;";
         
         $query_params = array(
             );
         
         try {
             $stmt = $bdd->prepare($query);
             $stmt->execute($query_params);
         } catch(Exception $e) {
             die('Erreur : ' . $e->getMessage());
         }
         $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $qu;
     }

     //--------------------------------------------------------------------------------

     function metier_SELECT()
     {
         $bdd = bdd();
         $query = "SELECT * FROM `specialite`;";
         
         $query_params = array(
             );
         
         try {
             $stmt = $bdd->prepare($query);
             $stmt->execute($query_params);
         } catch(Exception $e) {
             die('Erreur : ' . $e->getMessage());
         }
         $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $qu;
     }

      //--------------------------------------------------------------------------------

      function patient2_SELECT($idpatient)
      {
          $bdd = bdd();
          $query = "SELECT 
          patient.name,
          patient.id AS idp,
          patient.prenom AS pprenom,
          patient.adresse AS padresse,
          patient.mail AS pmail,
          patient.datebirth AS pdatebirth,
          patient.tel AS ptel,
          patient.statut AS pstatut,
          patient.code_postal AS ppostale,
          responsable.code_postal AS rpostale,
          responsable.adresse AS radresse,
          responsable.nom AS rnom,
          responsable.prenom AS rprenom,
          responsable.modevie,
          responsable.alimentation,
          responsable.numero AS rtel
          FROM `patient` 
          JOIN responsable ON responsable.id = patient.responsable_id AND patient.id = :id";
          
          $query_params = array(
              ':id' => $idpatient
              );
          
          try {
              $stmt = $bdd->prepare($query);
              $stmt->execute($query_params);
          } catch(Exception $e) {
              die('Erreur : ' . $e->getMessage());
          }
          $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $qu;
      }


//--------------------------------------------------------------------------------

function ficheconsult_SELECT($idpatient)
{
    $bdd = bdd();
    $query = "SELECT fiche_consult.id, rdv.date
    FROM `patient` 
    JOIN rdv ON rdv.patient_id = patient.id AND patient.id = :id
    JOIN fiche_consult ON fiche_consult.id = rdv.fiche_consult_id;";
    
    $query_params = array(
        ':id' => $idpatient
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

//--------------------------------------------------------------------------------

function fiche_SELECT($id)
{
    $bdd = bdd();
    $query = "SELECT *
    FROM fiche_consult 
    JOIN rdv ON rdv.fiche_consult_id = fiche_consult.id AND fiche_consult.id = :id 
    JOIN patient ON rdv.patient_id = patient.id
    ;";
    
    $query_params = array(
        ':id' => $id
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}


function checkmodifrdv_SELECT($id,$dat,$tim)
{
    $bdd = bdd();
    $query = "SELECT * FROM `rdv` WHERE date = :dat AND time = :tim AND id NOT LIKE :id
    ;";
    
    $query_params = array(
        ':id' => $id,
        ':tim' => $tim,
        ':dat' => $dat
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

function picture_SELECT($id)
{
    $bdd = bdd();
    $query = "SELECT * FROM `photo` WHERE fiche_consult_id = :id
    ;";
    
    $query_params = array(
        ':id' => $id
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

function pictureprofile_SELECT($id)
{
    $bdd = bdd();
    $query = "SELECT photo.photo
    FROM patient 
    JOIN rdv ON patient.id = rdv.patient_id AND patient_id = :id
    JOIN fiche_consult ON rdv.fiche_consult_id = fiche_consult.id
    JOIN photo ON photo.fiche_consult_id = fiche_consult.id
    
    ;";
    
    $query_params = array(
        ':id' => $id
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

function ficheconsultodel_SELECT($id)
{
    $bdd = bdd();
    $query = "SELECT fiche_consult_id FROM rdv WHERE patient_id = :id
    ;";
    
    $query_params = array(
        ':id' => $id
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

function phototodel_SELECT($id)
{
    $bdd = bdd();
    $query = "SELECT id FROM `photo` WHERE `fiche_consult_id` = :id
    ;";
    
    $query_params = array(
        ':id' => $id
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

function voiroldrdv_SELECT($a)
{
    $bdd = bdd();
    $query = "SELECT * FROM `rdv` 
    JOIN user_has_rdv ON user_has_rdv.rdv_id = rdv.id AND user_has_rdv.user_id = :id 
    AND rdv.date <= CURRENT_DATE 
    JOIN patient ON patient.id = rdv.patient_id
    ORDER BY rdv.date, rdv.time;";
    
    $query_params = array(
        ':id' => $a
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

function recherchetel_SELECT($a)
{
    $bdd = bdd();
    $query = "SELECT * FROM `patient` WHERE tel LIKE :tel;";
    
    $query_params = array(
        ':tel' => $a
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}


function recherchename_SELECT($a)
{
    $bdd = bdd();
    $query = "SELECT * FROM `patient` WHERE name LIKE :name OR prenom LIKE :name;";
    
    $query_params = array(
        ':name' => $a
        );
    
    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $qu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qu;
}

?>

