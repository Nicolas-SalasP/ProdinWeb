<?
require "../sconre.php"; 

//echo "id_origenn $id_origenn - id_ldp $id_ldp - tip $tip - fecha_asig_producc $fecha_asig_producc";

if($asignar_operarios){
	 
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'id_oper')
   {
	$id=$dat[1];
   	$id_operarios=$_POST["id_oper-$id"];
	$fecha_asig_operario=date("Y-m-d");
	$sqlasigoperarios="insert planilla_produccion  (id_ldp,id_operarios,fecha_asig_operario,fecha_asig_producc) values ('$id_ldp','$id_operarios','$fecha_asig_operario','$fecha_asig_producc')";
    $resultasigoperario=mysql_query($sqlasigoperarios,$link);
    	
  }
}
?>

<script languaje="javascript">
window.opener.document.location.replace('<? echo $url?>sistema.php?modulo=pproduccdetalle.php&id_ldp=<? echo $id_ldp?>&fecha_asig_producc=<? echo $fecha_asig_producc?>&tip=<? echo $tip?>');

window.close();
</script>


<?

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" href="../images/Underground.css" type="text/css" />			
<title>Asignacion de Operarios</title>
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>
<script language="javascript" type="text/javascript">
function Verifica_datos(){
var inicialesopv = 1;
inicialesopv=document.getElementById("inicialesopv");
frm=document.getElementById("form1");
frm.action="asignar_operarios.php?id_ldp=<? echo $id_ldp?>&amp;tip=<? echo $tip?>&amp;fecha_asig_producc=<? echo $fecha_asig_producc?>&inicialesopv=" + inicialesopv.value;

frm.submit();
return true;
}
</script>
</head>
<div id="maincenter">
<body>
<form name="form1" method="post" action="">
<table width="83%" border="0">
  <tr>
    
    <td width="18" height="19" rowspan="2" bgcolor="#FF9933"><? //echo $id_ldp?></td>
    <td colspan="5" bgcolor="#CCCCCC">&nbsp;<strong> Linea de Produccion <?
   if($id_ldp == 1){
   echo "ENTUBADO";
   }
    if($id_ldp == 2){
   echo "CALIBRADO";
   }
   ?>&nbsp;/&nbsp;Total Operarios: <?echo $cuantos?></strong></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC">&nbsp;&nbsp;BUSCAR OPERARIOS POR INICIALES
      <input name="inicialesopv" type="text" id="inicialesopv" value="<? echo $inicialesopv?>" />
      <input type="submit" name="asigimi" id="asigimi" value="Buscar" />
    </td>
  </tr>
  <tr>
    <td width="18" height="19" nowrap="nowrap" bgcolor="#FF9933"><center>
      <strong>&nbsp;N&ordm;</strong>
    </center></td>
    <td width="104" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;NOMBRE</strong></td>
    <td width="119" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;APELLIDOS</strong></td>
    <td width="118" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;INICIALES</strong></td>
    <td width="371" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;LINEA PRODUCCI&Oacute;N</strong></td>
    <td align="center" nowrap="nowrap" bgcolor="#FF9933"><center><a href="javascript:seleccionar_todo()"><img src="../codphp/jpgnew/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="../codphp/jpgnew/ninguno.jpg" width="13" height="13" border="0"/></a></center></td>
    </tr>
  <?
  
if($id_ldp){
$sql="SELECT o.id_operarios, o.apellido AS apellidoop, o.nombreop AS nombreop, o.iniciales AS iniciales, e.estado AS estado, o.fecha_ingreso AS fecha_ingreso, lp.ldp AS ldp, o.orden AS orden FROM operarios AS o, estado AS e, lineas_de_procesos AS lp where o.id_operarios != 0 and o.id_estado=e.id_estado and o.id_ldp = lp.id_ldp and o.id_ldp = $id_ldp and o.id_grupo != 0 ";
}

if($inicialesopv)
{
	$sql.= " and o.iniciales = '$inicialesopv'";
}

$sql.= " order by o.nombreop asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "sql $sql<br>";
  
	if($cuantos){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_operarios=$row[id_operarios];
	$nombreop=$row[nombreop];
	$apellidoop=$row[apellidoop];
	$inicialesop=$row[iniciales];
	$estadoop=$row[estado];
	$ldp=$row[ldp];
	$id_ldp=$row[ldp];
	$orden=$row[orden];
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);

  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $nombreop?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $apellidoop?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $inicialesop?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $ldp ?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>
      <input type="checkbox" name="id_oper-<? echo $id_operarios?>" id="id_oper" value="<? echo $id_operarios?>" /></center></td>
    <? }
	}
	?>
  </tr>
   <tr>
    <td height="19" nowrap="nowrap">&nbsp;</td>
    <td colspan="5" nowrap="nowrap">&nbsp;</td>
    </tr>
   <tr>
     <td height="19" nowrap="nowrap">&nbsp;</td>
     <td colspan="5" align="right" nowrap="nowrap">  <? if($cuantos){?>
    <input type="submit" name="asignar_operarios" id="asignar_operarios" value="Asignar" />
    <? } ?></td>
   </tr>
   <tr>
     <td height="19" nowrap="nowrap">&nbsp;</td>
     <td colspan="5" nowrap="nowrap">&nbsp;</td>
   </tr>
</table>

</form>
</div>

</body>
</html>