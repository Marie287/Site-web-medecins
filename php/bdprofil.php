<?php
require 'config.php';

class Medecins {

  const ECHEC = 0;
  const SUCCES = 1;
  const PAS_DE_FORMULAIRE = 2;
    
  public function enregistrerFormMED() {
    global  $database;
    $infoFormMED = array();
    if(!isset($_REQUEST["soumettre"])){
        return self::PAS_DE_FORMULAIRE;
    }
      
    // Récupération des informations du formulaire de la modale pour la modification du profil du médecin
    // et insertion de ces données dans une variable $infoFormMED
    $infoFormMED["nom"] = $_REQUEST["FnomMED"];
    $infoFormMED["prenom"] = $_REQUEST["FprenomMED"];
    $infoFormMED["datenaissance"] = $_REQUEST["FdatenaissanceMED"];
    $infoFormMED["email"] = $_REQUEST["FemailMED"];
    $infoFormMED["password"] = $_REQUEST["FpasswordMED"];
    $infoFormMED["telephone"] = $_REQUEST["FtelephoneMED"];
    $infoFormMED["mobile"] = $_REQUEST["FmobileMED"];
    $infoFormMED["adresse"] = $_REQUEST["FadresseMED"];
    $infoFormMED["ville"] = $_REQUEST["FvilleMED"];
    $infoFormMED["codepostal"] = $_REQUEST["FcodepostalMED"];

    // Insertion des nouvelles valeurs dans la base de données avec la méthode update(à de Medoo)
    $passedidMed = $_GET['idmed'];
    $editOk = $database->update("profil",$infoFormMED,["id" => $passedidMed ]);
    
    if($editOk){
      echo "<script>location.href = './profil.php?idmed=". $passedidMed ."&&edit=S';</script>";
      return self::SUCCES;
    }else{
      echo "<script>location.href = './profil.php?idmed=". $passedidMed ."&&edit=E';</script>";
      return self::ECHEC;
    }
  }
}
$part = new Medecins();
$part->enregistrerFormMED();