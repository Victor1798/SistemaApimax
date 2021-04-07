$("#btnEnviarCliente").click(function () {
  var id_cliente = $("#id_cliente").val();
  // alert(id_cliente);
  if (id_cliente != "") {
    var url = "guardar_cliente.php";

    $.ajax({
      url: url,
      type: "POST",
      dataType: "html",
      data: $("#frmVentas").serialize(),
      success: function (response) {
        Swal.fire("Hecho", "Cliente seleccionado, genera la venta", "success");
        // $("#id_venta")[0].reset();
        llenarVentas();
        // cargar_tabla(id_cliente);

        $("#frmVentas")[0].reset();
        $("#id_venta_cliente").val("");
        $("#titulo_formulario1").text(" Nueva venta");
      },
      error: function (error) {
        Swal.fire("Error", error, "error");
      },
    });
  } else {
    Swal.fire("Advertencia", "Favor de seleccionar un cliente", "warning");
  }
  $("#info_venta").removeAttr("hidden");
  $("#id_producto").focus();
});

$("#btnCancelarCliente").click(function () {
  $("#titulo_formulario1").text(" Nueva venta");
  $("#titulo_formulario2").text(" Información de venta");

  $("#id_venta_cliente").val("");
  $("#id_detalle_venta").val("");

  $("#frmVentas")[0].reset();
  $("#frmDetalleVentas")[0].reset();

  $("#info_venta").attr("hidden", true);
  $("#info_table").attr("hidden", true);
});

$("#btnCancelar").click(function () {
  $("#titulo_formulario2").text(" Información de venta");

  $("#id_detalle_venta").val("");
  $("#id_producto").val(1);
  $("#id_lote").val(1);
  $("#tipo_venta").val("Contado");
  $("#estado_pago").val(1);
  $("#fecha_pago").val("");
  $("#cantidad").val("");
  $("#descuento_pesos").val("");
  $("#descuento_porcen").val("");
  $("#descuento_pesos").removeAttr("readonly");
  $("#descuento_porcen").removeAttr("readonly");
  $("#precio").val("");
  $("#precio_oculto").val("");

  $("#total").val("");
});

$("#btnEnviar").click(function () {
  var id_venta = $("#id_venta").val();
  var id_producto = $("#id_producto").val();
  var id_lote = $("#id_lote").val();
  var tipo_venta = $("#tipo_venta").val();
  var estado_pago = $("#estado_pago").val();
  var fecha = $("#fecha").val();
  var cantidad = $("#cantidad").val();
  var precio = $("#precio").val();
  var total = $("#total").val();

  // alert(id_venta +" "+ id_producto+" "+ id_lote+" "+tipo_venta+" "+estado_pago+" "+fecha+" "+cantidad+" "+ precio)

  if (
    id_venta != "" &&
    id_producto != "" &&
    id_lote != "" &&
    tipo_venta != "" &&
    estado_pago != "" &&
    cantidad != "" &&
    precio != ""
  ) {
    var url = "guardar.php";

    var titulo = $("#titulo_formulario2").text();

    $.ajax({
      url: url,
      type: "POST",
      dataType: "html",
      data: $("#frmDetalleVentas").serialize(),
      success: function (response) {
        if (titulo == " Información de venta") {
          swal.fire("Éxito", "Venta agregada", "success");
        } else {
          swal.fire("Éxito", "Venta editada", "success");
        }
        cargar_tabla(id_venta);
        $("#info_table").removeAttr("hidden");

        $("#id_detalle_venta").val("");
        $("#id_producto").val(1);
        $("#id_lote").val(1);
        $("#tipo_venta").val("Contado");
        $("#estado_pago").val(1);
        $("#fecha_pago").val("");
        $("#cantidad").val("");
        $("#descuento_pesos").val("");
        $("#descuento_porcen").val("");
        $("#descuento_pesos").removeAttr("readonly");
        $("#descuento_porcen").removeAttr("readonly");
        $("#precio").val("");
        $("#precio_oculto").val("");
        $("#total").val("");
        $("#titulo_formulario2").text(" Información de venta");
      },
      error: function (error) {
        Swal.fire("Error", error, "error");
      },
    });
  } else {
    Swal.fire(
      "Advertencia",
      "Favor de llenar los campos que se piden",
      "warning"
    );
  }
});

