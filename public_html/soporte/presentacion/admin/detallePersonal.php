<? include("../../datos/connection.php");
$seleccionarticket = mysql_query("SELECT * FROM detpersonal where iddetPersonal=$id ");
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
<header> <h3>Cuentas</h3> </header>
<table border="1">
    <tr>
      <td>Tipo Cuenta:</td>
      <td><?=$mostrarticket['detCuenta']?></td>
    </tr>
    <tr>  
      <td>Password:</td>
      <td><?=$mostrarticket['detPassword']?></td>
    </tr>
    <tr>
      <td>User:</td>
      <td><?=$mostrarticket['detUser']?></td>
    </tr>
</table>
<footer>
<hr>
</footer>
</div> <!-- end container-->
<? } ?>
</body>
</html>
