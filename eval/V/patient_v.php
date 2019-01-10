<?php ob_start(); ?>
<style>
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}
</style>
<?php

if (isset($email_error)) alert($email_error);

if ($_GET['action'] === 'new') {
   if (!isset($_SESSION['ref'])) {
      ?>
      <div class="well" style="color: black">
         <form action='' method="POST" >                 
               <fieldset class="well" >
                  <div class="form-group">
                     <label class="label" for="name" style='margin-top:5px'>Email</label>
                     <input type="email" class="form-control space-bottom" autofocus name="email" placeholder="Email" 
                     pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required 
                     value="<?php if(isset($error)){ echo $email; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Prénom</label>
                     <input type="text" class="form-control space-bottom" name="first_name" placeholder="Prénom" required 
                     value="<?php if(isset($error)){ echo $first_name; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Nom</label>
                     <input type="text" class="form-control space-bottom" name="last_name" placeholder="Nom" required 
                     value="<?php if(isset($error)){ echo $last_name; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Date naissance</label>
                     <input type="date" onclick="datepicker_app()" placeholder="JJ/MM/AAAA" class="form-control space-bottom" name="date" max=<?php echo $currentdt; ?> required 
                     value="<?php if(isset($error)){ echo $date; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Adresse</label>
                     <input type="text" class="form-control space-bottom" name="address" placeholder="Adresse" required 
                     value="<?php if(isset($error)){ echo $address; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Code Postal</label>
                     <input type="text" class="form-control space-bottom" name="postal_code" placeholder="Code Postal" 
                     pattern=".{2,5}" title="Entrez un code postal valide" required 
                     value="<?php if(isset($error)){ echo $postal_code; } ?>"/>
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Ville</label>
                     <input type="text" class="form-control space-bottom" name="city" placeholder="Ville" required 
                     value="<?php if(isset($error)){ echo $city; }?>"/>
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Téléphone</label>
                     <input type="tel" class="form-control space-bottom" name="phone_number" 
                     placeholder="Numéro de téléphone" minlength="10" maxlength="12" 
                     pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$"
                     title="Entrez un numéro de téléphone valide" required 
                     value="<?php if(isset($error)){ echo $phone_number; } ?>" />
                  </div>
                  <div class="form-group">
                     <label>Statut</label>
                     <div class="form-group" style = "text-align:center">

                        <label class="radio-inline">
                           <input type="radio" name="statu" value="humain" style = "opacity: 1;position: relative" required>Humain
                        </label> 
                  
                        <label class="radio-inline">
                           <input type="radio" name="statu" value="animal" style = "opacity: 1;position: relative" required>Animal
                        </label>
                        
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Référant</label>
                     <div class="form-group" style = "text-align:center">

                        <label class="radio-inline">
                           <input type="radio" name="ref" value="new" style = "opacity: 1;position: relative" required>Nouveau
                        </label> 
                  
                        <label class="radio-inline">
                           <input type="radio" name="ref" value="exist" style = "opacity: 1;position: relative" required>Existant
                        </label>
                        
                     </div>
                     </div>
                  <div class="form-group">
                     <input type="submit" class="btn btn-block btn-primary space-bottom" name="register" value="Valider" />
                  </div>
               </fieldset>
         </form>
      </div>
      <?php
   } else if (isset($_SESSION['ref']) && $_SESSION['ref'] === 'new') {
      ?>
      <div class="well" style="color: black">
         <form action='' method="POST" >                 
               <fieldset class="well" >
                  <div class="form-group">
                     <label class="label" for="name" style='margin-top:5px'>Email</label>
                     <input type="email" class="form-control space-bottom" autofocus name="remail" placeholder="Laissez vide si pareil que patient" 
                     pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                     value="<?php if(isset($error)){ echo $email; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Prénom</label>
                     <input type="text" class="form-control space-bottom" name="rfirst_name" placeholder="Laissez vide si pareil que patient" 
                     value="<?php if(isset($error)){ echo $first_name; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Nom</label>
                     <input type="text" class="form-control space-bottom" name="rlast_name" placeholder="Laissez vide si pareil que patient" 
                     value="<?php if(isset($error)){ echo $last_name; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Adresse</label>
                     <input type="text" class="form-control space-bottom" name="raddress" placeholder="Laissez vide si pareil que patient" 
                     value="<?php if(isset($error)){ echo $address; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Code Postal</label>
                     <input type="text" class="form-control space-bottom" name="rpostal_code" placeholder="Laissez vide si pareil que patient" 
                     pattern=".{2,5}" title="Entrez un code postal valide"
                     value="<?php if(isset($error)){ echo $postal_code; } ?>"/>
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Ville</label>
                     <input type="text" class="form-control space-bottom" name="rcity" placeholder="Laissez vide si pareil que patient"
                     value="<?php if(isset($error)){ echo $city; }?>"/>
                  </div>
                  <div class="form-group">
                     <label class="label" for="name">Téléphone</label>
                     <input type="tel" class="form-control space-bottom" name="rphone_number" 
                     placeholder="Laissez vide si pareil que patient" minlength="10" maxlength="12" 
                     pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$"
                     title="Entrez un numéro de téléphone valide" 
                     value="<?php if(isset($error)){ echo $phone_number; } ?>" />
                  </div>
                  <div class="form-group"> Mode de vie<br>
                     <textarea name="modevie" rows="3" cols="120"></textarea>
                  </div>
                  <div class="form-group"> Alimentation<br>
                     <textarea name="alimentation" rows="3" cols="120"></textarea>
                  </div>
                  <div class="form-group">
                     <input type="submit" class="btn btn-block btn-primary space-bottom" name="register" value="Valider" />
                  </div>
               </fieldset>
         </form>
      </div>

      <?php
   } else if (isset($_SESSION['ref']) && $_SESSION['ref'] === 'exist') {
      ?>
      <div class="well" style="color: black">
         <form action='' method='POST'>
         <div class="form-group">
         <label class="label" for="name">Le representant</label>
            <select name='respons' class="form-control"  required style="">

            <?php
            foreach ($listrespon as $key => $value) {
               echo "<option value=".$value['id'].">".$value['nom']." ".$value['prenom']."</option>";
            }
            ?>
            <select>
            </div>
            <br>
            <div class="form-group">
               <input type="submit" class="btn btn-block btn-primary space-bottom" value="Valider" />
            </div>

         </form>
      </div>
      <?php
   }
}
else if ($_GET['action'] === 'voir'){
   if (isset($_POST['idfiche'])) {
      ?>
      <div class="well" style="color: black">
      <h2>FICHE DE CONSULTATION DU <?php echo $fiche['0']['date']; ?></h2><br>
      <h5>Client : <i><?php echo $fiche['0']['prenom']." "; echo $fiche['0']['name'];?></i></h5><br>
         <b> - Resume : </b><br> <?php 
         if ($fiche['0']['resume'] === NULL) {
            echo "<i> Il n'y a pas encore de resume pour cette fiche. </i>";
         } else {
            echo $fiche['0']['resume'];
         }
         ?><br><br>
         <b> - Protocole : </b><br> <?php 
         if ($fiche['0']['protocole'] === NULL) {
            echo "<i> Il n'y a pas encore de protocole pour cette fiche. </i>";
         } else {
            echo $fiche['0']['protocole'];
         }
         ?><br><br>
         <b> - Pathologie : </b><br> <?php 
         if ($fiche['0']['pathologie'] === NULL) {
            echo "<i> Il n'y a pas encore de pathologie pour cette fiche. </i>";
         } else {
            echo $fiche['0']['pathologie'];
         }
         ?><br><br>
         <b> - Type de consultation : </b><br> <?php 
         if ($fiche['0']['type'] === NULL) {
            echo "<i> Il n'y a pas encore de type pour cette fiche. </i>";
         } else {
            echo $fiche['0']['type'];
         }
         ?><br><br>
         <b> - Endroit : </b><br> <?php 
         if ($fiche['0']['place'] === NULL) {
            echo "<i> Il n'y a pas encore d'endroit pour cette fiche. </i>";
         } else {
            echo $fiche['0']['place'];
         }
         ?><br><br>
         <b> - Resultat : </b><br> <?php 
         if ($fiche['0']['resultat'] === NULL) {
            echo "<i> Il n'y a pas encore de resultat pour cette fiche. </i>";
         } else {
            echo $fiche['0']['resultat'].'<br>'; 
         }
         ?>
         <br><b> - Les images : </b><br><br>
        <?php
        if (isset($pictures['0'])) {
            echo "<center>";
            foreach ($pictures as $key => $value) {
                echo "<img src='./V/img/userimg/".$value['photo']."' width='90px' height='90px'> &nbsp&nbsp";
            }
            echo "</center><br>";
        }
        ?>
      </div>
      <form action="" method="POST">
         <input type="submit" class="btn btn-block btn-primary space-bottom" name="retour" value="Retour" />
      </form>
      <?php

   }
   else if (isset($_POST['patientvoir'])) {
      ?>
      <div class="well" style="color: black">
         <h2>La fiche Patient</h2><br>
         <b> - Nom : </b> <?php echo $patient['0']['name'];?><br>
         <b> - Prenom : </b> <?php echo $patient['0']['pprenom'];?><br>
         <b> - Adresse : </b> <?php echo $patient['0']['padresse']." "; echo $patient['0']['ppostale']?><br>
         <b> - Mail : </b> <?php echo $patient['0']['pmail'];?><br>
         <b> - Date Naissance : </b> <?php echo $patient['0']['pdatebirth'];?><br>
         <b> - Telephone : </b> <?php echo $patient['0']['ptel'];?><br>
         <b> - Statut : </b> <?php echo $patient['0']['pstatut'];?><br>
         <b> - Mode de vie : </b> <?php echo $patient['0']['modevie'];?><br>
         <b> - Alimentation: </b> <?php echo $patient['0']['alimentation'];?><br>
         
         <form action="" method='POST'>
            <input type="hidden" name='idpatient' value="<?php echo $patient['0']['idp'];?>">
            <input type='submit' name='delpatient'  style="float: right" class="btn btn-danger" value="supprimer le patient">
         </form>
         <form action="" method='POST'>
            <input type="hidden" name='idpatmodif' value="<?php echo $patient['0']['idp'];?>">
            <input type='submit' name='modifpatient'  style="float: right" class="btn btn-info" value="modifier sa fiche">
            </form>
         <br>
    

      </div>
      <div class="well" style="color: black">
         <h4>Le representant</h4><br>
         <b> - Nom : </b> <?php echo $patient['0']['rnom'];?><br>
         <b> - Prenom : </b> <?php echo $patient['0']['rprenom'];?><br>
         <b> - Adresse : </b> <?php echo $patient['0']['radresse']." "; echo $patient['0']['rpostale']?><br>
         <b> - Mail : </b> <?php echo $patient['0']['pmail'];?><br>
         <b> - Telephone : </b> <?php echo $patient['0']['rtel'];?><br>
      </div>
      <div class="well" style="color: black">
         <form action='' method='POST'>
            <div class="form-group">
            <label class="label" for="name">Les fiches de consultation</label>
               <select name='idfiche' class="form-control"  required style="">
               <?php
               foreach ($fiche as $key => $value) {
                  echo "<option value=".$value['id'].">".$value['date']."</option>";
               }
               ?>
               <select>
               </div>
               <br>
               <div class="form-group">
                  <input type="hidden" name='patientvoir' value='<?php echo $_POST["patientvoir"]; ?>'>
                  <input type="submit" class="btn btn-block btn-primary space-bottom" value="Consulter la fiche" />
               </div>
         </form>
      </div>
      <?php
        if (isset($pictures['0'])) {
            echo "<div class='well'><center>";
            foreach ($pictures as $key => $value) {
                echo "<img src='./V/img/userimg/".$value['photo']."' width='150px' height='150px'> &nbsp&nbsp";
            }
            echo "</center></div>";
        }
        ?>
      <?php
   }
   else if (isset($_POST['voirallpat'])) {
      
      ?>
      <div class="well" style="color: black">
         <h3>Voici tous les patients</h3><br>
            <?php
            foreach ($listpatient as $key => $value) {
               echo "- ".$value['name']." ".$value['prenom']."<br><br>";
            }
            ?>
      </div>
      <?php  
   }
   else if (isset($tel)) {
      
      ?>
      <div class="well" style="color: black">
         <h3>Voici les résultats de la rechcerhce</h3><br>
            <?php
            if (isset($tel['0'])) {
               foreach ($tel as $key => $value) {
                  echo "- <b>Patient :</b> ".$value['name']." ".$value['prenom']." || <b>Numéro : </b>".$value['tel']." || <b>Mail : </b>".$value['mail']."<form action='' method='POST'><input type='hidden' name='patientvoir' value='".$value['id']."'><input type='submit' class='btn btn-default' value='Voir sa fiche'></form><br><br>";
               }
               
            }
            ?>
      </div>
      <?php  
   }
   else if (isset($_POST['modifpatient'])) {
      ?>
      <div class="well" style="color: black">
         <form action='' method='POST'>
            <h2>FICHE DE <?php echo $fiche['0']['date']; ?></h2><br>
            <b> - Nom : </b><br> 
            <textarea name="name" rows="3" cols="145"><?php
            if ($fiche['0']['name'] !== NULL) {
               echo $fiche['0']['name'];
            } 
            ?></textarea><br><br>
            <b> - Prénom : </b><br>
            <textarea name="prenom" rows="3" cols="145"> <?php 
            if ($fiche['0']['prenom'] !== NULL) {
               echo $fiche['0']['prenom'];
            } 
            ?></textarea><br><br>
            <b> - Adresse : </b><br> 
            <textarea name="adresse" rows="3" cols="145"><?php 
            if ($fiche['0']['adresse'] !== NULL) {
               echo $fiche['0']['adresse'];
            } 
            ?></textarea><br><br>
            <b> - Code Postal : </b><br>
            <textarea name="code_postal" rows="3" cols="145"> <?php 
            if ($fiche['0']['code_postal'] !== NULL) {
               echo $fiche['0']['code_postal'];
            } 
            ?></textarea><br><br>
            <b> - Mail : </b><br> 
            <textarea name="mail" rows="3" cols="145"> <?php 
            if ($fiche['0']['mail'] !== NULL) {
               echo $fiche['0']['mail'];
            } 
            ?></textarea><br><br>
            <b> - Téléphone : </b><br><textarea name="tel" rows="3" cols="145"> <?php 
            if ($fiche['0']['tel'] !== NULL) {
               echo $fiche['0']['tel']; 
            } 
            ?></textarea><br><br>
            <div class="form-group">
               <input type="hidden" name="idpatmodif" value='<?php echo $_POST['idpatmodif'];?>'>
               <input type="hidden" name='modifpatient'>
               <input type="submit" class="btn btn-block btn-primary space-bottom" name="modifpatform" value="Valider" />
            </div>
         </form>
      </div>

      <?php
   }
   else if (!isset($_POST['patientvoir'])) {
      ?>
      <div class="well" style="color: black">
         <form action='' method='POST'>
         <div class="form-group">
         <label class="label" for="name"><b>Choisir le patient à voir</b></label>
            <select name='patientvoir' class="form-control"  required style="">

            <?php
            foreach ($listpatient as $key => $value) {
               echo "<option value=".$value['id'].">".$value['name']." ".$value['prenom']."</option>";
            }
            ?>
            <select>
            </div>
            <br>
            <div class="form-group">
               <input type="submit" class="btn btn-block btn-primary space-bottom" value="Valider" />
            </div>

         </form>
         <form action='' method='POST'>
            <input type="submit" class="btn btn-block btn-primary space-bottom" name='voirallpat' value="Voir tous les patients" />
         </form>
      </div><br>
      <div class="well" style="color: black">
         <form action='' method='POST'>
            <label class="label" for="name"><b>Recherche par numéro téléphone</b></label>
            <input type="tel" class="form-control space-bottom" name="telrech" 
               placeholder="Le numéro de téléphone à rechercher" minlength="10" maxlength="12" 
               pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$"
               title="Entrez un numéro de téléphone valide" required><br>
            <input type="submit" class="btn btn-block btn-primary space-bottom" name='recherchetel' value="Rechercher" />
         </form>
      </div><br>
      <div class="well" style="color: black">
         <form action='' method='POST'>
            <label class="label" for="name"><b>Recherche par nom ou prénom</b></label>
            <input type="text" class="form-control space-bottom" name="namerech" 
               placeholder="Le nom ou prénom à rechercher"
               title="Entrez un nom" required><br>
            <input type="submit" class="btn btn-block btn-primary space-bottom" name='recherchenom' value="Rechercher" />
         </form>
      </div>
      <?php
   }
}

$content = ob_get_clean();
?>