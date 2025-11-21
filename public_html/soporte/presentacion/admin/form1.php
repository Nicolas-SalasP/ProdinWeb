<? include("../datos/connection.php");
$seleccionarpersonal = mysql_query("SELECT * FROM regpersonal ORDER BY idregPersonal DESC");
$mostrarpersonal = mysql_fetch_array($seleccionarpersonal)
?>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Formulario Personal</title>
			<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
    <SCRIPT LANGUAGE="JavaScript">
    <!-- Begin
    function popUp(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=619,height=526,left = 373.5,top = 121');");
    }// End -->
    </script>
</head>
<form class="form-horizontal" method="post" action="../negocio/formPersonal.php">
<fieldset>

<!-- Form Name -->
<legend>Formulario Personal</legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="cuenta">Ultimo ID:</label>  
  <div class="col-md-1">
  <label class="col-md-4 control-label" for="cuenta"><b><?=$mostrarpersonal[idregPersonal]?></b></label>
    
  </div>
</div>

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