<? include("../../datos/config.php");

$seleccionarticket = mysql_query("SELECT * FROM tickets_soporte where id=$id ORDER BY id DESC limit 1");
while($mostrarticket = mysql_fetch_array($seleccionarticket)){


$fecha = $mostrarticket['fecha'];
$requerimiento = $mostrarticket['mensaje'];
$requerimientof = utf8_encode($requerimiento);
$solucion = $mostrarticket['solucion'];
$solucionf = utf8_encode($solucion);


?>
<head><meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<div class="container">
<header><h3> Detalle Reporte </h3></header>
<table style="width:70%; font-size:15px; ">
  <tr>
    <td>Fecha :</td>
    <td><?echo $fecha; ?></td> 
  </tr>
   <tr>
    <td>Solicitante :</td>
    <td><?=$mostrarticket['titulo']?></td> 
  </tr>
   <tr>
    <td>Correo :</td>
    <td><?=$mostrarticket['email']?></td> 
  </tr>
  </table>
  <br>
<h3>TICKET N°: <?=$mostrarticket['id']?></h3>
  <table style="width:70%">
  <tr>
    <td>Requerimiento : </td>
    <td><?echo $requerimientof;?></td> 
  </tr>
  <tr>
    <td>Categoria : </td>
    <td><?=$mostrarticket['categoria']?></td> 
  </tr>
 <br>   
  <tr>
    <td>Solución : </td>
    <td><?echo $solucionf;?></td> 
  </tr>
  </table>
  <br>
  <br>
<footer>
 Estado: <?=$mostrarticket['estadoReporte']?>
</footer>
</div> <!-- end container-->

<div>
<img src="vista.php?id=<?echo $id;?>" alt="Sin Imagen Adjunta" width="100%" />      
</div> 

<?}?>