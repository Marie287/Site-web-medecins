<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Se connecter</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/css/bootstrap-slider.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js" integrity="sha256-oj52qvIP5c7N6lZZoh9z3OYacAIOjsROAcZBHUaJMyw=" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
  <section class="section"></section> <!-- Pour inclure l'image -->

  <!-- ************* NAVBAR ************* -->
  <nav class="navbar navbar-expand-lg navbar-dark menu-bar">
    <a class="navbar-brand font-weight-bold" href="#"><i class="fas fa-laptop-medical fa-2x"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse float-right text-right justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <a class="navbar-brand translate" id="fr">
           <img src="../images/fr.svg" width="25" class="d-inline-block align-top flag">
        </a>
        <a class="navbar-brand translate" id="en">
           <img src="../images/en.svg" width="25" class="d-inline-block align-top flag">
        </a>
      </ul>
    </div>
  </nav>
  <!-- ************* NAVBAR ************* -->

  <!-- ************* HEADER ************* -->
  <div class="col-12">
    <br />
    <div class="container text-center">
      <div class="text-light">
        <br />
        <h1 id="grostitre" class="display-4 font-weight-bold text-shadow">Espace médecins</h1>
        <br />
      </div>
    </div>
  </div>
  <!-- ************* HEADER ************* -->

    <div class="container" id="container">
      <div class="bloc-login">
        <div class="shadow bg-white position-relative bloc col-xl-6 col-md-7 col-12 m-auto p-3">
          <div class="tab-content">
            <h1 id="clogintitle" class="text-center text-dark">Se connecter</h1>
            <hr class="mb-0">
            <div class="container col-11">
              <div class="alert text-center m-0" role="alert" style="color:red;height:40px;">
                <?php
                // Fonction qui affiche un message d'erreur si l'identifiant et le mot de passe sont invalides
                if (isset($_GET["login"])) {
                  $passedLogin = $_GET['login'];
                  if ($passedLogin == "F") {
                    echo "<span id='cinvalidMessage'><i class='fas fa-exclamation-circle'></i> <span id='message'>Cet email ou ce mot de passe est invalide.</span></span>";
                    echo "<script>$('#cinvalidMessage').delay(10000).hide(0);</script>";
                  }
                }
                ?>
              </div>
              <br />
              <form method="post" action="../php/validationLogin.php" class=" align-items-center" enctype="multipart/form-data">
                <div class="input-group mb-2 rounded">
                  <div class="input-group-prepend label-absolute">
                    <span id="temail" class="input-group-text" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Entrez votre email ici">
                      <i class="fa fa-user"></i>
                    </span>
                  </div>
                    <input type="email" class="form-control" id="cemail" name="cemail" placeholder="email@exemple.fr" autofocus>
                </div>
                <div class="form-group">
                  <div class="input-group mb-2 rounded">
                    <div class="input-group-prepend label-absolute">
                      <span id="tpassword" class="input-group-text" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Entrez votre mot de passe ici">
                        <i class="fas fa-lock"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Mot de passe">
                  </div>
                </div>
                <br />
                  <div class="text-center col-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="connecter" name="connecter" value="connecter"><span id="bsubmit">Se connecter</span> <i class="fas fa-sign-in-alt"></i></button>
                  </div>
                </form>
                <br />
            </div>
          </div>
        </div>
      </div>
    </div>

  <br /><br />

  <footer class="footer-page font-small bg-dark fixed-bottom">
    <div id="cFooterText" class="class-footer text-center text-white text-sm font-weight-light">© 2020 Copyright • Tous droits réservés.</div>
  </footer>

  <script defer src="../js/l.js"></script>
  <script defer src="../js/langues.js"></script>
</body>

</html>