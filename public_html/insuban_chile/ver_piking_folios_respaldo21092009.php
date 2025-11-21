<?
if ($modificar_all )
  {
   if ($id_ef_mod) 
    foreach ($id_ef_mod as $key)
   {
    $sql="update  etiquetados_folios set calibre_alt='$calibre_alt', nombre_alt='$nombre_alt' where id_etiquetados_folios=$key";
	$rest=mysql_query($sql);
   }
  
  }

$fecha=date("Y-m-d");
if($modificar_x or $id_estado_folio){

   if ($id_etiquetados_folios) 
    foreach ($id_etiquetados_folios as $key)
   {
    $sq_up_piking="update paking set  fdespacho_piking='$fecha' where id_etiquetados_folios =$key";
	
	$rest_up_piking=mysql_query($sq_up_piking);
	$sq_up_etf="update etiquetados_folios set id_estado_folio = '$id_estado_folio', id_destinos='$id_destinos', factura='$factura_paking',guia='$guia',fdespacho_piking='$fecha', glosa='$glosa'  where id_etiquetados_folios =$key";
	//echo "$sq_up_etf<br>";
	$rest_up_etf=mysql_query($sq_up_etf);
	}

}

if($borrar_x){
echo "Borrar";
}

//echo " id_paking_relacion   $id_paking_relacion";

$sql1="SELECT * from paking AS p, etiquetados_folios AS ef where p.id_paking_relacion = $id_paking_relacion and p.id_etiquetados_folios = ef.id_etiquetados_folios order by p.id_paking   desc";
$rest1=mysql_query($sql1);
$cuantos1=mysql_num_rows($rest1);

