<?
require "lib/conex_bd_doc.php";
$link = mysql_connect("$localhost2","$user2","$pass2");
mysql_select_db("$db2");
require "lib/fun_db_doc.php";

if($eliminar)
{
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'id_doc')
   {
	$id=$dat[1];
   	$id_doc=$_POST["id_doc-$id"];  
	
	 $sqlelim="delete from doc where id_doc = $id_doc";
 	  $resultelim=mysql_query($sqlelim);
   }
}
}
?>
<script language="JavaScript"> 
function Abrir_ventana_nueva1(pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=500, top=200, left=220"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript" type="text/javascript"> 
<!-- 
function Confirmar(form1) { 

var borrar = confirm("Estás seguro/a de que desea eliminar el registro?"); 

return borrar; //true o false 

} 
//--> 
</script>

<script language="JavaScript"> 
function Abrir_ventana_nueva2(pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=550, height=250, top=200, left=220"; 
window.open(pagina,"",opciones); 
} 
</script>
<style type="text/css">
<!--
.stylenegrita {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style4 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="713" border="0" align="center">
  <tr>
    <td colspan="3" class="stylenegrita">INFORMES POR PLANTAS.</td>
  </tr>
  <tr>
    <td width="413">&nbsp;</td>
    <td width="126">&nbsp;</td>
    <td width="152">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;<? $centro_produccion=crea_centros_producciondb2($link,$id_centros_produccion,1);
		echo $centro_produccion;?></td>
    <td><? if($permiso57 == 1){?><a href="javascript:Abrir_ventana_nueva1('agregar_plantas.php')" class="style4"><strong>Asignar Plantas</strong></a><? }else{ ?>
      <span class="style4">Asignar Plantas</span>      <? } ?></td>
    <td><? if($permiso57 == 1){?><a href="javascript:Abrir_ventana_nueva2('agregar_doc_plantas.php')" class="style4"><strong>Asignar Doc a Plantas</strong></a><? }else{ ?>
      <span class="style4">Asignar Doc a Plantas</span>      <? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td colspan="3">
      <?
  	  if($id_centros_produccion){
	  $sql="SELECT * FROM doc where id_centros_produccion = $id_centros_produccion order by	id_mes asc";
	  $result=mysql_query($sql);
	 $cuantos=mysql_num_rows($result);
	  //echo "cuantos $cuantos";
  ?>
    <table width="699" border="1">
      <tr class="style4">
        <td width="27" bgcolor="#CCCCCC">N&ordm;</td>
        <td width="333" bgcolor="#CCCCCC">Nombre del Archivo</td>
        <td width="144" bgcolor="#CCCCCC">Fecha de Ingreso</td>
        <td width="144" bgcolor="#CCCCCC"><center>Descargar</center></td>
        <? if($permiso57 == 1){?><td width="17" bgcolor="#CCCCCC"><input name="eliminar" type="submit" class="style4" id="eliminar" value="X"  onClick='return Confirmar(this.form1)'/></td><? }?>
      </tr>
      <?

	  if($cuantos){
	   $i=0;
       $color = "#000000";$i = 0;
       while ($row=mysql_fetch_array($result))
      { 
	  $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	  $id_doc=$row[id_doc];
	  $id_mes=$row[id_mes];
	  $nom_alternativo_doc=$row[nom_alternativo_doc];
	  $archivo_nombre =$row[archivo_nombre];
	  $fecha_sistema_adc=$row[fecha_sistema_adc];
	  
	  $i++;
	  ?>
      <tr class="style4">
        <td>&nbsp;<? echo $i;?></td>
        <td>&nbsp;<a href="ver_doc.php?id_doc=<? echo $id_doc?>" target="_blank"><?
        if($id_mes == 1) { echo "Enero";}
		if($id_mes == 2) { echo "Febrero";}
		if($id_mes == 3) { echo "Marzo";}
		if($id_mes == 4) { echo "Abril";}
		if($id_mes == 5) { echo "Mayo";}
		if($id_mes == 6) { echo "Junio";}		if($id_mes == 7) { echo "Julio";}
		if($id_mes == 8) { echo "Agosto";}
		if($id_mes == 9) { echo "Septiembre";}
		if($id_mes == 10) { echo "Octubre";}
		if($id_mes == 11) { echo "Noviembre";}
		if($id_mes == 12) { echo "Diciembre";}

		
		
		?>
        </a></td>
        <td>&nbsp;<a href="ver_doc.php?id_doc=<? echo $id_doc?>" target="_blank"><? echo $fecha_sistema_adc?></a></td>
        <td><center><a href="ver_doc.php?id_doc=<? echo $id_doc?>" target="_blank">ver</a></center></td>
       <? if($permiso57 == 1){?> <td><? //echo $id_doc?><input type="checkbox" name="id_doc-<? echo $id_doc?>" id="id_doc" value="<? echo $id_doc?>" /></td><? } ?>
      </tr>
      <? } //while
	  }//if
	  
  ?>
    </table>
    <? }//if($id_centros_produccion){?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</form>
