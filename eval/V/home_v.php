<?php $title='Accueil';  ?>
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
if (isset($_SESSION['successmodif'])) {
    ?>
        <div class="well" style="font-size: 18px;color:green">Votre modification a bien été enregistrée</div>
    <?php
    unset($_SESSION['successmodif']);
}

$current = date('Y-m-d');
$arrayrdv = checkrdv2_SELECT($_SESSION['id'], $current);
?>
</div>



<?php

if (isset($arrayrdv['0'])) {
   //var_dump($arrayrdv);
   $x = 0;

   foreach ($arrayrdv as $key => $value) {

       if ($x > 0 && $arrayrdv[$key-1]['date'] === $value['date']) {
           
               ?>

               <br><b>- <?php echo $value['time']; ?></b><br> &nbsp &nbsp &nbsp
                   <?php
                   if ($value['description'] !== NULL) {
                       echo $value['description']."<br> &nbsp &nbsp &nbsp"; 
                   } 
                   echo "<b>AVEC</b> : ".$value['name']." ".$value['prenom'];
                   
                   ?>
                   <div style='text-align: right'>
                   La fiche : <a href='index.php?page=fiche&num=<?php echo $value['fiche_consult_id'];?>'><img src='./V/img/clipboard.png' style='width:40px;height:40px'/></a>
                   </div>
               <?php
           
           
           
       } else {
           if ($x > 0) {
               echo "      </p>
                       </div>
                   </div>
               </div>";
           }
           
           if ($x % 3 === 0) {

               if ($x !== 0) {
                   echo "</div><br>";
               }
               ?>
               <div class="row">
               <?php
           }
           ?>
           <div class="col-sm-6">
               <div class="card">
                   <h5 class="card-header" style="color: black"><?php echo date("j M, Y", strtotime($value['date'])); ?></h5>
                       <div class="card-body" style="color: black">
                           <p class="card-text" style='color: black'>
                               <b>- <?php echo $value['time']; ?></b><br> &nbsp &nbsp &nbsp
                               <?php 
                               if ($value['description'] !== NULL) {
                                   echo $value['description']."<br> &nbsp &nbsp &nbsp"; 
                               } 
                               echo "<b>AVEC</b> : ".$value['name']." ".$value['prenom'];
                               ?>
                               <div style='text-align: right'>La fiche :<a href='index.php?page=fiche&num=<?php echo $value['fiche_consult_id'];?>'><img src='./V/img/clipboard.png' style='width:40px;height:40px'/></a></div>
           <?php
           $x++;
       }
   }
   echo "              </p>
                   
               </div>
           </div>";
   echo"</div>";

}
?>
<div class="col-sm-<?php
if (isset($arrayrdv['0'])) {
  echo "6";
} else {
   echo "12";
}?>
">
   <div class="card">
      <h5 class="card-header" style="color: black;text-align:center">Accueil</h5>
         <div class="card-body" style="color: black">
            <p class="card-text" style='color: black'>
                  Bienvenue <?php echo $_SESSION['username']; ?><br>
                  <?php 
                  if (isset($arrayrdv['0'])) {
                     ?>
                     Voici vos rendez-vous pour la journée :)
                     <?php
                  } else {
                     echo "Vous n'avez pas de rendez-vous aujourd'hui :)";
                  }
                  ?>
               </p>
            </div>
      </div>
   </div>
</div>

<?php $content = ob_get_clean(); ?>