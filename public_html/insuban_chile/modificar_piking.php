<?

$sql1="SELECT * from paking AS p, etiquetados_folios AS ef where p.id_paking_relacion = $id_paking_relacion and p.id_etiquetados_folios = ef.id_etiquetados_folios order by p.id_paking   desc ";
$rest1=mysql_query($sql1);
$cuantos1=mysql_num_rows($rest1);


$idd=$id_destinos;
//echo "idds $idd";
if($grabar_x){
if ($id_etiquetados_folios2) 
    foreach ($id_etiquetados_folios2 as $key)
   {
    $fecha_ingreso_paking  =date("Y-m-d");
	$sql="insert into paking (folio_piking,id_paking_relacion,id_etiquetados_folios,fecha_ingreso_paking ) values ($folio_piking,$id_paking_relacion,$key,'$fecha_ingreso_paking')";
	$res=mysql_query($sql);
	//echo "SQL $sql";
    $sq_up="update etiquetados_folios set id_estado_folio = '3', id_destinos= '$idd',factura = '$factura', guia = '$guia',glosa = '$glosa', id_pedidos = '$id_pedidos' where id_estado_folio != 3 and id_etiquetados_folios=$key";
	$rest_up=mysql_query($sq_up);
	
	//echo "sql $sq_up";
	}

}

if ($modificar_x) {
if($id_etiquetados_folios) {
 foreach ($id_etiquetados_folios as $key)
 {
 if($cuantos1 != 1){
 $sql="delete from paking where id_etiquetados_folios = $key";
 $res=mysql_query($sql);
 }
  $sq2="update etiquetados_folios set  id_estado_folio = 2, id_destinos = 0, factura = 0, guia = 0, fdespacho_piking = '0', glosa = '', nombre_alt = '', calibre_alt = '', id_pedidos = 0  where id_etiquetados_folios =$key";
  $res2=mysql_query($sq2);
 }
    if($cuantos1 == 1){
	 $feliminacionpiking  =date("Y-m-d");
 	$sql="update paking  set id_etiquetados_folios = '0', feliminacionpiking = '$feliminacionpiking' where id_etiquetados_folios =$id_etiquetados_folios_ultimo";
	$res=mysql_query($sql);
	
	echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=listar_piking.php\">";
	exit;
}
 	echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=modificar_piking.php&amp;id_paking_relacion=$id_paking_relacion&folio_piking=$folio_piking&id_destinos=$id_destinos;&guia=$guia;&factura=factura;&glosa=$glosa;?>\">";
 	exit;
}
}


