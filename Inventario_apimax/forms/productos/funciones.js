$("#frmProductos").submit(function (e) {
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

      $("#titulo_formulario").text(" Nuevo producto");

      $("#producto").val("");
      $("#id_tipo_miel").val();
      $("#tamano_frasco").val("");
      $("#precio").val("");

      $("#id_producto").val("");
      $("#frmProductos").attr("data-action", "agregar");

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

function editar(id_producto) {
  $("#titulo_formulario").text(" Editar producto");

  var fila = $("#producto_" + id_producto);
  var producto = $(fila).find(".producto").html();
  var id_tipo_miel = $("#id_tipo_miel_" + id_producto).val();
  var tamano_frasco = $(fila).find(".tamano_frasco").html();
  var precio = $(fila).find(".precio").html();

  var num_tipos_miel = document.getElementById("id_tipo_miel").length;
  for (let i = 1; i <= num_tipos_miel; i++) {
      $("#id_tipo_miel option[value="+i+"]").removeAttr("selected");
  }

  $("#producto").val(producto);
  $("#id_tipo_miel option[value="+id_tipo_miel+"]").attr("selected",true);
  $("#tamano_frasco").val(tamano_frasco);
  $("#precio").val(precio);
  $("#producto").focus();


  $("#id_producto").val(id_producto);
  $("#frmProductos").attr("data-action", "editar");

}
function cancelar() {
  $("#titulo_formulario").text(" Nuevo producto");
  $("#id_producto").val("");
  $("#frmProductos").attr("data-action", "agregar");
  $().val("");
}
