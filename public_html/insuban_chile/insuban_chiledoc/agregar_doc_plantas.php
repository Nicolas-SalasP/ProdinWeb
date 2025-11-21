<?
require "../lib/conexion.php";
require( '../lib/session_admin.php');
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";

if($guardar){
	
	//$fecha_sistema_adc =date("Y-m-d H:i:s");
	
if (isset($_REQUEST['proceso'])){ 
echo $_REQUEST['proceso']."<br>"; 
}
$hora = date("d-m-Y $hh:i:s"); 
$tipo_pdf="application/pdf";
$archivo=$archivo;
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal))); 
$binario_nombre=$_FILES['archivo']['name']; 
$binario_peso=$_FILES['archivo']['size']; 
$binario_tipo=$_FILES['archivo']['type']; 
$binario_nombre= $binario_nombre."/".$hora;


if($binario_tipo == $tipo_pdf){
if($binario_peso <= 100048576 )
{    
$fecha_ingreso=date("Y-m-d H:i:s");
$consulta_insertar = "INSERT INTO doc (archivo_binario,archivo_nombre,archivo_peso,archivo_tipo) VALUES ('$binario_contenido','$binario_nombre','$binario_peso','$binario_tipo')";
$rest=mysql_query($consulta_insertar);
//echo "consulta_insertar $consulta_insertar<br>";
$error=mysql_error();
}//if($binario_peso <= 3048576 )
}else{

echo "No es un archivo PDF";

}//if($binario_tipo == $tipo_pdf){

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
    <td>&nbsp;<? //$centro_produccion=crea_centros_produccion($link,$id_centros_produccion,1);
		//echo $centro_produccion;?></td>
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
