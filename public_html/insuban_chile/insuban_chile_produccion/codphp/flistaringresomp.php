<?

if(!$year){ $year=$fhoy=date("Y");	}

if($buscar){

if($fid) { $fidok=format_fecha_sin_hora($fid); }

if($fih) { $fihok=format_fecha_sin_hora($fih); }

if($fidfaenad) { $fidfaenadok=format_fecha_sin_hora($fidfaenad); }

if($fidfaenah) { $fidfaenadok=format_fecha_sin_hora($fidfaenah); }

if($id_procedencia == "N"){

$sql="SELECT mpn.comprobante_num AS comprobante_num, org.origen, org.id_origen AS id_origen, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_termino AS fecha_termino, count(DISTINCT mpn.id_mat_prima_nacional) AS cuentabidonesn, SUM(mpn.contenido)AS contenido, mpn.factura_mp AS factura_mp 

FROM mat_prima_nacional AS mpn, origenes AS org

WHERE mpn.id_mat_prima_nacional = mpn.id_mat_prima_nacional

AND mpn.id_origen = org.id_origen  ";

if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }

if($factura_mp){ $sql.= " and mpn.factura_mp = '$factura_mp' "; }

if($comprobante_num){ $sql.= " and mpn.comprobante_num = '$comprobante_num' "; }

if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }

if($year){ $sql.= " and mpn.ano = $year "; }

if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok'";}

if($fidfaenadok or $fidfaenadok){ $sql.= " and mpn.fecha_faena  between '$fidfaenadok' and '$fidfaenadok'";}

$sql.= " GROUP BY mpn.comprobante_num order by fecha_ingreso desc";

//echo "SQL1 $sql<br>";

$result=mysql_query($sql);

$cuantos=mysql_num_rows($result);

}

if($id_procedencia == "I" ){

$sqli="SELECT mpi.comprobante_num AS comprobante_num, mpi.guia_imp AS guia_imp, org.origen AS origen, org.id_origen AS id_origen2, mpi.fecha_ingreso AS fecha_ingreso, mpi.fecha_termino AS fecha_termino, count(DISTINCT mpi.id_mat_prima_importada) AS cuentabidonesi, SUM(mpi.contenido) AS contenidoi, mpi.ano AS ano FROM mat_prima_importada AS mpi, origenes AS org

WHERE mpi.id_mat_prima_importada = mpi.id_mat_prima_importada

AND mpi.id_origen = org.id_origen  and mpi.comprobante_num != 0 ";

$largo=strlen($id_mat_prima_importada);

if($largo == 10){

   $f=2;

   $dato=$f.$id_mat_prima_importada;
   $dato=$id_mat_prima_importada;

}

if($dato){ $sqli.= " and mpi.folio_m3_mpi = '$dato' "; }

if($comprobante_num){ $sqli.= " and mpi.comprobante_num = '$comprobante_num' "; }

if($guia_imp){ $sqli.= " and mpi.guia_imp = '$guia_imp' "; }

if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }

if($year){ $sqli.= " and mpi.ano = $year "; }

if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok'";}

$sqli.= " GROUP BY mpi.comprobante_num order by fecha_ingreso desc";

$resulti=mysql_query($sqli);

$cuantosi=mysql_num_rows($resulti);

}

}//fin del buscar

$cuantostotales=$cuantos+$cuantosi;

?>

<h1>LISTADO DE INGRESO DE MATERIA PRIMA</h1>

