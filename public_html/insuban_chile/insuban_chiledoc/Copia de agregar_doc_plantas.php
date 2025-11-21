<?
require "conex/conex.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "conex/fun.php";


if($guardar){
	
	$fecha_sistema_adc =date("Y-m-d H:i:s");
	
if (isset($_REQUEST['proceso'])){ 
echo $_REQUEST['proceso']."<br>"; 
}
$tipo_pdf2007="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; //office 2007
$tipo_pdf2003="application/vnd.ms-excel"; //office 2003
$tipo_pdf="application/pdf"; 
$archivo=$archivo;
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal))); 
$binario_nombre=$_FILES['archivo']['name']; 
$binario_peso=$_FILES['archivo']['size']; 
$binario_tipo=$_FILES['archivo']['type']; 
$binario_nombre= $binario_nombre."/".$fecha_sistema_adc;

if($binario_tipo == $tipo_pdf2007){		

  $sqlsubir="insert into doc  (id_centros_produccion,nom_alternativo_doc,archivo_binario,archivo_nombre,archivo_peso,archivo_tipo,fecha_sistema_adc) values ('$id_centros_produccion','$nom_alternativo_doc','$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo','$fecha_sistema_adc')";
  $resultsubir=mysql_query($sqlsubir);
  //echo "sqlsubir $sqlsubir<br>";
}
if($binario_tipo == $tipo_pdf2003){		

$sqlsubir="insert into doc  (id_centros_produccion,nom_alternativo_doc,archivo_binario,archivo_nombre,archivo_peso,archivo_tipo,fecha_sistema_adc) values ('$id_centros_produccion','$nom_alternativo_doc','$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo','$fecha_sistema_adc')";
  $resultsubir=mysql_query($sqlsubir);
 // echo "sqlsubir $sqlsubir<br>";
}

if($binario_tipo == $tipo_pdf)
$sqlsubir="insert into doc  (id_centros_produccion,nom_alternativo_doc,archivo_binario,archivo_nombre,archivo_peso,archivo_tipo,fecha_sistema_adc) values ('$id_centros_produccion','$nom_alternativo_doc','$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo','$fecha_sistema_adc')";
  $resultsubir=mysql_query($sqlsubir);
 // echo "sqlsubir $sqlsubir<br>";

}



?>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form name="form1" method="post" action="" enctype="multipart/form-data">
<table width="765" border="1">
  <tr>
    <td colspan="2">Adjuntar Documentos a planta</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="344">Seleccione el nombre de la planta</td>
    <td width="405">Nombre del documento</td>
  </tr>
  <tr>
    <td>&nbsp;<? $centro_produccion=crea_centros_produccion($link,$id_centros_produccion,1);
		echo $centro_produccion;?></td>
    <td><input name="nom_alternativo_doc" type="text" id="nom_alternativo_doc" size="50" maxlength="30"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Adjunto Documentos</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><input name="archivo" type="file" id="archivo" size="30" />
      &nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="guardar" id="guardar" value="Guardar"></td>
  </tr>
</table>

</form>
