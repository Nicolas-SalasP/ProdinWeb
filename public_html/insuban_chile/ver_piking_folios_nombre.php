<?
ini_set('memory_limit', '-1');
if ($modificar or $eliminar)
  {
  
   if ($modificar and $nombre_alt != '') {
     $sql="update etiquetados_folios set nombre_alt='$nombre_alt' where id_etiquetados_folios=$id_etiquetados_folios";
	$rest=mysql_query($sql);  
	  }
	  
   if ($modificar and $calibre_alt != '') {
     $sql="update etiquetados_folios set calibre_alt='$calibre_alt' where id_etiquetados_folios=$id_etiquetados_folios";
    $rest=mysql_query($sql);
	}
	  if ($modificar and $contenido_alt != '') {
     $sql="update etiquetados_folios set contenido_alt='$contenido_alt' where id_etiquetados_folios=$id_etiquetados_folios";
    $rest=mysql_query($sql);
	}
	
   if ($eliminar and $id_etiquetados_folios) {
       $sql="update etiquetados_folios set calibre_alt='',nombre_alt='', contenido_alt='' where id_etiquetados_folios=$id_etiquetados_folios";
    $rest=mysql_query($sql);
	//echo "SQL $sql";
	}
	
echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=ver_piking_folios.php&id_paking_relacion=$id_paking_relacion\">";
  exit;	
  }   

$sql="select * from etiquetados_folios where id_etiquetados_folios=$id_etiquetados_folios";
$rest=mysql_query($sql);
$cc=mysql_num_rows($rest);

if ($cc)
  {
  $row=mysql_fetch_array($rest);
  $id_producto=$row[id_producto];
  $id_calibre=$row[id_calibre];
$nombre1=$row[nombre_alt];
  }

if ($id_destinos) {
	 
   $sql="select * from producto_alt where id_producto=$id_producto and id_destinos=$id_destinos";
   $rest=mysql_query($sql);
   $cc1=mysql_num_rows($rest);
   //echo "Otro $sql";
   if ($cc1)
     { 
	  $row=mysql_fetch_array($rest);
	  $nombre=$row[producto_alt];
	 }
	 
  }
//echo "SQL $sql<br>";

?>
<style type="text/css">
<!--
.cajas {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>

<form id="form1" name="form1" method="post" action="">
  <table width="553" border="0" align="center">
    <tr>
      <td width="125" height="20" class="titulo">Producto</td>
      <td width="265" class="cajas"><? 
		 $producto= get_producto($link,$id_producto);
		 echo $producto;
		 ?></td>
    </tr>
    
    <tr>
      <td class="titulo">Destino</td>
      <td colspan="2" class="cajas"><? 
	    if  ($id_producto) {
		$destinos=crea_destinos_onchange2($link,$id_destinos,$id_producto);
		echo $destinos;
		   }
	  ?></td>
    </tr>
<? if  ($id_producto and $id_destinos) { ?>
    <tr>
      <td class="titulo">Nombre Asociado  </td>
      <td colspan="2"><label>
        <input name="nombre_alt" type="text" class="cajas" id="nombre_alt" value="<? echo $nombre?>">
      </label></td>
    </tr>
    <tr>
      <td class="titulo">Calibre </td>
      <td colspan="2"><label>
        <input name="calibre_alt" type="text" class="cajas" id="nombre_alt" value="<? echo $calibre?>" />
        <input name="modificar" type="submit" class="cajas" id="modificar" value="Modificar" />
      </label></td>
    </tr>
    <tr>
      <td colspan="3" class="titulo"><label>
        <input name="id_paking_relacion" type="hidden" id="id_pak" value="<?echo $id_paking_relacion?>" />
        <input name="id_etiquetados_folios" type="hidden" id="id_etiquetados_folios" value="<?echo $id_etiquetados_folios?>" />
        </label></td>
    </tr>
<? } ?>
  </table>
</form>