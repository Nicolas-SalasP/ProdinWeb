<?
if($generar_inv_mpn){
$sqlf="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, pro.id_producto AS id_producto, est.id_estado_material AS id_estado_material FROM mat_prima_nacional AS mpn, producto AS pro, estado_material AS est  WHERE mpn.id_estado_material = 1 AND mpn.id_estado_material = est.id_estado_material AND mpn.id_producto = pro.id_producto ";
$resultf=mysql_query($sqlf);

while ($rowf=mysql_fetch_array($resultf))
    { 
	
	$id_ptn=$rowf[id_mat_prima_nacional];
	$id_producn=$rowf[id_producto];
	$id_estfolion=$rowf[id_estado_material];
	echo "id_pt $id_ptn - id_produc $id_producn - id_estfolio $id_estfolion<br>";
	
	$f_toma_inventariom=date("Y-m-d"); 
	$sql_invpt="insert into historial_inventario_mpn (id_ptn,id_producn,id_estfolion,f_toma_inventariom) values ($id_ptn,$id_producn,$id_estfolion,'$f_toma_inventariom')";
    $result_invpt=mysql_query($sql_invpt,$link);
	
	
	}
	
	}//

if($buscarmpn){
	
	
if($fechainv){ $fechainvok=format_fecha_sin_hora($fechainv); }
	//echo "fechainvok $fechainvok";

}


?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-size: 14px}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">

<?

if(!$fechainv){
$fechainv=date("Y-m-d"); 	
$fechainv=format_fecha_sin_hora($fechainv); 
}
?>

<table width="763" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC">FILTRO DE BUSQUEDA DE INVENTARIO DE MATERIA PRIMA NACIONAL</td>
  </tr>
  <tr>
    <td><input name="fechainv" type="text" class="cajas"   id="fechainv"  value="<?echo $fechainv?>" size="7" maxlength="10" />
      <a href="javascript:show_Calendario('form1.fechainv');" ><img src="jpg/ver_t.jpg" width="14" height="17" border="0" />
        <input type="submit" name="buscarmpn" id="buscarmpn" value="Buscar" />
      </a></td>
  </tr>
  <tr>
    <td>Nota: El inventario de MPN incluye el estado de:  Bodega</td>
  </tr>
</table>
<? if($fechainv and $buscarmpn){?>
<table width="696" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><span class="titulo">INVENTARIO DE MPN</span></td>
  </tr>
  <tr class="titulo">
    <td width="22">&nbsp;</td>
    <td width="164">ORIGEN</td>
    <td colspan="4">N&ordm; COMPROBANTE</td>
    </tr>
  <?
  $sql="SELECT * FROM mat_prima_nacional AS mpn, origenes AS org, historial_inventario_mpn AS himpn WHERE mpn.id_mat_prima_nacional = himpn.id_ptn AND mpn.id_origen = org.id_origen AND himpn.f_toma_inventariom  = '$fechainvok' group by mpn.comprobante_num order by mpn.id_origen";
$result=mysql_query($sql);


  
  $i=0;
  while ($row=mysql_fetch_array($result))
    { 
	$i++;
	$origen=$row[origen];
	$id_origen=$row[id_origen];
	$producto=$row[producto];
	$comprobante_num=$row[comprobante_num];
	$total_bidones=$row[total_bidones];
	$contenido_unidades=$row[contenido_unidades];
	  
	 
  ?>
  <tr class="cajas">
    <td bgcolor="#CCCCCC">&nbsp;<? echo $i?></td>
    <td bgcolor="#CCCCCC">&nbsp;<? echo "$origen";?></td>
    <td width="99" bgcolor="#CCCCCC">&nbsp;<? echo $comprobante_num?></td>
    <td width="396" colspan="3" bgcolor="#CCCCCC">&nbsp;&nbsp;</td>
    </tr>
  <tr class="cajas">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;<?
     $sqlnum_comprobante="SELECT count(DISTINCT mpn.id_mat_prima_nacional) AS total_bidones, SUM(mpn.contenido) AS contenidompn, p.producto AS producto FROM historial_inventario_mpn AS himpn, mat_prima_nacional AS mpn, producto AS p WHERE himpn.id_ptn = mpn.id_mat_prima_nacional and mpn.id_producto = p.id_producto and mpn.comprobante_num = '$comprobante_num' AND himpn.f_toma_inventariom  = '$fechainvok' group by mpn.id_producto order by p.producto desc";
	 $resultnum_comprobante=mysql_query($sqlnum_comprobante);
	 //echo "<br>sqlnum_comprobante $sqlnum_comprobante";
  	 $cuantos_numc=mysql_num_rows($resultnum_comprobante);
	 //echo "cuantos_numc $cuantos_numc";
	
	  
	?></td>
    <td colspan="3">    
    <table width="399" border="1" cellpadding="0" cellspacing="0">
   
  
        <tr class="titulo">
          <td bgcolor="#FF9900">PRODUCTO</td>
          <td align="center" bgcolor="#FF9900">BIDONES</td>
          <td align="center" bgcolor="#FF9900">CONTENIDO</td>
        </tr>
         <? 
	  while ($rownum_comprobante=mysql_fetch_array($resultnum_comprobante))
    { 

	$producto=$rownum_comprobante[producto];
	$total_bidones=$rownum_comprobante[total_bidones];
	$contenidompn=$rownum_comprobante[contenidompn];
	  ?>
        <tr>
          <td width="129"><span class="cajas"><? echo "$producto";?></span></td>
          <td width="115" class="cajas"><center><? echo $total_bidones?></center></td>
          <td width="133" class="cajas"><center><? echo $contenidompn?></center></td>
        </tr>
           <? }
		 
		   ?>
     
      </table></td>
    </tr>
    <?
	}?>

</table>
<? }?>
<? if($fechainv and $buscarmpn){?>
<table width="694" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="685"> <!--<a href="excel_mpn.php?f_toma_inventariof=<? //echo $fechainvok?>" target="_blank">EXPORTAR A EXCEL
      
    </a>--> / <a href="excel_folios_mpn.php?f_toma_inventariof=<? echo $fechainvok?>" target="_blank">HISTORIAL DE FOLIOS AL <? echo $fechainvok?>
      
    </a></td>
  </tr>
</table>
<? }?>
</form>