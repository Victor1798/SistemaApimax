$("#frmApiario").submit(function (e) {
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

      $("#titulo_formulario").text(" Nuevo apiario");
      $("#nombre").val("");
      $("#id_apiario").val("");
      $("#frmApiario").attr("data-action", "agregar");

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

function editar(id_apiario) {
  $("#titulo_formulario").text(" Editar apiario");

  var fila = $("#nombre_" + id_apiario);
  var nombre = $(fila).find(".nombre").html();

  $("#nombre").val(nombre);
  $("#id_apiario").val(id_apiario);
  $("#frmApiario").attr("data-action", "editar");
  $("#nombre").focus();
}

function cancelar() {
  $("#titulo_formulario").text(" Nuevo apiario");
  $("#id_apiario").val("");
  $("#frmApiario").attr("data-action", "agregar");
  $().val("");
}