function cargar_tabla(id_venta) {
  var fecha_actual = new Date();
  var yyyy = fecha_actual.getFullYear();
  var mm = fecha_actual.getMonth() + 1;
  var dd = fecha_actual.getDate();
  var fecha = dd + "-" + mm + "-" + yyyy;

  $("#tabla_detalle_ventas").dataTable().fnDestroy();
  $("#tabla_detalle_ventas").DataTable({
    language: {
      url: "../../plugins/datatables/Spanish.json",
      searchPlaceholder: "Buscar...",
    },
    paging: true,
    dom: "Bfrtip",
    buttons: [
      "pageLength",
      {
        extend: "excel",
        text: "Excel",
        title: "APIMAX - Ventas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "APIMAX - Ventas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "print",
        text: "Imprimir",
        title: "APIMAX - Ventas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
    ],
    ajax: {
      type: "POST",
      url: "tabla.php?id_venta=" + id_venta,
      dataSrc: "",
    },
    columns: [
      {
        data: "id_detalle_venta",
      },
      {
        data: "id_producto",
      },
      {
        data: "id_lote",
      },
      {
        data: "tipo_venta",
      },
      {
        data: "fecha_pago",
      },
      {
        data: "cantidad",
      },
      {
        data: "descuento_pesos",
      },
      {
        data: "descuento_porcen",
      },
      {
        data: "precio",
      },
      {
        data: "total",
      },
      {
        data: "estado_pago",
      },
      {
        data: "editar",
      },
      {
        data: "eliminar",
      },
    ],
  });
}

function editar(id_detalle_venta) {
  $("#info_venta").removeAttr("hidden");

  $("#titulo_formulario2").text(" Editar información de venta");

  var url = "datos.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_detalle_venta: id_detalle_venta },
    success: function (response) {
      var array = eval(response);

      $("#id_detalle_venta").val(array[0]);
      $("#id_venta").val(array[1]);
      $("#id_producto").val(array[2]);
      $("#id_lote").val(array[3]);
      $("#tipo_venta").val(array[4]);
      $("#estado_pago").val(array[5]);
      $("#fecha_pago").val(array[6]);
      $("#cantidad").val(array[7]);
      $("#descuento_pesos").val(array[8]);
      $("#descuento_porcen").val(array[9]);
      $("#precio").val(array[10]);
      $("#total").val(array[11]);
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function calcular_precio() {
  var id_producto = $("#id_producto").val();
  // alert(id_producto);

  var cantidad = $("#cantidad").val();
  var descuento_pesos = $("#descuento_pesos").val();
  var descuento_porcen = $("#descuento_porcen").val();

  var total;

  var url = "calc_precio.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_producto: id_producto },
    success: function (response) {
      var array = eval(response);
      $("#precio").val(array[2]);
      var precio = array[2];

      if (descuento_pesos != "") {
        $("#cantidad").keyup(function () {
          $("#total").val("");

          var cantidad = $("#cantidad").val();
          var descuento_pesos = $("#descuento_pesos").val();
          var total;

          operacion_descuento = precio - descuento_pesos;
          total = operacion_descuento * cantidad;
          $("#total").val(total);
          $("#precio_oculto").val(operacion_descuento);
        });
        $("#descuento_pesos").keyup(function () {
          $("#total").val("");

          var cantidad = $("#cantidad").val();
          var descuento_pesos = $("#descuento_pesos").val();
          var total;

          operacion_descuento = precio - descuento_pesos;
          total = operacion_descuento * cantidad;
          $("#total").val(total);
          $("#precio_oculto").val(operacion_descuento);
        });
      } else if (descuento_porcen != "") {
        $("#cantidad").keyup(function () {
          $("#total").val("");

          var cantidad = $("#cantidad").val();
          var descuento_porcen = $("#descuento_porcen").val();
          var total;

          precio_desc = precio / 100;

          operacion_desc = precio_desc * descuento_porcen;
          precio_descuento = precio - operacion_desc;

          total = precio_descuento * cantidad;
          $("#total").val(total);
          $("#precio_oculto").val(precio_descuento);
        });
        $("#descuento_porcen").keyup(function () {
          $("#total").val("");

          var cantidad = $("#cantidad").val();
          var descuento_porcen = $("#descuento_porcen").val();
          var total;

          precio_desc = precio / 100;

          operacion_desc = precio_desc * descuento_porcen;
          precio_descuento = precio - operacion_desc;

          total = precio_descuento * cantidad;
          $("#total").val(total);
          $("#precio_oculto").val(precio_descuento);
        });
      } else {
        $("#cantidad").keyup(function () {
          $("#total").val("");
          var cantidad = $("#cantidad").val();
          var total;

          total = array[2] * cantidad;
          $("#total").val(total);
          $("#precio_oculto").val(precio);
        });
      }
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function pesos_porcentaje() {
  var descuento_pesos = $("#descuento_pesos").val();
  var descuento_porcen = $("#descuento_porcen").val();

  if (descuento_pesos == "" && descuento_porcen == "") {
    $("#descuento_pesos").removeAttr("readonly");
    $("#descuento_porcen").removeAttr("readonly");
  } else if (descuento_pesos == "") {
    $("#descuento_pesos").attr("readonly", true);
    $("#descuento_porcen").removeAttr("readonly");
  } else {
    $("#descuento_porcen").attr("readonly", true);
    $("#descuento_pesos").removeAttr("readonly");
  }
}

function llenarVentas() {
  $.ajax({
    url: "llenar_ventas.php",
    type: "POST",
    dataType: "html",
    success: function (datos) {
      if (datos == "sin-datos") {
        var sinValor = "<option value='1'>No hay ventas registradas</option>";
        $("#id_venta").html(sinValor);
      } else {
        $("#id_venta").html(datos);
        console.log(datos);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function llenarProductos() {
  $.ajax({
    url: "llenar_productos.php",
    type: "POST",
    dataType: "html",
    success: function (datos) {
      if (datos == "sin-datos") {
        var sinValor =
          "<option value='1'>No hay productos registrados</option>";
        $("#id_producto").html(sinValor);
      } else {
        $("#id_producto").html(datos);
        console.log(datos);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}
function llenarLotes() {
  $.ajax({
    url: "llenar_lotes.php",
    type: "POST",
    dataType: "html",
    success: function (datos) {
      if (datos == "sin-datos") {
        var sinValor = "<option value='1'>No hay lotes registrados</option>";
        $("#id_lote").html(sinValor);
      } else {
        $("#id_lote").html(datos);
        console.log(datos);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function eliminar(id_detalle_venta, id_venta) {
  Swal.fire({
    title: "Eliminar",
    text: "El producto será eliminado de la venta ¿Desea continuar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "SI",
    cancelButtonText: "NO",
  }).then((result) => {
    if (result.value) {
      var url = "eliminar.php";

      $.ajax({
        url: url,
        type: "POST",
        dataType: "html",
        data: { id_detalle_venta: id_detalle_venta },
        success: function (response) {
          cargar_tabla(id_venta);
          Swal.fire("Hecho", response, "success");
        },
        error: function (error) {
          Swal.fire("Error", error, "error");
        },
      });
    }
  });
}
function cambiar_estado(id_detalle_venta, estado_pago, id_venta) {
  Swal.fire({
    title: "Cambiar estado",
    text: "¿El producto ha sido pagado?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "SI",
    cancelButtonText: "NO",
  }).then((result) => {
    if (result.value) {
      var url = "estado_pago.php";

      $.ajax({
        url: url,
        type: "POST",
        dataType: "html",
        data: { id_detalle_venta: id_detalle_venta, estado_pago: estado_pago },
        success: function (response) {
          cargar_tabla(id_venta);
          Swal.fire("Hecho", response, "success");
        },
        error: function (error) {
          Swal.fire("Error", error, "error");
        },
      });
    }
  });
}
