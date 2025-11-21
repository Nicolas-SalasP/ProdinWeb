<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <title>Formulario de solicitud</title>

<style>
#t01 {
  width: 100%;
  background-color: #f1f1c1;
}
</style>
</head>

<body>
<table id="t01"><tr><th><h5>Formulario de Solicitud de Insumos</h5></th></tr></table>
<br>
<div class="col-sm-10">

<br>

  <form action="../modelo/agregar_solicitud.php" method="POST" > 

<? 
require "../controlador/conexion.php"; 

$sql = "SELECT * FROM ins_insumos where id_articulo=$articulo";
$result = $con->query($sql);

while($row = $result->fetch_assoc())  {

$item = $row[id_nombre];
}?>

  <div class="form-group row">
    <label for="articulo" class="col-sm-1 col-form-label">Artículo</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="articulo" name="articulo" >
    </div>

    <label for="item" class="col-sm-1 col-form-label">Item</label>
    <div class="col-sm-4">
<!--  <input type="text" class="form-control" id="item" name="item" > -->
      <input type="text" class="form-control" id="item" name="item" >      
    </div>


    <label for="unidad" class="col-sm-1 col-form-label">Cantidad</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="unidad" name="unidad">
    </div>
 
      <button type="submit" class="btn btn-primary">Enviar</button> 

  </div>
</form>
</div>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>