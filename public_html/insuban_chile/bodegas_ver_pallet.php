<?
if ($modificar) {
 if ($id_fajapallet)  
  foreach ($id_fajapallet as $key)
         {
		  $sql="update fajapallet set id_bodegas=$id_bodegas, id_estado_pallet=$id_estado_pallet where id_fajapallet = $key";
		  //echo "SQL $sql<br>";
		  $res=mysql_query($sql);
		 
         }
   }
$sql="
SELECT fp.id_fajapallet,fp.ano_fajapallet,fp.id_bodegas, fp.fpallet, fp.glosa, count( f.id_faja ) AS cfajas, fp.id_estado_pallet, p.nombre, SUM(f.neto) AS net
FROM fajapallet AS fp, fajas AS f, producto AS p
WHERE fp.id_fajapallet = f.id_fajapallet and f.id_producto = p.id_producto
AND fp.id_bodegas = $id_b
AND fp.id_estado_pallet =1
GROUP BY fp.id_fajapallet
";
$rest=mysql_query($sql);
//echo "SQL $sql";
$cuantos=mysql_num_rows($rest);

	   $estado_pallet=crea_select($link,1,"id_estado_pallet","estado_pallet","estado_pallet","Estado Pallet");
	   $bodega=crea_select($link,$id_b,"id_bodegas","bodegas","bodegas","Bodega");
?>
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
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.alerta {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px}
-->
</style>
<table width="490" border="0" align="center">
  <tr>
    <td class="titulo">Bodega <? echo $bo?></td>
  </tr>
  <tr>
    <td><div align="right" class="cajas"><a href="?modulo=bodegas_ver.php">Volver a Item Bodegas</a> </div></td>
  </tr>
  <tr>
    <td>
	<? if($cuantos){?>
	<table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td><form action="" method="post" name="form1" id="form1">
            <table width="84%" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></td>
                <td width="11%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Pallet </td>
                <td width="16%" bgcolor="#CCCCCC" class="titulo">Fecha Pallet </td>
                <td width="43%" bgcolor="#CCCCCC" class="titulo">Producto</td>
                <td width="13%" bgcolor="#CCCCCC" class="titulo">Cant Fajas </td>
                <td width="13%" bgcolor="#CCCCCC" class="titulo">Kilos</td>
              </tr>
    <? if ($cuantos) {
	   while ($r=mysql_fetch_array($rest)) { 
	   $fpallet=format_fecha($r[fpallet]);

	?>
              <tr>
                <td><label>
                  <input name="id_fajapallet[]" type="checkbox" class="cajas" id="id_fajapallet[]" value="<?echo $r[id_fajapallet];?>" />
                </label></td>
                <td nowrap="nowrap" class="cajas"><div align="center"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><? echo substr($r[ano_fajapallet],2,4);?><?echo $r[id_fajapallet]?></a></div></td>
                <td nowrap="nowrap" class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $fpallet?></a></td>
                <td nowrap="nowrap" class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $r[nombre]?></a></td>
                <td nowrap="nowrap" class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $r[cfajas]?></a></td>
                <td nowrap="nowrap" class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $r[net]?></a></td>
              </tr><? } ?>
            </table>
            <br>
            <table width="475" border="0" align="center">
              <tr>
                <td width="35" rowspan="2"><input name="id_b" type="hidden" id="id_bodegas" value="<?echo $id_b?>" />
                  <input name="bo" type="hidden" id="bodegas" value="<?echo $bo?>" /></td>
                <td class="titulo"><span class="cajas">Estado<br />
                </span></td>
                <td><span class="cajas">
				
                  <? 
		 	$estado_pallets= crea_estado_pallets_otro($link,$row[id_estado_pallet]);
			echo $estado_pallets;
			?>
                </span></td>
                <td width="134" rowspan="2"><input name="modificar" type="submit" class="cajas" id="modificar" value="Modificar Seleccionados" /></td>
              </tr>
              <tr>
                <td width="52" class="titulo"><span class="cajas">Bodega</span></td>
                <td width="236"><span class="cajas"><?echo $bodega?></span></td>
              </tr>
            </table>
            <? } ?>
        </form></td>
      </tr>
    </table>
	<? }else{?>
	<table width="598" border="1" bordercolor="#CCCCCC">
      <tr>
        <td height="145" class="titulo"><div align="center">Bodega sin Pallets </div></td>
      </tr>
    </table>
	<? }?>	</td>
  </tr>
</table>
