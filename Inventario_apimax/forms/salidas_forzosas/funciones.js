$("#btnEnviar").click(function () {
  var id_producto = $("#id_producto").val();
  var id_lote = $("#id_lote").val();
  var cantidad_desperdiciada = $("#cantidad_desperdiciada").val();
  var descripcion = $("#descripcion").val();
  var fecha = $("#fecha").val();
  var precio = $("#precio").val();
  var total = $("#total").val();

  if (
    id_producto != "" &&
    id_lote != "" &&
    cantidad_desperdiciada != "" &&
    descripcion != "" &&
    fecha != "" &&
    precio != "" &&
    total != ""
  ) {
    var url = "guardar.php";

    var titulo = $("#titulo_formulario").text();

    $.ajax({
      url: url,
      type: "POST",
      dataType: "html",
      data: $("#frmSalidas").serialize(),
      success: function (response) {
        if (titulo == " Nueva salida forzosa") {
          swal.fire("Éxito", "Registro agregado correctamente :)", "success");
        } else {
          swal.fire(
            "Éxito",
            "Registro actualizado correctamente :)",
            "success"
          );
        }
        cargar_tabla();
        $("#frmSalidas")[0].reset();
        $("#id_desperdicio").val("");
        $("#titulo_formulario").text(" Nueva salida forzosa");
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
  $("#titulo_formulario").text(" Nueva salida forzosa ");

  $("#id_desperdicio").val("");
  $("#frmSalidas")[0].reset();
});

function cargar_tabla() {
  // fecha
  var fecha_actual = new Date();
  var yyyy = fecha_actual.getFullYear();
  var mm = fecha_actual.getMonth() + 1;
  var dd = fecha_actual.getDate();
  var fecha = dd + "-" + mm + "-" + yyyy;

  $("#tabla_salidas").dataTable().fnDestroy();
  $("#tabla_salidas").DataTable({
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
        title: "APIMAX - Salidas forzosas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "APIMAX - Salidas forzosas" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "print",
        text: "Imprimir",
        title: "APIMAX - Salidas forzosas" + " " + fecha,
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

function editar(id_desperdicio) {
  $("#titulo_formulario").text(" Editar salidas forzosas");

  var url = "datos.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_desperdicio: id_desperdicio },
    success: function (response) {
      var array = eval(response);

      $("#id_desperdicio").val(array[0]);
      $("#id_producto").val(array[1]);
      $("#id_lote").val(array[2]);
      $("#cantidad_desperdiciada").val(array[3]);
      $("#descripcion").val(array[4]);
      $("#fecha").val(array[5]);
      $("#precio").val(array[6]);
      $("#total").val(array[7]);
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}
function cambiar_estado(id_desperdicio) {
  var url = "estado.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: { id_desperdicio: id_desperdicio },
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

  var cantidad_desperdiciada = $("#cantidad_desperdiciada").val();
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

      total = array[2] * cantidad_desperdiciada;

      $("#total").val(total);

      $("#cantidad_desperdiciada").keyup(function () {
        var cantidad_desperdiciada = $("#cantidad_desperdiciada").val();
        var total;

        total = array[2] * cantidad_desperdiciada;
        $("#total").val(total);
        // alert(array[2] + " " + cantidad_desperdiciada + " " + total);
      });
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
});
