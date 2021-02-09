$("#frmUsuarios").submit(function(e){
    var accion = $(this).attr("data-action");
    var url = "";

    var contra = $("#pass").val();
    var contra2 = $("#re_pass").val();

    if (contra == contra2) {
        if(accion == "agregar")
        {
            url ="guardar.php";
        }
        else if(accion == "editar")
        {
            url="actualizar.php";
        }
        $.ajax
        ({
            url:url,
            type:"POST",
            dataType:"html",
            data: $(this).serialize(),
            success:function(respuesta)
            {
                // alert(respuesta);

                if (accion == "agregar") {
                    swal.fire("Éxito","Registro agregado correctamente :)","success");
                }
                else if(accion == "editar")
                {
                    swal.fire("Éxito","Registro editado correctamente :)","success");
                }
                accion = $(this).attr("data-action");
                $("#titulo_formulario").text(" Nuevo usuario");

                $("#nombre").val("");
                $("#ap_paterno").val("");
                $("#ap_materno").val("");
                $("#fecha_nac").val("");
                $("#direccion").val("");
                $("#correo").val("");
                $("#telefono").val("");
                $("#tipo_user").val("");
                $("#usuario").val("");
                $("#pass").val("");
                $("#re_pass").val("");
                $("#id_usuario").val("");
                $("#frmUsuarios").attr("data-action","agregar");

                llenar_tabla();
            },
            error:function(respuesta_error)
            {
                swal.fire("Error","Ha ocurrido un error :(","error");

            }
        });
    //  ---
    }
    else{
        swal.fire("Lo sentimos","Las contraseñas no coinciden","error");
        $("#re_pass").focus();
    }
    e.preventDefault();
    return false;
 });

function llenar_tabla()
{
    $.ajax({
        url:"tabla.php",
        type:"GET",
        dataType:"html",
        success:function(tabla)
        {
          $("#cuerpo_tabla").html(tabla);
        },
        error:function(error_tabla)
        {
            alert("Error en la tabla :(");
        }
    });
}

function editar(id_usuario)
{
    $("#titulo_formulario").text(" Editar usuario");

    var fila = $("#usuario_" + id_usuario);
    var nombre = $(fila).find(".nombre").html();
    var ap_paterno = $(fila).find(".ap_paterno").html();
    var ap_materno = $(fila).find(".ap_materno").html();
    var fecha_nac = $(fila).find(".fecha_nac").html();
    var direccion = $(fila).find(".direccion").html();
    var correo = $(fila).find(".correo").html();
    var telefono = $(fila).find(".telefono").html();
    var usuario = $(fila).find(".usuario").html();
    var tipo_user = $(fila).find(".tipo_user").html();
    var pass = $(fila).find(".pass").html();
    var re_pass = $(fila).find(".re_pass").html();


    $("#nombre").val(nombre);
    $("#ap_paterno").val(ap_paterno);
    $("#ap_materno").val(ap_materno);
    $("#fecha_nac").val(fecha_nac);
    $("#direccion").val(direccion);
    $("#correo").val(correo);
    $("#telefono").val(telefono);
    $("#usuario").val(usuario);
    $("#tipo_user").val(tipo_user);
    $("#pass").val(pass);
    $("#re_pass").val(re_pass);
    $("#nombre").focus();

    $("#id_usuario").val(id_usuario);
    $("#frmUsuarios").attr("data-action","editar");

}
function cancelar()
{
    $("#titulo_formulario").text(" Nuevo usuario");
    $("#id_usuario").val("");
    $("#frmUsuarios").attr("data-action","agregar");
    $().val("");
}


