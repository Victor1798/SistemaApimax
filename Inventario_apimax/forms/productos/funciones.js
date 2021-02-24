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
      $("#id_tamano_frasco").val();
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
  var id_tipo_miel = $("#id_tipo_miel_" + id_producto).val();
  var id_tamano_frasco = $("#id_tamano_frasco_" + id_producto).val();
  var producto = $(fila).find(".producto").html();
  var precio = $(fila).find(".precio").html();


  var num_tipos_miel = document.getElementById("id_tipo_miel").length;
    for (let i = 1; i <= num_tipos_miel; i++) {
        $("#id_tipo_miel option[value="+i+"]").removeAttr("selected");
    }
    $("#id_tipo_miel option[value="+id_tipo_miel+"]").attr("selected",true);

    var num_tamanos_frascos = document.getElementById("id_tamano_frasco").length;
    for (let i = 1; i <= num_tamanos_frascos; i++) {
        $("#id_tamano_frasco option[value="+i+"]").removeAttr("selected");
    }
    $("#id_tamano_frasco option[value="+id_tamano_frasco+"]").attr("selected",true);

  $("#producto").val(producto);
  $("#precio").val(precio);
  $("#producto").focus();


  $("#id_producto").val(id_producto);
  $("#frmProductos").attr("data-action", "editar");

}

function generar_codigo(id_producto) {
  $("#bar_code_"+id_producto).JsBarcode(id_producto,{displayValue:true, fontSize:20});

  // $.ajax({
  //   url: "generar_codigo.php",
  //   type: "POST",
  //   dataType: "html",
  //   data: $(this).serialize(),
  //   success: function (respuesta) {

  //     swal.fire("Éxito", "Se ha generado el codigo de barras del producto :)", "success");

  //     llenar_tabla();
  //   },
  //   error: function (respuesta_error) {
  //     swal.fire("Error", "Ha ocurrido un error :(", "error");
  //   },
  // });

}

function cancelar() {
  $("#titulo_formulario").text(" Nuevo producto");
  $("#id_producto").val("");
  $("#frmProductos").attr("data-action", "agregar");
  $().val("");
}
