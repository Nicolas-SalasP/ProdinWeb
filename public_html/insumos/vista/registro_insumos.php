<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <title>Formulario de registro</title>

<style>
#t01 {
  width: 100%;
  background-color: #f1f1c1;
}
</style>
</head>

<body>
<table id="t01"><tr><th><h5>Agregar Insumos</h5></th></tr></table>
<br>
<div class="col-sm-10">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nuevo</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Insumos</a>
  </li>

</ul>
<br>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

  <form action="../modelo/agregar_insumo.php" method="POST" > 

  <div class="form-group row">
    <label for="articulo" class="col-sm-1 col-form-label">Artículo</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="articulo" name="articulo">
    </div>
  </div>
  <div class="form-group row">
    <label for="item" class="col-sm-1 col-form-label">Item</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="item" name="item">
    </div>
  </div>
  <div class="form-group row">
    <label for="unidad" class="col-sm-1 col-form-label">Unidad</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="unidad" name="unidad">
    </div>
  </div>
  <div class="form-group row">
    <label for="precio" class="col-sm-1 col-form-label">Precio</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" id="precio" name="precio" step="0.001" min="0">
    </div>
  </div>    

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</form>
</div>
  
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">  

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Artículo</th>
      <th scope="col">Item</th>
      <th scope="col">Unidad</th>
      <th scope="col">Precio(pesos)</th>
      <th scope="col"></th>
      <th scope="col">Acción</th>              
    </tr>
  </thead>
  <tbody>
    <tr>

<?php 
require "../controlador/conexion.php"; 

$sql = "SELECT * FROM productos order by id_producto desc";
$result = $con->query($sql);

while($row = $result->fetch_assoc())  {
echo "<form method='POST' action='../modelo/borrar_insumo.php'>";

$id = $row["id_producto"];
$articulo = $row["codigo_producto"];
$nombre = utf8_encode($row["nombre_producto"]);
$unidad = $row["unidad_medida_producto"];
$costo = $row["precio_producto"];
$costof =number_format($costo, 2, ',', '.');


echo "<th scope='row'>$id</th>";
echo" <td>$articulo</td>";
echo" <td>$nombre</td>";
echo" <td>$unidad</td>";
echo" <td>$ ".$costof."</td>";
echo "<td><input type='hidden' name='id' value='$id'></td>";
echo" <td><button type='submit' class='btn btn-danger' name='borrar' value='borrar'>Eliminar</button></td>";
echo" </tr> ";
echo "</form>";
}?>
</tbody>
</table>
</div>

<!--  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div> -->

</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>