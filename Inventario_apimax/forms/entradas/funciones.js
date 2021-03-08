$("#btnEnviar").click(function () {
  var id_producto = $("#id_producto").val();
  var id_lote = $("#id_lote").val();
  var cantidad = $("#cantidad").val();
  var precio = $("#precio").val();
  var fecha_entrada = $("#fecha_entrada").val();

  if (
    id_producto != "" &&
    id_lote != "" &&
    cantidad != "" &&
    precio != "" &&
    fecha_entrada != ""
  ) {
    var url = "guardar.php";

    $.ajax({
      url: url,
      type: "POST",
      dataType: "html",
      data: $("#frmEntradas").serialize(),
      success: function (response) {
        swal.fire("Éxito", "Registro agregado correctamente :)", "success");
        cargar_tabla();
        $("#frmEntradas")[0].reset();
        $("#id_entrada").val("");
        $("#titulo_formulario").text(" Nueva entrada");
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

$("#btnCancelar").click(function () {
  $("#titulo_formulario").text(" Nueva entrada");

  $("#id_entrada").val("");
  $("#frmEntradas")[0].reset();
});

function cargar_tabla() {
  $("#tabla_entradas").dataTable().fnDestroy();
  $("#tabla_entradas").DataTable({
    language: {
      url: "Spanish.json",
      searchPlaceholder: "Buscar...",
    },
    paging: false,
    dom: "Bfrtip",
    buttons: [
      {
        extend: "pageLength",
        text: "Registros",
        className: "btn btn-default",
      },
      {
        extend: "excel",
        text: "Exportar a EXCEL",
        className: "btn btn-default",
        title: "PlantasEXCEL",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pdf",
        text: "Exportar a PDF",
        className: "btn btn-default",
        title: "PlantasPDF",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        text: "Copiar",
        className: "btn btn-default",
        copySuccess: {
          _: "%d lignes copiées",
          1: "1 ligne copiée",
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
      {
        data: "estado",
      },
      {
        data: "editar",
      },
    ],
  });
}

function editar(id_entrada) {
  $("#titulo_formulario").text(" Editar entrada");

  var url = "datos.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_entrada: id_entrada },
    success: function (response) {
      var array = eval(response);

      $("#id_entrada").val(array[0]);
      $("#id_producto").val(array[1]);
      $("#id_lote").val(array[2]);
      $("#cantidad").val(array[3]);
      $("#precio").val(array[4]);
      $("#fecha_entrada").val(array[8]);
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}
function cambiar_estado(id_entrada) {
  var url = "estado.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_entrada: id_entrada },
    success: function (response) {
      cargar_tabla();
      Swal.fire("Hecho", response, "success");
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

$("#id_producto").change(function () {
  var id_producto = this.value;

  var url = "calc_precio.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_producto: id_producto },
    success: function (response) {
      var array = eval(response);
      $("#precio").val(array[2]);
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });

});
