<? include("../../datos/config.php");
$seleccionarticket = mysql_query("SELECT * FROM tickets_soporte ORDER BY id DESC limit 10");
while($mostrarticket = mysql_fetch_array($seleccionarticket))
{ ?>
<html>
<head>
<meta charset="utf-8">
<style> div.container {width: 100%;  border: 0px solid gray;} header {padding: 0em; color: white; background-color: black; clear: left; text-align: center;} footer {padding: 0em; color: black; background-color: white; clear: left; text-align: center;}</style>
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
<header> <h3>TICKET <?=$mostrarticket['id']?></h3> </header>
<ul><li>Fecha : <?=$mostrarticket['fecha']?></li>
<li>Solicitante : <?=$mostrarticket['titulo']?></li>
<li>Correo : <?=$mostrarticket['email']?></li>
<li>Requerimiento :<?=$mostrarticket['mensaje']?></li>
<li>Solución :<?=$mostrarticket['solucion']?></li>
<br>
<li>Estado Reporte :<b><?=$mostrarticket['estadoReporte']?></b></li></ul>
<footer>
<A HREF="javascript:popUp('detalleReport.php?id=<?=$mostrarticket['id']?>')">Detalle</A>
<A HREF="javascript:popUp('openReport.php?id=<?=$mostrarticket['id']?>')">Abrir</A>
</footer>
</div> <!-- end container-->
<? } ?>
</body>
</html>
