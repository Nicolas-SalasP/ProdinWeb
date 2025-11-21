<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-align: left;
}
-->
</style>
</head>
<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=yes,location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=yes, width=480, height=401, top=100, left=100"; 
window.open(pagina,"",opciones); 
} 
</script>
<body>
<form id="form1" name="form1" method="post" action="">

<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
  	 
    <tr>
       <td colspan="4" rowspan="2" align="center" bgcolor="#CCCCCC"><textarea name="folios" cols="30" rows="3" value="<? echo $folios?>" id="folios" onKeyPress="return numeros(event)"></textarea><? echo $folios?></td>
      <td align="center" bgcolor="#CCCCCC">Desde</td>
       <td align="center" bgcolor="#CCCCCC">Hasta</td>
       <td rowspan="2" align="center" bgcolor="#CCCCCC"><input name="buscar" type="submit" class="cajas" id="buscar" value="Buscar" /></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#CCCCCC"><span class="cajas">
        <input name="ini" type="text" id="ini" onkeypress="solo_numeros()" value="<? echo $ini?>" size="5" maxlength="5" />
      </span></td>
      <td align="center" bgcolor="#CCCCCC"><span class="cajas">
        <input name="fin" type="text" id="fin" onkeypress="solo_numeros()" value="<? echo $fin?>" size="5" maxlength="5" />
      </span></td>
    </tr>
    <tr>
      <td width="6%" align="center" bgcolor="#CCCCCC"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a> </td>
      <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Folio</td>
      <td width="18%" bgcolor="#CCCCCC" class="titulo">Fecha Elaboraci&oacute;n</td>
      <td width="34%" bgcolor="#CCCCCC" class="titulo">Producto</td>
      <td width="11%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
      <td width="10%" bgcolor="#CCCCCC" class="titulo"> Medida </td>
      <td width="11%" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
	
    <?
	
	 if($folios){
	
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
		 and ef.borrado != 1
		 and id_etiquetados_folios = $id_f
		 ";
         $rest=mysql_query($sql);
		 $cuantos_folios=mysql_num_rows($rest);
		 $cuantos_folios2++;
		
			$a=";";
			
		for($r=1; $r <= $cuantos_folios2; $r++)
		{
			$hoa=$array[$r]=$id_f.$a;
			
		}
		$sum .= $hoa;
		
		//echo "$sum ";
	?>

    </tr>
     <? if($cuantos_folios){ ?> 
       <tr>
	   <? 
		if ($r=mysql_fetch_array($rest)){ 
	  	$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
		$pallet=$r[pallet];
		$id_cruce_tablasss=$r[id_cruce_tablas];
	   ?>
      <td align="center" nowrap="nowrap" class="cajas">      
	  </td>
      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[id_etiquetados_folios]?></td>
      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[producto]?></td>
      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[calibre]?></td>
      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[medidas_productos]?></td>
      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[contenido_unidades]?>
	  </tr>
  <? 	
	  } //while ($r=mysql_fetch_array($rest)){ 
        } // if($cuantos_folios){
	 } // for ($i=0; $i<=$c;$i++)
	 }
	   }
	?>
  </table><a href="javascript:Abrir_ventana('print_etiqueta_especial.php?hoa=<? echo $sum?>&ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=10')"><img src="jpg/impresora.jpg" alt="Etiquetas" width="35" height="39" border="0" /><br />
        Imprimir Etiquetas</a>

</form>
</body>
</html>
