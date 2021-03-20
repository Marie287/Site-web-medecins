<?php
require 'config.php';
//-----------
class Patients{
  
  const ECHEC = 0;
  const SUCCES = 1;
  const PAS_DE_FORMULAIRE = 2;

  public function enregistrerForm(){
    global  $database;
    $infoForm = array();
    // On vérifie que l'utilisateur a bien cliqué sur le bouton de soumission de formulaire (pour un ajout ou une modification)
    if (!isset($_REQUEST["soumettre"]) && !isset($_REQUEST["soumettreEDIT"])) {
        echo "erreur";
        return self::PAS_DE_FORMULAIRE;
    }
    // Récupération des données dans le formulaire d'ajout de patient + création d'un tableau $infoForm contenant toutes les valeurs
    $infoForm["nom"] = $_REQUEST["nom"];
    $infoForm["prenom"] = $_REQUEST["prenom"];
    $infoForm["sexe"] = $_REQUEST["sexe"];
    $infoForm["datenaissance"] = $_REQUEST["datenaissance"];
    $infoForm["email"] = $_REQUEST["email"];
    $infoForm["telephone"] = $_REQUEST["telephone"];
    $infoForm["mobile"] = $_REQUEST["mobile"];
    $infoForm["adresse"] = $_REQUEST["adresse"];
    $infoForm["ville"] = $_REQUEST["ville"];
    $infoForm["codepostal"] = $_REQUEST["codepostal"];
    $infoForm["poids"] = $_REQUEST["poids"];
    $infoForm["taille"] = $_REQUEST["taille"];
    $infoForm["groupesanguin"] = $_REQUEST["groupesanguin"];
    $infoForm["frequencecardiaque"] = $_REQUEST["frequencecardiaque"];

    // Récupérer id du médecin
    $passedidMed = $_GET['idmed'];
    $infoForm["idmedecin"] = $passedidMed;

    // Récupérer id du prochain patient
    $idprochainpatient = ($database->max("patients", "id")) + 1;

    // Pathologies
    $infoPatho = $_REQUEST["Pathologies"];
    $tabPatho = explode(";", $infoPatho);

    // Vaccinations
    $infoVaccin = array();
    $infoVaccin["date"] = $_REQUEST["datevaccin"];
    $infoVaccin["vaccin"] = $_REQUEST["nomvaccin"];
    $infoVaccin["dose"] = $_REQUEST["dose"];
    $infoVaccin["idpatient"] = $idprochainpatient;
    $tabVaccin[] = $infoVaccin;
    $nbvacci = $_REQUEST['inputnbVacci'];

    // Hospitalisation
    $infoHospi = array();
    $infoHospi["dateentree"] = $_REQUEST["dateentree"];
    $infoHospi["datesortie"] = $_REQUEST["datesortie"];
    $infoHospi["raisonmedicale"] = $_REQUEST["raisonmedicale"];
    $infoHospi["idpatient"] = $idprochainpatient;
    $tabHospi[] = $infoHospi;
    $nbhospi = $_REQUEST['inputnbHospi'];


        // Si il s'agit d'un ajout on enrregistre les informations dans la base de données avec la fonction insert() de Medoo
    if (isset($_REQUEST["soumettre"])) {
      // Insertion infos patient
      $insertionInfoMed = $database->insert("patients", $infoForm);
      // Insertion pathologies
      foreach ($tabPatho as $pathologie) {
        $insertionPatho = $database->insert("pathologies", [
          "nom" => $pathologie,
          "idpatient" => $idprochainpatient
        ]);
      }

      // Insertion Vaccination
      if ($nbvacci > 1) {
        for ($i = 2; $i <= $nbvacci; $i++) {
          $autreinfoVaccin = array();
          $autreinfoVaccin["date"] = $_REQUEST["datevaccin" . $i];
          $autreinfoVaccin["vaccin"] = $_REQUEST["nomvaccin" . $i];
          $autreinfoVaccin["dose"] = $_REQUEST["dose" . $i];
          $autreinfoVaccin["idpatient"] = $idprochainpatient;
          $tabVaccin[] = $autreinfoVaccin;
        }
        foreach ($tabVaccin as $unVaccin) {
          $insertionVaccination = $database->insert("vaccinations", $unVaccin);
        }
      } else {
        $insertionVaccination = $database->insert("vaccinations", $infoVaccin);
      }

      // Insertion hospitalisation
      if ($nbhospi > 1) {
        echo $nbhospi;
        for ($i = 2; $i <= $nbhospi; $i++) {
          $autreinfoHospi = array();
          $autreinfoHospi["dateentree"] = $_REQUEST["dateentree" . $i];
          $autreinfoHospi["datesortie"] = $_REQUEST["datesortie" . $i];
          $autreinfoHospi["raisonmedicale"] = $_REQUEST["raisonmedicale" . $i];
          $autreinfoHospi["idpatient"] = $idprochainpatient;
          $tabHospi[] = $autreinfoHospi;
        }
        foreach ($tabHospi as $uneHospi) {
          $insertionHospitalisation = $database->insert("hospitalisations", $uneHospi);
        }
      } else {
        $insertionHospitalisation = $database->insert("hospitalisations", $infoHospi);
      }
      
      // Si les intertions se sont bien passées -> redirections
      if ($insertionInfoMed && $insertionPatho && $insertionVaccination && $insertionHospitalisation) {
        echo "<script>location.href = './mespatients.php?ajout=S&&idmed=" . $passedidMed . "';</script>";
        return self::SUCCES;
      } else {
        echo "<script>location.href = './mespatients.php?ajout=E&&idmed=" . $passedidMed . "';</script>";
        return self::ECHEC;
      }
    }

    // Si il s'agit d'une mdification on modifie les informations dans la base de données avec la fonction update() de Medoo
    if (isset($_REQUEST["soumettreEDIT"])) {
      $editOk = $database->update(
        "patients",
        $infoForm,
        array(
          'AND' => array(
            "nom" => $_REQUEST['nom'],
            "prenom" => $_REQUEST['prenom'],
          )
        )
      );

      // On supprime d'abord toutes les pathologies / vaccinations / hospitalisations
      $idPatientPage = $_REQUEST['idPatientPage'];
      $database->delete("pathologies", [
        "AND" => [
          "idpatient" => $idPatientPage
        ]
      ]);
      $database->delete("vaccinations", [
        "AND" => [
          "idpatient" => $idPatientPage
        ]
      ]);
      $database->delete("hospitalisations", [
        "AND" => [
          "idpatient" => $idPatientPage
        ]
      ]);
      // Puis on les réinsère
      // Insertion pathologies
      foreach ($tabPatho as $pathologie) {
        $insertionPatho = $database->insert("pathologies", [
          "nom" => $pathologie,
          "idpatient" => $idprochainpatient
        ]);
      }

      // Insertion Vaccination
      if ($nbvacci > 1) {
        for ($i = 2; $i <= $nbvacci; $i++) {
          $autreinfoVaccin = array();
          $autreinfoVaccin["date"] = $_REQUEST["datevaccin" . $i];
          $autreinfoVaccin["vaccin"] = $_REQUEST["nomvaccin" . $i];
          $autreinfoVaccin["dose"] = $_REQUEST["dose" . $i];
          $autreinfoVaccin["idpatient"] = $idprochainpatient;
          $tabVaccin[] = $autreinfoVaccin;
        }
        foreach ($tabVaccin as $unVaccin) {
          $insertionVaccination = $database->insert("vaccinations", $unVaccin);
        }
      } else {
          $insertionVaccination = $database->insert("vaccinations", $infoVaccin);
      }

      // Insertion hospitalisation
      if ($nbhospi > 1) {
        echo $nbhospi;
        for ($i = 2; $i <= $nbhospi; $i++) {
          $autreinfoHospi = array();
          $autreinfoHospi["dateentree"] = $_REQUEST["dateentree" . $i];
          $autreinfoHospi["datesortie"] = $_REQUEST["datesortie" . $i];
          $autreinfoHospi["raisonmedicale"] = $_REQUEST["raisonmedicale" . $i];
          $autreinfoHospi["idpatient"] = $idprochainpatient;
          $tabHospi[] = $autreinfoHospi;
        }
        foreach ($tabHospi as $uneHospi) {
          $insertionHospitalisation = $database->insert("hospitalisations", $uneHospi);
        }
      } else {
        $insertionHospitalisation = $database->insert("hospitalisations", $infoHospi);
      }


      if ($editOk && $insertionPatho && $insertionVaccination && $insertionHospitalisation) {
        echo "<script>location.href = './mespatients.php?edit=S&&idmed=" . $passedidMed . "';</script>";
        return self::SUCCES;
      } else {
        echo "<script>location.href = './mespatients.php?edit=E&&idmed=" . $passedidMed . "';</script>";
        return self::ECHEC;
      }
    }
  }
}
$part = new Patients();
$part->enregistrerForm();