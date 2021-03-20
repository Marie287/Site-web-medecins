<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mes patients</title>
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

  <script src="../js/file.js"></script>
</head>

<body class="bg-light">

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
          echo '<button type="button" class="btn btn-light mr-4" onclick=location.href="../php/profil.php?idmed=' . $passedidMed . '"><i class="fas fa-user-circle"></i> <span id="bmonprofil">Mon profil</span></button>';
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

  <div class="container col-md-7 col-12" id="container">
    <div id="div1">

      <div id="div2">
        <div id="div13" class="shadow bg-white position-relative bloc bloc-formulaire p-4 m-0" style="height:530px;">
          <div class="tab-content">
            <div class="d-flex justify-content-between">
              <div class="col"></div>
              <h2 id="titremespatients" class="text-center col"> Mes patients</h2>
              <div class="col text-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#m_ajoutpatient"><i class="fas fa-plus"></i> <i class="fas fa-users"></i></button>
                <button id="aidemespatients" type="button" class="btn btnstyle" data-html="true" data-trigger="focus" tabindex="0" style="cursor:pointer;color:rgb(80,80,80);" data-placement="top" data-toggle="popover" data-original-title="Aide" data-content="• Cliquez sur le bouton vert <span class='badge badge-success'><i class='fas fa-plus'></i> <i class='fas fa-users'></i></span> juste à gauche pour ajouter un nouveau patient. 
                <br/>• Dans la liste ci-dessous vous retrouverez tous vos patients. 
                Il vous suffira de cliquer sur une ligne du tableau pour afficher toutes les informations concernant le patient que vous aurez sélectionné. 
                <br/>• Pour une recherche rapide, vous pouvez taper le nom ou le prénom du patient dans la barre de recherche située en haut à droite du tableau. 
                <br/>• Pour afficher la suite de la liste de vos patients, utilisez le système de pagination <span class='badge badge-primary'>Précédent</span> et
                <span class='badge badge-primary'>Suivant</span>.">
                  <i class="fa fa-question-circle fa-2x"></i>
                </button>
              </div>
            </div>
            <hr style="color:rgb(200,200,200);width:100%;">
            <div class="m-auto" style="width:95%;">
              <div class="text-center" style="height:30px;">
                <?php
                require '../php/config.php';

                // Affichage d'un message lorsqu'un patient vient d'être ajouté
                if (isset($_GET["ajout"])) {
                  $passedAjout = $_GET['ajout'];
                  if ($passedAjout == "S") {
                    echo "<span id='succespatientajoute' style='background-color:white;color:#4C7B45;'><i class='far fa-check-circle'></i> Patient ajouté !</span>";
                    echo "<script>$('#succespatientajoute').delay(10000).hide(0);</script>";
                  }
                  if ($passedAjout == "E") {
                    echo "<span id='echecpatientajoute' style='background-color:white;color:#BE1B0B;'><i class='fas fa-times-circle'></i> Echec de lors de l'ajout du patient</span>";
                    echo "<script>$('#echecpatientajoute').delay(10000).hide(0);</script>";
                  }
                }

                // Affichage d'un message lorsqu'un patient vient d'être supprimé + suppression du patient dans la base de données
                global  $database;
                if (isset($_GET["suppr"])) {
                  $passedSuppr = $_GET['suppr'];
                  $database->delete("patients", [
                    "AND" => [
                      "id" => $passedSuppr
                    ]
                  ]);
                  $database->delete("pathologies", [
                    "AND" => [
                      "idpatient" => $passedSuppr
                    ]
                  ]);
                  $database->delete("vaccinations", [
                    "AND" => [
                      "idpatient" => $passedSuppr
                    ]
                  ]);
                  $database->delete("hospitalisations", [
                    "AND" => [
                      "idpatient" => $passedSuppr
                    ]
                  ]);
                  echo "<span id='patientsupprime' style='background-color:white;color:#BE1B0B;'><i class='far fa-check-circle'></i> Patient supprimé !</span>";
                  echo "<script>$('#patientsupprime').delay(10000).hide(0);</script>";
                }

                // Affichage d'un message lorsqu'un patient vient d'être modifié
                if (isset($_GET["edit"])) {
                  $passedEdit = $_GET['edit'];
                  if ($passedEdit == "S") {
                    echo "<span id='succespatientmodifie' style='background-color:white;color:#4C7B45;'><i class='far fa-check-circle'></i> Les informations de ce patient ont été modifiées !</span>";
                    echo "<script>$('#succespatientmodifie').delay(10000).hide(0);</script>";
                  }
                  if ($passedEdit == "E") {
                    echo "<span id='echecpatientmodifie' style='background-color:white;color:#BE1B0B;'><i class='fas fa-times-circle'></i> Echec de lors de la modification des informations de ce patient</span>";
                    echo "<script>$('#echecpatientmodifie').delay(10000).hide(0);</script>";
                  }
                }
                ?>
              </div>

              <table id="tablepatients" class="table shadow rounded">
                <thead>
                  <tr>
                    <th id="colNom" scope="col">Nom</th>
                    <th id="colPrenom" scope="col">Prénom</th>
                    <th id="colAge" scope="col">Âge</th>
                  </tr>
                </thead>
                <tbody id="listepatientTableau">
                  <?php
                    // Récupération des données des patients dans la base de données
                    if (isset($_GET["idmed"])) {
                      $passedidMed = $_GET['idmed'];
                      $enregistrements = $database->select("patients", [
                        "id",
                        "nom",
                        "prenom",
                        "datenaissance"
                      ], [
                        "idmedecin" => $passedidMed
                      ]);
                      echo "<div id='idmed' value='" . $passedidMed . "'> </div>";
                    }

                    // On compte le nombre de patients présents dans la base de données
                    $nombrePatients = count($enregistrements);

                    // Fonction qui permet de calculer l'âge du patient avec sa date de naissance
                    function age($jour, $mois, $annee)
                    {
                      $age = (date('Y') - $annee);
                      if (($mois - date('m')) > 0) {
                        $age = ($age - 1);
                      }
                      if (($mois - date('m')) == 0 && ($jour - date('d')) > 0) {
                        $age = ($age - 1);
                      }
                      return $age;
                    }

                    // Affichage de chaque ligne du tableau de patients avec le prénom, le nom et l'âge du patient
                    if ($nombrePatients > 0) {  // On vérifie au préalable qu'il y a au moins un patient dans la base de données (pour éviter une erreur)
                      foreach ($enregistrements as $enregistrement) {
                        echo "<tr id='" . $enregistrement["id"] . "' class='selectpatient' value='" . $passedidMed . "'>";
                        echo "<td>" . $enregistrement["nom"] . "</td>";
                        echo "<td>" . $enregistrement["prenom"] . "</td>";
                        $orderdate = explode('-', $enregistrement["datenaissance"]);
                        $year = $orderdate[0];
                        $month   = $orderdate[1];
                        $day  = $orderdate[2];
                        $age = age($day, $month, $year);

                        echo "<td>" . $age . "</td>";
                        echo "</tr>";
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <footer class="footer-page font-small bg-dark fixed-bottom">
    <div id="cFooterText" class="class-footer text-center text-white text-sm font-weight-light">© 2020 Copyright • Tous droits réservés.</div>
  </footer>

  <!-- Modale ajout patients -->
  <div id="m_ajoutpatient" class="modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;"></div>

  <script src="../js/langues.js"></script>
</body>

</html>