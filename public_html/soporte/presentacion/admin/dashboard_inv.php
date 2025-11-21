<?php session_start();?>
<? include("../../datos/config.php");
$seleccionarticket = mysql_query("SELECT count(*) FROM tickets_soporte where estadoReporte='Abierto'");
$ticket = mysql_fetch_row($seleccionarticket);
{ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='../css/3913bb86301e8d3ad3eafbc7832aaa8e.css'>
  <link rel='stylesheet' href='../css/oswald_css.css'>
  <title>Sistema de Gestion</title>
</head>
<body>
<div class="all-wrapper">
  <div class="row">
    <div class="col-md-3">
      <div class="text-center">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
</div>
<div class="side-bar-wrapper collapse navbar-collapse navbar-ex1-collapse">
  <a href="../admin/dashboard_table.php" class="logo hidden-sm hidden-xs">
    <span>Administración TI</span>
  </a>
  <ul class="side-menu">
    <li>
      <a href="../tickets/ver_tickets2.php">
        <span class="badge badge-notifications pull-right alert-animated"><?echo $ticket[0];?></span>
        Ticket de soporte
      </a>
    </li>
  </ul>
  <div class="relative-w">
    <ul class="side-menu">
      <li class='current'>
        <a class='current' href="dashboard_table.php">
          <span class="badge pull-right"></span>
          Dashboard
        </a>
      </li>
      <li>
        <a href="dashboard_table1.php" class="is-dropdown-menu">
          <span class="badge pull-right"></span>
          Mantención
        </a>
      </li>
      <li>
        <a href="dashboard_inv.php">
          <span class="badge pull-right"></span>
          Inventario
        </a>
      </li>
      <li>
        <a href="../admin/formPersonal.php">
          <span class="badge pull-right"></span>
          Gestión
        </a>
      </li>
    </ul>
  </div>
</div>
    </div>
    <div class="col-md-9">
    
      <div class="content-wrapper wood-wrapper">
        <div class="content-inner">
          <div class="page-header">
          <div class="header-links hidden-xs">
            <b>User: </b><?echo $_SESSION['Usuarionombre'];?>
            <a href="../../../../index2.html"> Logout</a>
          </div>
          <h1>Dashboard</h1>
        </div>
          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
<!-- insertar codigo  -->

                    <object data="http://localhost/desarrollos/soporte/presentacion/inventario/index.php" width="850" height="500">     
                    <embed wmode="transparent" src="http://localhost/desarrollos/soporte/presentacion/inventario/index.php" width="700" height="500" /> 
                    Error: Embedded data could not be displayed. </object>

<!-- end codigo  -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<? } ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src='js/865b8229b0ce41d6b0c8e0fc7416f9f2.js'></script>
<script src='js/15a0b84663e72cbef64a7b3ee6cd86b8.js'></script>
</body>
</html>