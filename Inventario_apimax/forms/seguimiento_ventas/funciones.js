function cargar_tabla() {
  // fecha
  var fecha_actual = new Date();
  var yyyy = fecha_actual.getFullYear();
  var mm = fecha_actual.getMonth() + 1;
  var dd = fecha_actual.getDate();
  var fecha = dd + "-" + mm + "-" + yyyy;

  $("#tabla_ventas").dataTable().fnDestroy();
  $("#tabla_ventas").DataTable({
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
      url: "tabla.php",
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
        data: "fecha_venta",
      },
      {
        data: "total",
      },
      {
        data: "dinero_descontado",
      },
      {
        data: "estado",
      },
    ],
  });
}

function cargar_tabla_detalles(id_venta) {
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
        title: "APIMAX - Detalle de venta" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "APIMAX - Detalle de venta" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "print",
        text: "Imprimir",
        title: "APIMAX - Detalle de venta" + " " + fecha,
        exportOptions: {
          columns: ":visible",
        },
      },
    ],
    ajax: {
      type: "POST",
      url: "tabla_detalles.php?id_venta=" + id_venta,
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
        data: "dinero_descontado",
      },
      {
        data: "estado_pago",
      },
    ],
  });
  // cargar_tabla();
}

function cargar_detalles(id_venta) {
  cargar_tabla_detalles(id_venta);
}

function cambiar_estado_modal(id_detalle_venta, estado_pago, id_venta) {
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
        calcular_estado(id_venta)
        cargar_tabla_detalles(id_venta);

          Swal.fire("Hecho", response, "success");
        },
        error: function (error) {
          Swal.fire("Error", error, "error");
        },
      });
    }
  });
}

function calcular_estado(id_venta)  {
  var url = "consulta_estado_venta.php";

  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: {
      id_venta: id_venta,
    },
    success: function (response) {
      var array = eval(response);
      // alert(array[0]);
      cambiar_estado_general(id_venta, array[0]);
    },
    error: function (error) {
      Swal.fire("Error", error, "error");
    },
  });
}

function cambiar_estado_general(id_venta, estado_pago) {
  var url1 = "actualizar_estado.php";

  $.ajax({
    url: url1,
    type: "POST",
    dataType: "html",
    data: { id_venta: id_venta, estado_pago: estado_pago},
    success: function (response) {
      cargar_tabla(id_venta);

    },
  });
}
