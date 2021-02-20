$("#frmTamanoFrasco").submit(function (e) {
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

      $("#titulo_formulario").text(" Nuevo tamaño de frasco");
      $("#tamano_frasco").val("");
      $("#id_tamano_frasco").val("");
      $("#frmTamanoFrasco").attr("data-action", "agregar");

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

function editar(id_tamano_frasco) {
  $("#titulo_formulario").text(" Editar tamaño de frasco");

  var fila = $("#tamano_frasco_" + id_tamano_frasco);
  var tamano_frasco = $(fila).find(".tamano_frasco").html();

  $("#tamano_frasco").val(tamano_frasco);
  $("#id_tamano_frasco").val(id_tamano_frasco);
  $("#frmTamanoFrasco").attr("data-action", "editar");
  $("#tamano_frasco").focus();
}
function cancelar() {
  $("#titulo_formulario").text(" Nuevo tamaño de frasco");
  $("#id_tamano_frasco").val("");
  $("#frmTamanoFrasco").attr("data-action", "agregar");
  $().val("");
}
