<?
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
/*$sql="SELECT pro.nombre AS prod, c.calibre, ef.contenido_unidades, ef.f_elaboracion, ef.f_vencimiento, mp.nombre AS nombre3, ef.id_etiquetados_folios, ef.ano,ef.nombre_alt,ef.calibre_alt
		
		FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion 
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by prod,nombre_alt, c.calibre, mp.nombre, ef.id_etiquetados_folios asc
	
		"; 	
		
		*/
		
		
		$sql="SELECT pro.nombre AS prod, c.calibre, ef.contenido_unidades, ef.f_elaboracion,ef.f_vencimiento, mp.nombre AS nombre3, ef.id_etiquetados_folios, ef.ano,ef.nombre_alt,ef.calibre_alt
		
		FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion 
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by nombre_alt, c.calibre, mp.nombre, ef.id_etiquetados_folios asc
	
		";
		
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
		
		//group by ef.id_etiquetados_folios


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
body {
	margin-left: 0px;
	margin-top: 0px;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/javascript">
window.print();
</script>
<?   
      if($id_etiquetas == 7){

		for ($i=$hasta ; $i <= $valor ; $i++)
   		{
   		$num=$i;

    
      $r=mysql_fetch_array($rest);
	  $f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        
?>
<table width="393" height="421" border="0">
  <tr>
    <td width="123" height="19" class="style7">Exportador</td>
    <td width="3">:</td>
    <td colspan="2" class="style7">PROCESADORA INSUBAN LTDA </td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Antillanca Norte 391 </td>
  </tr>
  <tr>
    <td height="19">Pa&iacute;s Exportador </td>
    <td>:</td>
    <td colspan="2">Santiago Chile </td>
  </tr>
  <tr>
    <td height="19">Pa&iacute;s de Destino </td>
    <td>:</td>
    <td colspan="2">Genova / Italia </td>
  </tr>
  <tr>
    <td height="19">Compa&ntilde;ia</td>
    <td>:</td>
    <td colspan="2">BLANCASING&nbsp;</td>
  </tr>
  <tr>
    <td height="19">Direcci&oacute;n</td>
    <td>:</td>
    <td colspan="2">Via Montegrappa 17/25 </td>
  </tr>
  <tr>
    <td height="19">N&ordm; de Bultos </td>
    <td>:</td>
    <td colspan="2"><? echo $cuantos;?></td>
  </tr>
  <tr>
    <td height="19">Enviado Por </td>
    <td>:</td>
    <td colspan="2">Maritimo</td>
  </tr>
  <tr>
    <td height="19">N&ordm; de Lote </td>
    <td>:</td>
    <td colspan="2"><? echo substr($r[ano],2,4); ?><?echo $r[id_etiquetados_folios]?></td>
  </tr>
  <tr>
    <td height="19">Cantidad</td>
    <td>:</td>
    <td colspan="2"><?echo $r[contenido_unidades]?></td>
  </tr>
  <tr>
    <td height="19">Tripa</td>
    <td>:</td>
    <td colspan="2">
      <?
	     if ($r[nombre_alt] != '')
		  {
		  echo "$r[nombre_alt]";
	      }else{
		   echo "$r[nombre_pro]";
		  }
		/*if ($r[nombre_alt] != '') {
		  $i++;
		  $nombre=$r[nombre_alt];
		}
		else
		$nombre=$r[nombre_pro];
		echo $nombre;*/
		?>    </td>
  </tr>
  <tr>
    <td height="19">Calibre</td>
    <td>:</td>
    <td width="83">
      <?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>    </td>
    <td width="166" rowspan="4"><img src="jpg/NR1362.jpg" width="140" height="78" /></td>
  </tr>
  <tr>
    <td height="19">Metraje</td>
    <td>:</td>
    <td><?echo $r[nombre3]?></td>
  </tr>
  <tr>
    <td height="19">Fecha de Elab </td>
    <td>:</td>
    <td> <? 
	 $dat2=split(" ",$f_elaboracion);
      $dat=split("-",$dat2[0]);
      $f_elaboracion="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	?></td>
  </tr>
  <tr>
    <td height="19">Fecha Cad </td>
    <td>:</td>
    <td><? 
	 $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	 ?></td>
  </tr>
  <tr>
    <td height="50" colspan="4" class="cajas">Mantener en Lugar Fresco y Seco a Temperatura Ambiente </td>
  </tr>
  <tr>
    <td height="9" colspan="4"><? echo $num;?></td>
  </tr>
</table>
<? 
}//for
 } //fin del etiquetas == 7
?>

<?   
      if($id_etiquetas == 15){

		for ($i=1 ; $i <= $hasta ; $i++)
   		{
   		$num=$i;

    
      $r=mysql_fetch_array($rest);
	  $f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        
?>

<table width="409" border="0">
  <tr>
    <td width="127">Consignor</td>
    <td width="4">:</td>
    <td colspan="2">PROCESADORA INSUBAN LTDA </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Antillanca Norte 391 (chile) </td>
  </tr>
  <tr>
    <td>Export Country </td>
    <td>:</td>
    <td colspan="2">Santiago Chile </td>
  </tr>
  <tr>
    <td>Destination Country </td>
    <td>:</td>
    <td colspan="2">Sydney - Australia </td>
  </tr>
  <tr>
    <td>Consignee</td>
    <td>:</td>
    <td colspan="2">Almol Casings PTY </td>
  </tr>
  <tr>
    <td>Address:</td>
    <td>:</td>
    <td colspan="2">18 Clevedon Street Botany </td>
  </tr>
  <tr>
    <td>N&ordm; Of Cask </td>
    <td>:</td>
    <td colspan="2"><? echo $cuantos;?></td>
  </tr>
  <tr>
    <td>Transport</td>
    <td>:</td>
    <td colspan="2">Martim</td>
  </tr>
  <tr>
    <td>Quantity</td>
    <td>:</td>
    <td colspan="2"><?echo $r[contenido_unidades]?></td>
  </tr>
  <tr>
    <td>Tipe</td>
    <td>:</td>
    <td colspan="2">
      <?
		
		?>    </td>
  </tr>
  <tr>
    <td>Calibre</td>
    <td>:</td>
    <td>
      <?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>    </td>
    <td width="179" rowspan="4"><img src="jpg/NR1362.jpg" width="140" height="78" /></td>
  </tr>
  <tr>
    <td>Metraje</td>
    <td>:</td>
    <td><?echo $r[nombre2]?></td>
  </tr>
  <tr>
    <td>Fecha de Elab </td>
    <td>:</td>
    <td width="81"><? echo $f_elaboracion?></td>
  </tr>
  <tr>
    <td height="21">Fecha Cad </td>
    <td>:</td>
    <td><? echo $f_vencimiento?></td>
  </tr>
  <tr>
    <td colspan="4">Keep In Fresh and Dryve Place at Temperature Not <BR>More Than 25&ordm;C </td>
  </tr>
  <tr>
    <td height="20" colspan="4"><? echo $num;?></td>
  </tr>
</table>
<? 
}//for
 } //fin del etiquetas == 2
?>