?>
<style type="text/css">
<!--
.cajas {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=yes,location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=yes, width=480, height=401, top=100, left=100"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>

<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="519" height="6" class="titulo">&nbsp;</td>
    <td width="101" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="6" class="titulo">Despacho Picking </td>
    <td width="101" class="cajas"><a href="?modulo=picking_folios.php">Volver Folios Picking</a></td>
  </tr>
  <tr>
    <td height="13" colspan="2" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" colspan="2"><form id="form1" name="form1" method="post" action="">
<? if($cuantos1){?>
<? if ($row=mysql_fetch_array($rest1)){ 
$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
?>
<table width="616" border="0" align="center">
  <tr>
    <td width="89" nowrap="nowrap" class="titulo">Estado Paking </td>
    <td class="cajas"><input name="id_pak" type="hidden" id="id_pak" value="<?echo $id_pak?>" />
	  
	  <? 
		$e= crea_efolio($link,$row[id_estado_folio],1);
		echo $e;
		
		
	   ?>
	  </td>
    <td width="299" rowspan="5" valign="top" class="cajas"><table width="279" border="0" align="center">
      <tr>
        <td colspan="3" class="titulo"><label>Cambiar  listado completo de los Productos Nombre y Calibre </label></td>
      </tr>
      <tr>
        <td width="137" class="cajas">Nombre Asociado </td>
        <td width="132" colspan="2"><input name="nombre_alt" type="text" class="cajas" id="nombre_alt2" /></td>
      </tr>
      <tr>
        <td class="cajas">Calibre </td>
        <td colspan="2"><label>
          <input name="calibre_alt" type="text" class="cajas" id="nombre_alt" />
          <input name="modificar_all" type="submit" class="cajas" id="modificar_all" value="Modificar Producto" />
        </label></td>
      </tr>
      <tr>
        <td colspan="3" class="titulo"><label>
            
			       <div align="center"></div>
          </label></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="9" class="titulo">Destino</td>
    <td width="214" class="cajas">
	           <? 
			        $destinos= crea_destinos($link,$row[id_destinos]);
					echo $destinos;
					
				   
				?>				</td>
    </tr>
  <tr>
    <td height="-2" class="titulo">Factura</td>
    <td class="cajas"><input name="factura_paking" type="text" id="factura_paking" value="<? echo $row[factura]?>" /></td>
    </tr>
  <tr>
    <td height="0" class="titulo">Gu&iacute;a</td>
    <td class="cajas"><input name="guia" type="text" id="guia" value="<? echo $row[guia]?>" /></td>
  </tr>
  <tr>
    <td height="1" class="titulo">Glosa</td>
    <td class="cajas"><input name="glosa" type="text" id="glosa" value="<? echo $row[glosa]?>" /></td>
    </tr>
  <tr>
    <td height="4" colspan="3" class="titulo"><hr></td>
    </tr>
  <tr>
    <td colspan="3" class="titulo">
	 <? if($id_destinos or $row[factura]){
	$etiquetas= crea_etiquetas_predefinidas($link,$id_etiquetas);
	echo $etiquetas;
	}
	?>
	    <? if($id_etiquetas){?>
		 <div align="center">
	    <a href="javascript:Abrir_ventana('print_agrimares.php?id_paking_relacion=<? echo $id_paking_relacion ?>&cuantos1=<? echo $cuantos1 ?>&id_etiquetas=<? echo $id_etiquetas?>&folio_piking=<? echo $row[folio_piking]?>')"> <img src="jpg/impresora.jpg" alt="Etiquetas" width="35" height="39" border="0" /><br>
	    Imprimir Etiquetas </a>	
		 </div>
	    <? }?>
	    </div></td>
  </tr>
  <tr>
    <td colspan="3" class="titulo">&nbsp;</td>
  </tr>
</table>
<? }?><br><br>
<table width="620" border="0" align="center">
  <tr>
    <td width="614"><table width="614" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio Nro </td>
        <td width="11%" bgcolor="#CCCCCC" class="titulo">Fecha Folio </td>
        <td width="35%" bgcolor="#CCCCCC" class="titulo">Producto <a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></td>
        <td width="12%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
        <td width="7%" bgcolor="#CCCCCC" class="titulo"> Medida </td>
        <td width="8%" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
        <td width="11%" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
      </tr>
      <? 
	
		$sql="SELECT pro.nombre, c.calibre, ef.contenido_unidades, ef.f_elaboracion, mp.nombre AS nombre2, ef.id_etiquetados_folios, ef.ano,ef.nombre_alt,ef.calibre_alt
		
		FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion 
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by pro.nombre, c.calibre, mp.nombre, ef.id_etiquetados_folios desc
	
		";
		$rest=mysql_query($sql);
		$cuantos=mysql_num_rows($rest);
        	//group by ef.id_etiquetados_folios
       //echo "Cuantos $cuantos";

     	 if($cuantos){
		    while ($r=mysql_fetch_array($rest)){ 
	   		$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
	        $i=0;
		?>
      <tr>
        <td class="cajas">
          <div align="center">
            <input name="id_etiquetados_folios[]" type="hidden" id="id_etiquetados_folios" value="<?echo $r[id_etiquetados_folios]?>" />
            <?echo $r[id_etiquetados_folios]?></div></td>
        <td class="cajas"><?echo $f_elaboracion?></td>
        <td class="cajas">
		
		<input name="id_ef_mod[]" type="checkbox" id="id_ef_mod[]" value="<?echo $r[id_etiquetados_folios]?>" />
		<?
		if ($r[nombre_alt] != '') {
		  $i++;
		  $nombre=$r[nombre_alt];
		  }
		else
		  $nombre=$r[nombre];
		echo $nombre;
		?> 
		<? if (!$i) { ?>
		<a href="?modulo=ver_piking_folios_nombre.php&id_etiquetados_folios=<?echo $r[id_etiquetados_folios]?>&id_paking_relacion=<? echo $id_paking_relacion?>"><img src="jpg/modificar_click.jpg" alt="Modificar Nombre Alternativo" width="19" height="24" border="0" /></a> 
		<? } ?>		</td>
        <td class="cajas">
		<?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>		</td>
        <td class="cajas"><?echo $r[nombre2]?></td>
        <td class="cajas"><?echo $r[contenido_unidades]?></td>
        <td class="cajas">
		<? if ($r[nombre_alt] != '' or $r[nombre_alt] != '') { ?> 
		<a href="?modulo=ver_piking_folios_nombre.php&eliminar=1&id_etiquetados_folios=<?echo $r[id_etiquetados_folios]?>&id_paking_relacion=<? echo $id_paking_relacion?>"><img src="jpg/eliminar_click.jpg" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" /></a>
		<? } ?>&nbsp;</td>
      </tr>
      <?
	 }//while ($r=mysql_fetch_array($rest)){ 
	}// if($cuantos){
	
?>
    </table></td>
  </tr>
  <tr>
    <td>
	  
   
   <a href="javascript: document.form1.submit();">
        <label></label>
      </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><a href="javascript: document.form1.submit();">
      <input type="image" name="modificar" src="jpg/despachar_picking.jpg" />
    </a></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<? } // fin if cuantos?>
</form></td>
  </tr>
</table>
