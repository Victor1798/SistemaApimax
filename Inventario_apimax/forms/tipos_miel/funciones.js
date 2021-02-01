$("#frmTipoMiel").submit(function(e){
    var accion = $(this).attr("data-action");
    var url = "";

    var tipo_miel = $("#tipo_miel").val();
    

    if (tipo_miel) {
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


                $("#titulo_formulario").text(" Nuevo tipo de miel");
                $("#tipo_miel").val("");
               
                
                $("#id_tipo_miel").val("");
                $("#frmTipoMiel").attr("data-action","agregar");

                llenar_tabla();
            },
            error:function(respuesta_error)
            {
                swal.fire("Error","Ha ocurrido un error :(","error");

            }
        });
    //  ---
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

function editar(id_tipo_miel)
{
    $("#titulo_formulario").text(" Editar tipo de miel");

    var fila = $("#tipo_miel_" + id_tipo_miel);
    var tipo_miel = $(fila).find(".tipo_miel").html();
    

    $("#tipo_miel").val(tipo_miel);
    

    $("#id_tipo_miel").val(id_tipo_miel);
    $("#frmTipoMiel").attr("data-action","editar");

    $("#tipo_miel").focus();
    
}
function cancelar()
{
    $("#titulo_formulario").text(" Nuevo tipo de miel");
    $("#id_tipo_miel").val("");
    $("#frmTipoMiel").attr("data-action","agregar");
    $().val("");
}