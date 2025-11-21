<?

if ($modificar_x)
  {
 // echo "WASAP";
 
  $dat2=split(" ",$fdespacho);
  $dat=split("-",$dat2[0]);
  $fdespacho1="$dat[2]-$dat[1]-$dat[0]";
   
   $sql1="update fajapallet set fpallet='$fpallet'
   ,id_destinos=$id_destinos,fdespacho='$fdespacho1',glosa='$glosa',estado='$estado' 
   where id_fajapallet=$id_fajapallet";
   $rest1=mysql_query($sql1);
   //echo "SQL $sql1<br>";
   
   $id_fajap2=$id_fajapallet;
   
   $sql2="update fajas set id_fajapallet=0 where id_fajapallet=$id_fajapallet";
   $rest2=mysql_query($sql2);
    
  if ($id_faja) 
  foreach($id_faja as $key => $value){
            
     		 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$key";
			 $rest=mysql_query($sq);
			  //echo "$sq -------- KEY -> $key<br>";
	    }
  }

if($id_fajap2){
$sql="select * from fajas AS f, fajapallet AS fjp, producto AS p where f.id_fajapallet = $id_fajap2 and fjp.id_fajapallet= $id_fajap2 and p.id_producto=f.id_producto";
$result2=mysql_query($sql);
$cuantos=mysql_num_rows($result2);
 if ($row=mysql_fetch_array($result2))  {
		      $id_fajapallet=$row[id_fajapallet];	 
		      $fdespacho=format_fecha_sin_hora($row[fdespacho]);
		      $fpallet =format_fecha_sin_hora($row[fpallet]);
			  $id_fajap2=$row[id_fajapallet];
	}		 
} 
else 
{

$sql="select * FROM fajas AS f, fajapallet AS fjp, producto AS p
WHERE f.id_fajapallet = fjp.id_fajapallet
AND fjp.id_fajapallet = f.id_fajapallet
AND p.id_producto = f.id_producto
GROUP BY fjp.id_fajapallet
ORDER BY fjp.id_fajapallet";

$result=mysql_query($sql);
$cuantos3=mysql_num_rows($result);
//echo "CUANTOS $cuantos3 <br>";

if(!$op) $op=0;

$sql="SELECT * 
FROM fajas AS f, fajapallet AS fjp, producto AS p
WHERE f.id_fajapallet = fjp.id_fajapallet
AND fjp.id_fajapallet = f.id_fajapallet
AND p.id_producto = f.id_producto
GROUP BY fjp.id_fajapallet
ORDER BY fjp.id_fajapallet
 LIMIT $op , 1 ";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos3 - 1;

//echo "cuantos3 $cuantos3 ante $ante, next $next -> SQL  $sql";

 if ($row=mysql_fetch_array($result))  {
		      $id_fajapallet=$row[id_fajapallet];	 
		      $fdespacho=format_fecha_sin_hora($row[fdespacho]);
		      $fpallet =format_fecha_sin_hora($row[fpallet]);
			  $id_fajap2=$row[id_fajapallet];
	}		  

$sql="select * from fajas AS f, fajapallet AS fjp, producto AS p where f.id_fajapallet = $id_fajap2 and fjp.id_fajapallet= $id_fajap2 and p.id_producto=f.id_producto";
$result2=mysql_query($sql);
$cuantos=mysql_num_rows($result2);

}



     
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.caja_texto {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
  <table width="600" border="1" align="center" bordercolor="#999999">
  <tr>
    <td width="600"><table width="46%" border="0" align="center">
      <tr>
        <td>
          <div align="center">
            <input name="id_fajap" type="hidden" value="<?echo $id_fajapallet?>" />
            <table width="609" border="0" align="center">
                  <tr>
                    <td colspan="3" class="titulo"></td>
                  </tr>
                  <tr>
                    <td width="86" class="titulo">Fecha</td>
                    <td width="250"><input name="fpallet" type="text" class="cajas" id="fpallet" value="<?echo $fpallet?>" size="10" maxlength="10" /></td>
                    <td rowspan="5" valign="top"><div align="right">
                      <table width="76" height="60" border="0" align="right">
                        <tr>
                          <td width="66" height="12" nowrap="nowrap"><div align="center"><span class="titulo">Pallets:</span>
                              <input name="id_fajap2" type="text" class="cajas" id="id_fajap2" value="<?echo $id_fajap2?>" size="5" maxlength="5" />
                          </div></td>
                        </tr>
                        <tr>
                          <td height="12" nowrap="nowrap"><div align="center">
                            <input name="buscar" type="submit" class="cajas" value="Buscar" />
                          </div></td>
                        </tr>
                        <tr>
                          <td height="12" nowrap="nowrap"><a href="?modulo=pallet_con_fajas.php" class="caja_texto">Pallets con Fajas </a></td>
                        </tr>
                      </table>
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="titulo">Bodega</td>
                    <td><select name="select" class="cajas" id="select">
                        <option value="B" selected="selected">Bodega</option>
                        <option value="D">Despacho</option>
                        <option value="R">Reprocesado</option>
                        <option value="A">Anulado</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td class="titulo">Destino</td>
                    <td>
			<? 
		 	$destinos= crea_destinos($link,$row[id_destinos]);
			echo $destinos;
			?></td>
                  </tr>
                  <tr>
                    <td class="titulo">Glosa</td>
                    <td><input name="glosa" type="text" class="cajas" id="glosa" size="50"  value="<?echo $row[glosa]?>"/></td>
                  </tr>
                  <tr>
                    <td class="titulo">Fecha Despacho</td>
                    <td><input name="fdespacho" type="text" class="cajas"   id="fdespacho"  value="<?echo $fdespacho?>" size="10" maxlength="10" />
                      <a href="javascript:show_Calendario('form1.fvencimiento');" class="cajas"  >Ver<span class="titulo">
                     
                    </span></a> </td>
              </tr>
    </table>
<br>
	<table width="199" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
              <tr>
                <td><div align="center"><span class="titulo">Unidades</span> <span class="cajas"><?echo "$cuantos2";?></span></div></td>
              </tr>
            </table>
	<br>
            <table width="551" border="1" align="center" cellpadding="1" cellspacing="1">
              <tr>
                <td width="24" bgcolor="#CCCCCC">&nbsp;</td>
                <td width="26" bgcolor="#CCCCCC" class="titulo">Faja</td>
                <td width="37" bgcolor="#CCCCCC" class="titulo">Pallet</td>
                <td width="36" bgcolor="#CCCCCC" class="titulo">Lote</td>
                <td width="116" bgcolor="#CCCCCC" class="titulo">Producto</td>
                <td width="57" bgcolor="#CCCCCC" class="titulo">E.Emisi&oacute;n</td>
                <td width="95" bgcolor="#CCCCCC" class="titulo">F.Vencimiento</td>
                <td width="40" bgcolor="#CCCCCC" class="titulo">Neto</td>
                <td width="36" bgcolor="#CCCCCC" class="titulo">Tara</td>
                <td width="42" bgcolor="#CCCCCC" class="titulo">Est</td>
                <? 
				  
				  while ($ro=mysql_fetch_array($result2))  { 
				 ?>
              </tr>
              <tr>
                <td nowrap="nowrap"><label>
 
                  <input name="id_faja[<?echo $ro[id_faja]?>]" type="checkbox" class="cajas" id="id_faja[<?echo $ro[id_faja]?>]" value="checkbox" <?if ($id_fajap2) echo "checked";?>/>
              
  
                </label></td>
                <td nowrap="nowrap" class="titulo"><?echo $ro[id_faja]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[id_fajapallet]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[loten]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[nombre]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[femision]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[fvencimiento]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[neto]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[tara]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[estado]?>
                    <? } ?>
                </td>
              </tr>
            </table>
         
    <table width="414" border="0" align="center">
      <tr>
        <td width="54" class="style2"><a href="?modulo=ejemplo_pallet_con_fajas.php&amp;cancelar=1" ><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
        <td width="54" class="style2"><? if($ante >= 0){ ?>
            <a href="?modulo=ejemplo_pallet_con_fajas.php&amp;op=<? echo $ante?>" ><img src="jpg/anterior.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
          &nbsp;
          <? }?>        </td>
        <td width="58"><? if ($cuantos3 > $next){ ?>
            <a href="?modulo=ejemplo_pallet_con_fajas.php&amp;op=<? echo $next?>" ><img src="jpg/siguiente.jpg" width="58" height="13" border="0" /></a>
            <? }else{?>
          &nbsp;
          <? }?>        </td>
        <td width="47"><? if ($cuantos3){ ?>
            <a href="?modulo=ejemplo_pallet_con_fajas.php&amp;op=<? echo $ultimo?>" ><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
            <? }?>        </td>
        <td width="47"><a href="?modulo=ejemplo_pallet_con_fajas.php&amp;nuevo=1" ></a></td>
        <td width="55"><a href="?modulo=ejemplo_pallet_con_fajas.php&amp;cancelar=1"></a></td>
        <td width="69"><a href="javascript: document.form1.submit();">
          <input name="id_fajapallet" type="hidden" id="id_fajapallet" value="<?echo $id_fajap2?>" />
          <input type="image" src="jpg/modificar.jpg" width="62" height="13" border="0" name="modificar"/></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>