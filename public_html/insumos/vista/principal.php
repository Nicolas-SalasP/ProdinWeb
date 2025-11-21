<?php
include('../controlador/session.php');

require "../controlador/conexion.php";

$query11="SELECT user.us_nombre, user.us_perfil, cat.id_categoria, cat.nom_categoria 
from ins_usuarios as user 
left outer join categorias as cat on user.us_area = cat.id_categoria
where user.us_nombre = '$login_session' ";
$resp = mysqli_query($con,$query11);
$row= mysqli_fetch_array($resp);
$cat = $row[2];
$cat_nom = $row[3];

?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Insulogics</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Escritorio</h1>
<?php if ($perfil_session == 3 or $perfil_session == 4) {?>            
            <a href="exportar_solicitudes.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> <?php } ?>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nuevas Solicitudes</div>

                              <?php include("../controlador/conexion.php");
                      if ($perfil_session == 1) {
                        $sql = "SELECT * FROM tmp as tmp where session_id = '$login_session' ";
                      }else{
                              $sql = "SELECT * FROM tmp as tmp where session_id = '$login_session' and estado_solicitud = ' ' and area = '$cat' ";
                           }
                              $result = mysqli_query($con,$sql);
                              $count = mysqli_num_rows($result);
                                                                    
                          echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$count."</div>"; ?>           
                       </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Consumo</div>
                              
                              <?php 
                              include("../controlador/conexion.php");

                              $sql2 = "SELECT sum(precio_tmp) as precio FROM tmp where estado_solicitud = 'Aprobado' and session_id = '$login_session' and area = '$cat'  ";
                              $result2 = mysqli_query($con,$sql2);
                              $count2 = mysqli_num_rows($result2);

                              while($row = $result2->fetch_assoc()) {  

                              $precio = $row["precio"];

                      echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$precio."</div>"; }?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Insumos Solicitados</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">

                          <?php 
                              include("../controlador/conexion.php");

                              $sql2 = "SELECT sum(cantidad_tmp) as cantidad 
                              FROM tmp where estado_solicitud = 'Aprobado' and session_id = '$login_session' and area = '$cat' ";
                              $result2 = mysqli_query($con,$sql2);
                              $count2 = mysqli_num_rows($result2);

                              while($row = $result2->fetch_assoc()) {  

                              $cantidad = $row["cantidad"];

                              echo "<div class='h5 mb-0 mr-3 font-weight-bold text-gray-800'>".$cantidad."</div>"; }?>
                        </div>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendientes de Aprobación</div>
                              <?php include("../controlador/conexion.php");
                        if ($perfil_session == 1) {
                              $sql1 = "SELECT * FROM tmp as tmp where estado_solicitud != 'Aprobado' and session_id = '$login_session' and area = $cat  ";
                         }else{
                            $sql1 = "SELECT * FROM tmp as tmp where estado_solicitud != 'Aprobado' ";
                         }     
                              $result1 = mysqli_query($con,$sql1);
                              $count1 = mysqli_num_rows($result1);
                                                  
                              
                              echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$count1."</div>"; ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

          </div>

          <!-- Content Row -->
          <div class="row">

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
