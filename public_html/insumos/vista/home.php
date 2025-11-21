<?php include('../controlador/session.php');

require "../controlador/conexion.php";

$query11="SELECT user.us_nombre, user.us_perfil, cat.id_categoria, cat.nom_categoria, per.id_perfil, per.nom_perfil 
from ins_usuarios as user 
left outer join categorias as cat on user.us_area = cat.id_categoria
left outer join perfil as per on user.us_perfil = per.id_perfil
where user.us_nombre = '$login_session' ";

$resp = mysqli_query($con,$query11);
$row= mysqli_fetch_array($resp);
$cat = utf8_encode($row[3]);
$per = utf8_encode($row[5]);
?>
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

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-satellite-dish"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Insulogics <sup>2020</sup><br> Insumos</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
<?php if ($perfil_session == 5) {?>
      <li class="nav-item">
        <a class="nav-link" href="principal.php" target="miiframe">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Escritorio</span></a>
      </li>
<?php }?>

<?php if ($perfil_session == 1 or $perfil_session == 5) {?>
      <li class="nav-item">
        <a class="nav-link" href="solicitud.php" target="miiframe">
          <i class="far fa-hand-point-right"></i>
          <span>Nueva Solicitud</span></a>
      </li>
<?php }?>

<?php if ($perfil_session == 3 or $perfil_session == 5) {?>       
      <li class="nav-item">
        <a class="nav-link" href="registro_insumos.php" target="miiframe">
          <i class="fas fa-stream"></i>
          <span>Insumos</span></a>
      </li>
<?php }?>

<?php if ($perfil_session == 1 or $perfil_session == 2 or $perfil_session == 3 or $perfil_session == 4 or $perfil_session == 5) {?>                  
      <li class="nav-item">
        <a class="nav-link" href="reportes.php" target="miiframe">
          <i class="fas fa-check-double"></i>
          <span>Ver Solicitudes</span></a>
      </li>
<?php }?>

<?php if ($perfil_session == 3 or $perfil_session == 5) {?>
      <li class="nav-item">
        <a class="nav-link" href="registro_usuarios.php" target="miiframe">
          <i class="fas fa-users"></i>
          <span>Usuarios</span></a>
      </li>      
<?php }?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

         

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>Bienvenido:</b> <?php echo $login_session; ?> <b>Area:</b> <?php echo $cat; ?><br><b>Cat.:</b> <?php echo $per; ?> <p style='color:Blue;'> Salir </p>  </span>
<!--           <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

      <iframe name="miiframe" id="miiframe" width="100%" height="700" style="border:none;" src="principal.php"></iframe>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Insulogics 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Terminamos por hoy?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Presione "Salir" si realmente quiere cerrar la sesión.</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-success" href = "../controlador/logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
