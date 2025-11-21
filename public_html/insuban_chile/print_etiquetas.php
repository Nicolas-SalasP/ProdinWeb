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

$sql="select * from etiquetas_pakings where id_etiquetas = 2 order by fecha_etiqueta_paking desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//echo "cuantos sql $cuantos";
//echo "SQL $sql";

if ($id_etiquetas == 3 or $id_etiquetas == 4){

 $hasta= $cuantos1;

  $fecha_etiqueta_paking=date("Y-m-d H:i:s");
  $sql_nuevo="insert into etiquetas_pakings   (folio_piking,id_etiquetas,desde,hasta,fecha_etiqueta_paking) values ($folio_piking,$id_etiquetas,1,$hasta,'$fecha_etiqueta_paking')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
 }
if($id_etiquetas == 2)
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
-->
</style>
<br>

<script language="JavaScript" type="text/javascript">
window.print();
</script>
<?   
      if($id_etiquetas == 2){

		for ($i=$hasta ; $i <= $valor ; $i++)
   		{
   		$num=$i;

    
      $r=mysql_fetch_array($rest);
	  $f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        
?>

<table width="403" height="322" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="148" height="19" class="titulo">Exportador</td>
    <td width="6" class="titulo">:</td>
    <td width="249" class="titulo">PROCESADORA INSUBAN LTDA </td>
  </tr>
  <tr>
    <td height="19" class="titulo">&nbsp;</td>
    <td class="titulo">&nbsp;</td>
    <td class="titulo">Antillanca Norte 391 </td>
  </tr>
  <tr>
    <td height="19" class="titulo">Pa&iacute;s Exportador </td>
    <td class="titulo">:</td>
    <td class="titulo">Santiago Chile </td>
  </tr>
  <tr>
    <td height="19" class="titulo">Pa&iacute;s de Destino </td>
    <td class="titulo">:</td>
    <td class="titulo">Barcelona- Espa&ntilde;a </td>
  </tr>
  <tr>
    <td height="19" class="titulo">Compa&ntilde;ia</td>
    <td class="titulo">:</td>
    <td class="titulo">Agrimares S L </td>
  </tr>
  <tr>
    <td height="19" class="titulo">Direcci&oacute;n</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas">Via Carlos III 65 E3</span></td>
  </tr>
  <tr>
    <td height="19" class="titulo">N&ordm; de Bultos </td>
    <td class="titulo">:</td>
    <td class="titulo"><? echo $cuantos;?></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Enviado Por </td>
    <td class="titulo">:</td>
    <td class="titulo">Maritimo</td>
  </tr>
  <tr>
    <td height="19" class="titulo">N&ordm; de Lote </td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas"><? echo substr($r[ano],2,4); ?><?echo $r[id_etiquetados_folios]?></span></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Cantidad</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas"><?echo $r[contenido_unidades]?></span></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Tripa</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas">
      <?
		if ($r[nombre_alt] != '') {
		  $i++;
		  $nombre=$r[nombre_alt];
		  }
		else
		  $nombre=$r[nombre];
		echo $nombre;
		?>
    </span></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Calibre</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas">
      <?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>
    </span></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Metraje</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas"><?echo $r[nombre2]?></span></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Fecha de Elab </td>
    <td class="titulo">:</td>
    <td class="titulo"><? echo $f_elaboracion?></td>
  </tr>
  <tr>
    <td height="19" class="titulo">Fecha Cad </td>
    <td class="titulo">:</td>
    <td class="titulo"><? echo $f_vencimiento?></td>
  </tr>
  <tr>
    <td colspan="3" class="titulo">Mantener en Lugar Fresco y Seco a Temperatura Ambiente </td>
  </tr>
  <tr>
    <td height="18" colspan="3" class="titulo"><? echo $num;?></td>
  </tr>
</table><br><br>
<? 
}//for
 } //fin del etiquetas == 2
?>

<?   
      if($id_etiquetas == 3){

		for ($i=1 ; $i <= $hasta ; $i++)
   		{
   		$num=$i;

    
      $r=mysql_fetch_array($rest);
	  $f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        
?>

<table width="396" border="0">
  <tr>
    <td width="118" class="titulo">Consignor</td>
    <td width="4" class="titulo">:</td>
    <td width="260" class="titulo">PROCESADORA INSUBAN LTDA </td>
  </tr>
  <tr>
    <td class="titulo">&nbsp;</td>
    <td class="titulo">&nbsp;</td>
    <td class="titulo">Antillanca Norte 391 (chile) </td>
  </tr>
  <tr>
    <td class="titulo">Export Country </td>
    <td class="titulo">:</td>
    <td class="titulo">Santiago Chile </td>
  </tr>
  <tr>
    <td class="titulo">Destination Country </td>
    <td class="titulo">:</td>
    <td class="titulo">Sydney - Autralia </td>
  </tr>
  <tr>
    <td class="titulo">Consignee</td>
    <td class="titulo">:</td>
    <td class="titulo">Almol Casings PTY </td>
  </tr>
  <tr>
    <td class="titulo">Address:</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas">18 Clevedon Street Botany </span></td>
  </tr>
  <tr>
    <td class="titulo">N&ordm; Of Cask </td>
    <td class="titulo">:</td>
    <td class="titulo"><? echo $cuantos;?></td>
  </tr>
  <tr>
    <td class="titulo">Transport</td>
    <td class="titulo">:</td>
    <td class="titulo">Matiyim</td>
  </tr>
  <tr>
    <td class="titulo">Quantity</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas"><?echo $r[contenido_unidades]?></span></td>
  </tr>
  <tr>
    <td class="titulo">Tipe</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas">
      <?
		if ($r[nombre_alt] != '') {
		  $i++;
		  $nombre=$r[nombre_alt];
		  }
		else
		  $nombre=$r[nombre];
		echo $nombre;
		?>
    </span></td>
  </tr>
  <tr>
    <td class="titulo">Calibre</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas">
      <?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>
    </span></td>
  </tr>
  <tr>
    <td class="titulo">Metraje</td>
    <td class="titulo">:</td>
    <td class="titulo"><span class="cajas"><?echo $r[nombre2]?></span></td>
  </tr>
  <tr>
    <td class="titulo">Fecha de Elab </td>
    <td class="titulo">:</td>
    <td class="titulo"><? echo $f_elaboracion?></td>
  </tr>
  <tr>
    <td class="titulo">Fecha Cad </td>
    <td class="titulo">:</td>
    <td class="titulo"><? echo $f_vencimiento?></td>
  </tr>
  <tr>
    <td colspan="3" class="titulo">Keep In Fresh and Dryve Place at Temperature Not More Than 25&ordm;C </td>
  </tr>
  <tr>
    <td colspan="3" class="titulo"><div align="right"><strong>Chile Nr. 13-62 </strong></div></td>
  </tr>
  <tr>
    <td colspan="3" class="titulo"><? echo $num;?></td>
  </tr>
</table>
<br><br>
<? 
}//for
 } //fin del etiquetas == 2
?>
