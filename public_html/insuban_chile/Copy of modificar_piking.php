<?


$idd=$id_destinos;
//echo "idds $idd";



if($grabar_x){
if ($id_etiquetados_folios2) 
    foreach ($id_etiquetados_folios2 as $key)
   {
    $fecha_ingreso_paking  =date("Y-m-d");
	$sql="insert into paking (folio_piking,id_paking_relacion,id_etiquetados_folios,fecha_ingreso_paking ) values ($folio_piking,$id_paking_relacion,$key,'$fecha_ingreso_paking')";
	$res=mysql_query($sql);
	echo "SQL $sql";
    $sq_up="update etiquetados_folios set id_estado_folio = '3', id_destinos= '$idd',factura = '$factura', guia = '$guia',glosa = '$glosa' where id_estado_folio != 3 and id_etiquetados_folios=$key";
	$rest_up=mysql_query($sq_up);
	
	echo "sql $sq_up";
	}

}

if($elimupdate)
{

$sq2="update etiquetados_folios  set  id_estado_folio = 2, id_destinos = 0, factura = 0, guia = 0, fdespacho_piking = '0000-00-00', glosa = '', nombre_alt = '', calibre_alt = '' where id_etiquetados_folios =$id_etiq";
$res2=mysql_query($sq2);
$fecha_eliminacion =date("Y-m-d");
$sql="update paking set id_etiquetados_folios=0,fecha_ingreso_paking='0000-00-00', fdespacho_piking='0000-00-00', feliminacionpiking ='$fecha_eliminacion' where  id_etiquetados_folios = $id_etiq";
 $res=mysql_query($sql);

echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=listar_piking.php\">";
 exit;
}
/*
if($agrega_nota and $observaciones != '')
{

$sqlf="update paking  set observaciones  = '$observaciones'  where  id_etiquetados_folios = $id_etiq ";
$resf=mysql_query($sqlf);

$sql1f="SELECT * from paking where id_etiquetados_folios = $id_etiq";
$rest1f=mysql_query($sql1f);

 while ($rdf=mysql_fetch_array($rest1f)){ 
$observaciones=$rdf[observaciones];
} 
 }
*/
if ($eliminarfolio) {
if($id_etiquetados_folios) {
 foreach ($id_etiquetados_folios as $key)
 {
$sql="delete from paking where  id_etiquetados_folios = $key";
 $res=mysql_query($sql);
 
  $sq2="update etiquetados_folios  set  id_estado_folio = 2, id_destinos = 0, factura = 0, guia = 0, fdespacho_piking = '0000-00-00', glosa = '', nombre_alt = '', calibre_alt = '' where id_etiquetados_folios =$key";
  $res2=mysql_query($sq2);
 }
echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=modificar_piking.php&id_paking_relacion=$id_paking_relacion\">";
exit;
}
}else{

$notas=1;

}

