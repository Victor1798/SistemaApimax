$("#btnEnviar").click(function () {
  var fecha1 = $("#fecha_inicio").val();
  var fecha2 = $("#fecha_fin").val();
  // var fecha_inicio="fecha_inicio="+fecha1;
  // var fecha_fin="fecha_fin="+fecha2;

  //  llenar_totales(fecha1,fecha2);

  if (fecha1 != "" && fecha2 != "") {
    $("#info_reportes").removeAttr("hidden");

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
        url: "tabla.php?fecha_inicio="+fecha1+"&fecha_fin="+fecha2,
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
          data: "pendiente",
        },
        {
          data: "fecha_registro",
        },
        {
          data: "activo",
        },
        {
          data: "id_detalle_venta",
        },
        {
          data: "id_venta",
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
          data: "estado_pago",
        },
        {
          data: "fecha_pago",
        },
        {
          data: "cantidad",
        },
        {
          data: "descuento",
        },
        {
          data: "precio",
        },
        {
          data: "fecha_registro",
        },
        {
          data: "activo",
        },
      ],
    });
  } else {
    Swal.fire(
      "Advertencia",
      "Favor de llenar los campos que se piden",
      "warning"
    );
  }
});

$("#btnCancelar").click(function () {
  $("#info_reportes").attr("hidden", true);
  $("#frmReportes")[0].reset();
});

function calcular_totales(fecha_inicio, fecha_fin) {

  var url = "calc_totales.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { fecha_inicio: fecha_inicio, fecha_fin:fecha_fin},
    success: function (response) {
      var array = eval(response);
      $("#precio").val(array[2]);
      var precio = array[2];


    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

