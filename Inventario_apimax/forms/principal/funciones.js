function modulo_usuarios() {
  var tipo_user = $("#tipo_user").val();

  if (tipo_user != "Administrador") {
    $("#modulo_usuarios").attr("type", "hidden");
  } else if (tipo_user == "Administrador") {
    $("#modulo_usuarios").removeAttr("hidden");
  }
}
