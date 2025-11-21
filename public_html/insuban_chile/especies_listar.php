<?
require "lib/conexion.php";

$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";
   //echo "echo1**#".$username."-use".$password."-Pass#";
       //  if ($username and $password)
      //  {

$sql="SELECT * FROM especie where id_especie != 0 and especie != '' ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//}

?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="600" height="180" border="0" align="center">
  <tr>
    <td width="600" valign="top"><table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="14" colspan="3" class="titulo"><div align="right"><a href="?modulo=especies.php&amp;nuevo=1" >Ingresar Nuevo</a></div></td>
        </tr>
      <tr>
        <td width="29" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&deg;</td>
        <td width="523" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Especies</td>
        <td width="40" bgcolor="#CCCCCC" class="titulo">&nbsp;ID </td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_especie=$row[id_especie];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=especies.php&id_esp=<?echo $row[id_especie]?>"><?echo $row[especie]?></a></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_especie?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>