<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

 $sql="SELECT * FROM etiquetados_folios AS ef, producto AS p, calibre AS c where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_producto = p.id_producto and ef.id_calibre=c.id_calibre";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);
 
 $sql2="SELECT * FROM etiquetados_folios AS ef, operarios AS o where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_operarios = o.id_operarios";
 $result2=mysql_query($sql2);
 $cuantos2=mysql_num_rows($result2);
 
 $sql3="SELECT * FROM etiquetados_folios AS ef, medidas_productos AS mp where ef.id_etiquetados_folios='$id_etiquetados_folios' and ef.id_medidas_productos=mp.id_medidas_productos";
 $result3=mysql_query($sql3);
 $cuantos3=mysql_num_rows($result3);
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-size: 13px; font-family: Verdana, Arial, Helvetica, sans-serif;}
body {
	margin-left: 0px;
	margin-top: 0px;
}
.style4 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style5 {font-size: 13px}
.style6 {font-size: 12px}
-->
</style>
<script language="JavaScript" type="text/javascript">
window.print();
</script>
<?
	  if ($row=mysql_fetch_array($result))
      { 
	  $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $f_termino =format_fecha_sin_hora($row[f_termino ]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
       
      ?>
<table width="292" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td height="37" colspan="2"><span class="numero"><? echo $nom=$row[nombre]?></span></td>
  </tr>
  <tr>
    <td height="34" colspan="2"><table width="338" border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
      <tr>
        <td width="162" class="numero"><span class="style5">CALIBRE:</span>          <? echo $row[calibre]?></td>
        <td width="163" class="numero"><span class="style5">MEDIDA:</span>          <? 
		if ($row3=mysql_fetch_array($result3))
      { 
		echo $row3[nombre];
		}
		?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25" colspan="2" class="numero"><span class="style5">CONTENIDO:</span> <? echo $row[contenido_unidades]?> <span class="style5">Unidades</span> </td>
  </tr>
  <tr>
    <td height="26" colspan="2" class="numero"><span class="style5">Fecha de Elaboraci&oacute;n:</span> <? echo $f_elaboracion?></td>
  </tr>
  <tr>
    <td height="34" colspan="2" class="numero"><span class="style6">Utilizar preferentemente antes de:</span> <span class="style5"><? echo $f_vencimiento?></span></td>
  </tr>
  <tr>
    <td height="16" colspan="2" class="numero"><span class="style5">Operador:</span>      <? 
	if ($row2=mysql_fetch_array($result2))
      { 
	echo "$row2[nombre] $row2[apellido]";
	}
	?></td>
  </tr>
  <tr>
    <td height="80" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="23" colspan="2" class="style2">PAIS DE ORIGEN CHILE </td>
  </tr>
  <tr>
    <td width="157" height="23" class="style4">REGISTRO SAG 13-62 </td>
    <td width="178" class="style4">Resoluci&oacute;n SESMA: 9242/04 </td>
  </tr>
  <tr>
    <td height="27" colspan="2" class="style4">Mantener en lugar fresco y seco a temperatura ambiente </td>
  </tr>
</table>
<? }?>
 