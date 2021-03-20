<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mon profil</title>
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.0/umd/popper.min.js"></script> <!-- attention dep pour bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
</head>

<body class="bg-light">
  
  <?php
  require '../php/config.php';
  global  $database;
  $passedidMed = $_GET['idmed'];
  $enregistrements = $database->select("profil", [
    "id",
    "nom",
    "prenom",
    "datenaissance",
    "email",
    "telephone",
    "mobile",
    "adresse",
    "ville",
    "codepostal"
  ], [
    "id" => $passedidMed
  ]);
  echo "<div id='idmedProfil' value='" . $passedidMed . "'> </div>";
  ?>
  
  <section class="section"></section> <!-- Pour inclure l'image -->

  <!-- ************* NAVBAR ************* -->
  <nav class="navbar navbar-expand-lg navbar-dark menu-bar">
    
    <?php
    $passedidMed = $_GET['idmed'];
    echo '<a class="navbar-brand font-weight-bold" href="../php/mespatients.php?idmed=' . $passedidMed . '"><i class="fas fa-laptop-medical fa-2x"></i></a>';
    ?>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse float-right text-right justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          
          <?php
          $passedidMed = $_GET['idmed'];
          echo '<button type="button" class="btn btn-light" onclick=location.href="../php/mespatients.php?idmed=' . $passedidMed . '"><i class="fas fa-users"></i> <span id="bmespatients">Mes patients</span></button>';
          ?>
          
        </li>
        <li class="nav-item mx-xl-3">
          <a class="button btn btn-outline-light mr-3" href="../php/l.php">
            <i class="fas fa-power-off"></i> <span id="blogout">Se déconnecter</span>
          </a>
        </li>

        <div>
          <a class="navbar-brand translate currentlanguage" id="fr">
            <img src="../images/fr.svg" width="25" class="d-inline-block align-top flag">
          </a>
          <a class="navbar-brand translate" id="en">
            <img src="../images/en.svg" width="25" class="d-inline-block align-top flag">
          </a>
        </div>
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

  <div class="container col-md-5 col-12" id="container">
    <div id="div1">
      <div id="div2">
        <div id="div13" class="shadow bg-white position-relative bloc bloc-formulaire p-4 m-0">
          <div class="tab-content">
            <div class="d-flex justify-content-between">
              <div></div>
              <h2 class="text-center">Mon profil</h2>
              <div>
                <button id="aideprofil" type="button" class="btn btnstyle" data-trigger="focus" tabindex="0" style="cursor:pointer;color:rgb(80,80,80);" data-placement="top" data-toggle="popover" data-html="true" data-original-title="Aide" data-content="Si vous souhaitez modifier les informations de votre profil, cliquez sur le crayon &nbsp; <small><i class='fas fa-pen color-icon'></i></small>">
                  <i class="fa fa-question-circle fa-2x"></i>
                </button>
              </div>
            </div>
            <hr style="color:rgb(200,200,200);width:100%;">
            <div class="text-center" style="height:30px;">
              
              <?php
              if (isset($_GET["edit"])) {
                $passedEdit = $_GET['edit'];
                if ($passedEdit == "S") {
                  echo "<span id='succesmedecinmodifie' style='background-color:white;color:#4C7B45;'><i class='far fa-check-circle'></i> Vos informations personnelles ont été modifiées !</span>";
                  echo "<script>$('#succesmedecinmodifie').delay(10000).hide(0);</script>";
                }
                if ($passedEdit == "E") {
                  echo "<span id='echecmedecinmodifie' style='background-color:white;color:#BE1B0B;'><i class='fas fa-times-circle'></i> Echec de lors de la modification de vos coordonnées</span>";
                  echo "<script>$('#echecmedecinmodifie').delay(10000).hide(0);</script>";
                }
              }
              ?>
              
            </div>
            <div class="col-12 m-auto">

              <div class="card">
                <div class="card-header text-center">
                  <div class="card-title d-flex justify-content-between">
                    <div></div>
                    <h4 class="modal-title">Mes informations</h4>
                    <div>
                      <button type="button" class="btn px-1 bsetprofil" data-toggle="modal" data-target="#m_profil"><i class="fas fa-pen color-icon"></i></button>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3" style="line-height:35px;">

                  <p>
                    <span class="labeldescription">Nom : </span><span id="nomMED"><?php echo $enregistrements[0]["nom"]; ?></span>
                    <span class="labeldescription ml-4">Prénom : </span><span id="prenomMED"><?php echo $enregistrements[0]["prenom"]; ?></span>
                  </p>
                  <p><span class="labeldescription"><i class="far fa-calendar-alt icon-color esp"></i> Date de naissance : </span><span id="datenaissanceMED"><?php echo $enregistrements[0]["datenaissance"]; ?></span></p>
                  <p><span class="labeldescription"><i class="far fa-envelope icon-color esp"></i> Email : </span><span id="emailMED"><?php echo $enregistrements[0]["email"]; ?></span></p>
                  <p><span class="labeldescription"><i class="fas fa-phone-alt icon-color esp"></i> Téléphone :
                    </span><span id="telephoneMED"><?php echo $enregistrements[0]["telephone"]; ?></span>
                  </p>

                  <p><span class="labeldescription"><i class="fas fa-mobile-alt icon-color esp"></i>Mobile :
                    </span><span id="mobileMED"><?php echo $enregistrements[0]["mobile"]; ?></span>
                  </p>
                  <p><span class="labeldescription"><i class="fas fa-map-marker-alt icon-color esp"></i> Adresse du cabinet : </span><span id="adresseMED"><?php echo $enregistrements[0]["adresse"]; ?></span></p>
                  <p>
                    <span class="labeldescription">Ville : </span><span id="villeMED"><?php echo $enregistrements[0]["ville"]; ?></span>
                    <span class="labeldescription ml-4">Code Postal : </span><span id="codepostalMED"><?php echo $enregistrements[0]["codepostal"]; ?></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer-page font-small bg-dark fixed-bottom">
    <div id="cFooterText" class="class-footer text-center text-white text-sm font-weight-light">© 2020 Copyright • Tous droits réservés.</div>
  </footer>

  <!-- Modale ajout des courriels (Private auction) -->
  <div id="m_profil" class="modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;"></div>

  <script src="../js/file.js"></script>
  <script src="../js/langues.js"></script>


</body>

</html>