$('.translate').click(function () {
  var lang = $(this).attr('id');
  if (lang == "fr") {
    $("#fr").addClass("currentlanguage");
    $("#en").removeClass("currentlanguage");
    // Changement langue Datatable :
    $("#tablepatients_next").find("a").html("Suivant");
    $("#tablepatients_previous").find("a").html("Précédent");
  } else {
    $("#en").addClass("currentlanguage");
    $("#fr").removeClass("currentlanguage");
    // Changement langue Datatable :
    $("#tablepatients_next").find("a").html("Next");
    $("#tablepatients_previous").find("a").html("Previous");
  }
  $.ajax({
    url: "../data/" + lang + ".json",
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, x) {
        if (x.propriete == "text") $(x.obj).text(x.value);
        if (x.propriete == "title") $(x.obj).selectpicker({ title: x.value }).selectpicker('render');

        if (x.propriete == "textdrop") {
          $(x.obj).text(x.value);
        }
        else {
          $(x.obj).attr(x.propriete, x.value);
        }
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log('error');
      console.log(thrownError);
    }
  });
});
