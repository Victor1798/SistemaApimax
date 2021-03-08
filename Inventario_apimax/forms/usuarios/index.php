<?php
include '../../conexion/conexion.php';
include '../../seguridad/verificar_sesion_inicio.php';

$personas = $conexion->prepare("SELECT id_persona, CONCAT(nombre,' ', ap_paterno,' ',ap_materno) AS Nombre_full
FROM personas
WHERE activo = 1");
$personas->execute();

?>
<!DOCTYPE html>
<html>

<!-- Head -->
<?php include '../../head.php'; ?>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-yellow navbar-light ">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../principal/index.php" class="nav-link">Inicio</a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-slide="true" href="../../cerrar_sesion.php" role="button">
            <i class="fas fa-sign-out-alt"></i> Salir
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../../dist/img/logo_apimax.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b> APIMAX</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar ">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-1 mb-1 d-flex">
          <div class="image pt-2">
            <img src="../../dist/img/usuario.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <!-- <a href="#" class="d-block">Nombre usuario</a> -->
            <a href="#" class="d-block"><?php echo $_SESSION["apimax_nombre_persona"]; ?></a>
            <span id="tipo_user" class="d-block text-warning"><?php echo $_SESSION["apimax_tipo_usuario"]; ?></span>

          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 sidebar-dark">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../principal/index.php" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Menu Principal</p>
              </a>
            </li>
            <li id="modulo_modulos" class="nav-item has-treeview menu-close" hidden>
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Modulos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../tipos_miel/index.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipos de miel</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../tamanos_frascos/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tamaños de frascos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../productos/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../apiarios/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Apiarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../ubicaciones/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ubicaciones</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../lotes/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lotes</p>
                  </a>
                </li>
              </ul>
            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  Ventas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../entradas/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Entradas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../ventas/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ventas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../salidas_forzosas/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salidas forzosas</p>
                  </a>
                </li>
              </ul>
            <li id="modulo_usuarios" class="nav-item has-treeview menu-open" hidden>
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Personas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../personas/index.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Personas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../usuarios/index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../clientes/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>
              </ul>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Personas</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- div de columnas -->
          <div class="col-sm-12 col-md-12 col-lg-12">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h2 class="card-title" id="titulo_formulario"> Nuevo usuario</h2>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div id="formUsuarios" class="card-body">
                <form action="#" method="POST" id="frmUsuarios" data-action="agregar">
                  <input type="hidden" name="id_usuario" id="id_usuario">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="tipo_user">Tipo de usuario:</label>
                        <select id="tipo_user" name="tipo_user" class="form-control" required title="Solo el tipo de usuario de Administrador puede accesar al modulo de Usuarios">
                          <option value="Administrador">Administrador</option>
                          <option value="Basico">Basico</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-12 col-md-8">
                        <label for="id_persona">Nombre de persona:</label>
                        <select name="id_persona" id="id_persona" class="form-control" required>
                          <?php
                          while ($row = $personas->fetch(PDO::FETCH_NUM)) {
                          ?>
                            <option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?> </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="usuario">Usuario:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa el nombre de usuario..." required>
                        </div>
                      </div>
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="pass">Contraseña:</label>
                        <div class="input-group mb-3">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          <input type="password" id="pass" name="pass" class="form-control" placeholder="Ingresa la contraseña..." required>
                        </div>
                      </div>
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="re_pass">Verifica contraseña:</label>
                        <div class="input-group mb-3">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          <input type="password" id="re_pass" name="re_pass" class="form-control" placeholder="Repite la contraseña..." required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="reset" id="btnCancelar" class="btn btn-secondary" onclick="cancelar();"><i class="nav-icon fas fa-times"></i> Cancelar</button>
                    <button type="submit" id="btnEnviar" class="btn btn-warning float-right"><i class="nav-icon fas fa-check"></i> Aceptar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Tabla----------------------------------------------------------------------------------------------------------------------------------------- -->
          <div class="col-md-12">
            <div class="card card-warning">
              <div class="card-header ">
                <h4 class="card-title"><i class="fas fa-stream"></i> Tabla de usuarios</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <div class="col-md-7">
                      </div>
                      <div class="input-group mb-3 col-md-5 float-right">
                        <input type="text" class="form-control pull-right" style="width:25%" id="search" placeholder="Buscar...">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-search"></span>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:25%" id="search" placeholder="Buscar...">
                  </div>    -->
                      <table id="tabla_usuarios" class="table table-bordered table-striped">
                        <thead class="text-center">
                          <tr>
                            <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Nombre del usuario</th>
                            <th class="bg-gradient-warning">Tipo usuario</th>
                            <th class="bg-gradient-warning">Usuario</th>
                            <th class="bg-gradient-warning">Contraseña</th>
                            <th class="bg-gradient-warning" hidden>Rep contraseña</th>
                            <th class="bg-gradient-warning">Estado</th>
                            <th class="bg-gradient-warning">Editar</th>
                          </tr>
                        </thead>
                        <tbody class="" id="cuerpo_tabla">

                        </tbody>
                        <tfoot class="text-center">
                          <tr>
                            <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Nombre del usuario</th>
                            <th class="bg-gradient-warning">Tipo usuario</th>
                            <th class="bg-gradient-warning">Usuario</th>
                            <th class="bg-gradient-warning">Contraseña</th>
                            <th class="bg-gradient-warning" hidden>Rep contraseña</th>
                            <th class="bg-gradient-warning">Estado</th>
                            <th class="bg-gradient-warning">Editar</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>

  </div>
  <!-- ./wrapper -->
  <?php include '../../scripts.php'; ?>

  <script type="text/javascript" src="funciones.js"></script>
  <script type="text/javascript">
    $(document).ready(function(e) {

      llenar_tabla();

      var tipo_user = $("#tipo_user").text();

      if (tipo_user == 'Administrador') {
        $("#modulo_modulos").removeAttr("hidden");
        $("#modulo_usuarios").removeAttr("hidden");
      } else {
        $("#modulo_modulos").attr("type", "hidden");
        $("#modulo_usuarios").attr("type", "hidden");
      }
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#search").keyup(function() {
        _this = this;
        $.each($("#tabla_usuarios tbody tr"), function() {
          if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
          else
            $(this).show();
        });
      });
    });
  </script>

</body>

</html>