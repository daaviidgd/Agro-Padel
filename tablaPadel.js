window.onload = function() {
  var today = new Date().toISOString().split('T')[0];
  document.getElementById("fecha").setAttribute('min', today);
  document.getElementById("fecha").setAttribute('value', today);
}

$(document).ready(function() {
    $("#fecha").change(function() {
      var fecha = $(this).val();
      
      // Vaciar el contenido del div
      $("#resultadoTabla").empty();

      
      $.ajax({
        url: "tabla.php",
        type: "POST",
        data: { fecha: fecha },
        success: function(response) {
          $("#resultadoTabla").html(response);
        },
        error: function() {
          $("#resultadoTabla").html("Error en la solicitud AJAX.");
        }
      });
    });
  });

