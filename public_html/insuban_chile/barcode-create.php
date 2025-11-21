<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";


if($imprimir){
$fhoy=date("y");

$sql="select * from etiqueta_material where id_procedencia='$id_procedencia' order by fecha_emision desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "SQL $sql";
if ($cuantos)
$row=mysql_fetch_array($result);

 $hasta= $row[hasta] + 1;
 $valor= $row[hasta] + $cantidad;

  $fecha_emision=date("Y-m-d H:i:s");
  $sql_nuevo="insert into etiqueta_material  (id_procedencia,fhoy,desde,hasta,fecha_emision,id_operarios) values ('$id_procedencia','$fhoy',$hasta,$valor,'$fecha_emision',$id_operarios)";
  $result_nuevo=mysql_query($sql_nuevo,$link);
?><style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
window.print();
</script>
<br />
<table width="495" border="0" cellpadding="3" cellspacing="3">
<?
//echo "Valor $valor";



for ($i=0;$i < $cantidad;$i++)
   {
   $count++;
   $num=$hasta + $i;
   $text="$id_procedencia".$fhoy.$num;
?>
  <tr>
    <td height="68" nowrap="nowrap"><div align="center">&nbsp;&nbsp;<img src="barcode.php?barcode=<?echo $text?>&width=240&height=120" /></div></td>
    <td nowrap="nowrap"> <div align="center">&nbsp;&nbsp;&nbsp;<IMG SRC="barcode.php?barcode=<?echo $text?>&width=240&height=120"></div></td>
  </tr>
  <tr>
    <td colspan="2"><br /><br /></td>
  </tr>
  <?
   $mod=$count % 3;
   if ($mod == 0 and $count != $cantidad){
  ?>
  <tr>
    <td colspan="2"><br /></td>
  </tr>
  <? 
   }
  ?>
  <? } }?>
</table>