if($agregar_comentario){

   //$sql="insert into paking (folio_piking,id_paking_relacion,id_etiquetados_folios,feliminacionpiking,observaciones_picking) values ($folio_piking,$id_paking_relacion,0,'$feliminacionpiking','$observaciones_picking')";
	
	//$sql="update paking  set  folio_piking = '$folio_piking', id_paking_relacion = '$id_paking_relacion', id_etiquetados_folios = '0', feliminacionpiking = '$feliminacionpiking', observaciones_picking = '$observaciones_picking' where id_etiquetados_folios =$id_etiquetados_folios_ultimo";
	
	$sql="update paking  set  observaciones_picking = '$observaciones_picking' where id_etiquetados_folios =$id_etiquetados_folios_ultimo";
	$res=mysql_query($sql);
	//echo "SQL $sql";
}





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
<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function numeros(evt){ 
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 
var key = nav4 ? evt.which : evt.keyCode; 
return (key <= 32 || (key >= 48 && key <= 59) || (key >= 45 && key <= 47 ));
}
//-->
</script>
<table width="635" border="0" align="center">
  <tr>
    <td width="521">&nbsp;</td>
    <td width="104"><span class="cajas"><a href="?modulo=listar_piking.php">Volver Folios Picking</a></span></td>
  </tr>
  <tr>
    <td colspan="2" class="titulo">Para eliminar el Folio del Picking debe Selecionarlo y posteriormente presionar Modificar </td>
  </tr>
  <tr>
    <td colspan="2" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><form id="form1" name="form1" method="post" action="">
      <table width="629" border="0" align="center">
  <tr>
    <td colspan="2">
	<? if ($row=mysql_fetch_array($rest1)){ 
    $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	
	?>
	
      <table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" bgcolor="#CCCCCC"><span class="cajas">&nbsp;N&deg; Picking </span></td>
          <td colspan="5" bgcolor="#CCCCCC" class="titulo">&nbsp;<? echo $folio_piking?></td>
          </tr>
        <tr>
          <td width="3%" bgcolor="#CCCCCC" class="titulo">Nº</td>
          <td width="3%" bgcolor="#CCCCCC">&nbsp;<a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></td>
          <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio Nro </td>
          <td width="11%" bgcolor="#CCCCCC" class="titulo">Fecha Folio </td>
          <td width="46%" bgcolor="#CCCCCC" class="titulo">Producto</td>
          <td width="9%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
          <td width="8%" bgcolor="#CCCCCC" class="titulo">Medida</td>
          <td width="10%" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
        </tr>
        <? 
		$sql="SELECT *
		
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

     	 if($cuantos){
		    while ($r=mysql_fetch_array($rest)){ 
	   		$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
			$id_etiquetados_folios=$r[id_etiquetados_folios];
	        $i++;
			$observaciones_picking=$r[observaciones_picking];
		?>
        <tr>
          <td ><span class="cajas"><? echo $i;?></span></td>
          <td><label> <span class="cajas">
          <? //echo $id_etiquetados_folios?>
          <input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $r[id_etiquetados_folios];?>" />
		  <input name="id_etiquetados_folios_ultimo" type="hidden" id="id_etiquetados_folios" value="<?echo $r[id_etiquetados_folios]?>" />
		    </span></label></td>
          <td class="cajas">&nbsp;<?echo $r[folio_m3]?> <input name="id_pedidos" type="hidden" value="<?echo $row[id_pedidos]?>" /></td>
          <td class="cajas">&nbsp;<?echo $f_elaboracion?></td>
          <td class="cajas">&nbsp;<?
		if ($r[nombre_alt] != '') {

		  $producto=$r[nombre_alt];
		  }
		else
		  $producto=$r[producto];
		echo $producto;
		?>                </td>
          <td class="cajas">&nbsp;<?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>          </td>
          <td class="cajas">&nbsp;<?echo $r[medidas_productos]?></td>
          <td class="cajas">&nbsp;<?echo $r[contenido_unidades]?></td>
          </tr>
        <?
	 }//while ($r=mysql_fetch_array($rest)){ 
	}// if($cuantos){
	
?>
      </table>
      <? }?></td>
  </tr>
  <tr>
    <td colspan="2">
	  <div align="center">
	  <? if($permiso37 == 1){?>
	  <? if($observaciones_picking == '' and $cuantos1 != 1){?>
	  <a href="javascript: document.form1.submit();">
      <input type="image" name="modificar" src="jpg/eliminar_folio.jpg" />
      </a>
	  <? }
	    if($observaciones_picking != '' and $cuantos1 == 1){?>
	  <a href="javascript: document.form1.submit();">
      <input type="image" name="modificar" src="jpg/eliminar_folio.jpg" />
      </a>
	  <? 
	  }
	  }?>
	  </div></td>
  </tr>
  <tr>
    <td colspan="2"><? if($permiso37 == 1){?><a href="#" onclick="cambiar('error'); return false;"  class="titulo">Agregar Folios al Picking</a><? }?></td>
  </tr>
  <tr>
    <td colspan="2">
	<div id="error" style="display: none;">
	<textarea name="folios" cols="30" rows="3" id="folios" onKeyPress="return numeros(event)"></textarea>
    <input name="buscar" type="submit" class="cajas" id="buscar" value="Buscar" /></div></td>
  </tr>
  <? if($cuantos1 == 1){?>
  <tr>
    <td width="349">&nbsp;</td>
    <td width="270" class="titulo">Comentarios:</td>
  </tr>
  <tr>
    <td><span class="titulo">Importante:</span> <span class="cajas">Debe ingresar observaciones para poder eliminar por completo el Folio asociado al Picking.</span></td>
    <td><textarea name="observaciones_picking" cols="30" rows="3" id="observaciones_picking"><? echo $observaciones_picking?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="agregar_comentario" type="submit" class="cajas" id="agregar_comentario" value="Agregar Comentario" /></td>
  </tr>
  <? }?>
  <tr>
    <td colspan="2">
    <table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
  	 <? if($folios){
	
	$dat=split("\n",$folios);
	 $c=count($dat);
	
	
		 
		?>
	
    <tr>
      <td width="6%" align="center" bgcolor="#CCCCCC"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a> </td>
      <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio Nro </td>
      <td width="18%" bgcolor="#CCCCCC" class="titulo">Fecha Elaboraci&oacute;n</td>
      <td width="34%" bgcolor="#CCCCCC" class="titulo">Producto</td>
      <td width="11%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
      <td width="10%" bgcolor="#CCCCCC" class="titulo"> Medida </td>
      <td width="11%" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
	
    <?
	
	 for ($i=0; $i<=$c;$i++)
	  { 
	   if ($dat[$i] != "")
	   {
	    $id_f=$dat[$i];
		$largo=strlen($id_f);
		if($largo != 1){
		  $id_f=substr($id_f, 0, $largo);
		}
	
    $sql="SELECT *
		 FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mp 
		 where ef.id_etiquetados_folios = ef.id_etiquetados_folios 
		 and ef.id_producto = p.id_producto 
		 and ef.id_calibre=c.id_calibre 
		 and ef.id_medidas_productos = mp.id_medidas_productos 
		 and (ef.id_estado_folio = 2 or ef.id_estado_folio = 10)
		 and ef.id_pedidos = 0
		 and ef.ocupado = 0
		 and ef.borrado != 1
		 and id_etiquetados_folios = $id_f
		 ";
         $rest=mysql_query($sql);
		 $cuantos_folios=mysql_num_rows($rest);
	?>

    </tr>
     <? if($cuantos_folios){ ?> 
       <tr>
	   <? 
		while ($r=mysql_fetch_array($rest)){ 
	  	$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
		$id_pedidos=$r[id_pedidos];
	   ?>
      <td align="center" class="cajas">
	  <? if(!$id_pedidos) {?>
	  <label>
	  <input name="id_etiquetados_folios2[]" type="checkbox" id="id_etiquetados_folios2[]" value="<?echo $r[id_etiquetados_folios];?>" />		      <? }else{?>
	  <? echo "<b> Pedido: </b> $r[id_pedidos]";?>
	  <? }?>
	  </label>
	  </td>
      <td class="cajas">&nbsp;<?echo $r[id_etiquetados_folios]?></td>
      <td class="cajas">&nbsp;<?echo $f_elaboracion?></td>
      <td class="cajas">&nbsp;<?echo $r[producto]?></td>
      <td class="cajas">&nbsp;<?echo $r[calibre]?></td>
      <td class="cajas">&nbsp;<?echo $r[medidas_productos]?></td>
      <td class="cajas">&nbsp;<?echo $r[contenido_unidades]?>
	  </tr>
  <? 	
	  } //while ($r=mysql_fetch_array($rest)){ 
	  }//if ($dat[$i] != "")
	 } // for ($i=0; $i<=$c;$i++)
	} //if($folios){
	?>
  </table>
  
  <a href="javascript: document.form1.submit();"><label>
  <? if($permiso37 == 1){?>
  <? if($cuantos_folios){?>
  <div align="center">
  <? if(!$id_pedidos) {?>
  <input type="image" name="grabar" src="jpg/agregar_folio.jpg" />
  <? }?>
  </div>
  <? }?>
  <? }?>
  </label>
  </a>	
  <? }?>  </td>
  </tr>
</table>
    </form></td>
  </tr>
</table>