<? include("../../datos/connection.php");
$seleccionarticket = mysql_query("SELECT * FROM regpersonal ORDER BY idregPersonal DESC");
$mostrarticket = mysql_fetch_array($seleccionarticket)
?>
<form class="form-horizontal" method="post" action="../negocio/formPersonal2.php">

              <div class="col-md-6">
                <div class="widget">
                  <div class="widget-content-white glossed">
                    <div class="padded">
                      <form action="" role="form" class="form-horizontal">
                        <div class="widget-controls pull-right">
                        </div>
                        <h3 class="form-title form-title-first">Horizontal Form</h3>
                        <div class="form-group">
                          <label class="col-md-4 control-label">ID: </label>
                          <div class="col-md-8">
                            <input type="email" value="<?=$mostrarticket[idregPersonal]?>" class="form-control">
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
              </div>





<fieldset>

<!-- Form Name -->
<legend>Datos</legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="cuenta">ID:</label>  
  <div class="col-md-1">
  <input id="id" name="id" type="text" value="<?=$mostrarticket[idregPersonal]?>" class="form-control input-md"></label>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cuenta">Cuenta</label>  
  <div class="col-md-2">
  <input id="cuenta" name="cuenta" type="text" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="user">User</label>  
  <div class="col-md-2">
  <input id="user" name="user" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="clave">Password</label>  
  <div class="col-md-2">
  <input id="clave" name="clave" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">solo si corresponde</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnform2"></label>
  <div class="col-md-4">
    <button type="submit" id="btnform2" name="btnform2" class="btn btn-success">Agregar</button>
  </div>
</div>

</fieldset>
</form>