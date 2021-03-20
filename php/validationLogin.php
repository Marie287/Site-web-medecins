<?php
require 'config.php';
//-----------
class Login{
  
  const ECHEC = 0;
  const SUCCES = 1;
  const PAS_DE_FORMULAIRE = 2;

  public function enregistrerForm(){
    global  $database;
    if (!isset($_REQUEST["connecter"])) {
      echo "erreur";
      return self::PAS_DE_FORMULAIRE;
    }
    // Récupérer tous les emails et les mots de passe dans la base de données dans la variable $enregistrements
    $enregistrements = $database->select("profil", [
      "id",
      "email",
      "password"
    ]);
    // Vérifier pour chaque enrregistrement si il y en a un qui correspond aux informations de connexion entrées dans le formulaire
    foreach ($enregistrements as $enregistrement) {
      if (($enregistrement["email"] == $_REQUEST["cemail"]) && ($enregistrement["password"] == $_REQUEST["cpassword"])) {
        // Si l'identifiant et le mot de passe sont valides, on provoque une redirection vers mespatients.php
        echo "<script>location.href = './mespatients.php?idmed=" . $enregistrement["id"] . "';</script>";
        echo "SUCCES";
        return self::SUCCES;
      }
    }
    // Si les informations sont invalides, on affiche un message d'erreur
    echo "<script>location.href = './l.php?login=F';</script>";
    echo "NO";
    return self::ECHEC;
  }
}
$part = new Login();
$part->enregistrerForm();