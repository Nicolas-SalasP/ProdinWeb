<?
$fhoy=date("Y-m-d");

if ($grabar and ($id_faja or $folios))
  {
 // echo "WASAP";
 
   $dat2=split(" ",$fdespacho);
  $dat=split("-",$dat2[0]);
  $fdespacho1="$dat[2]-$dat[1]-$dat[0]";
  
  $dat3=split(" ",$fhoy);
  $dat1=split("-",$dat3[0]);
  $fpallet1="$dat1[2]-$dat1[1]-$dat1[0]";

   if (!$id_fajapal) {
   $sql1="insert into fajapallet (fpallet,id_bodega,id_destinos,fdespacho,glosa,estado)
    values ('$fpallet1',1,$id_destinos,'$fdespacho1','$glosa','$estado')";
   $rest1=mysql_query($sql1);
   //echo "SQL1 $sql1";
   $id_fajapallet=mysql_insert_id();
   }
   else {
    $id_fajapallet=$id_fajapal;
   }
   
  if ($id_faja) 
  foreach($id_faja as $key => $value){
            
     		 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$key";
			 $rest=mysql_query($sq);
			  //echo "$sq -------- KEY -> $key<br>";
	    }
  if ($folios)
      {
	  //echo "VALOR FOLIOS $folios <br>";
	  $dat=split("\n",$folios);
	  $c=count($dat);
	  //echo "son $c datos<br>";
	  for ($i=0; $i<$c;$i++) 
	    if ($dat[$i] != "") {
	    $id_f=$dat[$i];
		 $sql="select * from fajas where id_faja=$id_f and id_fajapallet=0";
		 //echo "SQL $sql";
		 $rest=mysql_query($sql);
		 $c1=mysql_num_rows($rest);
		 if ($c1)
		    {
			 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$id_f";
			 $rest=mysql_query($sq);
			}
		 //else 
		  //  echo "el valor $id_f esta asignado o no existe<br>";
			
		}  
	  }
		
echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ejemplo_pallet_con_fajas.php\">";
 exit;	
		
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
  <table width="606" border="0" align="center">
    <tr>
      <td width="600" height="30"><span class="titulo">Pallets con Fajas </span></td>
    </tr>
    <tr>
      <td><table width="600" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="59%" border="0" align="center">
              <tr>
                <td colspan="2"><?
if ($id_fajapallet)
$ext.=" and id_fajapallet='$id_fajapallet' ";
else
$ext.=" and id_fajapallet=0 ";
   
$sql="select * from fajas as f, producto as p where f.id_producto = p.id_producto and f.estado='E'  $ext ";
//echo "SQL $sql";
$r=mysql_query($sql);
$cuantos=mysql_num_rows($r);



?></td>
              </tr>
              <tr>
                <td colspan="2"></label>
                    <div align="center">
                      <table width="406" border="0">
                        <tr>
                          <td width="130" class="titulo">Fecha</td>
                          <td width="266"><input name="fpallet " type="text" class="cajas" id="fpallet" value="<?echo $fhoy?>" size="10" maxlength="10" />
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
                          <td><input name="glosa" type="text" class="cajas" id="glosa" size="50" /></td>
                        </tr>
                        <tr>
                          <td class="titulo">Fecha Despacho</td>
                          <td><input name="fdespacho" type="text" class="cajas"  size="10" maxlength="10" />
                            <a href="javascript:show_Calendario('form1.fdespacho');" class="cajas" >Ver</a></td>
                        </tr>
                      </table>
                    </div></td>
              </tr>
              <tr>
                <td colspan="2">
<? if (!$cap_folios) { ?>				
				
				<table width="551" border="1" cellpadding="1" cellspacing="1">
                    <tr>
                      <td width="111" bgcolor="#CCCCCC">&nbsp;</td>
                      <td width="37" bgcolor="#CCCCCC" class="titulo">Faja</td>
                      <td width="33" bgcolor="#CCCCCC" class="titulo">Pallet</td>
                      <td width="26" bgcolor="#CCCCCC" class="titulo">Lote</td>
                      <td width="57" bgcolor="#CCCCCC" class="titulo">Producto</td>
                      <td width="55" bgcolor="#CCCCCC" class="titulo">E.Emisi&oacute;n</td>
                      <td width="83" bgcolor="#CCCCCC" class="titulo">F.Vencimiento</td>
                      <td width="28" bgcolor="#CCCCCC" class="titulo">Neto</td>
                      <td width="28" bgcolor="#CCCCCC" class="titulo">Tara</td>
                      <td width="40" bgcolor="#CCCCCC" class="titulo">Est </td>
                      <? if ($cuantos) while ($ro=mysql_fetch_array($r))  {
					  //fechas
					  
					  ?>
                    </tr>
                    <tr>
                      <td nowrap="nowrap"><label>
                        <?if(!$id_fajapallet){?>
                        <input name="id_faja[<?echo $ro[id_faja]?>]" type="checkbox" class="cajas" id="id_faja[<?echo $ro[id_faja]?>]" value="checkbox" />
                        <?}else{?>
                        <input name="ver" type="checkbox" class="caja_texto" value="1" checked="checked"/>
                        <?}?>
                      </label></td>
                      <td nowrap="nowrap" class="titulo"><?php echo substr($ro[ano],2,4); ?><?echo $ro[id_faja]?> </td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[id_fajapallet]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[loten]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[nombre]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[femision]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[fvencimiento]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[neto]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[tara]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $ro[estado]?>
                          <? } ?>                      </td>
                    </tr>
                </table>
<? } 
 else
   { ?>
   
   CAPTURAR FOLIOS<br />
   <textarea name="folios" cols="30" rows="10" id="folios"></textarea>
      <? } ?>				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="52%" nowrap="nowrap"><div align="center">
				  <?if ($cuantos) {?> 
				<? 
				$sqlp="select * from fajapallet order by id_fajapallet";
				$restp=mysql_query($sqlp);
				?>
				<select name="id_fajapal" id="id_fajapal">
				  <option value="0">Nuevo Pallet</option>
				  <? while ($r=mysql_fetch_array($restp)) { ?>
				  <option value="<?echo $r[id_fajapallet]?>"><?echo $r[id_fajapallet]?></option>
				  <? } ?>
				</select>
				
                 <input name="grabar" type="submit" class="cajas" value="Asignar Faja a Pallets" /><? } ?>
                </div></td>
                <td width="48%" class="cajas"><div align="center"><a href="?modulo=ejemplo_pallet_con_fajas.php">Ver Pallets </a> - - - <a href="?modulo=pallet_con_fajas.php&amp;cap_folios=1">Capturar folios </a></div></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>