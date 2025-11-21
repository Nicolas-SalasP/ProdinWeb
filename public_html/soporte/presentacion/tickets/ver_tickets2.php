<?php session_start();?>
<? include("../../datos/config.php");
$cuentaticket = mysql_query("SELECT count(*) FROM tickets_soporte where estadoReporte='Abierto'");
$ticket = mysql_fetch_row($cuentaticket);
{?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='../css/3913bb86301e8d3ad3eafbc7832aaa8e.css'>
  <link rel='stylesheet' href='../css/oswald_css.css'>

  <style> li {font-size:20px;} div.container {width: 100%;  border: 0px solid gray;} header {padding: 0em; color: white; background-color: black; clear: left; text-align: center;} footer {padding: 0em; color: black; background-color: white; clear: left; text-align: center;} b </style>
    <SCRIPT LANGUAGE="JavaScript">
    <!-- Begin
    function popUp(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=619,height=526,left = 373.5,top = 121');");
    }// End -->
    </script>
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
            <a href="http://190.107.176.73/~prodinwe/soporte/presentacion/acceso.php"> Logout</a>
          </div>
          <h1>Tickets de soporte</h1>
        </div>
          <div class="main-content">
            <div class="row">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                      <? include("../../datos/config.php");
                      
                      if ($ticket != 0) {
                        $seleccionarticket = mysql_query("SELECT * FROM tickets_soporte ORDER BY estadoReporte ASC ");
                      }else{
                        $seleccionarticket = mysql_query("SELECT * FROM tickets_soporte ORDER BY id ASC ");
                      }                
                      
                      while($mostrarticket = mysql_fetch_array($seleccionarticket)) { 

                    $estado = $mostrarticket['estadoReporte'];
                    $requerimiento = $mostrarticket['mensaje'];
                    $requerimientof = utf8_encode($requerimiento);
                    $solucion = $mostrarticket['solucion'];
                    $solucionf = utf8_encode($solucion);
?>                        
                      <header> <h2>TICKET <?=$mostrarticket['id']?></h2> </header>
                      <ul><li>Fecha : <?=$mostrarticket['fecha']?></li>
                      <li>Solicitante : <?=$mostrarticket['titulo']?></li>
                      <li>Correo : <?=$mostrarticket['email']?></li>
                      <li>Requerimiento :<? echo $requerimientof; ?></li>
                      <li>Solución :<?echo $solucionf; ?></li>
                      <br><br>
                      <li>Categoria : <b><?=$mostrarticket['categoria']?></b></li>
                      <li>Anexo : <b><?=$mostrarticket['anexo']?></b></li>
<? if ($estado == "Abierto") { ?>                      
                      <li>Estado Reporte : <b style="color:green;font-size:25px;"><?=$mostrarticket['estadoReporte']?></b></li></ul>
<?}else{?>
                      <li>Estado Reporte : <b style="color:red;font-size:25px;"><?=$mostrarticket['estadoReporte']?></b></li></ul> 
<?}?> 
                      <footer>                 
                      <A HREF="javascript:popUp('detalleReport.php?id=<?=$mostrarticket['id']?>')">Detalle </A>
 <? if ($estado == "Cerrado"){ ?>
                      <A HREF=" "></A>
<?}else{?>
                      <A HREF="javascript:popUp('openReport.php?id=<?=$mostrarticket['id']?>')"> Responder</A>
<?}?>                      
                      </footer>
<? } ?>
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