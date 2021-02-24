$("#frmLotes").submit(function (e) {
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

      $("#titulo_formulario").text(" Nuevo lote");

      $("#id_ubicaciones").val();
      $("#id_apiario").val();
      $("#fecha_produccion").val("");

      $("#id_lote").val("");
      $("#frmLotes").attr("data-action", "agregar");

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

function editar(id_lote) {
  $("#titulo_formulario").text(" Editar lote");

  var fila = $("#lote_" + id_lote);
  var id_ubicacion = $("#id_ubicacion_" + id_lote).val();
  var id_apiario = $("#id_apiario_" + id_lote).val();
  var fecha_produccion = $(fila).find(".fecha_produccion").html();

  var num_ubicaciones = document.getElementById("id_ubicacion").length;
  for (let i = 1; i <= num_ubicaciones; i++) {
    $("#id_ubicacion option[value=" + i + "]").removeAttr("selected");
  }
  $("#id_ubicacion option[value=" + id_ubicacion + "]").attr("selected", true);

  var num_apiarios = document.getElementById("id_apiario").length;
  for (let i = 1; i <= num_apiarios; i++) {
    $("#id_apiario option[value=" + i + "]").removeAttr("selected");
  }
  $("#id_apiario option[value=" + id_apiario + "]").attr("selected",true);

  $("#fecha_produccion").val(fecha_produccion);
  $("#id_ubicacion").focus();

  $("#id_lote").val(id_lote);
  $("#frmLotes").attr("data-action", "editar");
}
function cancelar() {
  $("#titulo_formulario").text(" Nuevo lote");
  $("#id_lote").val("");
  $("#frmLotes").attr("data-action", "agregar");
  $().val("");
}
