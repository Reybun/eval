<?php $title = 'Incription'; ?>
<?php ob_start(); ?>
<html>

<head>
    <meta charset="utf-8"/>
    <!-- Le script du head -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="./V/css/connectio.css" rel="stylesheet" type="text/css" />
</head>

<body>  
<div class="background">
<div class="page-container">
    

        <form action="index.php?page=inscription" method="POST" class="form-signin">
       <!-- <div id="erreur">
    <p>Vous n'avez pas rempli correctement les champs du formulaire !</p>
</div> -->

    <label class="label" for="email" style="color: black">Username</label><input type="text" name="username" id="username" placeholder="Pseudo"
    title="L\'username doit faire entre 3 et 25 caractères" /><br><br>
    <label class="label" for="password" style="color: black">Mot de passe</label><input type="password" name="password" id="password" placeholder="Mot de passe" 
    title="Le mot de passe doit contenir : 3 caractères minimum"/><br><br>
    <label class="label" for="email" style="color: black">Email</label><input type="text" name="email" id="mail" style='color: black' placeholder="E-mail"/><br><br>
    <label class="label" for="name" style="color: black">Metier</label>
    <select name='metier' class="form-control"  required style="">
    <?php
    foreach ($metier as $key => $value) {
        echo "<option value=".$value['id'].">".$value['nom']."</option>";
    }
    ?>
    <select>
    <input type="submit" id="envoi" class="form-signin" value="Inscription"/> 
</form>

<script>
// Contrôle du courriel en fin de saisie
//CONTROLE MAIL
document.getElementById("email").addEventListener("input", function (e) {
    var validiteCourriel = "";
    var couleurMsg = "red";
    if (e.target.value.indexOf("@" && ".") === -1) {
        // Le courriel saisi ne contient pas le caractère @
        validiteCourriel = "Adresse invalide";
    } else {
      validiteCourriel = "Adresse valide";
      var couleurMsg = "green"; 
    }
    var aideCourrielElt = document.getElementById("aideCourriel");
    document.getElementById("aideCourriel").textContent = validiteCourriel;
    aideCourrielElt.style.color = couleurMsg;
});
</script>

        <!-- Bouton de retour à l'écran d'accueil -->
<form action='index.php?page=home' method='POST'>
    <button type="submit" value="Retour à l'écran de connexion" >Retour à l'écran de connexion</button>
</form>



 </div>    
 
<?php $content = ob_get_clean(); ?>
<?php require(dirname(__FILE__).'/template_inscription.php'); ?>
