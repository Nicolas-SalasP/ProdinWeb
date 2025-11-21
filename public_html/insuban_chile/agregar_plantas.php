<?
require "lib/conex_bd_doc.php";
$link = mysql_connect("$localhost2","$user2","$pass2");
mysql_select_db("$db2");
require "lib/fun_db_doc.php";

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
<form id="form1" name="form1" method="post" action="">
<table width="300" border="0">

<tr>
    <td bgcolor="#FF9900">N&ordm;</td>
    <td bgcolor="#FF9900">Plantas</td>
    <td width="49" bgcolor="#D6D6D6"><a href="#" onclick="cambiar('error'); return false;"  class="titulo">Ingresar</a></td>
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
    <td width="222"><input name="centro_produccion-<? echo $id_centros_produccion?>" type="text" id="centro_produccion" value="<?echo $row[centro_produccion]?>" size="30" maxlength="25" /></td>
    <td>
    <?   $sqls="SELECT * FROM doc where id_centros_produccion = $id_centros_produccion";
	     $results=mysql_query($sqls);
	     $cuantoss=mysql_num_rows($results);
		 //echo $cuantoss;
	 
	 ?>
    <? if(!$cuantoss){?>
   <center><a href="agregar_plantas.php?elim=<? echo $id_centros_produccion ?>" target="_parent">X</a></center>
   <? }?>
    </td>
  </tr>
  <?
	  }
  ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" name="modificar" id="modificar" value="Modificar"></td>
  </tr>
 
</table>


<div id="error" style="display: none;">
<table width="300" border="0">
  <tr>
    <td colspan="2" bgcolor="#FF9900">Ingresar Centro Produccion</td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#D6D6D6">Centro Produccion</td>
    </tr>
  <tr>
    <td width="20"><input name="centro_produccion" type="text" id="centro_produccion2" size="30" maxlength="25" /></td>
    <td width="270" align="right"><input type="submit" name="agregar" id="agregar" value="Agregar" /></td>
  </tr>
</table>
</div>




</form>