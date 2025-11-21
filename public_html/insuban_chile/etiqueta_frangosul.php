<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";



//echo "id_pakin_relacion $id_paking_relacion <br>";
//echo "Cuantos1 $cuantos1 <br>";
//echo "Etiquetas $id_etiquetas<br>";
//echo "folio_piking  $folio_piking ";
//echo "Cantidad $cantidad<br>Unidad Produccion $id_unidad_produccion<br>Responsable $id_operarios";
$fhoy=date("y");



if($id_paking_relacion){
$fhoy=date("y");

$sql="select * from etiquetas_pakings where id_etiquetas = 7 order by fecha_etiqueta_paking desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "cuantos sql $cuantos";
//echo "SQL $sql";

if ($id_etiquetas == 15 or $id_etiquetas == 12){

 $hasta= $cuantos1;

  $fecha_etiqueta_paking=date("Y-m-d H:i:s");
  $sql_nuevo="insert into etiquetas_pakings   (folio_piking,id_etiquetas,desde,hasta,fecha_etiqueta_paking) values ($folio_piking,$id_etiquetas,1,$hasta,'$fecha_etiqueta_paking')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
 }
if($id_etiquetas == 7)
{
$row=mysql_fetch_array($result);
if($row[hasta] == ''){
$hasta= $row[hasta] + 1;
$valor= $row[hasta] + $cuantos1;
}else{
$hasta= $row[hasta] + 1;
$valor= $row[hasta] + $cuantos1;
}


  $fecha_etiqueta_paking=date("Y-m-d H:i:s");
  $sql_nuevo="insert into etiquetas_pakings   (folio_piking,id_etiquetas,desde,hasta,fecha_etiqueta_paking) values ($folio_piking,$id_etiquetas,$hasta,$valor,'$fecha_etiqueta_paking')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  //echo "$sql_nuevo<br>";
  
 }
}



//$id_pak $id_etiquetas
$sql="SELECT pro.nombre, c.calibre, ef.contenido_unidades, ef.f_elaboracion, ef.f_vencimiento, mp.nombre AS nombre2, ef.id_etiquetados_folios, ef.ano,ef.nombre_alt,ef.calibre_alt
		
		FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion 
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		
		group by ef.id_etiquetados_folios
		";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
		
		


?>

<script language="JavaScript" type="text/javascript">
window.print();
</script>
<?   
      if($id_etiquetas == 12){

		for ($i=1 ; $i <= $hasta ; $i++)
   		{
   		$num=$i;

    
      $r=mysql_fetch_array($rest);
	  $f_termino=format_fecha_sin_hora($r[f_termino]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	  
	 
	 
	        
?>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif}
.style5 {font-size: 14px}
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<table width="433" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><div align="center" class="style15 style5">ENVOLT&Oacute;RIO NATURAL SALGADO DE SUINO<BR>
    (TRIP&Aacute;)</div></td>
  </tr>
  <tr>
    <td width="165"><span class="style5">CONTEM</span></td>
    <td width="3"></td>
    <td colspan="2">TRIPAS DE SUINO SALGADAS </td>
  </tr>
  <tr>
    <td><span class="style5">INGREDIENTES</span></td>
    <td><span class="style5">:</span></td>
    <td colspan="2"><span class="style5">TRIPA E SAL </span></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="2"><span class="style5">PROCESADORA INSUBAN LTDA </span></td>
  </tr>
  <tr>
    <td></span></td>
    <td></span></td>
    <td colspan="2"><span class="style5">AV. ANTILLANCA NORTE 391 </span></span></td>
  </tr>
  <tr>
    <td></span></td>
    <td></span></td>
    <td colspan="2"><span class="style5">ZONA INDUSTRIAL LO BOZA/PUDAHUEL </span></span></td>
  </tr>
  <tr>
    <td><span class="style5">:</span></span></td>
    <td></span></td>
    <td colspan="2"><span class="style5">SANTIAGO - CHILE </span></span></td>
  </tr>
  <tr>
    <td><span class="style5">ESTABLECIMIENTO</span></span></td>
    <td><span class="style5">:</span></span></td>
    <td colspan="2"><span class="style5"> N&ordm; 13-62 </span></span></td>
  </tr>
  <tr>
    <td><span class="style5">IMPOTADOR</span></span></td>
    <td><span class="style5">:</span></span></td>
    <td colspan="2"><span class="style5">FRIMESA COOPERATIVA CENTRAL </span></td>
  </tr>
  <tr>
    <td></span></td>
    <td></span></td>
    <td colspan="2">R. BAHIA, 159 MEDIANEIRA - PR </td>
  </tr>
  <tr>
    <td></span></td>
    <td></span></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style5">NUMERACAO</span></span></td>
    <td></span>:</td>
    <td colspan="2"><? echo $num;?></span></td>
  </tr>
  <tr>
    <td><span class="style5">PAIS DE ORIGEM </span></span></td>
    <td><span class="style5">:</span></span></td>
    <td colspan="2"><span class="style5">CHILE</span></span></td>
  </tr>
  <tr>
    <td><span class="style5">PAIS DE PROCEDENCIA </span></span></td>
    <td></span><span class="style5">:</span></span></td>
    <td colspan="2"><span class="style5">CHILE</span></span></td>
  </tr>
  <tr>
    <td colspan="4"><span class="style5">REGISTRO NO MINISTERIO DA AGRICULTURA </span></span></td>
  </tr>
  <tr>
    <td colspan="4"><span class="style5">SIF/DIPOA sob n 002/13-52 </span></td>
  </tr>
  <tr>
    <td><span class="style5">DATA DE FABRICACAO </span></span></td>
    <td><span class="style5">:</span></span></td>
    <td width="84">&nbsp;<span class="style5">
	 <? 
	 $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	?>
	</span></span></td>
    <td width="181"></span></td>
  </tr>
  <tr>
    <td height="21"><span class="style5">DATA DE VALIDADE </span></span></td>
    <td><span class="style5">:</span></span></td>
    <td>&nbsp;<span class="style5">
	<? 
	 $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	 ?>
	</span></span></td>
    <td width="181"></span></td>
  </tr>
  <tr>
    <td colspan="4"><span class="style5">INDUSTRIA DO CHILE </span></span></td>
  </tr>
  <tr>
    <td colspan="4"><span class="style5">MANTENHA EM LOCAL SECO E AREJADO </span></span></td>
  </tr>
  <tr>
    <td colspan="4" class="style4">&nbsp;</td>
  </tr>
   <tr>
    <td colspan="4" class="style4">&nbsp;</td>
  </tr>
</table>
<? 
}//for
 } //fin del etiquetas == 2
?>