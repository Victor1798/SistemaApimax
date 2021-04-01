$("#btnEnviar").click(function () {
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_inicio").val();

  if (fecha_inicio != "" && fecha_fin != "")
  {
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
          url: "tabla.php",
          dataSrc: "",
        },
        columns: [
          {
            data: "id_desperdicio",
          },
          {
            data: "id_producto",
          },
          {
            data: "id_lote",
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

function cargar_tabla() {
  // fecha
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
      url: "tabla.php",
      dataSrc: "",
    },
    columns: [
      {
        data: "id_desperdicio",
      },
      {
        data: "id_producto",
      },
      {
        data: "id_lote",
      },
      {
        data: "cantidad_desperdiciada",
      },
      {
        data: "descripcion",
      },
      {
        data: "fecha",
      },
      {
        data: "precio",
      },
      {
        data: "total",
      },
      {
        data: "estado",
      },
      {
        data: "editar",
      },
    ],
  });
}

