<?
require "conex/conex.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");

if($modificar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'centro_produccion')
	{
    $id=$dat[1];
    $centro_produccion=$_POST["centro_produccion-$id"];
    $sql="UPDATE centros_produccion SET  centro_produccion='$centro_produccion' where id_centros_produccion = $id";
	$retsul=mysql_query($sql);
	//echo "sql $sql<br>";
	}
}
}

if($agregar){
  $sql="insert into centros_produccion (centro_produccion) values ('$centro_produccion')";
  $result=mysql_query($sql);
}


 if($elim){
   $sql="delete from centros_produccion where id_centros_produccion = $elim";
   $result=mysql_query($sql);
   }//fin borrar
  
$sql="SELECT * FROM centros_produccion";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);



?>
<script language="JavaScript"> 
function cambiar(esto)
{
	vista=document.getElementById(esto).style.display;
	if (vista=='none')
		vista='block';
	else
		vista='none';

	document.getElementById(esto).style.display = vista;
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
<table width="302" border="1">

<tr class="stylenegrita">
    <td bgcolor="#FF9900">N&ordm;</td>
    <td bgcolor="#FF9900">Plantas</td>
    <td width="48" bgcolor="#999999"><a href="#" onclick="cambiar('error'); return false;"  class="titulo">Ingresar</a></td>
  </tr>
 
  <? 
  $i=0;
  while ($row=mysql_fetch_array($result))
      {
	  $i++;	  
	  $id_centros_produccion=$row[id_centros_produccion];
  ?>
  <tr>
    <td width="20"><? echo $i?></td>
    <td width="212" class="style4">
      <input name="centro_produccion-<? echo $id_centros_produccion?>" type="text" id="centro_produccion" value="<?echo $row[centro_produccion]?>" size="20" maxlength="20" />
    </td>
    <td>
   <center>
     <span class="style4"><a href="agregar_plantas.php?elim=<? echo $id_centros_produccion ?>" target="_parent">X</a></span>
   </center>
    </td>
  </tr>
  <?
	  }
  ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input name="modificar" type="submit" class="style4" id="modificar" value="Modificar"></td>
  </tr>
 
</table>

<div id="error" style="display: none;">c

<table width="302" border="1">
  <tr>
    <td bgcolor="#CCCCCC" class="stylenegrita">Ingresar Centro Producci&oacute;n</td>
  </tr>
  <tr>
    <td class="style4">Centro Producci&oacute;n</td>
    </tr>
  <tr>
    <td><input name="centro_produccion" type="text" class="style4" id="centro_produccion2" size="20" maxlength="20" /></td>
    </tr>
  <tr>
    <td><input name="agregar" type="submit" class="style4" id="agregar" value="Agregar"></td>
    </tr>
</table>
</div>



</form>