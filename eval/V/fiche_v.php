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

<div class="well" style="color: black">

    <form enctype="multipart/form-data" action='' method='POST'>
        <h2>FICHE DE CONSULTATION DU <?php echo $fiche['0']['date']; ?></h2><br>
        <h5>Client : <i><?php echo $fiche['0']['prenom']." "; echo $fiche['0']['name'];?></i></h5><br>
        <b> - Resume : </b><br> 
        <textarea name="resume" rows="3" cols="145"><?php
        if ($fiche['0']['resume'] !== NULL) {
            echo $fiche['0']['resume'];
        } 
        ?></textarea><br><br>
        <b> - Protocole : </b><br>
        <textarea name="protocole" rows="3" cols="145"> <?php 
        if ($fiche['0']['protocole'] !== NULL) {
            echo $fiche['0']['protocole'];
        } 
        ?></textarea><br><br>
        <b> - Pathologie : </b><br> 
        <textarea name="pathologie" rows="3" cols="145"><?php 
        if ($fiche['0']['pathologie'] !== NULL) {
            echo $fiche['0']['pathologie'];
        } 
        ?></textarea><br><br>
        <b> - Type de consultation : </b><br>
        <textarea name="type" rows="3" cols="145"> <?php 
        if ($fiche['0']['type'] !== NULL) {
            echo $fiche['0']['type'];
        } 
        ?></textarea><br><br>
        <b> - Endroit : </b><br> 
        <textarea name="place" rows="3" cols="145"> <?php 
        if ($fiche['0']['place'] !== NULL) {
            echo $fiche['0']['place'];
        } 
        ?></textarea><br><br>
        <b> - Resultat : </b><br><textarea name="resultat" rows="3" cols="145"> <?php 
        if ($fiche['0']['resultat'] !== NULL) {
            echo $fiche['0']['resultat']; 
        } 
        ?></textarea><br><br>
        <b> - Ajouter image(jpg/jpeg/png) : </b><br>
        <?php
        if (isset($pictures['0'])) {
            echo "<center>";
            foreach ($pictures as $key => $value) {
                echo "<img src='./V/img/userimg/".$value['photo']."' width='90px' height='90px'> &nbsp&nbsp";
            }
            echo "</center><br>";
        }
        ?>
        <input type='file' name='picture'><br><br>
        <div class="form-group">
            <input type="submit" class="btn btn-block btn-primary space-bottom" name="fichconfirm" value="Valider" />
        </div>
    </form>
</div>





<?php $content = ob_get_clean(); ?>