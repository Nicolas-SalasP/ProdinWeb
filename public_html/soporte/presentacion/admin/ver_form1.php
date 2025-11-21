<? include("../datos/connection.php");
$seleccionarticket = mysql_query("SELECT * FROM regpersonal ORDER BY idregPersonal ASC ");
while($mostrarticket = mysql_fetch_array($seleccionarticket))
{ ?>
<html>
<head>
<meta charset="utf-8">
<style> div.container {width: 100%;  border: 0px solid gray;} header {padding: 0em; color: white; background-color: black; clear: left; text-align: left;} footer {padding: 0em; color: black; background-color: white; clear: left; text-align: center;}</style>
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
<div class="container">
<header> <h3><?=$mostrarticket['nombrePersonal']?></h3> </header>
<table border="1">
    <tr>
      <td>Correo:</td>
      <td><?=$mostrarticket['correoPersonal']?></td>
      <td>Tipo Cuenta:</td>
      <td><?=$mostrarticket['detCuenta']?></td>
    </tr>
    <tr>  
      <td>Dominio:</td>
      <td><?=$mostrarticket['dominioPersonal']?></td>
      <td>Password:</td>
      <td><?=$mostrarticket['detPassword']?></td>
    </tr>
    <tr>
      <td>Planta:</td>
      <td><?=$mostrarticket['plantaPersonal']?></td>
      <td>User:</td>
      <td><?=$mostrarticket['detUser']?></td>
    </tr>
    <tr>
      <td>Área:</td>
      <td><?=$mostrarticket['areaPersonal']?></td>
    </tr>
    <tr>
      <td>Cargo:</td>
      <td><?=$mostrarticket['cargoPersonal']?></td>
    </tr>
    <tr>
      <td>Anexo:</td>
      <td><?=$mostrarticket['anexoPersonal']?></td>
    </tr>
</table>
<footer>
<A HREF="javascript:popUp('detallePersonal.php?id=<?=$mostrarticket['idregPersonal']?>')">Otros Datos</A>
<hr>
</footer>
</div> <!-- end container-->
<? } ?>
</body>
</html>