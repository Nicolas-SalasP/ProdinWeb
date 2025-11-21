<?

 if($id_estado_pallet == 2){
   $fechahoy=date("Y-m-d"); 
  }else{
  $fechahoy='0000-00-00'; 
  }

  if(!$id_destinos){
  $id_destinos=0; 
  }

if ($modificar) {
 if ($id_fajapallet)  
  foreach ($id_fajapallet as $key)
         {
		  $sql="update fajapallet set id_estado_pallet=$id_estado_pallet, id_destinos=$id_destinos, fdespacho='$fechahoy'  where id_fajapallet = $key";
		  //echo "SQL $sql<br>";
		  $res=mysql_query($sql);
		 
         }
   }
$sql="
SELECT fp.id_fajapallet,fp.ano_fajapallet,fp.id_bodegas, fp.fpallet, fp.glosa, count( f.id_faja ) AS cfajas, fp.id_estado_pallet, p.nombre, b.bodegas
FROM fajapallet AS fp, fajas AS f, producto AS p, bodegas AS b
WHERE fp.id_fajapallet = f.id_fajapallet and f.id_producto = p.id_producto and fp.id_bodegas = b.id_bodegas
AND fp.id_estado_pallet = 6
GROUP BY fp.id_fajapallet
";
$rest=mysql_query($sql);
$cuantos=mysql_num_rows($rest);

	  
	   //$bodega=crea_select($link,$id_b,"id_bodegas","bodegas","bodegas","Bodega");
?>
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
</script><form action="" method="post" name="form1" id="form1">
<table width="493" border="0" align="center">
  <tr>
    <td width="483" height="30" class="titulo">Pallets en Paking List </td>
  </tr>
  <tr>
    <td>
	<? if($cuantos){?>
	<table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="575">
            <table width="456" border="0" align="center">
              <tr>
                <td width="21" rowspan="2"><input name="id_b" type="hidden" id="id_bodegas" value="<?echo $id_b?>" />
                    <input name="bo" type="hidden" id="bodegas" value="<?echo $bo?>" /></td>
                <td width="43" class="titulo">Estado</td>
                <td width="240" class="cajas"><? 
		 	$estado_pallets= crea_estado_pallets($link,$id_estado_pallet,1);
			echo $estado_pallets;
			?>
                    <br /></td>
                <td width="134"><input name="modificar" type="submit" class="cajas" id="modificar" value="Modificar Seleccionados" /></td>
              </tr>
              <tr>
                <td height="21" class="titulo">&nbsp;</td>
                <td width="240" class="cajas"><? if($id_estado_pallet == 2){
   			        $destinos= crea_destinos($link,$id_destinos);
				    echo $destinos;
				   }
				?></td>
                <td width="134">&nbsp;</td>
              </tr>
            </table>
            <table width="595" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="7%" bgcolor="#CCCCCC">
				<a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a>  
			    <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a>
				</td>
                <td width="11%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Pallet Nro </td>
                <td width="13%" bgcolor="#CCCCCC" class="titulo">Fecha Pallet </td>
                <td width="49%" bgcolor="#CCCCCC" class="titulo">Producto</td>
                <td width="11%" bgcolor="#CCCCCC" class="titulo">Cant Fajas </td>
                <td width="9%" bgcolor="#CCCCCC" class="titulo"> Bodega</td>
              </tr>
              <? if ($cuantos) {
	   while ($r=mysql_fetch_array($rest)) { 
	   $fpallet=format_fecha($r[fpallet]);

	?>
              <tr>
                <td><label>
                  <input name="id_fajapallet[]" type="checkbox" id="id_fajapallet[]" value="<?echo $r[id_fajapallet];?>" />
                </label></td>
                <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><? echo substr($r[ano_fajapallet],2,4);?><?echo $r[id_fajapallet]?></a></td>
                <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $fpallet?></a></td>
                <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $r[nombre]?></a>&nbsp;</td>
                <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $r[cfajas]?></a></td>
                <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f=<?echo $r[id_fajapallet]?>"><?echo $r[bodegas]?></a></td>
              </tr>
              <?
	 }
		?>
            </table>
            <br>
            <? } ?>
        </td>
      </tr>
    </table><? }else{?>
    <table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td height="145" class="titulo"><div align="center">Paking List sin Pallets </div></td>
      </tr>
    </table>
    <? }?></td>
  </tr>
</table></form>
