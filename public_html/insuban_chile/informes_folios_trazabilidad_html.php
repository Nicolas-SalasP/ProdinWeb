<?
/*
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
*/

$sql1="SELECT * from paking AS p, etiquetados_folios AS ef where p.id_paking_relacion = $id_paking_relacion and p.id_etiquetados_folios = ef.id_etiquetados_folios order by p.id_paking desc";
$rest1=mysql_query($sql1);
$cuantos1=mysql_num_rows($rest1);

?>
<style type="text/css">
<!--
.cajas {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.titulo_grande {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
.titulo_color {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #0000FF; }
-->
</style>

<table width="600" border="0" align="center">
  <tr>
    <td width="517" height="21" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" class="titulo">PROCESADORA INSUBAN LTDA</td>
  </tr>
  <tr>
    <td height="9" class="titulo">DEPTO. ASEG. CALIDAD</td>
  </tr>
  <tr>
    <td height="10" class="titulo">DESTINOS:
	<?
	$sqldes="SELECT * from destinos where id_destinos = $id_destinos";
	$restdes=mysql_query($sqldes);
	while ($rdes=mysql_fetch_array($restdes)){ 
	echo $rdes[destinos];
	}
	
	?></td>
  </tr>
  <tr>
    <td height="21" class="titulo">CANTIDAD: <? echo $cantifo ?></td>
  </tr>
  <tr>
    <td class="titulo">FACTURA: <? echo $factura ?></td>
  </tr>
  
  <tr>
    <td height="21" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">
      <table width="614" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="13" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">ID</td>
          <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&deg; FOLIO</td>
          <td width="18%" valign="bottom" bgcolor="#CCCCCC" class="titulo">FECHA SALADO</td>
          <td width="19%" bgcolor="#CCCCCC" class="titulo">FECHA INICIO<a href="javascript:deseleccionar_todo()"></a></td>
          <td width="20%" bgcolor="#CCCCCC" class="titulo">FECHA TERMINO</td>
          <td width="22%" bgcolor="#CCCCCC" class="titulo">FECHA VENCIMIENTO</td>
        </tr>
        <? 
	
		$id_paking_relacion=$id_paking_relacion;
		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
 
     	 if($cuantos){
			 
		 $color = "#000000";$i = 0;
		   while ($r=mysql_fetch_array($rest)){ 
			$i++;
			 $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
			
			$f_elaboracion =format_fecha_sin_hora($r[f_elaboracion]);
			$f_inicio =format_fecha_sin_hora($r[f_inicio]);
			$f_termino =format_fecha_sin_hora($r[f_termino]);
			$f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
	        $id_etiquetados_folios=$r[id_etiquetados_folios];
			 
		?>
		
		   <tr>
		    <td width="7%" valign="top" bgcolor="<? echo $color?>" class="cajas">
            <div align="left"><? echo $i;?></div></td>
          <td width="14%" valign="top"  bgcolor="<? echo $color?>" class="cajas"><? echo $id_etiquetados_folios?></td>
          <td  bgcolor="<? echo $color?>" valign="top" class="cajas">&nbsp;<? echo $f_elaboracion?></td>
          <td valign="top"  bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $f_inicio?></td>
          <td valign="top"  bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $f_termino?></td>
          <td valign="top"  bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $f_vencimiento?>
		  <? if($i==54){?>
		  <br><br><br><br><br><br><br><br><br><br><br><br>
		  <? }?>
		  </td>
		  
		  
        </tr>
		
	
        <?
		
	 }//while ($r=mysql_fetch_array($rest)){ 
	 	

	}// if($cuantos){
	
?>
      </table></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" class="titulo">Material provenientes de las plantas de: </td>
  </tr>
  <tr>
    <td height="3" class="cajas"><?
	
			$sql_buscar="SELECT * 
FROM paking AS p, etiquetados_folios AS ef, folios_mat AS fm, mat_prima_nacional AS mpn, origenes AS orig
WHERE p.id_paking_relacion = $id_paking_relacion
AND p.id_etiquetados_folios = ef.id_etiquetados_folios
AND ef.id_etiquetados_folios = fm.id_etiquetados_folios
AND fm.id_mat = mpn.id_mat_prima_nacional
AND mpn.id_origen = orig.id_origen 
group by orig.origen";
			$result_buscar=mysql_query($sql_buscar);

			while ($rdes=mysql_fetch_array($result_buscar)){ 
			 echo "$rdes[origen] / ";
		   }
	?></td>
  </tr>
  <tr>
    <td height="1" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="1" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" class="cajas"><div align="center"><? $firma=crea_firma($link,$id_usuario);
														echo $firma;
													?></div></td>
  </tr>
  <tr>
    <td height="4" class="cajas"><div align="center">Firma autorizada que avala esta certif&iacute;caci&oacute;n </div></td>
  </tr>
  <tr>
    <td height="4" class="cajas">&nbsp;</td>
  </tr>
</table>
