<?php session_start();?>
<? include("../../datos/config.php");
$seleccionarpersonal = mysql_query("SELECT * FROM regpersonal ORDER BY idregPersonal DESC");
$mostrarpersonal = mysql_fetch_array($seleccionarpersonal);
{ ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='../css/3913bb86301e8d3ad3eafbc7832aaa8e.css'>
  <link rel='stylesheet' href='../css/oswald_css.css'>
  <title>Gestion Personal</title>

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
  <a href="../admin/dashboard_table.php" class="logo hidden-sm hidden-xs">
    <span>Administración TI</span>
  </a>
  <ul class="side-menu">
    <li>
      <a href="../tickets/ver_tickets2.php">
        <?
        $seleccionarticket = mysql_query("SELECT count(*) FROM tickets_soporte where estadoReporte='Abierto'");
        $ticket = mysql_fetch_row($seleccionarticket);
        ?>
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
        <a href="formPersonal.php">
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
              <div class="col-md-6">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                      <form action="../../negocio/formPersonal.php" role="form" method="post">

                        <h3 class="form-title form-title-first">Formulario Personal</h3>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Ultimo ID: <b><?=$mostrarpersonal[idregPersonal]?></b></label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Nombre: </label>
                              <input type="text" class="form-control" id="nombre" name="nombre">
                                <A HREF="javascript:popUp('formPersonal2.php')">+ datos</A>  
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Correo: </label>
                          <input type="email" id="email" name="email" class="form-control" >
                        </div>
                        <div class="form-group">
                          <label>dominio: </label>
                          <input type="text"  id="dominio" name="dominio" class="form-control" >
                        </div>
                        <div class="form-group">
                          <label>Corresponde a: </label>
                          <select  id="select1" name="select1" class="form-control">
                            <option value="0"></option>
                            <option value="PLANTA 1">PLANTA 1</option>
                            <option value="PLANTA 2">PLANTA 2</option>
                            <option value="INDEXNA">INDEXNA</option>
                            <option value="COMAFRI">COMAFRI</option>
                            <option value="MAXAGRO">MAXAGRO</option>
                            <option value="CAMER">CAMER</option>
                            <option value="AGROLOMA">AGROLOMA</option>
                            <option value="TEMUCO">TEMUCO</option>
                            <option value="COEXCA">COEXCA</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Área: </label>
                          <select  id="select2" name="select2" class="form-control">
                          <option value="0">Seleccionar</option>
                          <option value="RR.HH.">RR.HH.</option>
                          <option value="BODEGA">BODEGA</option>
                          <option value="CALIDAD">CALIDAD</option>
                          <option value="PRODUCCIÓN">PRODUCCIÓN</option>
                          <option value="MANTENCIÓN">MANTENCIÓN</option>
                          <option value="COMERCIAL">COMERCIAL</option>
                          <option value="FACTURACIÓN">FACTURACIÓN</option>
                          <option value="ASEO">ASEO</option>
                          <option value="INFORMATICA">INFORMATICA</option>
                          <option value="GERENCIA">GERENCIA</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Cargo: </label>
                          <input type="text"  id="cargo" name="cargo" class="form-control" >
                        </div>
                        <div class="form-group">
                          <label>Ánexo: </label>
                          <input type="text"  id="anexo" name="anexo" class="form-control" >
                        </div>
                          <button type="submit" id="button1id" name="button1id" class="btn btn-primary">Guardar</button>
                        <!--  <button id="button2id" name="button2id" class="btn btn-danger">Cancelar</button> -->
                      </form>
                    </div>
                  </div>
                </div>
              </div>

<!--              <div class="col-md-6">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                      <form action="" role="form" class="form-horizontal">
                        <div class="widget-controls pull-right">
                        </div>
                        <h3 class="form-title form-title-first">Horizontal Form</h3>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Text Field</label>
                          <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Enter email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Password</label>
                          <div class="col-md-8">
                            <input type="password" class="form-control" placeholder="Password">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Disabled</label>
                          <div class="col-md-8">
                            <input class="form-control" disabled="disabled" placeholder="Disabled Field Value">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Select Box</label>
                          <div class="col-md-8">
                            <select class="form-control">
                              <option>France</option>
                              <option>Italy</option>
                              <option>Brazil</option>
                              <option>Portugal</option>
                              <option>Sweden</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-offset-4 col-md-8">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> Remember me
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-offset-4 col-md-8">
                            <button type="submit" class="btn btn-default">Primary Button</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> -->
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