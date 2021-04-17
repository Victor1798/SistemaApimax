<?php
include '../../conexion/conexion.php';
include '../../seguridad/verificar_sesion_inicio.php';

?>
<!DOCTYPE html>
<html>

<!-- Head -->
<?php include '../../head.php'; ?>


<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
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
                  <a href="../tipos_miel/index.php" class="nav-link">
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
                <li class="nav-item">
                  <a href="../seguimiento_ventas/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Seguimiento de ventas</p>
                  </a>
                </li>
              </ul>
            <li id="modulo_usuarios" class="nav-item has-treeview menu-close" hidden>
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Personas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../personas/index.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Personas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../usuarios/index.php" class="nav-link">
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
              <li id="modulo_reportes" class="nav-item" hidden>
              <a href="../reportes/index.php" class="nav-link active">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Reportes</p>
              </a>
            </li>
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
              <h1 class="m-0 text-dark">Reportes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Reportes</a></li>
                <li class="breadcrumb-item active">Apimax</li>
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
          <div id="info_combo" class="col-md-12">
            <div class="card card-warning">
              <div class="card-header">
                <h2 class="card-title" id="titulo_combo"><i class="fas fa-sort"></i> Mostrar Reportes</h2>
              </div>
              <div class="card-body">
                <div class="row">
                <div class="form-group col-sm-12 col-md-12">
                        <label for="reportes">Seleccionar los Reportes que se Desean Mostrar:</label>
                        <select id="reportes" name="reportes" class="form-control">
                          <option value="Ventas">Ventas</option>
                          <option value="Entradas">Entradas</option>
                          <option value="Salidas Forzosas">Salidas Forzosas</option>
                        </select>
                      </div>
                </div>
              </div>
            </div>
          </div>
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h2 class="card-title" id="titulo_formulario"><i class="fas fa-search-plus"></i> Filtro de Búsqueda</h2>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div id="formReportes" class="card-body">
                <form action="#" method="POST" id="frmReportes" data-action="agregar">
                  <div class="card-body">
                    <div class="row" id="date_filter">
                      <div class="form-group col-sm-12 col-md-6">
                        <label for="fecha_inicio">Fecha inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" title="Ingresa la fecha de inicio" required>
                      </div>
                      <div class="form-group col-sm-12 col-md-6">
                        <label for="fecha_fin">Fecha fin:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" title="Ingresa la fecha de fin" required>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="reset" id="btnCancelar" class="btn btn-secondary"><i class="nav-icon fas fa-times"></i> Cancelar</button>
                    <button type="button" id="btnEnviar" class="btn btn-warning float-right"><i class="nav-icon fas fa-search"></i> Buscar</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
          <!-- Tabla----------------------------------------------------------------------------------------------------------------------------------------- -->
          <div id="info_reportes" class="col-md-12" hidden>
            <div class="card card-warning">
              <div class="card-header ">
                <h4 class="card-title"><i class="fas fa-cart-arrow-down"></i> Registros de Ventas</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table id="tabla_reportes" class="table table-bordered table-striped">
                        <thead class="text-center">
                          <tr>
                          <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Cliente</th>
                            <th class="bg-gradient-warning">Estado de Pago</th>
                            <th class="bg-gradient-warning">Fecha de Venta</th>
                            <th class="bg-gradient-warning">Total</th>                            
                            <th class="bg-gradient-warning">Descuento</th>
                            <th class="bg-gradient-warning">Producto</th>
                            <th class="bg-gradient-warning">Lote</th>
                            <th class="bg-gradient-warning">Tipo Venta</th>
                            <th class="bg-gradient-warning">Cantidad</th>
                            <th class="bg-gradient-warning">Precio</th>
                          </tr>
                        </thead>
                        <tbody class="text-center" id="cuerpo_tabla">

                        </tbody>
                        <tfoot class="text-center">
                          <tr>
                          <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Cliente</th>
                            <th class="bg-gradient-warning">Estado de Pago</th>
                            <th class="bg-gradient-warning">Fecha de Venta</th>
                            <th class="bg-gradient-warning">Total</th>                            
                            <th class="bg-gradient-warning">Descuento</th>
                            <th class="bg-gradient-warning">Producto</th>
                            <th class="bg-gradient-warning">Lote</th>
                            <th class="bg-gradient-warning">Tipo Venta</th>
                            <th class="bg-gradient-warning">Cantidad</th>
                            <th class="bg-gradient-warning">Precio</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div id="info_reportes_entradas" class="col-md-12" hidden>
            <div class="card card-warning">
              <div class="card-header ">
                <h4 class="card-title"><i class="fas fa-dolly"></i> Registros de Entradas</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table id="tabla_reportes_entradas" class="table table-bordered table-striped">
                        <thead class="text-center">
                        <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Producto</th>
                            <th class="bg-gradient-warning">Lote</th>
                            <th class="bg-gradient-warning">Cantidad</th>
                            <th class="bg-gradient-warning">Precio</th>
                            <th class="bg-gradient-warning">Cantidad disponible</th>
                            <th class="bg-gradient-warning">Cantidad vendida</th>
                            <th class="bg-gradient-warning">Cantidad desperdiciada</th>
                            <th class="bg-gradient-warning">Fecha de entrada</th>
                          </tr>
                        </thead>
                        <tbody class="text-center" id="cuerpo_tabla_entradas">

                        </tbody>
                        <tfoot class="text-center">
                        <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Producto</th>
                            <th class="bg-gradient-warning">Lote</th>
                            <th class="bg-gradient-warning">Cantidad</th>
                            <th class="bg-gradient-warning">Precio</th>
                            <th class="bg-gradient-warning">Cantidad disponible</th>
                            <th class="bg-gradient-warning">Cantidad vendida</th>
                            <th class="bg-gradient-warning">Cantidad desperdiciada</th>
                            <th class="bg-gradient-warning">Fecha de entrada</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div id="info_totales" class="col-md-12" hidden>
            <div class="card card-warning">
              <div class="card-header">
                <h2 class="card-title" id="titulo_total"><i class="fas fa-chart-pie"></i> Totales</h2>
              </div>
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="form-group col-sm-12 col-md-2">
                    <label for="ventas">Ventas:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-shopping-cart"></span>
                        </div>
                      </div>
                      <input type="text" id="ventas" name="ventas" class="form-control" placeholder="Total Ventas" required readonly>
                    </div>
                  </div>
                  <div class="form-group col-sm-12 col-md-2">
                    <label for="produccion">Producción:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-chart-bar"></span>
                        </div>
                      </div>
                      <input type="text" id="produccion" name="produccion" class="form-control" placeholder="Total Producción" required readonly>
                    </div>
                  </div>
                  <div class="form-group col-sm-12 col-md-2">
                    <label for="desperdicio">Desperdicio:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-trash-alt"></span>
                        </div>
                      </div>
                      <input type="text" id="desperdicio" name="desperdicio" class="form-control" placeholder="Total Desperdicio" required readonly>
                    </div>
                  </div>
                  <div class="form-group col-sm-12 col-md-2">
                    <label for="descuentos">Descuentos:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-percent"></span>
                        </div>
                      </div>
                      <input type="text" id="descuentos" name="descuentos" class="form-control" placeholder="Total Descuentos" required readonly>
                    </div>
                  </div>
                  <div class="form-group col-sm-12 col-md-2">
                    <label for="ingresos">Ingresos:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-dollar-sign"></span>
                        </div>
                      </div>
                      <input type="text" id="ingresos" name="ingresos" class="form-control" placeholder="Total Ingresos" required readonly>
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
      var tipo_user = $("#tipo_user").text();

      if (tipo_user == 'Administrador') {
        $("#modulo_modulos").removeAttr("hidden");
        $("#modulo_usuarios").removeAttr("hidden");
        $("#modulo_reportes").removeAttr("hidden");

      } else {
        $("#modulo_modulos").attr("type", "hidden");
        $("#modulo_usuarios").attr("type", "hidden");
        $("#modulo_reportes").attr("type", "hidden");

      }

      $('#tabla_reportes').DataTable()
      cargar_tabla_entradas();

    });
  </script>


</html>