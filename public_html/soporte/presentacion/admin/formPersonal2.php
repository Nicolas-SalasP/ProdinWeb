<? include("../../datos/connection.php");
$seleccionarticket = mysql_query("SELECT * FROM regpersonal ORDER BY idregPersonal DESC");
$mostrarticket = mysql_fetch_array($seleccionarticket)
?>
<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='../css/3913bb86301e8d3ad3eafbc7832aaa8e.css'>
  <link rel='stylesheet' href='../css/oswald_css.css'>
</head>
            <div class="row">
              <div class="col-md-6">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                      <form method="post" action="../../negocio/formPersonal2.php" class="form-horizontal">
                        <h3 class="form-title form-title-first">+ Datos</h3>
                        <div class="form-group">
                          <label class="col-md-4 control-label">ID: </label>
                          <div class="col-md-2">
                            <input id="id" name="id" type="text" value="<?=$mostrarticket[idregPersonal]?>" class="form-control">
                          </div>
                        </div>
                          <div class="form-group">
                          <label class="col-md-4 control-label">Cuenta: </label>
                          <div class="col-md-2">
                            <input id="cuenta" name="cuenta" type="text" class="form-control">
                          </div>
                        </div>
                          <div class="form-group">
                          <label class="col-md-4 control-label">User: </label>
                          <div class="col-md-2">
                            <input id="user" name="user" type="text" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Password</label>
                          <div class="col-md-2">
                            <input id="clave" name="clave" type="password" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-offset-4 col-md-8">
                            <button type="submit" id="btnform2" name="btnform2" class="btn btn-success">Agregar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>