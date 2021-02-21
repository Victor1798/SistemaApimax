$("#frmPersonas").submit(function (e) {
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
      $("#titulo_formulario").text(" Nueva persona");

      $("#nombre").val("");
      $("#ap_paterno").val("");
      $("#ap_materno").val("");
      $("#fecha_nac").val("");
      $("#direccion").val("");
      $("#correo").val("");
      $("#telefono").val("");

      $("#id_persona").val("");
      $("#frmPersonas").attr("data-action", "agregar");

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

function editar(id_persona) {
  $("#titulo_formulario").text(" Editar persona");

  var fila = $("#persona_" + id_persona);
  var nombre = $(fila).find(".nombre").html();
  var ap_paterno = $(fila).find(".ap_paterno").html();
  var ap_materno = $(fila).find(".ap_materno").html();
  var fecha_nac = $(fila).find(".fecha_nac").html();
  var direccion = $(fila).find(".direccion").html();
  var correo = $(fila).find(".correo").html();
  var telefono = $(fila).find(".telefono").html();

  $("#nombre").val(nombre);
  $("#ap_paterno").val(ap_paterno);
  $("#ap_materno").val(ap_materno);
  $("#fecha_nac").val(fecha_nac);
  $("#direccion").val(direccion);
  $("#correo").val(correo);
  $("#telefono").val(telefono);
  $("#nombre").focus();

  $("#id_persona").val(id_persona);
  $("#frmPersonas").attr("data-action", "editar");
}
function cancelar() {
  $("#titulo_formulario").text(" Nueva persona");
  $("#id_persona").val("");
  $("#frmPersonas").attr("data-action", "agregar");
  $().val("");
}
