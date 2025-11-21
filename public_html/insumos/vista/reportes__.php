<?php
  include('../controlador/session.php');
?>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <title>Reporte de Solicitudes</title>

<style>
#t01 {
  width: 100%;
  background-color: #f1f1c1;
}

</style>
</head>

<body>
<table id="t01"><tr><th><h4>Reporte de Solicitudes</h4></th></tr></table>
<br>
<?php if ($perfil_session == 3 or $perfil_session == 4) {?><h5><a href="exportar_solicitudes.php">Exportar a excel</a></h5><?}?>
<div class="col-sm-10">
<div>

<table class="table">
  <thead>
    <tr>   
      <th scope="col">Fecha</th>
      <th scope="col">Solicitante</th>
      <th scope="col">Area</th>      
      <th scope="col">Cod. Artículo</th>      
      <th scope="col">Item</th>
      <th scope="col">Cantidad</th>
<?php if ($perfil_session == 2 or $perfil_session == 4) {?> <th scope="col">Precio</th>  <?php } ?>    
      <th scope="col">Estado</th>      
<?php if ($perfil_session == 2 or $perfil_session == 3 or $perfil_session == 4) {?>
      <th scope="col"></th>
      <th scope="col">Acción</th>      
      <th scope="col"></th>              
<?php } ?>
    </tr>
  </thead>
  <tbody>
  <tr>

<?php 
require "../controlador/conexion.php";

$query11="SELECT user.us_nombre, user.us_perfil, cat.id_categoria, cat.nom_categoria 
from ins_usuarios as user 
left outer join categorias as cat on user.us_area = cat.id_categoria
where user.us_nombre = '$login_session' ";
$resp = mysqli_query($con,$query11);
$row= mysqli_fetch_array($resp);
$cat = $row[2];
$cat_nom = $row[3];


if ($perfil_session == 1) {
$sql = "SELECT *
FROM tmp as tmp 
left outer join productos as prd on tmp.id_producto = prd.id_producto 
where tmp.session_id = '$login_session' ";
}elseif ($perfil_session == 2) {
$sql = "SELECT *
FROM tmp as tmp 
left outer join productos as prd on tmp.id_producto = prd.id_producto 
where area = $cat ";
}else{
$sql = "SELECT *
FROM tmp as tmp 
left outer join productos as prd on tmp.id_producto = prd.id_producto ";
}
$result = $con->query($sql);

while($row = $result->fetch_assoc())  {

echo "<form method='POST' action='../modelo/accion_solicitud.php'>";

$fecha = $row["fecha_solicitud"];
$session_id = $row["session_id"];
$area = $cat_nom;
$id = $row["id_tmp"];
$articulo = $row["codigo_producto"];
$nombre = utf8_encode($row["nombre_producto"]);
$cantidad = $row["cantidad_tmp"];
$precio = $row["precio_tmp"];
$estado = $row["estado_solicitud"];

echo" <td>$fecha</td>";
echo" <td>$session_id</td>";
echo" <td>$area</td>";
echo" <td>$articulo</td>";
echo" <td>$nombre</td>";
echo" <td>$cantidad</td>";
if ($perfil_session == 2 or $perfil_session == 4) { echo "<td>$precio</td>";}
echo" <td>$estado</td>";
echo "<td><input type='hidden' name='id' value='$id'></td>";
if ($perfil_session == 2 or $perfil_session == 4) {
echo "<td><button type='submit' class='btn btn-success' name='aprobar' value='aprobar'>Aprobar</button></td>";
echo "<td><button type='submit' class='btn btn-danger' name='borrar' value='borrar'>Eliminar</button></td>";
}
if ($perfil_session == 3 and $estado == 'Aprobado') {
  echo "<td><button type='submit' class='btn btn-warning' name='entregado' value='entregado'>Entregado</button></td>";
}
if ($perfil_session == 3 and $estado == 'Entregado') {
 echo "<td><button type='submit' class='btn btn-danger' name='borrar' value='borrar'>Eliminar</button></td>";
}
echo" </tr> ";
echo "</form>";
}?>
</tbody>
</table>
</div>

</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>