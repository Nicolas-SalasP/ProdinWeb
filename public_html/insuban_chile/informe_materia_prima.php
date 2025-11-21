<?
$largo=strlen($dato);
$newano=substr($dato, 0, 2);
$newano="20".$newano;
$newdato=substr($dato, 0, $largo);


			        if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-1;
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					}
					
				
//echo " Largo $largo , Dato $dato , New $newano - $newdato";

//$largod=strlen($desde);
//$newanod=substr($desde, 0, 2);
//$newanod="20".$newanod;
//$newdatod=substr($desde, 0, $largod); 
//echo "newdatod $newdatod";

//$largoh=strlen($hasta);
//$newanoh=substr($hasta, 0, 2);
//$newanoh="20".$newanoh;
//$newdatoh=substr($hasta, 0, $largoh); 

//echo "newdatoh $newdatoh";

//if(!$anoingreso){
//$anoingreso=2009;
//}
if($fecha_ingresod != '' and fecha_ingresoh != ''){
$fecha_ingresodesde=format_fecha_sin_hora($fecha_ingresod);
$fecha_ingresohasta=format_fecha_sin_hora($fecha_ingresoh);
}

if($fecha_ingresod2 != '' and fecha_ingresoh2 != ''){
$fecha_ingresodesde2=format_fecha_sin_hora($fecha_ingresod2);
$fecha_ingresohasta2=format_fecha_sin_hora($fecha_ingresoh2);
}



if($id_procedencia == "N" or $entreano1 or $entreano2){



$sql="SELECT *  FROM mat_prima_nacional As mpn, estado_material AS em, producto AS p, origenes AS orig where mpn.id_mat_prima_nacional = mpn.id_mat_prima_nacional and mpn.id_estado_material = em.id_estado_material and mpn.id_producto=p.id_producto and mpn.id_origen = orig.id_origen ";


if($id_producto)
	$sql.= " and p.id_producto = '$id_producto' ";
	
if($bidon_num)
	$sql.= " and mpn.bidon_num = '$bidon_num' ";
if($comprobante_num)
$sql.= " and mpn.comprobante_num = '$comprobante_num' ";
	
if($id_origen)
	$sql.= " and orig.id_origen = '$id_origen' ";
if($desde and $hasta)
$sql.= " and mpn.id_mat_prima_nacional between '$desde' and '$hasta' and mpn.id_mat_prima_nacional=mpn.id_mat_prima_nacional ";
if($alerta)
	$sql.= " and mpn.alerta = '$alerta' ";
if($rcp)
	$sql.= " and mpn.rcp = '$rcp' ";
if($entreano1 and $entreano2 and !$fecha_ingresodesde or !$fecha_ingresohasta)
$sql.= " and mpn.ano between '$entreano1' and '$entreano2' ";
if($fecha_ingresodesde and $fecha_ingresohasta and $entreano1 and $entreano2)
$sql.= " and mpn.fecha_ingreso between '$fecha_ingresodesde' and '$fecha_ingresohasta'";
if($fecha_ingresodesde2 and $fecha_ingresohasta2 and $entreano1 and $entreano2)
$sql.= " and mpn.fecha_salida between '$fecha_ingresodesde2' and '$fecha_ingresohasta2'";
if($id_estado_material)
	$sql.= " and mpn.id_estado_material = '$id_estado_material' ";

$sql.=" order by mpn.id_mat_prima_nacional";
$result=mysql_query($sql);
$cuantos2=mysql_num_rows($result);
//echo "$sql<br>";
//echo "Cantidad $cuantos";
}