if(!$obser){
$sql1="SELECT * from paking AS p, etiquetados_folios AS ef where p.id_paking_relacion = $id_paking_relacion and p.id_etiquetados_folios = ef.id_etiquetados_folios order by p.id_paking   desc";
$rest1=mysql_query($sql1);
$cuantos1=mysql_num_rows($rest1);
}
?>
<style type="text/css">
<!--
.cajas {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
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
    <td colspan="2" class="titulo">Para eliminar el Folio del Picking debe Selecionarlo y posteriormente presionar Eliminar Folio </td>
  </tr>
  <tr>
    <td colspan="2"><form id="form1" name="form1" method="post" action="">
      <table width="629" border="0" align="center">
  <tr>
    <td width="619">
	<? if ($row=mysql_fetch_array($rest1)){ 
    $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
    ?>
      <table width="614" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6%" bgcolor="#CCCCCC"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></td>
          <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio Nro </td>
          <td width="11%" bgcolor="#CCCCCC" class="titulo">Fecha Folio </td>
          <td width="46%" bgcolor="#CCCCCC" class="titulo">Producto</td>
          <td width="9%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
          <td width="8%" bgcolor="#CCCCCC" class="titulo"> Medida </td>
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
	        $i=0;
			
			$id_etiq=$r[id_etiquetados_folios];
			
		?>
        <tr>
          <td><label> <span class="cajas">
          <input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $r[id_etiquetados_folios];?>" />
		    </span></label></td>
          <td class="cajas">&nbsp;<?echo $r[id_etiquetados_folios]?></td>
          <td class="cajas">&nbsp;<?echo $f_elaboracion?></td>
          <td class="cajas">&nbsp;<?
		if ($r[nombre_alt] != '') {
		  $i++;
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
    <td><div align="center"> <? if($permiso37 == 1){?>
	   <? if($observaciones){?>
	   <input name="elimupdate" type="submit" class="cajas" id="elimupdate" value="Eliminar Folioup" />
	   <? }else{?>
	   <input name="eliminarfolio" type="submit" class="cajas" id="eliminarfolio" value="Eliminar Folio" />
	   <? }?><? }?></div></td>
  </tr>
  <tr>
    <td><? if($permiso37 == 1){?><a href="#" onclick="cambiar('error'); return false;"  class="titulo">Agregar Folios al Picking</a><? }?></td>
  </tr>
  <tr>
    <td>
	<div id="error" style="display: none;">
	<textarea name="folios" cols="30" rows="3" id="folios" onKeyPress="return numeros(event)"></textarea>
    <input name="buscar" type="submit" class="cajas" id="buscar" value="Buscar" />
	</div></td>
  </tr>
  <tr>
    <td>
	<? if($folios){?>
	
	<table width="614" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="7%" bgcolor="#CCCCCC"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a> </td>
      <td width="11%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio Nro </td>
      <td width="13%" bgcolor="#CCCCCC" class="titulo">Fecha Folio </td>
      <td width="43%" bgcolor="#CCCCCC" class="titulo">Producto</td>
      <td width="9%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
      <td width="8%" bgcolor="#CCCCCC" class="titulo"> Medida </td>
      <td width="9%" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
    </tr>
      <? if($folios){
 $dat=split("\n",$folios);
	 $c=count($dat);
	
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
		 and ef.id_estado_folio != 3
		 and ef.id_estado_folio = 2
		 and ef.borrado != 1
		 and id_etiquetados_folios = $id_f
		 ";
         $rest=mysql_query($sql);
		 $cuantos=mysql_num_rows($rest);
		 
		
?> 
    <tr>
	   <? 
		if($cuantos){
	    while ($r=mysql_fetch_array($rest)){ 
	  	$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
	   ?>
      <td><label>
        <input name="id_etiquetados_folios2[]" type="checkbox" id="id_etiquetados_folios2[]" value="<?echo $r[id_etiquetados_folios];?>" />
      </label></td>
      <td class="cajas">&nbsp;<?echo $r[id_etiquetados_folios]?></td>
      <td class="cajas">&nbsp;<?echo $f_elaboracion?></td>
      <td class="cajas">&nbsp;<?echo $r[producto]?></td>
      <td class="cajas">&nbsp;<?echo $r[calibre]?></td>
      <td class="cajas">&nbsp;<?echo $r[medidas_productos]?></td>
      <td class="cajas">&nbsp;<?echo $r[contenido_unidades]?>	  </tr>
	  <?
	   }
	  }// if($cuantos){
	  ?>
	       <?
	
	
	}//if ($dat[$i] != "")
	}//for ($i=0; $i<=$c;$i++)
	
	}	
?>
  </table>

 <a href="javascript: document.form1.submit();">
   <label>
   <? if($permiso37 == 1){?>
   <div align="center">
     <input type="image" name="grabar" src="jpg/agregar_folio.jpg" />
    </div>
	<? }?>
   </label>
   </a>	
   <? }?>
   <? if($cuantos1 == 1 or $obser != '' )
      {
   ?>
   <table width="544" border="1" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td height="31">
         <div align="center"><span class="style2">Debe ingresar  observaci&oacute;n de lo contrario no podra eliminar el Folio al Picking Asignado</span></div></td>
     </tr>
     <tr>
       <td><div align="center">
         <textarea name="observaciones" cols="100" class="cajas" id="observaciones"><? echo "$observaciones";?></textarea>
       </div></td>
     </tr>
     <tr>
       <td><div align="center">
         <input name="agrega_nota" type="submit" class="cajas" id="agrega_nota" value="Agregar / Modificar Nota" />
       </div></td>
     </tr>
   </table>
   <? }?>   </td>
  </tr>
</table>
    </form></td>
  </tr>
</table>