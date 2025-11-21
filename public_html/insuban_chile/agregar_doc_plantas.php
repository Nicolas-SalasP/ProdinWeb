<?
require "lib/conex_bd_doc.php";
$link = mysql_connect("$localhost2","$user2","$pass2");
mysql_select_db("$db2");
require "lib/fun_db_doc.php";



if($guardar and $id_mes){
	
	$fecha_sistema_adc =date("Y-m-d H:i:s");
	
if (isset($_REQUEST['proceso'])){ 
echo $_REQUEST['proceso']."<br>"; 
}
$tipo_pdf2007="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; //office 2007
$tipo_pdf2003="application/vnd.ms-excel"; //office 2003
//$tipo_pdf="application/pdf"; 
$archivo=$archivo;
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal))); 
$binario_nombre=$_FILES['archivo']['name']; 
$binario_peso=$_FILES['archivo']['size']; 
$binario_tipo=$_FILES['archivo']['type']; 
$binario_nombre= $binario_nombre;

if($binario_tipo == $tipo_pdf2007){		

  $sqlsubir="insert into doc  (id_centros_produccion,id_mes,archivo_binario,archivo_nombre,archivo_peso,archivo_tipo,fecha_sistema_adc) values ('$id_centros_produccion','$id_mes','$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo','$fecha_sistema_adc')";
  $resultsubir=mysql_query($sqlsubir);
  //echo "sqlsubir $sqlsubir<br>";
}
if($binario_tipo == $tipo_pdf2003){		

$sqlsubir="insert into doc  (id_centros_produccion,id_mes,archivo_binario,archivo_nombre,archivo_peso,archivo_tipo,fecha_sistema_adc) values ('$id_centros_produccion','$id_mes','$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo','$fecha_sistema_adc')";
  $resultsubir=mysql_query($sqlsubir);
 // echo "sqlsubir $sqlsubir<br>";
}

/*if($binario_tipo == $tipo_pdf){
$sqlsubir="insert into doc  (id_centros_produccion,nom_alternativo_doc,archivo_binario,archivo_nombre,archivo_peso,archivo_tipo,fecha_sistema_adc) values ('$id_centros_produccion','$nom_alternativo_doc','$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo','$fecha_sistema_adc')";
  $resultsubir=mysql_query($sqlsubir);
 // echo "sqlsubir $sqlsubir<br>";
}*/
$mensaje=1;
}



?>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
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
<form name="form1" method="post" action="" enctype="multipart/form-data">
<table width="434" border="0">
  <tr>
    <td colspan="2" bgcolor="#FF9900" class="stylenegrita">Adjuntar Documentos a planta</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="222" bgcolor="#CCCCCC" class="style4">Seleccione el nombre de la planta</td>
    <td width="200" bgcolor="#CCCCCC" class="style4">Selecione el Mes</td>
  </tr>
  <tr>
    <td>&nbsp;<? $centro_produccion=crea_centros_producciondb2($link,$id_centros_produccion,1);
		echo $centro_produccion;?></td>
    <td><?
    $mes=crea_mes($link,$id_mes);
		echo $mes;
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" class="style4">Adjunto Documentos</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><input name="archivo" type="file" class="style4" id="archivo" size="30" />
      &nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<? if($mensaje){?>
    Documento Guardado en la base de datos 
	<? }?></td>
  </tr>
  <tr>
    <td colspan="2"><input name="guardar" type="submit" class="style4" id="guardar" value="Guardar"></td>
  </tr>
</table>

</form>


<script languaje="javascript">
<? if($mensaje){ ?>
window.opener.document.location.replace('http://200.63.96.220/~insubac/insuban_chile/<? echo $url;?>sistema.php?modulo=informes_por_planta.php&id_centros_produccion=<? echo $id_centros_produccion?>');

</script>
<script language="javascript">
window.close();
</script><? } ?>