if($id_procedencia == "I"){

$sql="SELECT *  FROM mat_prima_importada As mpi, estado_material AS em, producto AS p, origenes AS orig where mpi.id_mat_prima_importada = mpi.id_mat_prima_importada and mpi.id_estado_material = em.id_estado_material and mpi.id_producto=p.id_producto and mpi.id_origen = orig.id_origen and mpi.ano between '$entreano1' and '$entreano2' ";

if($id_estado_material)
	$sql.= " and mpi.id_estado_material = '$id_estado_material' ";
if($id_producto)
	$sql.= " and p.id_producto = '$id_producto' ";
if($id_unidad_produccion)
	$sql.= " and orig.id_origen = '$id_origen' ";
if($desde and $hasta)
$sql.= " and mpi.id_mat_prima_importada between '$desde' and '$hasta' and mpi.id_mat_prima_importada=mpi.id_mat_prima_importada ";
if($fecha_ingresodesde and $fecha_ingresohasta)
$sql.= " and mpi.fecha_ingreso between '$fecha_ingresodesde' and '$fecha_ingresohasta'";

if($fecha_ingresodesde2 and $fecha_ingresohasta2 and $entreano1 and $entreano2)
$sql.= " and mpi.fecha_salida between '$fecha_ingresodesde2' and '$fecha_ingresohasta2'";

if($entreano1 and $entreano2)
$sql.= " and mpi.ano between '$entreano1' and '$entreano2' ";

$sql.=" order by mpi.id_mat_prima_importada";
//echo "SQL -> $sql<br>";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "Cuantos $cuantos";


}
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
  <table width="767" border="0" align="center">
    <tr>
      <td width="56" height="30">&nbsp;</td>
      <td width="764"><span class="titulo">Informe Materia Prima Nacional / Importada </span></td>
    </tr>
    <tr>
      <td colspan="2"><table width="824" border="0" align="center" bordercolor="#CCCCCC">
        <tr>
          <td width="818"><table width="616" height="216" border="0" align="center">

              <tr>
                <td class="titulo">Procedencia</td>
                <td height="11" valign="top"><span class="titulo">Estado Material</span></td>
                <td height="11"><span class="titulo">Producto</span></td>
                <td width="92" height="11" valign="top"><span class="titulo">Origen</span></td>
                <td height="11" valign="top"><span class="titulo">Alerta</span></td>
                </tr>
              <tr>
                <td class="titulo"><? 
		 	$procedencia= crea_procedencia222222($link,$id_procedencia,1);
			echo $procedencia;
			?>
            
          
            </td>
                <td height="13" valign="top"><span class="titulo">
                  <? 
		 	$dato=1;
			$estado_material= crea_estado_material($link,$id_estado_material);
			echo $estado_material;
			?>
                </span></td>
                <td height="13"><? 
		 	
			$producto= crea_producto($link,$id_producto);
			echo $producto;
			?></td>
                <td height="13" valign="top"><? 
					$origen= crea_origenes($link,$id_origen);
			echo $origen;
			?></td>
                <td height="13" valign="top"><select name="alerta" class="cajas">
                  <option value="0">Seleccione Alerta</option>
                  <option value="1">Alerta</option>
                </select></td>
                </tr>
              <tr>
                <td height="23" colspan="3" valign="middle" class="cajas">[* Fecha por defecto A&ntilde;o <? echo $entreano1?> - <? echo $entreano2?>]</td>
                <td height="23" valign="top">&nbsp;</td>
                <td>&nbsp;</td>
                </tr>
              <tr>
                <td height="15" valign="middle" bgcolor="#CCCCCC" class="titulo">&nbsp;A&ntilde;o:</td>
                <td height="15" valign="top"><input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
				<input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="3" maxlength="4" /></td>
                <td height="15" colspan="2" bgcolor="#CCCCCC"><span class="titulo">&nbsp;Fecha de Ingreso</span></td>
                <td height="15" bgcolor="#CCCCCC" class="titulo">Numero de Bidon</td>
                </tr>
              <tr>
                <td width="96" height="22" bgcolor="#CCCCCC"><span class="titulo">&nbsp;Desde Nro: </span></td>
                <td width="187" valign="top"><input name="desde" type="text" class="cajas" id="desde" size="10" value="<?echo $desde?>"/></td>
                <td width="56" valign="top" bgcolor="#FF9933"><span class="titulo">&nbsp;Desde</span></td>
                <td valign="top" bgcolor="#FF9933"><span class="titulo">&nbsp;Hasta</span></td>
                <td valign="top"><input name="bidon_num" type="text" class="cajas" id="bidon_num" size="10" value="<?echo $bidon_num?>"/></td>
                </tr>
              <tr>
                <td height="22" bgcolor="#CCCCCC"><span class="titulo">&nbsp;Hasta Nro: </span></td>
                <td width="187" valign="top"><input name="hasta" type="text" class="cajas" id="hasta" size="10" value="<? echo $hasta ?>"/></td>
                <td bgcolor="#FFFFFF" class="cajas"><input name="fecha_ingresod" type="text" class="cajas"   id="fecha_ingresod"  value="<?echo $fecha_ingresod?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fecha_ingresod');" class="cajas"  >Ver</a></td>
                <td bgcolor="#FFFFFF" class="cajas"><input name="fecha_ingresoh" type="text" class="cajas"   id="fecha_ingresoh"  value="<?echo $fecha_ingresoh?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fecha_ingresoh');" class="cajas"  >Ver</a></td>
                <td bgcolor="#CCCCCC" class="titulo">Numero de Comprobante</td>
                </tr>
              <tr>
                <td height="22" bgcolor="#CCCCCC">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td colspan="2" bgcolor="#CCCCCC" class="titulo">Fecha de Despacho</td>
                <td><input name="comprobante_num " type="text" class="cajas" id="comprobante_num " size="10" value="<?echo $comprobante_num ?>"/></td>
              </tr>
              <tr>
                <td height="22" bgcolor="#CCCCCC"><span class="titulo">Rcp:</span></td>
                <td valign="top"><input name="rcp" type="text" class="cajas"   id="rcp"  value="<?echo $rcp?>" size="10" maxlength="10" /></td>
                <td valign="top" bgcolor="#FF9933"><span class="titulo">&nbsp;Desde</span></td>
                <td valign="top" bgcolor="#FF9933"><span class="titulo">&nbsp;Hasta</span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="22" bgcolor="#CCCCCC">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td class="titulo"><span class="cajas">
                  <input name="fecha_ingresod2" type="text" class="cajas"   id="fecha_ingresod2"  value="<?echo $fecha_ingresod2?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fecha_ingresod2');" class="cajas"  >Ver</a></span></td>
                <td><span class="cajas">
                  <input name="fecha_ingresoh2" type="text" class="cajas"   id="fecha_ingresoh2"  value="<?echo $fecha_ingresoh2?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fecha_ingresoh2');" class="cajas"  >Ver</a></span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="22" bgcolor="#CCCCCC"><span class="titulo">&nbsp;</span></td>
                <td width="187" valign="top">&nbsp;</td>
                <td width="56" class="titulo"><input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
                <td>&nbsp;</td>
                <td width="163">&nbsp;</td>
                </tr>
          </table>
            <table width="818" border="0" align="center">
              <tr>
                <td width="812" valign="top"><? if($buscar and $id_procedencia == "N"){?>
				<a href="excel_mpnsalidalistar.php?id_producto=<?echo $id_producto?>&id_origen=<?echo $id_origen?>&id_estado_material=<?echo $id_estado_material?>&rcp=<?echo rcp?>&desde=<?echo $desde?>&hasta=<?echo $hasta?>&fecha_ingresod=<?echo $fecha_ingresod?>&fecha_ingresoh=<?echo $fecha_ingresoh?>&entreano1=<? echo $entreano1?>&entreano2=<? echo $entreano2?>&fecha_ingresodesde2=<? echo $fecha_ingresodesde2?>&fecha_ingresohasta2=<? echo $fecha_ingresohasta2?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /></a><span class="titulo"><?echo "Cantidad $cuantos2";?></span><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="24" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="center">N&deg;</div></td>
                      <td width="45" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Numero</td>
                      <td width="113" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Producto</td>
                      <td width="46" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Origen</td>
                      <td width="46" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Contenido</td>
                      <td width="31" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">RCP</td>
                      <td width="79" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N&deg; Comprob. </td>
                      <td width="60" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">N&deg; Bidon</td>
                      <td width="59" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Ingreso</td>
                      <td width="52" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Faena </td>
                      <td width="60" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Termino</td>
                      <td width="48" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">F/Salida</td>
                      <td width="71" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo">Est/Material</td>
                      <td width="50" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Alerta</td>
                    </tr>
                    <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$i++;
	?>
                    <tr>
                      <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i?></td>
                      <td nowrap="nowrap" class="cajas"><div align="center"><? echo $row[id_mat_prima_nacional];?></div></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[producto]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[origen]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[contenido]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[rcp]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[comprobante_num]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[bidon_num]?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fecha_ingreso?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fecha_faena?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fecha_termino?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $fecha_salida?></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[estado_material]?></td>
                      <td class="cajas"><? 
		if($row[alerta] == 1){
		?>
                          <div align="center">Alerta </div>
                        <?
		}else{
		echo " &nbsp;";
		}
		?></td>
                    </tr>
                    <? }?>
                  </table>
                  <? } ?>
                  <? if($buscar and $id_procedencia == "I"){?>
                  <a href="excel_mpisalidalistar.php?id_estado_material=<?echo $id_estado_material?>&id_producto=<?echo $id_producto?>&id_origen=<?echo $id_origen?>&id_estado_material=<?echo $id_estado_material?>&rcp=<?echo rcp?>&desde=<?echo $desde?>&hasta=<?echo $hasta?>&fecha_ingresod=<?echo $fecha_ingresod?>&fecha_ingresoh=<?echo $fecha_ingresoh?>&entreano1=<? echo $entreano1?>&entreano2=<? echo $entreano2?>&fecha_ingresodesde2=<? echo $fecha_ingresodesde2?>&fecha_ingresohasta2=<? echo $fecha_ingresohasta2?>" target="_blank"><img src="jpg/icono-excel.gif" width="33" height="33" border="0" /><span class="titulo"><?echo "Cantidad $cuantos";?></span></a>          <table width="757" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="52" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">N&deg; Folio</div></td>
                      <td width="143" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                      <td width="78" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
                      <td width="75" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&deg; Comprob. </td>
                      <td width="62" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&deg; Bidon </td>
                      <td width="64" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Contenido</td>
                      <td width="62" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/Ingreso </td>
                      <td width="51" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F/Salida </td>
                      <td width="74" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est/Material </td>
                      <td width="74" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Alerta</td>
                    </tr>
                    <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);
	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
	$id_mat_prima_importada=$row[id_mat_prima_importada];
		
    $largo=strlen($id_mat_prima_importada);
			  
			   if($largo == 8){ 
			   $id_mat_prima_importada=substr($id_mat_prima_importada,1,8);
			   }
  			   if($largo == 9){
			   $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
			   }
	
	
	$i++;
	
	
	?>
                    <tr>
                      <td nowrap="nowrap" class="cajas"><div align="center"><? echo $id_mat_prima_importada;?></div></td>
                      <td nowrap="nowrap" class="cajas">&nbsp;<?echo $row[producto]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[origen]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[comprobante_num]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[bidon_num]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[contenido]?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $fecha_ingreso?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $fecha_salida?></td>
                      <td nowrap="nowrap" class="cajas"><?echo $row[estado_material]?></td>
                      <td nowrap="nowrap" class="cajas"><? 
		if($row[alerta] == 1){
		?>
                        Alerta
                        <?
		}else{
		echo " &nbsp;";
		}
		?>                      </td>
                    </tr>
                    <? }?>
                  </table>
                  <? }?></td>
              </tr>
            </table>			</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>