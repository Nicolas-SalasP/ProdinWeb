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
  <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=619,height=526,left = 373.5,top = 121');");
}// End -->
</script>
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
  <a href="../admin/dashboard_home.php" class="logo hidden-sm hidden-xs">
    <span>Administración TI</span>
  </a>
  <ul class="side-menu">
    <li>
      <a href="../tickets/ver_tickets2.php">
        <span class="badge badge-notifications pull-right alert-animated"><?echo $ticket[0];?></span>
        <?}?>
        Ticket de soporte
      </a>
    </li>
  </ul>
  <div class="relative-w">
    <ul class="side-menu">
      <li class='current'>
        <a class='current' href="dashboard_home.php">
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
        <a href="dashboard_inv.php" >
          <span class="badge pull-right"></span>
          Inventario
        </a>
      </li>
      <li>
        <a href="datatable.html" class="is-dropdown-menu">
          <span class="badge pull-right"></span>
          Tables
        </a>
        <ul>
          <li>
            <a href="datatable.html">
              Data Tables
            </a>
          </li>
          <li>
            <a href="table.html">
              Regular Tables
            </a>
          </li>
        </ul>
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
 <!--           <a href="#">User Alerts</a>
            <a href="#">Settings</a> -->
            <b>User: </b><?echo $_SESSION['Usuarionombre'];?>
            <a href="../../../../index2.html"> Logout</a>
          </div>
          <h1>Dashboard</h1>
        </div>
          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                    <div class="padded">
                <h3 class="form-title form-title-first">Formulario Personal</h3>
                <? include("../../datos/connection.php");
                  $regpersonal = mysql_query("SELECT
rp.idregPersonal, 
rp.nombrePersonal,
rp.correoPersonal,
rp.dominioPersonal,
rp.plantaPersonal,
rp.areaPersonal,
rp.cargoPersonal,
rp.anexoPersonal,
dp.detCuenta,
dp.detPassword,
dp.detUser
FROM regpersonal rp
LEFT JOIN detpersonal dp ON rp.idregPersonal=dp.iddetPersonal ORDER BY idregPersonal ASC ");
                  while($mostrarreg = mysql_fetch_array($regpersonal))
                  { ?>
                <header> <h4><?=$mostrarreg['nombrePersonal']?></h4> </header>
                <table border="1">
                    <tr>
                      <td>Correo:</td>
                      <td>Dominio:</td>
                      <td>Planta:</td>
                      <td>Área:</td>
                      <td>Cargo:</td>
                      <td>Anexo:</td>
                      <td>Tipo Cuenta:</td>
                      <td>Password:</td>
                      <td>User:</td>
                    </tr>
                    <tr>  
                      <td><?=$mostrarreg['correoPersonal']?></td>
                      <td><?=$mostrarreg['dominioPersonal']?></td>
                      <td><?=$mostrarreg['plantaPersonal']?></td>
                      <td><?=$mostrarreg['areaPersonal']?></td>
                      <td><?=$mostrarreg['cargoPersonal']?></td>
                      <td><?=$mostrarreg['anexoPersonal']?></td>
                      <td><?=$mostrarreg['detCuenta']?></td>
                      <td><?=$mostrarreg['detPassword']?></td>
                      <td><?=$mostrarreg['detUser']?></td>  
                    </tr>
                </table>
            <? } ?>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>0
  </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src='js/865b8229b0ce41d6b0c8e0fc7416f9f2.js'></script>
<script src='js/15a0b84663e72cbef64a7b3ee6cd86b8.js'></script>
</body>
</html>