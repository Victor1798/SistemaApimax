$("#frmUbicacion").submit(function (e) {
  var accion = $(this).attr("data-action");
  var url = "";

  if (accion == "agregar") {
    url = "guardar.php";
  } else if (accion == "editar") {
    url = "actualizar.php";
  }
  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: $(this).serialize(),
    success: function (respuesta) {
      if (accion == "agregar") {
        swal.fire("Éxito", "Registro agregado correctamente :)", "success");
      } else if (accion == "editar") {
        swal.fire("Éxito", "Registro editado correctamente :)", "success");
      }
      accion = $(this).attr("data-action");

      $("#titulo_formulario").text(" Nueva ubicación");
      $("#ubicacion").val("");
      $("#id_ubicacion").val("");
      $("#frmUbicacion").attr("data-action", "agregar");

      llenar_tabla();
    },
    error: function (respuesta_error) {
      swal.fire("Error", "Ha ocurrido un error :(", "error");
    },
  });
  e.preventDefault();
  return false;
});

function llenar_tabla() {
  $.ajax({
    url: "tabla.php",
    type: "GET",
    dataType: "html",
    success: function (tabla) {
      $("#cuerpo_tabla").html(tabla);
    },
    error: function (error_tabla) {
      alert("Error en la tabla :(");
    },
  });
}

function editar(id_ubicacion) {
  $("#titulo_formulario").text(" Editar ubicación");

  var fila = $("#ubicacion_" + id_ubicacion);
  var ubicacion = $(fila).find(".ubicacion").html();

  $("#ubicacion").val(ubicacion);
  $("#id_ubicacion").val(id_ubicacion);
  $("#frmUbicacion").attr("data-action", "editar");
  $("#ubicacion").focus();
}
function cancelar() {
  $("#titulo_formulario").text(" Nueva ubicación");
  $("#id_ubicacion").val("");
  $("#frmUbicacion").attr("data-action", "agregar");
  $().val("");
}
