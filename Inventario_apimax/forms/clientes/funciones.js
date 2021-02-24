$("#frmClientes").submit(function (e) {
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

      $("#titulo_formulario").text(" Nuevo cliente");
      $("#id_persona").val();
      $("#id_cliente").val("");
      $("#frmClientes").attr("data-action", "agregar");

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

function editar(id_cliente) {
  $("#titulo_formulario").text(" Editar cliente");
  var fila = $("#cliente_" + id_cliente);
  var id_persona = $("#id_persona_" + id_cliente).val();
  var num_personas = document.getElementById("id_persona").length;
  for (let i = 1; i <= num_personas; i++) {
    $("#id_persona option[value=" + i + "]").removeAttr("selected");
  }
  $("#id_persona option[value=" + id_persona + "]").attr("selected", true);

  $("#cliente").focus();

  $("#id_cliente").val(id_cliente);
  $("#frmClientes").attr("data-action", "editar");
}
function cancelar() {
  $("#titulo_formulario").text(" Nuevo cliente");
  $("#id_cliente").val("");
  $("#frmClientes").attr("data-action", "agregar");
  $().val("");
}
