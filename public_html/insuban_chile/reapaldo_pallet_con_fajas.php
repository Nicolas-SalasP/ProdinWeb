<?
$fhoy=date("Y-m-d");

if (!$id_fajapallet and $grabar)
  {
 // echo "WASAP";
 
   $dat2=split(" ",$fdespacho);
  $dat=split("-",$dat2[0]);
  $fdespacho1="$dat[2]-$dat[1]-$dat[0]";
   
   $sql1="insert into fajapallet (fpallet,id_bodega,id_destino,fdespacho,glosa,estado)
    values ('$fpallet',1,$id_destinos,'$fdespacho1','$glosa','$estado')";
   $rest1=mysql_query($sql1);
   //echo "SQL1 $sql1";
   $id_fajapallet=mysql_insert_id();
  
  if ($id_faja) 
  foreach($id_faja as $key => $value){
            
     		 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$key";
			 $rest=mysql_query($sq);
			  //echo "$sq -------- KEY -> $key<br>";
	    }
  }
     
if ($menos)
$id_fajapallet--;
if ($mas)
$id_fajapallet++;


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
    <td width="600"><table width="59%" border="0" align="center">
      <tr>
        <td width="50%" bgcolor="#CCCCCC"><span class="titulo">Pallet</span>
         <input name="id_fajapallet" type="text" class="cajas" id="id_fajapallet" value="<?echo $id_fajapallet?>" size="5" maxlength="5" />
          <? //if ($id_fajapallet > 0) { ?>
          <input name="menos" type="submit" class="cajas" id="menos" value="&lt;" />
          <? //}?>
          <input name="mas" type="submit" class="cajas" id="mas" value="&gt;" />
          <input name="buscar" type="submit" class="cajas" value="buscar" />         </td>
        <td width="25%" bgcolor="#CCCCCC"><div align="center">
          <input name="grabar" type="submit" class="cajas" value="Grabar" />
        </div></td>
        <td width="25%" bgcolor="#CCCCCC"><div align="center">
          <input name="nuevo" type="submit" class="cajas" value="Nuevo" />
        </div></td>
      </tr>
      <tr>
        <td colspan="3"><?
if ($id_fajapallet)
$ext.=" and id_fajapallet='$id_fajapallet' ";
else
$ext.=" and id_fajapallet=0 ";
   
$sql="select * from fajas as f, producto as p where f.id_producto = p.id_producto and f.estado='E'  $ext ";
//echo "SQL $sql";
$r=mysql_query($sql);
$cuantos=mysql_num_rows($r);

$sql2="select * from fajas as f, producto as p where f.id_producto = p.id_producto and f.estado='E'  $ext ";
//echo "SQL $sql";
$r2=mysql_query($sql2);
$cuantos2=mysql_num_rows($r2);

?></td>
        </tr>
      
      <tr>
        <td colspan="3"><div align="center"><? if($buscar || $menos || $mas){?>
            <? if ($cuantos2) while ($ro2=mysql_fetch_array($r2))  { ?>
        </div>
          </label>
          <div align="center">
            <table width="406" border="0">
                <tr>
                  <td width="130" class="titulo">Fecha</td>
                  <td width="266"><input name="fpallet" type="text" class="cajas" id="fpallet" value="<?echo $fhoy?>" size="10" maxlength="10" />
                      <span class="cajas">(yyyy-mm-dd))datos</span></td>
                </tr>
                <tr>
                  <td class="titulo">Bodega</td>
                  <td><select name="estado" class="cajas" id="estado">
                      <option value="B" selected="selected">Bodega</option>
                      <option value="D">Despacho</option>
                      <option value="R">Reprocesado</option>
                      <option value="A">Anulado</option>
                  </select></td>
                </tr>
                <tr>
                  <td class="titulo">Destino</td>
                  <td><? 
		 	
			$destinos= crea_destinos($link,$r[id_destinos]);
			echo $destinos;
			?></td>
                </tr>
                <tr>
                  <td class="titulo">Glosa</td>
                  <td><input name="glosa" type="text" class="cajas" id="glosa" size="50" /></td>
                </tr>
                <tr>
                  <td class="titulo">Fecha Despacho</td>
                  <td><input name="fdespacho" type="text" class="cajas"  size="10" maxlength="10" />
                    <a href="javascript:show_Calendario('form1.fdespacho');" class="cajas" >Ver</a></td>
                </tr>
                      </table>
            <? }}?>
            <? if(!$buscar || !$menos || !$mas){?>
            <table width="406" border="0">
                <tr>
                  <td width="130" class="titulo">Fecha</td>
                  <td width="266"><input name="fpallet2" type="text" class="cajas" id="fpallet2" value="<?echo $fhoy?>" size="10" maxlength="10" />
                      <span class="cajas">(yyyy-mm-dd)</span></td>
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
                  <td><? 
		 	
			$destinos= crea_destinos($link,$row[id_destinos]);
			echo $destinos;
			?></td>
                </tr>
                <tr>
                  <td class="titulo">Glosa</td>
                  <td><input name="glosa2" type="text" class="cajas" id="glosa2" size="50" /></td>
                </tr>
                <tr>
                  <td class="titulo">Fecha Despacho</td>
                  <td><input name="fdespacho2" type="text" class="cajas"  size="10" maxlength="10" />
                    <a href="javascript:show_Calendario('form1.fdespacho');" class="cajas" >Ver</a></td>
                </tr>
                      </table>
            <? }?>
          </div></td>
        </tr>
      
      
      <tr>
        <td colspan="3"><table width="551" border="1" cellpadding="1" cellspacing="1">
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
                <td width="42" bgcolor="#CCCCCC" class="titulo">Est                  </td><?if ($cuantos) while ($ro=mysql_fetch_array($r))  { ?>
              </tr>
            
              <tr>
                <td nowrap="nowrap"><label>
<?if(!$id_fajapallet){?>
<input name="id_faja[<?echo $ro[id_faja]?>]" type="checkbox" class="cajas" id="id_faja[<?echo $ro[id_faja]?>]" value="checkbox" />
<?}else{?>
<input name="ver" type="checkbox" class="caja_texto" value="1" checked="checked"/>
<?}?>
                </label></td>
                <td nowrap="nowrap" class="titulo"><?echo $ro[id_faja]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[id_fajapallet]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[loten]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[nombre]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[femision]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[fvencimiento]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[neto]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[tara]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $ro[estado]?><? } ?>                  </td>
              </tr>
             
          </table> </td>
      </tr>
    </table></td>
  </tr>
</table>
</form>