<table width="100%" border="0">

  <tr>

    <td height="19" colspan="8" align="right"><table width="961" border="0" align="center">

      <tr>

        <td width="955" nowrap="nowrap"><table width="1016" border="0">

          <tr>

            <td width="21" align="left"><? $procedencia= crea_procedencia($link,$id_procedencia,1);

		  echo $procedencia;

				

			?></td>

            <td width="30" align="left"><? 

			if($id_procedencia){

	   		$s=$id_procedencia;

	   		$producto= crea_producto_ok_filtro_new($link,$s,$id_producto,1);

		    echo $producto;

	   		}?></td>

            <td width="24" align="left"><?

            if($id_producto){

		    $s=$id_procedencia;

		    $origen= crea_origenes_ok_filtro_new($link,$id_origen,$id_producto,$s,1);

	        echo $origen;

		    }

			?></td>

            <td width="70" align="left"><? if($id_procedencia){ ?>N&ordm; FOLIO<? } ?></td>

            <td width="92" align="left">

			<? if($id_procedencia == 'N'){ ?>

            <input name="id_mat_prima_nacional" type="text" id="id_mat_prima_nacional" value="<? echo $id_mat_prima_nacional?>" size="8" maxlength="8" />

            <? } ?>

            <? if($id_procedencia == 'I'){ ?>

            <input name="id_mat_prima_importada" type="text" id="id_mat_prima_importada" value="<? echo $id_mat_prima_importada?>" size="8" maxlength="10" />

            <? } ?>            </td>

            <td width="112" align="left"><? if($id_procedencia == 'I'){?>

FACTURA IMP

  <? } if($id_procedencia== 'N'){?>

FACTURA NAC

<? } ?></td>

            <td width="76" align="left"> <? if($id_procedencia == 'I'){?>

       <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="5" maxlength="10" />

	   <? } if($id_procedencia== 'N'){?> 

       <input name="factura_mp" type="text" id="factura_mp" value="<? echo $factura_mp?>" size="5" maxlength="10" />

	   <? } ?></td>

            <td width="90" align="left"><? if($id_procedencia == 'I'){ ?>

            GUIA IMP 

       <? } if($id_procedencia== 'N'){?> 

       		GUIA NAC

       <? } ?></td>

            <td width="77" align="left"> <? if($id_procedencia == 'I'){ ?>

       <input name="guia_imp" type="text" id="guia_imp" value="<? echo $guia_imp?>" size="5" maxlength="10" />

       <? } if($id_procedencia== 'N'){?> 

       <input name="comprobante_num" type="text" id="comprobante_num" value="<? echo $comprobante_num?>" size="5" maxlength="10" />

	   <? } ?></td>

            <td width="124" align="left"> <? if($id_procedencia == 'I'){ ?>

            N&ordm; BIDON IMP 

       <? } if($id_procedencia== 'N'){?> 

       		 N&ordm; BIDON NAC 

       <? } ?></td>

            <td width="105" align="left"><? if($id_procedencia){?><input name="bidon_num" type="text" id="bidon_num" value="<? echo $bidon_num?>" size="5" maxlength="10" /><? } ?></td>

            <td width="35" align="left"><? if($id_procedencia){?>A&Ntilde;O<? }?></td>

            <td width="106" align="left"><? if($id_procedencia){?><input name="year" type="text" id="year" value="<? echo $year?>" size="5" maxlength="10" /><? }?></td>

            </tr>

            <? if($id_procedencia){?>

          <tr>

            <td colspan="13" align="left"><table width="100%" border="0">

              <tr>

                <td colspan="6" bgcolor="#CCCCCC">&nbsp;Buscar por rango de fechas</td>

              </tr>

              <tr>

                <td width="89">F/INGRESO:</td>

                <td width="106"><input name="fid" type="text" id="fid" value="<? echo $fid?>" size="8" maxlength="10" />

                  <a href="javascript:show_Calendario('form1.fid');"> ver</a></td>

                <td width="163"><input name="fih" type="text" id="fih" value="<? echo $fih?>" size="8" maxlength="10" />

                  <a href="javascript:show_Calendario('form1.fih');"> ver</a></td>

                <td width="68">F/FAENA:</td>

                <td width="106"><input name="fidfaenad" type="text" id="fidfaenad" value="<? echo $fidfaenad?>" size="8" maxlength="10" />

                  <a href="javascript:show_Calendario('form1.fidfaenad');"> ver</a></td>

                <td width="452"><input name="fidfaenadh" type="text" id="fidfaenadh" value="<? echo $fidfaenadh?>" size="8" maxlength="10" />

                  <a href="javascript:show_Calendario('form1.fidfaenadh');"> ver</a></td>

              </tr>

            </table></td>

            </tr>

            <? }?>

        </table></td>

        </tr>

      <tr>

        <? if($id_procedencia){?><td align="right" nowrap="nowrap"><input type="submit" name="buscar" id="buscar" value="Buscar" />          <? }?></td>

      </tr>

    </table></td>

  </tr>

 <? if($cuantostotales){?>

  <tr>

    <td width="23" height="19" bgcolor="#FF9933"><center><strong>N&ordm;</strong></center></td>

    <td width="86" bgcolor="#FF9933"><strong>&nbsp;FACTURA</strong></td>

    <td width="104" bgcolor="#FF9933"><strong>&nbsp;GUIA</strong></td>

    <td width="413" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>

    <td width="90" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>

    <td width="65" bgcolor="#FF9933"><strong>&nbsp;F/VENC</strong></td>

    <td width="76" bgcolor="#FF9933"><strong>&nbsp;BIDONES</strong></td>

    <td width="90" bgcolor="#FF9933"><strong>&nbsp;UNIDADES</strong></td>

  </tr>

   <?

   if($cuantos){

   $color = "#000000";$i = 0;

   while ($row=mysql_fetch_array($result))

   {

	$i++;

	 $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";

	 $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);   

	 $fecha_termino=format_fecha_sin_hora($row[fecha_termino]);

	 $cuentabidonesn=$row[cuentabidonesn];

	 $id_origen=$row[id_origen];

	 $contenido=$row[contenido];

	?>

  <tr>

    <td bgcolor="<? echo $color?>" height="19" nowrap="nowrap">&nbsp;<? echo $i?></td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap">&nbsp;

    <? if($row[factura_mp]){?>

    <a href="?modulo=flistaringresomodetalle.php&amp;factura_mp=<?echo $row[factura_mp]?>&amp;cuentabidones=<?echo $cuentabidones?>&amp;contenido=<?echo $contenido?>&fresca=<? echo "N";?>&id_origen=<? echo $id_origen?>"><? echo $row[factura_mp]?></a>

    <? } ?>

    </td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap">&nbsp;

    <? if($row[comprobante_num]){?>

    <a href="?modulo=flistaringresomodetalle.php&amp;comprobante_num=<?echo $row[comprobante_num]?>&cuentabidones=<?echo $cuentabidones?>&contenido=<?echo $contenido?>&fresca=<? echo "N";?>&id_origen=<? echo $id_origen?>"><? echo $row[comprobante_num]?></a>

    <? } ?>

    </td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap">&nbsp;<a href="?modulo=flistaringresomodetalle.php&amp;comprobante_num=<?echo $row[comprobante_num]?>&cuentabidones=<?echo $cuentabidones?>&contenido=<?echo $contenido?>&fresca=<? echo "N";?>&id_origen=<? echo $id_origen?>"><? echo $row[origen]?></a></td>

    <td bgcolor="<? echo $color?>" align="center" nowrap="nowrap">&nbsp;<? echo $fecha_ingreso?></td>

    <td bgcolor="<? echo $color?>" align="center" nowrap="nowrap">&nbsp;<? echo $fecha_termino?></td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap"><center><? echo $cuentabidonesn?></center></td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap"><center><? echo $contenido?></center></td>

   <? 

	  $cn = $cn + $cuentabidonesn;

	  $cont= $cont + $contenido;

    }



    }

    

   ?>

  </tr>

   <?

   if($cuantosi){

   

   $color = "#000000";$i = 0;

   while ($rowi=mysql_fetch_array($resulti))

   {

	$i++;

	 $color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";

	 $fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);   

	 $fecha_termino=format_fecha_sin_hora($rowi[fecha_termino]);

	 $cuentabidonesi=$rowi[cuentabidonesi];

	 $contenidoi=$rowi[contenidoi];

	

  ?>

  <tr>

    <td bgcolor="<? echo $color?>" height="19" nowrap="nowrap">&nbsp;<? echo $ii=$i+$cuantos?></td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap">&nbsp;

    <? if($rowi[comprobante_num]){?>

    <a href="?modulo=flistaringresomodetalle.php&amp;comprobante_num=<?echo $rowi[comprobante_num]?>&amp;cuentabidones=<?echo $cuentabidonesi?>&amp;contenido=<?echo $contenidoi?>&salada=<? echo "I";?>"><? echo $rowi[comprobante_num]?></a>

    <? } ?>

    </td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap">&nbsp;</td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap">&nbsp;   <a href="?modulo=flistaringresomodetalle.php&amp;comprobante_num=<?echo $rowi[comprobante_num]?>&amp;cuentabidones=<?echo $cuentabidonesi?>&amp;contenido=<?echo $contenidoi?>&salada=<? echo "I";?>"><? 

	$comprobante_num=$rowi[comprobante_num];

	$id_origen2=$rowi[id_origen2];

	$sqlo="SELECT org.origen AS origenn FROM mat_prima_importada AS mpi, origenes AS org where mpi.id_mat_prima_importada = mpi.id_mat_prima_importada and mpi.comprobante_num = $comprobante_num and mpi.id_origen = org.id_origen

  group by mpi.id_origen order by mpi.id_origen";

	$resulto=mysql_query($sqlo);

	//$cuantoso=mysql_num_rows($resulto);

	while ($rowo=mysql_fetch_array($resulto))

    {

 	$origenf = $rowo[origenn];

		echo "$origenf / ";

	}

   ?></a></td>

    <td bgcolor="<? echo $color?>" align="center" nowrap="nowrap">&nbsp;<? echo $fecha_ingreso?></td>

    <td bgcolor="<? echo $color?>" align="center" nowrap="nowrap">&nbsp;<? echo $fecha_termino?></td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap"><center><? echo $cuentabidonesi?></center></td>

    <td bgcolor="<? echo $color?>" nowrap="nowrap"><center><? echo $contenidoi?></center></td>

    <? 

		   $ci = $ci + $cuentabidonesi;	

		   $conti = $conti + $contenidoi;

     } 

   }

   ?>

  </tr>

  <tr>

    <td align="right">&nbsp;</td>

    <td align="right">&nbsp;</td>

    <td align="right">&nbsp;</td>

    <td align="right">&nbsp;</td>

    <td align="right">&nbsp;</td>

    <td align="right"><strong>TOTAL</strong></td>

    <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $fstotal=$cn+$ci;?></td>

    <td align="center" bgcolor="#CCCCCC">&nbsp;<? echo $fsuni=$cont+$conti;?></td>

  </tr>

  <? }?>

</table>

<? if($buscar) {?>



<? if($id_procedencia == "N"){?>

<table>

   <tr>

      <td><div>

          <a href="codphp/informes_pdf_excel/excel_producto_fresco.php"><img src="../jpg/icono-excel.gif"></a> Informe 2015-<?echo $year;?> FRESCO

      </div></td>

      <td></td>

    </tr>   

</table>

<?}else{?>

<table>

   <tr>

      <td><div>

          <a href="codphp/informes_pdf_excel/excel_producto_salado.php"><img src="../jpg/icono-excel.gif"></a> Informe 2017-<?echo $year;?> SALADO

      </div></td>

      <td></td>

    </tr>   

</table>

<?}?> 

<?}?>

