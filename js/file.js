$(document).ready(function () {
  // Chargmement des 3 modales
  $('#m_ajoutpatient').load('../html/m.ap.html');
  $('#m_v').load('../html/m.v.html');
  $('#m_profil').load('../html/m.profil.html');
  $('[data-toggle="popover"]').popover(); // L'aide contextuelle utilise des popovers
  $('[data-toggle="tooltip"]').tooltip(); // Les tooltip sont utilisés sur la page de connexion
  // Chargement de la Datatable
  $('#tablepatients').DataTable({
    "pageLength": 5,
    "lengthChange": false,
    "ordering": false,
    "info": false,
    "language": {
      "sSearch": "Rechercher :",
      "sZeroRecords": "Aucun élément correspondant trouvé",
      "oPaginate": {
        "sFirst": "Premier",
        "sLast": "Dernier",
        "sNext": "Suivant",
        "sPrevious": "Précédent"
      }
    }
  });

  // Remettre le bouton submit du formulaire pour l'ajout d'un patient à ses valeurs par défaut
  $("#validerpatient").attr('name', 'soumettre');
  $("#validerpatient").attr('value', 'soumettre');
  // Lorsque l'on clique sur la ligne du tableau affichant tous les patients, cette fonction va provoquer une redirection vers la
  // page spécifique au patient sélectionné
  $(".selectpatient").on("click", function (e) {
      var id = $(this).attr("id");
      var idMed = $(this).attr("value");
      location.href = "../php/patient.php?idmed=" + idMed + "&&id=" + id;
  });


  // Bouton pour modifier le profil - La fonction récupère les informations dans la page html et les insère dans le forulaire contenu dans la modale m_profil
  $('.bsetprofil').on("click", function (e) {
    $('#m_ajoutpatient').modal('show');
    $('#FnomMED').val($("#nomMED").html()).change();
    $('#FprenomMED').val($("#prenomMED").html()).change();
    $('#FdatenaissanceMED').val($("#datenaissanceMED").html()).change();
    $('#FemailMED').val($("#emailMED").html()).change();
    $('#FtelephoneMED').val($("#telephoneMED").html()).change();
    $('#FmobileMED').val($("#mobileMED").html()).change();
    $('#FadresseMED').val($("#adresseMED").html()).change();
    $('#FvilleMED').val($("#villeMED").html()).change();
    $('#FcodepostalMED').val($("#codepostalMED").html()).change();
  });

  // Fonction qui gère le click sur le bouton de modification d'un patient : récupération des informations du patient dans la page html
  // + changement des titres de la modale + changement de la valeur du bouton submit du formulaire 
  // (pour indiquer au backend qu'il ne s'agit plus d'un ajout mais d'une mofification)
  $('.bsetpatient').on("click", function (e) {
    changerTitres();
    $("#validerpatient").attr('name', 'soumettreEDIT');
    $("#validerpatient").attr('value', 'soumettreEDIT');
    $('#m_ajoutpatient').modal('show');
    $('#nom').val($("#nompatient").html()).change();
    $('#prenom').val($("#prenompatient").html()).change();
    $('#sexe').val($("#sexepatient").html()).change();
    $('#datenaissance').val($("#datenaissancepatient").html()).change();
    $('#email').val($("#emailpatient").html()).change();
    $('#telephone').val($("#telephonepatient").html()).change();
    $('#mobile').val($("#mobilepatient").html()).change();
    $('#adresse').val($("#adressepatient").html()).change();
    $('#ville').val($("#villepatient").html()).change();
    $('#codepostal').val($("#codepostalpatient").html()).change();
    $('#poids').val($("#poidspatient").html()).change();
    $('#taille').val($("#taillepatient").html()).change();
    $('#groupesanguin').val($("#groupesanguinpatient").html()).change();
    $('#frequencecardiaque').val($("#frequencecardiaquepatient").html()).change();
    var listePathologies = $("#listePathologies").find("li");
    $(listePathologies).each(function () {
      console.log($(this).html());
      $('#Pathologies').val($('#Pathologies').val() + $(this).html() + ";");
    });

    // Hospitalisations
    var nbHospi = $("#listehospiTab").find("tr").length; // Nombre d'hospitalisations
    $("#nbHospi").html(nbHospi);
    if (nbHospi >= 1) {
      $('#dateentree').val($("#listehospiTab").find("tr").eq(0).find("td").eq(0).html());
      $('#datesortie').val($("#listehospiTab").find("tr").eq(0).find("td").eq(1).html());
      $('#raisonmedicale').val($("#listehospiTab").find("tr").eq(0).find("td").eq(2).html());
    }
    if (nbHospi > 1) {
      var i;
      for (i = 1; i < (nbHospi - 1); i++) {
        $("#ajoutformhospi").trigger("click");
        $('#dateentree' + (i + 1)).val($("#listehospiTab").find("tr").eq(i).find("td").eq(0).html());
        $('#datesortie' + (i + 1)).val($("#listehospiTab").find("tr").eq(i).find("td").eq(1).html());
        $('#raisonmedicale' + (i + 1)).val($("#listehospiTab").find("tr").eq(i).find("td").eq(2).html());
      }
    }
    // Vaccinations
    var nbVacci = $("#listeVaccinations").find("tr").length; // Nombre de vaccinations
    $("#nbVacci").html(nbVacci);
    if (nbVacci >= 1) {
      $('#datevaccin').val($("#listeVaccinations").find("tr").eq(0).find("td").eq(0).html());
      $('#nomvaccin').val($("#listeVaccinations").find("tr").eq(0).find("td").eq(1).html());
      $('#dose').val($("#listeVaccinations").find("tr").eq(0).find("td").eq(2).html());
    }
    if (nbVacci > 1) {
      var j;
      for (j = 1; j < (nbVacci - 1); j++) {
        $("#ajoutformvacci").trigger("click");
        $('#datevaccin' + (j + 1)).val($("#listeVaccinations").find("tr").eq(j).find("td").eq(0).html());
        $('#nomvaccin' + (j + 1)).val($("#listeVaccinations").find("tr").eq(j).find("td").eq(1).html());
        $('#dose' + (j + 1)).val($("#listeVaccinations").find("tr").eq(j).find("td").eq(2).html());
      }
    }
    $('#validerpatient').on("click", function (e) {
      remettreTitres()
    });
  });

  // Fonction qui vient changer les titres de la modale d'ajout en titres pour une modification
  function changerTitres() {
    if ($('#en').hasClass("currentlanguage")) { // Si en anglais
      $('#titrepatient').html("Modify this patient");
      $('#textbuttonAjout').html("Replace");
    } else { // Si en français
      $('#titrepatient').html("Modifier ce patient");
      $('#textbuttonAjout').html("Remplacer");
    }
  }

  // Fonction qui vient remettre les titres par défaut (pour l'ajout d'un patient)
  function remettreTitres() {
    if ($('#en').hasClass("currentlanguage")) { // Si en anglais
      $('#titrepatient').html("Add a new patient");
      $('#textbuttonAjout').html("Add");
    } else { // Si en français
      $('#titrepatient').html("Ajouter un nouveau patient");
      $('#textbuttonAjout').html("Ajouter");
    }
  }

  // Fonction qui délanche la modale de validation de suppression d'un patient (quand on clique sur le bouton poubelle)
  $('.btrash').click(function () {
    $('#m_v').modal('show');
    validationSuppression($("#idpatient").html());
  });

  // Fonction qui va envoyer une redirection vers la page principale pour déclencher la suppression du patient de la base de données (si l'utilisateur
  // clique sur le bouton supprimer)
  // Si l'utilisateur clique sur le bouton "Retour", alors la modale se ferme simplement
  function validationSuppression(x) {
    $(".bYes").click(function () {
      $('#m_v').modal('hide');
      var idMedecin2 = $("#idmed2").attr('value');
      location.href = "./mespatients.php?suppr=" + x + "&&idmed=" + idMedecin2 + "&&id=" + $("#idpatient").html();
    });
    $(".bNo").click(function () {
      $('#m_v').modal('hide');
    });
  }

  $('#m_ajoutpatient').on('shown.bs.modal', function () {
    var nbHospi = 1;
    var nbVacci = 1;
    var idMedecin = $("#idmed").attr('value');
    $('#formAjoutPatient').attr('action', "./bdpatient.php?idmed=" + idMedecin);
    // Ajout d'un bloc de formulaire supplémentaire pour ajouter une nouvelle hospitalisation
    $("#ajoutformhospi").click(function () {
      nbHospi++;
      $("#nbHospi").html(nbHospi);
      $("#inputnbHospi").attr("value", nbHospi);

      // Si la page est en français
      if ($("#fr").hasClass("currentlanguage")) {
        var html = '<hr style="color:rgb(200,200,200);">' +
          '<div class="form-group">' +
          '<input type="text" class="form-control" name="raisonmedicale' + nbHospi + '" id="raisonmedicale' + nbHospi + '" placeholder="Raison médicale">' +
          '</div>' +
          '<div class="form-row mb-3">' +
          '<label id="labeldateentree" for="dateentree' + nbHospi + '" class="col-4 col-form-label labeldateentree">Date d entrée</label>' +
          '<div class="col-8">' +
          '<input class="form-control" type="date" name="dateentree' + nbHospi + '" id="dateentree' + nbHospi + '" min="1930-01-01" max="2020-01-01">' +
          '</div>' +
          '</div>' +
          '<div class="form-row mb-3">' +
          '<label id="labeldatesortie" for="datesortie' + nbHospi + '" class="col-4 col-form-label labeldatesortie">Date de sortie</label>' +
          '<div class="col-8">' +
          '<input class="form-control" type="date" name="datesortie' + nbHospi + '" id="datesortie' + nbHospi + '" min="1930-01-01" max="2020-01-01">' +
          '</div>' +
          '</div>' +
          '<br/>';
      }

      // Si la page est en anglais
      else {
        var html = '<hr style="color:rgb(200,200,200);">' +
          '<div class="form-group">' +
          '<input type="text" class="form-control" name="raisonmedicale' + nbHospi + '" id="raisonmedicale' + nbHospi + '" placeholder="Medical Reason">' +
          '</div>' +
          '<div class="form-row mb-3">' +
          '<label id="labeldateentree" for="dateentree' + nbHospi + '" class="col-4 col-form-label labeldateentree">Start date</label>' +
          '<div class="col-8">' +
          '<input class="form-control" type="date" name="dateentree' + nbHospi + '" id="dateentree' + nbHospi + '" min="1930-01-01" max="2020-01-01">' +
          '</div>' +
          '</div>' +
          '<div class="form-row mb-3">' +
          '<label id="labeldatesortie" for="datesortie' + nbHospi + '" class="col-4 col-form-label labeldatesortie">Exit date</label>' +
          '<div class="col-8">' +
          '<input class="form-control" type="date" name="datesortie' + nbHospi + '" id="datesortie' + nbHospi + '" min="1930-01-01" max="2020-01-01">' +
          '</div>' +
          '</div>' +
          '<br/>';
      }
      $("#listeHospi").append(html);
    });

    // Ajout d'un bloc de formulaire supplémentaire pour ajouter une nouvelle vaccination
    $("#ajoutformvacci").click(function () {
      nbVacci++;
      $("#nbVacci").html(nbVacci);
      $("#inputnbVacci").attr("value", nbVacci);
      // Si la page est en français
      if ($("#fr").hasClass("currentlanguage")) {
        var html = '<hr style="color:rgb(200,200,200);">' +
          '<div class="form-row">' +
          '<div class="form-group col-md-6">' +
          '<input type="text" class="form-control" name="nomvaccin' + nbVacci + '" id="nomvaccin' + nbVacci + '" placeholder="Nom vaccin">' +
          '</div>' +
          '<div class="form-group col-md-6">' +
          '<input type="number" class="form-control" name="dose' + nbVacci + '" id="dose' + nbVacci + '" step=0.01 placeholder="Dose">' +
          '</div>' +
          '</div>' +
          '<div class="form-row mb-3">' +
          '<label id="labeldatevaccin" for="datevaccin' + nbVacci + '" class="col-4 col-form-label labeldatevaccin">Date du vaccin</label>' +
          '<div class="col-8">' +
          '<input class="form-control" type="date" name="datevaccin' + nbVacci + '" id="datevaccin' + nbVacci + '" min="1930-01-01" max="2020-01-01">' +
          '</div>' +
          '</div>' +
          '<br/>';
      } else {
        var html = '<hr style="color:rgb(200,200,200);">' +
          '<div class="form-row">' +
          '<div class="form-group col-md-6">' +
          '<input type="text" class="form-control" name="nomvaccin' + nbVacci + '" id="nomvaccin' + nbVacci + '" placeholder="Vaccin name">' +
          '</div>' +
          '<div class="form-group col-md-6">' +
          '<input type="number" class="form-control" name="dose' + nbVacci + '" id="dose' + nbVacci + '" step=0.01 placeholder="Dose">' +
          '</div>' +
          '</div>' +
          '<div class="form-row mb-3">' +
          '<label id="labeldatevaccin" for="datevaccin' + nbVacci + '" class="col-4 col-form-label labeldatevaccin">Vaccin date</label>' +
          '<div class="col-8">' +
          '<input class="form-control" type="date" name="datevaccin' + nbVacci + '" id="datevaccin' + nbVacci + '" min="1930-01-01" max="2020-01-01">' +
          '</div>' +
          '</div>' +
          '<br/>';
      }
      $("#listeVacci").append(html);
    });
  });

  // Redirection vers le fichier bdprofil.php lorsqu'on enrregistre les modifications du profil du médecin (pour gérer l'enrregistrement des infos)
  $('#m_profil').on('shown.bs.modal', function () {
    var idMed = $("#idmedProfil").attr('value');
    $('#formProfil').attr('action', "./bdprofil.php?idmed=" + idMed);
  });
});