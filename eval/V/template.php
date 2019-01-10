<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" id="compiled.css-css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-4.6.0.min.css?ver=4.6.0" type="text/css" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    --><link href="./V/css/footer.css" rel="stylesheet">
    
    <title>Eval</title>
  </head>
  <body style="background-color:#333333" onload="startTime()">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="?">
    <img src="./V/img/logo.png" width="60" height="60" class="d-inline-block align-middle" alt=""> MyEval</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active" >
        <a class="nav-link" style ="border-radius: 25%" href="index.php?page=home">Accueil <span class="sr-only">(current)</span></a>
      </li> &nbsp&nbsp&nbsp
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Patient
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=patient&action=voir">Les patients</a>
          <a class="dropdown-item" href="index.php?page=patient&action=new">Nouveau patient</a>
        </div>
      </li>
      &nbsp&nbsp&nbsp
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=calendar">Calendrier</a>
      </li> &nbsp&nbsp&nbsp
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Agenda
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=rdv&action=voir">Voir rdv</a>
          <a class="dropdown-item" href="index.php?page=rdv&action=new">Prendre rdv</a>
          <a class="dropdown-item" href="index.php?page=rdv&action=modify">Modifier rdv</a>
          <a class="dropdown-item" href="index.php?page=rdv&action=old">Ancien rdv</a>
        </div>
      </li>
    </ul>
    <div class="col-sm-4"></div>
    <div class="col-sm-1">
    <iframe src="https://open.spotify.com/embed/track/49y78l709VxMkIcq7jUJKN" width="80" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
    </div>
    <div class="col-sm-1">
    <img src=<?php echo $_SESSION['picture']; ?> width="69px" height="69px" class="d-inline-block align-middle" style="float: right;border-radius: 25%" alt="">
    </div>
    <div class="col-sm-2" style="float: left">
    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style ="padding=0px">
    <?php echo $_SESSION['username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=profile&menu=username">Changer pseudo</a>
          <a class="dropdown-item" href="index.php?page=profile&menu=password">Changer mdp</a>
          <a class="dropdown-item" href="index.php?page=profile&menu=picture">Changer image profile</a>
          <a class="dropdown-item" href="index.php?page=profile&menu=horaires">Horaires</a>
          <a class="dropdown-item" href="index.php?page=profile&menu=dc">Deconnexion</a>
    </div>
  </div>
</nav>
<br><br>
<div class="container main-container" style='color: white'>
        <div class="span8 blog">
                <?php 
                  //var_dump($_SESSION);
                  if (isset($content)) {
                    echo $content; 
                  } 
                ?>

        </div>
  </div><br><br><br>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    <script>
    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('horloge').innerHTML =
      h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
      if (i < 10) {i = "0" + i};  
      return i;
    }
</script>
    <!-- Footer -->
  <footer class="footer">
      <div class="container" style="margin: -20px auto;">
        <span ><center><div id="horloge">Copyright le temps de l'eval</div></center></span>
      </div>
    </footer>
  </body>
</html>