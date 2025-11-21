<?
$sql="SELECT * FROM destinos AS des, estado AS es where des.id_destinos != 0 and des.id_estado = es.id_estado order by destinos asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Destinos Lista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
-->
</style>


<script>
window.onload = detectarCarga;
function detectarCarga(){
   document.getElementById("carga").style.display="none";
}</script>

<div id="carga">
  <img height="80" width="80" border="0" src="jpg/cargando.gif" />
</div>






<form id="form1" name="form1" method="post" action="" >
<table width="650" height="180" border="0" align="center">
  <tr>
    <td width="596" valign="top">
        <table class="table table-hover" width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="14" colspan="8" class="titulo"><div align="right"><a href="?modulo=destinos.php&amp;nuevo=1" ><b>Ingresar Nuevo</b></a></div></td>
        </tr>
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td width="183" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;ID M3</td>
        <td width="183" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Destinos</td>
        <td width="144" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Domicilio</span></td>
        <td width="192" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Ciudad</span></td>
        <td width="192" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Pais</span></td>
        <td width="116" align="center" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Estado</span></td>
        <td width="116" align="center" bgcolor="#CCCCCC" class="linknegro"><span class="titulo">&nbsp;Asignado</span></td>
        </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_destinos=$row[id_destinos];
	$estado=$row[estado];
  $id_M3_destino=$row[id_M3_destino];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=destinos.php&id_de=<?echo $row[id_M3_destino]?>"><?echo $row[id_M3_destino]?></a>&nbsp;</td>        
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=destinos.php&id_de=<?echo $row[id_destinos]?>"><?echo $row[destinos]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=destinos.php&id_de=<?echo $row[id_destinos]?>"><?echo $row[domicilio]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=destinos.php&id_de=<?echo $row[id_destinos]?>"><?echo $row[ciudad]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=destinos.php&id_de=<?echo $row[id_destinos]?>"><?echo $row[pais]?></a>&nbsp;</td>
        <td align="center" nowrap="nowrap" class="cajas">&nbsp;<? echo $estado;?></td>
        <td align="center" nowrap="nowrap" class="cajas"><?
        
		$sqlb="SELECT* 
FROM etiquetados_folios
WHERE id_destinos =$id_destinos
LIMIT 0 , 1 ";
		$resultb=mysql_query($sqlb);
		$cuantosb=mysql_num_rows($resultb);
		//echo $cuantosb;
		if($cuantosb)
		{
			echo "SI";
		}else{
			
				echo "NO";
		}
		
		
		
		?></td>
        </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>