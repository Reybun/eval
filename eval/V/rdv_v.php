<?php
ob_start();
if ($_GET["action"] === "new") {

    if (isset($_SESSION['hrdv']) && isset($_SESSION['dtrdv']) && isset($alreadyrdv) && !isset($_SESSION['description'])) {
        //var_dump($rdv);
        ?>
        <form method="POST" action="index.php?page=rdv&action=new">
        <div class="form-group">
                Il y a déjà un rdv de prévu à l'heure choisie continuer ?<br>
                <div class="form-group">
                    <input type='submit' class="btn btn-default" name="continueh" value="Continuer">
                    <input type='submit' class="btn btn-default" name="cancelh" value="Annuler">
                </div>
            </div>
        </form> 
        <?php
        
    }

    else if (isset($_SESSION['hrdv']) && isset($_SESSION['dtrdv'])) {
        ?>
        <form method="POST" action="index.php?page=rdv&action=new">
            <div class="form-group">
            <label class="label" for="name">Le patient</label>
            <select name='patient' class="form-control"  required style="">

            <?php
            foreach ($listpatient as $key => $value) {
               echo "<option value=".$value['id'].">".$value['nom']." ".$value['prenom']."</option>";
            }
            ?>
            <select>
            </div>

            <div class="form-group">
            <label>La description du rdv</label><br>
                <div class="form-group">
                    <textarea name="descript" rows="3" cols="80"></textarea><br><br>
                    <input type='submit' class="btn btn-default" value="Continuer">
                    <input type='submit' class="btn btn-default" name="cancelh" value="Annuler">
                </div>
            </div>

        </form> 
        <?php
        
    }
    
    else if (!isset($_SESSION['dtrdv'])) {
        if (isset($errordt)) {
            echo 'La date doit être supérieur à la date actuelle<br>';
        }
        ?>
        <form method="POST" action="index.php?page=rdv&action=new">
            <div class="form-group">
                <label>Choisissez une date</label>
                <div class="form-group">
                    <input type="date" class="form-control" onclick="datepicker_app()" placeholder="JJ/MM/AAAA" min=<?php echo $currentdt; ?> name="dt" required>
                    <input type='submit' class="btn btn-default" value="Confirmer">
                </div>
            </div>
        </form> 
        <?php
    }
    else if (isset($_SESSION['dtrdv'])) {
        if(isset($rdvday['0'])){
            echo "Vos rdv :<br>";
            foreach ($rdvday as $key => $value) {
                echo " - HEURE : ".$value['time']."<br>";
                echo "<b>AVEC</b> : ".$value['name']." ".$value['prenom']."<br>";
                if ($value['description'] !== NULL) {
                    echo "<b>DESCRIPTION </b> :";
                    echo "<br>".$value['description'];
                }
                echo "<br>";
            }
        } else {
            echo "Vous n'avez pas encore de rdv prévu ce jour là.";
        }
        ?>
        <br>
        <form method="POST" action="index.php?page=rdv&action=new">
            
            <span class="input-group-addon">Heure du rdv :</span>
                <input type="number" style="width:60px;max-width:60px" class="form-control" min="00" max="23" value=<?php 
                if (isset($_POST['hour'])) {
                    echo $_POST['hour'];
                }
                else {
                    echo '0';
                }?> step="1" name="hour" required/>
                <span class="input-group-addon" style="border-left: 0; border-right: 0;">h</span>
                <input type="number" style="width:60px;max-width:60px" class="form-control" value=<?php 
                if (isset($_POST['min'])) {
                    echo $_POST['min'];
                }
                else {
                    echo '0';
                }?> 
                min="0" max="30" step="30" name="min" required/>
                <span class="input-group-addon" style="border-left: 0; border-right: 0;">min
                <br><br><br>
                <input type='submit' class="btn btn-default" value="Confirmer">
                <input type='submit' class="btn btn-default" name="backdt" value="Retour choix date">
            </span><br>
        </form> 
        <?php        
    }
}
elseif ($_GET["action"] === "voir" || $_GET["action"] === "old") {
    
        if (isset($arrayrdv['0'])) {
            //var_dump($arrayrdv);
            $x = 0;

            foreach ($arrayrdv as $key => $value) {

                if ($x > 0 && $arrayrdv[$key-1]['date'] === $value['date']) {
                    
                        ?>

                        <br><br><br><b>- <?php echo $value['time']; ?></b><br> &nbsp &nbsp &nbsp
                            <?php
                            if ($value['description'] !== NULL) {
                                echo $value['description']."<br> &nbsp &nbsp &nbsp"; 
                            } 
                            echo "<b>AVEC</b> : ".$value['name']." ".$value['prenom'];
                            
                            ?>
                            <br><br>
                            <div >
                            <?php 
                            if ($_GET["action"] === "voir") {
                                if ($value['time'] < $currenttime && $value['date'] === $currentdt) {
                                } else {
                                    echo "<a style='float: left' href='index.php?page=rdv&action=supp&num=".$value['fiche_consult_id']."'><img src='./V/img/x-button.png' style='width:25px;height:25px'/></a>";
                            }
                            }?>                            
                            <a style="float: right" href='index.php?page=fiche&num=<?php echo $value['fiche_consult_id'];?>'> La fiche : <img src='./V/img/clipboard.png' style='width:40px;height:40px'/></a>
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
                    <div class="col-sm-4">
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
                                        <br><br>
                            <div > 
                            <?php 
                            if ($_GET["action"] === "voir") {
                                if ($value['time'] < $currenttime && $value['date'] === $currentdt) {
                                } else {
                                    echo "<a style='float: left' href='index.php?page=rdv&action=supp&num=".$value['fiche_consult_id']."'><img src='./V/img/x-button.png' style='width:25px;height:25px'/></a>";
                                }
                            }   
                            ?>
                            
                            <a style="float: right" href='index.php?page=fiche&num=<?php echo $value['fiche_consult_id'];?>'> La fiche : <img src='./V/img/clipboard.png' style='width:40px;height:40px'/></a>
                            </div>
                    <?php
                    $x++;
                }
            }
            echo "              </p>
                            </div>
                        </div>
                    </div>";
            echo"</div>";




        } else {
            ?>
            <div class="card">
                <h5 class="card-header" style="color: black">Vous n'avez pas de rdv à afficher</h5>
                <div class="card-body">
                    <a href="index.php?page=rdv&action=new" class="btn btn-primary">En prendre un</a>
                </div>
            </div>
            <?php
        }
        if (isset($_GET['date'])) {
            ?>
            <br>
            <a href="index.php?page=rdv&action=voir" class="btn btn-primary">Voir tous les rdv</a>
            <?php
        }
        ?>
        <?php
} elseif ($_GET["action"] === "modify") {

    
    if (isset($alreadyrdv)) {
        ?>
        <form method="POST" action="">
        <div class="form-group">
                Il y a déjà un rdv de prévu à l'heure choisie continuer ?<br>
                <div class="form-group">
                    <input type='submit' class="btn btn-default" name="continuemodif" value="Continuer">
                    <input type='submit' class="btn btn-default" name="cancelmodif" value="Annuler">
                </div>
            </div>
        </form> 
        <?php
    }

    
    else if (isset($_POST['date'])) {

        if (isset($arrayrdv['0'])) {
            //var_dump($arrayrdv);
            $x = 0;
            var_dump($arrayrdv);
            foreach ($arrayrdv as $key => $value) {

                if ($x > 0 && $arrayrdv[$key-1]['date'] === $value['date']) {
                    
                        ?>

                        <br><b>
                            <form action="" method="POST">
                            - A : <input type="time" name="newhour" step="1800" value=<?php echo $value['time']; ?>></b><br><br>
                            <?php 
                            echo "<b>AVEC</b> : ".$value['name']." ".$value['prenom'];
                            ?><br><br>
                            <textarea name="description" rows="2" cols="40"><?php echo $value['description'];?></textarea>
                            <input type="hidden" name='date' value=<?php echo $value['date'];?>>
                            <input type="hidden" name='idrdv' value=<?php echo $value['rdv_id'];?>><br><br>
                            <center><input type='submit' name='modifrdv' class="btn btn-default" value="Modifier ce rdv"></center></form>
                        
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
                    <div class="col-sm-4">
                        <div class="card">
                            <h5 class="card-header" style="color: black"><?php echo date("j M, Y", strtotime($value['date'])); ?></h5>
                                <div class="card-body" style="color: black">
                                    <p class="card-text">
                                        <form action="" method="POST">
                                        <b>- A : <input type="time" name="newhour" step="1800" value=<?php echo $value['time']; ?>></b><br><br>
                                        <?php 
                                        echo "<b>AVEC</b> : ".$value['name']." ".$value['prenom'];
                                        ?><br><br>
                                        <textarea name="description" rows="2" cols="40"><?php echo $value['description'];?></textarea>
                                        <input type="hidden" name='date' value=<?php echo $value['date'];?>>
                                        <input type="hidden" name='idrdv' value=<?php echo $value['rdv_id'];?>><br><br>
                                        <center><input type='submit' name='modifrdv' class="btn btn-default" value="Modifier ce rdv"></center></form><br>
                        
                    <?php
                    $x++;
                }
            }
            echo "              </p>
                            </div>
                        </div>
                    </div>";
            echo"</div>";
        }
        
    }
    
    else if (!isset($_POST['date'])) {

        if (isset($arrayrdv['0'])) {
            //var_dump($arrayrdv);
            $x = 0;

            foreach ($arrayrdv as $key => $value) {

                if ($x > 0 && $arrayrdv[$key-1]['date'] === $value['date']) {                
                    
                    
                } else {
                    if ($x > 0) {
                        echo "      
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
                    <div class="col-sm-4">
                        <div class="card">
                            <h5 class="card-header" style="color: black">
                                <form action="index.php?page=rdv&action=modify" method ="POST">
                                    <input type="hidden" name='date' value=<?php echo $value['date'];?>>
                                    <input type="submit"  class="btn btn-link" value='<?php echo strval(date("j M, Y", strtotime($value['date']))); ?>'/> 
                                </form>
                            </h5>
                                
                            
                    <?php
                    $x++;
                }
            }
            echo "              
                        </div>
                    </div>";
            echo"</div>";




        } else {
            ?>
            <div class="card">
                <h5 class="card-header" style="color: black">Vous n'avez pas de rdv à afficher</h5>
                <div class="card-body">
                    <a href="index.php?page=rdv&action=new" class="btn btn-primary">En prendre un</a>
                </div>
            </div>
            <?php
        }
        
    }

}
$content = ob_get_clean();
?>