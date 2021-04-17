$("#btnEnviar").click(function () {
  var fecha1 = $("#fecha_inicio").val();
  var fecha2 = $("#fecha_fin").val();

  calcular_totales(fecha1, fecha2);
  calcular_productos(fecha1, fecha2);
  calcular_desperdicios(fecha1, fecha2);
  calcular_ingresos(fecha1, fecha2);
  calcular_descuentos(fecha1, fecha2);

  if (fecha1 != "" && fecha2 != "") {
    $("#info_reportes").removeAttr("hidden");
    // $("#info_reportes_entradas").removeAttr("hidden");
    $("#info_totales").removeAttr("hidden");

    var fecha_actual = new Date();
    var yyyy = fecha_actual.getFullYear();
    var mm = fecha_actual.getMonth() + 1;
    var dd = fecha_actual.getDate();
    var fecha = dd + "-" + mm + "-" + yyyy;

    $("#tabla_reportes").dataTable().fnDestroy();
    $("#tabla_reportes").DataTable({
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
          title: "APIMAX - Reporte del" + " " + fecha,
          exportOptions: {
            columns: ":visible",
          },
        },
        {
          extend: "pdf",
          text: "PDF",
          title: "APIMAX - Reporte del" + " " + fecha,
          exportOptions: {
            columns: ":visible",
          },
        },
        {
          extend: "print",
          text: "Imprimir",
          title: "APIMAX - Reporte del" + " " + fecha,
          exportOptions: {
            columns: ":visible",
          },
        },
      ],
      ajax: {
        type: "POST",
        url: "tabla.php?fecha_inicio=" + fecha1 + "&fecha_fin=" + fecha2,
        dataSrc: "",
      },
      columns: [
        {
          data: "id_venta",
        },
        {
          data: "id_cliente",
        },
        {
          data: "estado_pago",
        },
        {
          data: "fecha_venta",
        },
        {
          data: "total",
        },
        {
          data: "dinero_descontado",
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
          data: "cantidad",
        },
        {
          data: "precio",
        },
      ],
    });
  } else {
    Swal.fire(
      "Advertencia",
      "Favor de llenar los campos que se piden!!",
      "warning"
    );
  }
});

$("#btnCancelar").click(function () {
  $("#info_reportes").attr("hidden", true);
  $("#info_totales").attr("hidden", true);
  $("#info_reportes_entradas").attr("hidden", true);
  $("#frmReportes")[0].reset();
});

function cargar_tabla_entradas() {
  var fecha_actual = new Date();
  var yyyy = fecha_actual.getFullYear();
  var mm = fecha_actual.getMonth() + 1;
  var dd = fecha_actual.getDate();
  var fecha = dd + "-" + mm + "-" + yyyy;

  $("#tabla_reportes_entradas").dataTable().fnDestroy();
  $("#tabla_reportes_entradas").DataTable({
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
        title: "APIMAX - Reporte Entradas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "APIMAX - Reporte Entradas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "print",
        text: "Imprimir",
        title: "APIMAX - Reporte Entradas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
    ],
    ajax: {
      type: "POST",
      url: "tabla_entradas.php?fecha_inicio=" + fecha1 + "&fecha_fin=" + fecha2,
      dataSrc: "",
    },
    columns: [
      {
        data: "id_entrada",
      },
      {
        data: "id_producto",
      },
      {
        data: "id_lote",
      },
      {
        data: "cantidad",
      },
      {
        data: "precio",
      },
      {
        data: "cantidad_disponible",
      },
      {
        data: "cantidad_vendida",
      },
      {
        data: "cantidad_desperdiciada",
      },
      {
        data: "fecha_entrada",
      },
    ],
  });
}

function calcular_totales(fecha_inicio, fecha_fin) {
  var url = "calc_totales.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
    success: function (response) {
      var array = eval(response);
      var total_venta = array[0];
      $("#ventas").val(total_venta);
      //alert(total_venta)
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function calcular_productos(fecha_inicio, fecha_fin) {
  var url = "calc_totales_productos.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
    success: function (response) {
      var array = eval(response);
      var total_venta = array[0];
      $("#produccion").val(total_venta);
      //alert(total_venta)
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function calcular_desperdicios(fecha_inicio, fecha_fin) {
  var url = "calc_totales_desperdicios.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
    success: function (response) {
      var array = eval(response);
      var total_desperdicio = array[0];
      $("#desperdicio").val(total_desperdicio);
      //alert(total_desperdicio)
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function calcular_ingresos(fecha_inicio, fecha_fin) {
  var url = "calc_totales_ingresos.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
    success: function (response) {
      var array = eval(response);
      var total_ingresos = array[0];
      $("#ingresos").val(total_ingresos);
      //alert(total_ingresos)
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function calcular_descuentos(fecha_inicio, fecha_fin) {
  var url = "calc_totales_descuentos.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
    success: function (response) {
      var array = eval(response);
      var total_descuentos = array[0];
      $("#descuentos").val(total_descuentos);
      //alert(total_descuentos)
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}
