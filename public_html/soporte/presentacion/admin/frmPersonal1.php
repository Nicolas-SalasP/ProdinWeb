<? include("../../datos/config.php");
$cuentaticket = mysql_query("SELECT count(*) FROM tickets_soporte");
$ticket = mysql_fetch_row($cuentaticket);
{ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='../css/3913bb86301e8d3ad3eafbc7832aaa8e.css'>
  <link rel='stylesheet' href='../css/oswald_css.css'>
  <title>Sistema de Gestion</title>
        <!-- Bootstrap -->


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
  <a href="#" class="logo hidden-sm hidden-xs">
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
        <a class='current' href="index.html">
          <span class="badge pull-right">17</span>
          Dashboard
        </a>
      </li>
      <li>
        <a href="charts.html" class="is-dropdown-menu">
          <span class="badge pull-right"></span>
          Charts
        </a>
        <ul>
          <li>
            <a href="charts.html#area_chart_anchor">
              Area Chart
            </a>
          </li>
          <li>
            <a href="charts.html#circle_chart_anchor">
              Circular Chart
            </a>
          </li>
          <li>
            <a href="charts.html#bar_chart_anchor">
              Bar Chart
            </a>
          </li>
          <li>
            <a href="charts.html#line_chart_anchor">
              Line Chart
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="forms.html">
          <span class="badge pull-right">12</span>
          Forms
        </a>
      </li>
      <li>
        <a href="elements.html" class="is-dropdown-menu">
          <span class="badge pull-right"></span>
          UI Elements
        </a>
        <ul>
          <li>
            <a href="elements.html">
              Elements
            </a>
          </li>
          <li>
            <a href="icons.html">
              Icons
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="datatable.html" class="is-dropdown-menu">
          <span class="badge pull-right">24</span>
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
        <a href="calendar.html">
          <span class="badge pull-right">11</span>
          Calendar
        </a>
      </li>
      <li>
        <a href="login.html">
          <span class="badge pull-right"></span>
          Login Page
        </a>
      </li>
    </ul>
  </div>
</div>
    </div>
    <div class="col-md-9">
      <div class="content-wrapper">
        <div class="content-inner">
          <div class="page-header">
  <div class="header-links hidden-xs">
    <a href="#">Logout</a>
  </div>
  <h1>Formulario Personal</h1>
</div>
          <div class="main-content">
            <div class="widget">
              <h3 class="section-title first-title">Users Table</h3>
              <div class="widget-content-white glossed">
                <div class="padded">
                      <? include("../../datos/connection.php");
                      $seleccionarpersonal = mysql_query("SELECT * FROM regpersonal ORDER BY idregPersonal DESC");
                      $mostrarpersonal = mysql_fetch_array($seleccionarpersonal)
                      ?>
                      <form class="form-horizontal" method="post" action="../negocio/formPersonal.php">
                      <fieldset>
                      <!-- Form Name -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="cuenta">Ultimo ID:</label>  
                        <div class="col-md-1">
                        <label class="col-md-4 control-label" for="cuenta"><b><?=$mostrarpersonal[idregPersonal]?></b></label>
                          
                        </div>
                      </div>
<? } ?>
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre:</label>  
                        <div class="col-md-4">
                        <input id="nombre" name="nombre" type="text" placeholder="" class="form-control input-md" required="">
                        <A HREF="javascript:popUp('form2.php')">+ datos</A>  
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="email">Correo:</label>  
                        <div class="col-md-4">
                        <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">
                          
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="dominio">Dominio:</label>  
                        <div class="col-md-2">
                        <input id="dominio" name="dominio" type="text" placeholder="" class="form-control input-md" required="">
                          
                        </div>
                      </div>

                      <!-- Select Basic -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="select1">Planta</label>
                        <div class="col-md-2">
                          <select id="select1" name="select1" class="form-control">
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
                      </div>

                      <!-- Select Basic -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="select2">Área</label>
                        <div class="col-md-2">
                          <select id="select2" name="select2" class="form-control">
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
                          </select>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="cargo">Cargo:</label>  
                        <div class="col-md-2">
                        <input id="cargo" name="cargo" type="text" placeholder="" class="form-control input-md" required="">
                          
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="anexo">Anexo:</label>  
                        <div class="col-md-1">
                        <input id="anexo" name="anexo" type="text" placeholder="" class="form-control input-md"> 
                        
                        </div>  
                      </div>

                      <!-- Button (Double) -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="button1id"></label>
                        <div class="col-md-8">
                          <button type="submit" id="button1id" name="button1id" class="btn btn-primary">Guardar</button>
                          <button id="button2id" name="button2id" class="btn btn-danger">Cancelar</button>
                        </div>
                      </div>

                      </fieldset>
                      </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src='js/865b8229b0ce41d6b0c8e0fc7416f9f2.js'></script>
<script src='js/67b4d81b44effbc5e221a119f719782b.js'></script>
</body>
</html>