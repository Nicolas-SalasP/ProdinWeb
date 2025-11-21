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
  <? } ?>
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
					<div class="col-md-6">
					<div class="widget-controls pull-right">
                    </div>
	              	</div>
                  <div class="widget-content-white glossed">
                    <div class="padded">
<!-- insertar codigo  -->
<h3 class="form-title form-title-first">Mantención</h3>

<!-- Page Content -->
    <div class="container">

     <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-left">
            <li role="presentation"><a href="dashboard_table1.php">Producto</a></li>
            <li role="presentation"><a href="dashboard_table1.1.php">Entradas</a></li>
            <li role="presentation" class="active"><a href="#">Salidas</a></li>
            <li role="presentation"><a href="dashboard_table1.3.php">Informes</a></li>
          </ul>
        </nav>
      </div>


        
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Salida</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Producto</label>
  <div class="col-md-4">

     <select NAME="salidas" id="selectbasic" class="form-control">
         <option>Seleccione una Opción...</option>
          <?php        
        include("../../datos/conn.php");
        $clavebuscada=mysql_query("select * from Inventarioinsumos",$conexion);
        while($row = mysql_fetch_array($clavebuscada))
        {
        echo'<OPTION VALUE="'.$row['id_insumos'].'">'.$row['Insumo'].'</OPTION>';
        }?>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Impresora</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Stock Actual</label>  
  <div class="col-md-2">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Cantidad Salida</label>  
  <div class="col-md-2">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Saldo Stock</label>  
  <div class="col-md-2">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Cliente</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Fecha Salida</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="button1id" name="button1id" class="btn btn-success">Agregar</button>
    <button id="button2id" name="button2id" class="btn btn-danger">Cancelar</button>
  </div>
</div>

</fieldset>
</form>





    </div>
</div>

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
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src='js/865b8229b0ce41d6b0c8e0fc7416f9f2.js'></script>
<script src='js/15a0b84663e72cbef64a7b3ee6cd86b8.js'></script>
</body>
</html>