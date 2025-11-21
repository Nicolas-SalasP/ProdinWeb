<?
require "lib/conex_bd_doc.php";
$link2 = mysql_connect("$localhost2","$user2","$pass2");
mysql_select_db("$db2");
?>
<script language="JavaScript"> 
function Abrir_ventana_nueva(pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=500, top=200, left=220"; 
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
    <td colspan="3" class="stylenegrita">INFORMES POR PLANTAS</td>
  </tr>
  <tr>
    <td width="413">&nbsp;</td>
    <td width="126">&nbsp;</td>
    <td width="152">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;<? //$centro_produccion=crea_centros_produccion($link,$id_centros_produccion,1);
		//echo //$centro_produccion;?></td>
    <td><a href="javascript:Abrir_ventana_nueva('agregar_plantas.php')" class="style4"><strong>Asignar Plantas</strong></a></td>
    <td><a href="javascript:Abrir_ventana_nueva('insuban_chiledoc/agregar_doc_plantas.php')" class="style4"><strong>Asignar Doc a Plantas</strong></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td colspan="3">
      <?
  	  //if($id_centros_produccion){
	  $sql="SELECT * FROM doc where id_doc = id_doc";
	  $result=mysql_query($sql);
	 $cuantos=mysql_num_rows($result);
	 // echo "cuantos $cuantos";
  ?>
    <table width="699" border="1">
      <tr class="style4">
        <td width="27" bgcolor="#CCCCCC">N&ordm;</td>
        <td width="333" bgcolor="#CCCCCC">Nombre del Archivo</td>
        <td width="144" bgcolor="#CCCCCC">Fecha de Ingreso</td>
        <td width="144" bgcolor="#CCCCCC"><center>Descargar</center></td>
        <td width="17" bgcolor="#CCCCCC"><input name="button" type="submit" class="style4" id="button" value="X" /></td>
      </tr>
      <?

	  if($cuantos){
	   $i=0;
       $color = "#000000";$i = 0;
       while ($row=mysql_fetch_array($result))
      { 
	  $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	  $id_doc=$row[id_doc];
	  $nom_alternativo_doc=$row[nom_alternativo_doc];
	  $archivo_nombre =$row[archivo_nombre];
	  $fecha_sistema_adc=$row[fecha_sistema_adc];
	  
	  $i++;
	  ?>
      <tr class="style4">
        <td>&nbsp;<? echo $i;?></td>
        <td>&nbsp;<a href="insuban_chiledoc/ver_doc.php?id_doc=<? echo $id_doc?>" target="_blank"><? echo $archivo_nombre?></a></td>
        <td>&nbsp;<a href="insuban_chiledoc/ver_doc.php?id_doc=<? echo $id_doc?>" target="_blank"><? echo $fecha_sistema_adc?></a></td>
        <td><center><a href="insuban_chiledoc/ver_doc.php?id_doc=<? echo $id_doc?>" target="_blank">ver</a></center></td>
        <td><input name="checkbox" type="checkbox" class="style4" id="checkbox" /></td>
      </tr>
      <? } //while
	  }//if
	  
	 // }//id_centros_produccion
	  ?>
      <tr>
        <td colspan="5">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</form>
