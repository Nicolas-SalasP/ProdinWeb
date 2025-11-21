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
<table id="t01"><tr><th><h5>Agregar Usuarios</h5></th></tr></table>
<BR>
<div class="col-sm-10">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nuevo</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Registros</a>
  </li>

</ul>
<br>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

  <form action="../modelo/agregar_usuario.php" method="POST" >
    <div class="form-group row">
    <label for="nombre" class="col-sm-1 col-form-label">Usuario</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" id="email" name="email">
    </div>
  </div>
  <div class="form-group row">
    <label for="clave" class="col-sm-1 col-form-label">Clave</label>
    <div class="col-sm-1">
      <input type="password" class="form-control" id="clave" name="clave" maxlength="4">
    </div><div><i><p style="color:green; font-size:14px;"><-- Contraseña 4 dígitos</p></i></div>
  </div>
    <div class="form-group row">
    <label for="area" class="col-sm-1 col-form-label">Area</label>
    <div class="col-sm-2">
          <select name="area">
            <option value="0">Seleccione...</option>            
            <option value="1">ADMINISTRACIÓN</option>
            <option value="2">PRODUCCIÓN</option>
            <option value="3">FINANZAS</option>
            <option value="4">MANTENCIÓN</option>
            <option value="5">CALIDAD</option>
            <option value="6">INFORMATICA</option>
            <option value="7">OPERACIONES</option>
            <option value="8">ASEO</option>
            <option value="9">PLANTA 1</option>
            <option value="10">PLANTA 2</option>
            <option value="11">MATADEROS</option> 
            <option value="12">COMEX</option>                                                                                                                
      </select>
    </div>  
  </div>  
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-1 pt-0">Perfil</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="1" value="1">
          <label class="form-check-label" for="gridRadios1">
            Solicitante
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="2" value="2">
          <label class="form-check-label" for="gridRadios2">
            Aprobador
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="3" value="3">
          <label class="form-check-label" for="gridRadios3">
            Operaciones
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="4" value="4">
          <label class="form-check-label" for="gridRadios4">
            Bodega
          </label>
        </div>                
      </div>
    </div>
  </fieldset>

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
      <th scope="col">Usuario</th>
      <th scope="col">Email</th>
      <th scope="col">Perfil</th>
      <th scope="col">Area</th>
      <th scope="col"></th>      
      <th scope="col">Acción</th>              
    </tr>
  </thead>
  <tbody>
    <tr>

<?php 
require "../controlador/conexion.php"; 

$sql = "SELECT us.id_usuario,us.us_nombre,us.us_email,pf.nom_perfil,ar.nombre_area
FROM ins_usuarios as us
left outer join perfil as pf on us.us_perfil = pf.id_perfil
left outer join areas as ar on us.us_area = ar.id_area
where us.us_perfil != 4 ";
$result = $con->query($sql);

while($row = $result->fetch_assoc())  {

echo "<form method='POST' action='../modelo/borrar_usuario.php'>";

$id = $row["id_usuario"];
$nombre = $row["us_nombre"];
$email = $row["us_email"];
$perfil = $row["nom_perfil"];
$area = $row["nombre_area"];

echo" <td>$nombre</td>";
echo" <td>$email</td>";
echo" <td>$perfil</td>";
echo" <td>$area</td>";
echo "<td><input type='hidden' name='id' value='$id'></td>";
echo" <td><button type='submit' class='btn btn-danger' name='borrar' value='borrar'>Eliminar</button></td>";
echo "</form>";
echo" </tr> ";
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