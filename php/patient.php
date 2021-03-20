<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient</title>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.0/umd/popper.min.js"></script><!-- attention dep pour bootstrap -->
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
		$passedId = $_GET['id'];
		echo "<div id='idPatientPage' value='" . $passedId . "'> </div>";
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
					echo "<div id='idmed2' value='" . $passedidMed . "'> </div>";
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

	<div class="container col-md-10 col-12" id="container">
		<div id="div1">


			<div id="div2">
				<div id="div13" class="shadow bg-white position-relative bloc bloc-formulaire p-4 m-0">
					<div class="tab-content patient">
						<div class="d-flex justify-content-between">
							<div class="col">
								
								<?php
								if (isset($_GET["idmed"])) {
									$passedidMed = $_GET['idmed'];
									echo '<button type="button" class="btn p-0 ml-2 btnstyle" onclick=location.href="./mespatients.php?idmed=' . $passedidMed . '"><i class="fas fa-arrow-left fa-2x"></i></button>';
								}
								?>
								
							</div>

							<?php
							require './config.php';
							global  $database;
							$enregistrements = $database->select("patients", [
								"id",
								"nom",
								"prenom",
								"sexe",
								"datenaissance",
								"email",
								"telephone",
								"mobile",
								"adresse",
								"ville",
								"codepostal",
								"taille",
								"poids",
								"groupesanguin",
								"frequencecardiaque"
							]);

							$idDansTable = $passedId;
							// Récupération de l'id du patient dans la base de données
							foreach ($enregistrements as $clef => $valeur) {
								if ($passedId == $valeur["id"]) {
									$idDansTable = $clef;
									break;
								}
							}

							// Fonction qui calcule l'age du patient avec sa date de naissance
							function age($jour, $mois, $annee)
							{
								$age = (date('Y') - $annee);
								if (($mois - date('m')) > 0) $age = ($age - 1);
								if (($mois - date('m')) == 0 && ($jour - date('d')) > 0) $age = ($age - 1);
								return $age;
							}

							?>
							
							<h2 class="text-center col">Patient n°<span id="idpatient"><?php echo $enregistrements[$idDansTable]["id"];; ?></span></h2>
							<div class="col text-right">
								<button type="button" class="btn bsetpatient" style="background-color:white;"><i class="fas fa-pen color-icon fa-lg"></i></button>
								<button type="button" class="btn btrash" style="background-color:white;"><i class="fas fa-trash color-icon fa-lg"></i></button>
								<button type="button" class="btn" style="cursor:pointer;color:rgb(80,80,80);background-color:white;"><i class="fas fa-download fa-lg"></i></button>
								<button id="aidepatient" type="button" class="btn btnstyle" data-trigger="focus" tabindex="0" style="cursor:pointer;color:rgb(80,80,80);" data-placement="top" data-toggle="popover" data-original-title="Aide" data-html="true" data-content="• Si vous souhaitez modifier les informations concernant ce patient, 
									cliquez sur le crayon &nbsp; <small><i class='fas fa-pen color-icon'></i></small>
									<br> • Si vous souhaite le supprimer, cliquez sur la poubelle &nbsp; <small><i class='fas fa-trash color-icon'></i></small>
									<br> • Si vous voulez télécharger au format pdf toutes les informations concernant ce patient, cliquez sur le bouton
									&nbsp; <small><i class='fas fa-download color-icon'></i></small>
									">
									<i class="fa fa-question-circle fa-2x"></i>
								</button>
							</div>
						</div>
						<hr style="color:rgb(200,200,200);width:100%;">

						<div class="row">
							<div class="col-xl-4 col-12">
								<div class="card">
									<div class="card-header text-center px-0">
										<div class="card-title text-center">
											<h4 id="titreinfoperso" class="modal-title">Informations personnelles</h4>

										</div>
									</div>
									<div class="card-body p-3" style="height:350px;line-height:30px;">
										<p>
											<span class="labeldescription"><span id="lnom">Nom</span> : </span><span id="nompatient" class="valeurBD"><?php echo $enregistrements[$idDansTable]["nom"]; ?></span>
											<span class="labeldescription ml-4"><span id="lprenom">Prénom</span> : </span><span id="prenompatient" class="valeurBD"><?php echo $enregistrements[$idDansTable]["prenom"]; ?></span>
										</p>
										<p><span class="labeldescription"><span id="lsexe">Sexe</span> : </span><span id="sexepatient" class="valeurBD"><?php echo $enregistrements[$idDansTable]["sexe"]; ?></span></p>
										<p><span class="labeldescription"><i class="far fa-calendar-alt icon-color esp"></i> <span id="ldatenaissance">Date de naissance</span> :
											</span><span id="datenaissancepatient"><?php echo $enregistrements[$idDansTable]["datenaissance"]; ?></span></p>
										<p><span class="labeldescription"><i class="far fa-envelope icon-color esp"></i>
												<span id="lemail">Email</span> : </span><span id="emailpatient"><?php echo $enregistrements[$idDansTable]["email"]; ?></span></p>
										<p><span class="labeldescription"><i class="fas fa-phone-alt icon-color esp"></i> <span id="ltelephone">Téléphone</span> :
											</span><span id="telephonepatient"><?php echo $enregistrements[$idDansTable]["telephone"]; ?></span></p>
										<p><span class="labeldescription"><i class="fas fa-mobile-alt icon-color esp"></i> <span id="lmobile">Mobile</span> :
											</span><span id="mobilepatient"><?php echo $enregistrements[$idDansTable]["mobile"]; ?></span></p>
										<p><i class="fas fa-map-marker-alt icon-color esp"></i> <span class="labeldescription"><span id="ladresse">Adresse</span> : </span><span id="adressepatient"><?php echo $enregistrements[$idDansTable]["adresse"]; ?></span></p>
										<p>
											<span class="esp"></span>
											<span class="labeldescription"><span id="lville">Ville</span> : </span><span id="villepatient" class="valeurBD"><?php echo $enregistrements[$idDansTable]["ville"]; ?></span>
											<span class="labeldescription ml-4"><span id="lcodepostal">Code Postal</span> : </span><span id="codepostalpatient"><?php echo $enregistrements[$idDansTable]["codepostal"]; ?></span>
										</p>

									</div>
								</div>
							</div>

							<div class="col-xl-8 col-12">
								<div class="card">
									<div class="card-header text-center">
										<div class="card-title text-center">
											<h4 id="titreinfomed" class="modal-title">Informations médicales</h4>
										</div>
									</div>

									<div class="card-body p-3" style="overflow-y: scroll;height:350px;">
										<div class="row">
											<span class="col-4"><span class="labeldescription"><i class="fas fa-birthday-cake icon-color"></i> <span id="lage">Âge</span> :
												</span><span>
													
													<?php
													//  Fonction qui converti une date de naissance au format mm-jj-aaaa en format aaaa-mm-dd
													$orderdate = explode('-', $enregistrements[$idDansTable]["datenaissance"]);
													$year = $orderdate[0];
													$month   = $orderdate[1];
													$day  = $orderdate[2];
													echo age($day, $month, $year);
													?>
													
													<span id="ans">ans</span></span></span>
											<span class="col-4"><span class="labeldescription"><i class="fas fa-ruler-vertical icon-color"></i> <span id="ltaille">Taille</span> :
												</span><span id="taillepatient"><?php echo $enregistrements[$idDansTable]["taille"]; ?></span><span> m</span></span>
											<span class="col-4"><span class="labeldescription"><i class="fas fa-weight icon-color"></i> <span id="lpoids">Poids</span> : </span>
												<span id="poidspatient"><?php echo $enregistrements[$idDansTable]["poids"]; ?></span><span> kg</span></span>
										</div>
										<br />
										<div class="row">
											<span class="col-4"><span class="labeldescription"><span id="lgroupesanguin">Groupe sanguin</span> :
												</span><span class="valeurBD" id="groupesanguinpatient"><?php echo $enregistrements[$idDansTable]["groupesanguin"]; ?></span></span>
											<span class="col-4"><span class="labeldescription"><span id="lfreqcardiaque">Fréquence cardiaque</span> :

												</span><span id="frequencecardiaquepatient"><?php echo $enregistrements[$idDansTable]["frequencecardiaque"]; ?></span> bpm</span>
										</div>

										<br />
										<div class="row">
											<p class="col-md-auto"><span class="labeldescription"><i class="fas fa-notes-medical icon-color"></i> <span id="lpathologies">Pathologies</span> :
												</span></p>
											<ul class="col" id="listePathologies">
												
												<?php
												$pathologies = $database->select("pathologies", [
													"nom",
													"idpatient"
												], [
													"idpatient" => $passedId
												]);

												foreach ($pathologies as $pathologie) {
													echo "<li>" . $pathologie["nom"] . "</li>";
												}
												?>
												
											</ul>
										</div>

										<br />
										<div class="row pr-2">
											<p class="labeldescription col-3"><i class="far fa-hospital icon-color"></i>
												<span id="lhospi">Hospitalisations</span> : </p>


											<table class="table table-sm col">
												<thead>
													<tr>
														<th scope="col"><span id="ldateentree">Date entrée</span></th>
														<th scope="col"><span id="ldatesortie">Date sortie</span></th>
														<th scope="col"><span id="lraisonmedicale">Raison médicale</span></th>
													</tr>
												</thead>
												<tbody id="listehospiTab">
													
													<?php
													$hospitalisations = $database->select("hospitalisations", [
														"dateentree",
														"datesortie",
														"raisonmedicale",
														"idpatient"
													], [
														"idpatient" => $passedId
													]);

													foreach ($hospitalisations as $hospitalisation) {
														echo "<tr>";
														echo "<td>" . $hospitalisation["dateentree"] . "</td>";
														echo "<td>" . $hospitalisation["datesortie"] . "</td>";
														echo "<td>" . $hospitalisation["raisonmedicale"] . "</td>";
														echo "</tr>";
													}
													?>
													
												</tbody>
											</table>

										</div>

										<br />
										<div class="row pr-2">
											<p class="labeldescription col-3"><i class="fas fa-syringe icon-color"></i>
												<span id="vaccinations">Vaccinnations</span> : </p>


											<table class="table table-sm col">
												<thead>
													<tr>
														<th scope="col"><span id="datevacci">Date</span></th>
														<th scope="col"><span id="lvaccin">Vaccin</span></th>
														<th scope="col"><span id="ldose">Dose</span></th>
													</tr>
												</thead>
												<tbody id="listeVaccinations">
													
													<?php
													$vaccinations = $database->select("vaccinations", [
														"date",
														"vaccin",
														"dose",
														"idpatient"
													], [
														"idpatient" => $passedId
													]);

													foreach ($vaccinations as $vaccination) {
														echo "<tr>";
														echo "<td>" . $vaccination["date"] . "</td>";
														echo "<td>" . $vaccination["vaccin"] . "</td>";
														echo "<td>" . $vaccination["dose"] . "</td>";
														echo "</tr>";
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
				</div>
			</div>

			<footer class="footer-page font-small bg-dark fixed-bottom">
				<div id="cFooterText" class="class-footer text-center text-white text-sm font-weight-light">© 2020 Copyright • Tous droits réservés.</div>
			</footer>

			<!-- Modale ajout patients -->
			<div id="m_ajoutpatient" class="modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;"></div>
			<div id="m_v" class="modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;"></div>

			<script src="../js/langues.js"></script>

</body>
</html>