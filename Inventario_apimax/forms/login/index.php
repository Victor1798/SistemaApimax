<?php
  include "../../conexion/conexion.php";
  include "../../seguridad/verificar_sesion_login.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>INVENTARIO APIMAX</title>
  <link rel="icon" href="../../dist/img/graduation-hat.png" type="image/png"/>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.min.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<style type="text/css">
  body {
    background-image: url("../../dist/img/panel_colmena.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 85%;
    background-position: 0px 130px;
    }
</style>

<body class="hold-transition" style="margin-top: 150px; padding-top: 50px; padding-bottom: 0px;">

  <!-- JUMBOTRON CON INFORMACION  -->
  <div class="jumbotron jumbotron-fluid bg-white elevation-2 pt-3 pb-3 fixed-top" style="height: 130px;">
    <div class="container h-100 w-100 d-flex align-items-center">
      <a href="#" class="d-inline-block mr-2">
        <img src="../../dist/img/logooficial.png" class="img-responsive" style="height: 100px; width: 90px; border-radius: 7px 12px">
      </a>
      <a href="#" class="text-dark d-inline-block border-left border-dark pl-2" style="font-size: 35px;">
        <h1>APIMAX</h1>
      </a>
      <br>
    </div>
  </div>
  <!-- FIN -->

  <!--CAJA INICIO DE SESION -->
  <div class="login-box" style="position: relative; margin-left: auto; margin-right: auto;">
    <!-- LOGO -->
    <div class="login-logo">
      <a href="index.php"><b class="text-white font-weight-bolder" style="font-size: 35px;">INVENTARIO</b><b class="text-warning font-weight-bolder" style="font-size: 35px;"> APIMAX</b></a>
    </div>
    <!-- FIN LOGO -->
    <!-- CARD -->
    <div class="card elevation-3" style="">
      <!-- CARD BODY -->
      <div class="card-body login-card-body" style="border-radius: 7px 12px; border-color: yellow;">
        <p class="login-box-msg" style="font-size: 22px;">Inicio de sesión</p>

        <form action="POST" id="form_credenciales">
          <div class="input-group mb-3">
            <input value="vic17" type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="Usuario" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">Recordar contraseña</label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
            <button type="submit" id="verificar" class="btn btn-warning btn-block"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Iniciar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <br>
        <p class="mb-1 ">
          <a href="#">¿Has olvidado tu contraseña?</a>
        </p>
      <!-- FIN CARD BODY -->
      </div>
    </div>
    <!-- FIN CARD -->
  </div> 
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- JS para Sweetalert -->
  <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

  <script>   
    $(function(){
     $("#verificar").click(function(){


     var url = "../../validar_usuario.php"; 
        $.ajax({
               type:"POST",
               url: url,
               data: $("#form_credenciales").serialize(),
               success: function(respuesta)
               {
                if (respuesta=="1") {
                  swal.fire("Lo sentimos","El usuario o la contrase&ntilde;a son incorrectas","error");
                }
                else if(respuesta=="2"){
                  window.location="../principal/index.php";
                  $(":text").val(''); 
                }
                $(":password").val(''); 
               }
             });
        return false;
     });
    });
  </script>


</body>
</html>
