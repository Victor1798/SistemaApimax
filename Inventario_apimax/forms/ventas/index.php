<?php
include '../../conexion/conexion.php';
include '../../seguridad/verificar_sesion_inicio.php';

$clientes = $conexion->prepare("SELECT c.id_cliente, CONCAT(p.nombre,' ', p.ap_paterno,' ', p.ap_materno)AS NameFull,  c.activo
FROM clientes c
INNER JOIN personas p ON c.id_persona = p.id_persona
ORDER BY id_cliente");
$clientes->execute();

$productos = $conexion->prepare("SELECT id_producto, producto, precio FROM productos WHERE activo = 1");
$productos->execute();

$lotes = $conexion->prepare("SELECT id_lote FROM lotes WHERE activo = 1");
$lotes->execute();

// $ventas = $conexion->prepare("SELECT v.id_venta, CONCAT(p.nombre,' ', p.ap_paterno,' ', p.ap_materno)AS NameFull,  v.activo
// FROM ventas v
// INNER JOIN clientes c ON v.id_cliente = c.id_cliente
// INNER JOIN personas p ON c.id_persona = p.id_persona
// ORDER BY id_venta");
// $ventas->execute();

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
            <li class="nav-item has-treeview menu-close menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  Ventas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../entradas/index.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Entradas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../ventas/index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ventas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../salidas_forzosas/index.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salidas forzosas</p>
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
                  <a href="../personas/index.php" class="nav-link ">
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
              <h1 class="m-0 text-dark">Ventas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                <li class="breadcrumb-item active">Ventas</li>
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
                <h2 class="card-title" id="titulo_formulario1"> Nueva venta</h2>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div id="formVentas" class="card-body">
                <form action="#" method="POST" id="frmVentas" data-action="agregar">
                  <input type="hidden" name="id_venta_cliente" id="id_venta_cliente">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-12">
                        <label for="id_cliente">Cliente:</label>
                        <select name="id_cliente" id="id_cliente" class="form-control" required>
                          <?php
                          while ($row_c = $clientes->fetch(PDO::FETCH_NUM)) {
                          ?>
                            <option value="<?php echo $row_c[0]; ?>"><?php echo $row_c[1]; ?> </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <div class="form-group col-sm-12 col-md-12">
                      <button type="reset" id="btnCancelarCliente" class="btn btn-secondary"><i class="nav-icon fas fa-times"></i> Cancelar</button>
                      <button type="button" id="btnEnviarCliente" class="btn btn-warning float-right"><i class="nav-icon fas fa-check"></i> Aceptar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div id="info_venta" class="card card-warning" hidden>
              <div class="card-header">
                <h2 class="card-title" id="titulo_formulario2"> Información de venta</h2>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <!-- form start -->
              <div id="formDetalleVentas" class="card-body">
                <form action="#" method="POST" id="frmDetalleVentas" data-action="agregar">
                  <input type="hidden" name="id_detalle_venta" id="id_detalle_venta">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-12">
                        <label for="id_venta">Venta para:</label>
                        <select name="id_venta" id="id_venta" class="form-control">

                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-6">
                        <label for="id_producto">Producto:</label>
                        <select name="id_producto" id="id_producto" class="form-control" required>
                          <?php
                          while ($row_p = $productos->fetch(PDO::FETCH_NUM)) {
                          ?>
                            <option value="<?php echo $row_p[0]; ?>"><?php echo $row_p[1]; ?> </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-12 col-md-6">
                        <label for="id_lote">Lote:</label>
                        <select name="id_lote" id="id_lote" class="form-control" required>
                          <?php
                          while ($row_l = $lotes->fetch(PDO::FETCH_NUM)) {
                          ?>
                            <option value="<?php echo $row_l[0]; ?>"><?php echo $row_l[0]; ?> </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-6">
                        <label for="tipo_venta">Tipo de venta:</label>
                        <select name="tipo_venta" id="tipo_venta" class="form-control" required>
                          <option value="Contado">Contado</option>
                          <option value="Consigna">Consigna</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-12 col-md-3">
                        <label for="estado_pago">Estado de pago:</label>
                        <select name="estado_pago" id="estado_pago" class="form-control" required>
                          <option value="Pagado">Pagado</option>
                          <option value="No pagado">No pagado</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-12 col-md-3">
                        <label for="fecha_pago">Fecha:</label>
                        <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" title="Ingresa la fecha...." required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="cantidad">Cantidad de productos:</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingresa la cantidad..." required>
                      </div>
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="precio">Precio:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                          </div>
                          <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio del producto..." step="any" required readonly>
                        </div>
                      </div>
                      <div class="form-group col-sm-12 col-md-4">
                        <label for="total">Total:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                          </div>
                          <input type="number" class="form-control" id="total" name="total" placeholder="..." step="any" required readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="button" id="btnCancelar" class="btn btn-secondary"><i class="nav-icon fas fa-times"></i> Cancelar</button>
                    <button type="button" id="btnEnviar" class="btn btn-warning float-right"><i class="nav-icon fas fa-check"></i> Aceptar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Tabla----------------------------------------------------------------------------------------------------------------------------------------- -->
          <div id="info_table" class="col-md-12" hidden>
            <div class="card card-warning">
              <div class="card-header ">
                <h4 class="card-title"><i class="fas fa-stream"></i> Tabla de ventas</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table id="tabla_detalle_ventas" class="table table-bordered table-striped">
                        <thead class="text-center">
                          <tr>
                            <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Producto</th>
                            <th class="bg-gradient-warning">Lote</th>
                            <th class="bg-gradient-warning">Tipo de venta</th>
                            <th class="bg-gradient-warning">Fecha de pago</th>
                            <th class="bg-gradient-warning">Cantidad</th>
                            <th class="bg-gradient-warning">Descuento</th>
                            <th class="bg-gradient-warning">Precio</th>
                            <th class="bg-gradient-warning">Estado de pago</th>
                            <th class="bg-gradient-warning">Editar</th>
                            <th class="bg-gradient-warning">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody class="text-center" id="cuerpo_tabla">

                        </tbody>
                        <tfoot class="text-center">
                          <tr>
                            <th class="bg-gradient-warning">#</th>
                            <th class="bg-gradient-warning">Producto</th>
                            <th class="bg-gradient-warning">Lote</th>
                            <th class="bg-gradient-warning">Tipo de venta</th>
                            <th class="bg-gradient-warning">Fecha de pago</th>
                            <th class="bg-gradient-warning">Cantidad</th>
                            <th class="bg-gradient-warning">Descuento</th>
                            <th class="bg-gradient-warning">Precio</th>
                            <th class="bg-gradient-warning">Estado de pago</th>
                            <th class="bg-gradient-warning">Editar</th>
                            <th class="bg-gradient-warning">Eliminar</th>
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
      var tipo_user = $("#tipo_user").text();

      if (tipo_user == 'Administrador') {
        $("#modulo_modulos").removeAttr("hidden");
        $("#modulo_usuarios").removeAttr("hidden");
      } else {
        $("#modulo_modulos").attr("type", "hidden");
        $("#modulo_usuarios").attr("type", "hidden");
      }

      $('#tabla_detalle_ventas').DataTable()
      llenarVentas();
      // cargar_tabla();

    });
  </script>


</html>