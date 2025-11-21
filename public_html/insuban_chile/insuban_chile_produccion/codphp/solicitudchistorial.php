<h1>LISTAR CAMBIOS ESTADOS</h1>
<table width="1010" border="0">
 <tr>
   <td height="8" colspan="10"><? 
			$cambio_estado= crea_cambio_estado_ok($link,$id_ce,1);
			echo $cambio_estado;
			?></td>
  </tr>
  <?   if($id_ce){
	  
	  $sql="SELECT ces.id_c_es_so AS id_c_es_so,ces.id_ce AS id_ce, pro.producto AS producto, org.origen AS origen, proc.id_procedencia AS id_procedencia, ces.fechaces AS fechaces, ces.fecha_mp_pt AS fecha_mp_pt, ces.fechaanulacion AS fechaanulacion, us.username AS username, cambio_estado As cambio_estado from usuarios AS us, cambio_estado_solicitud AS ces, procedencia AS proc, producto AS pro, origenes AS org, cambio_estado AS cestado where ces.id_usuario = us.id_usuario and ces.id_procedencia = proc.id_procedencia and ces.id_origen = org.id_origen and ces.id_producto = pro.id_producto and ces.id_ce  = cestado.id_ce  and ces.id_ce = $id_ce  and ces.fecha_cierre_proceso  != '0000-00-00' order by id_c_es_so DESC";
$result=mysql_query($sql);
 $cuantossmp=mysql_num_rows($result);
  
//echo "sql $sql<br>"; 
//echo "cuantossmp $cuantossmp<br>";
if($cuantossmp){
	  ?>
 <tr>
 
   <td width="21" height="19" bgcolor="#FF9933">&nbsp;</td>
   <td colspan="9" bgcolor="#CCCCCC">&nbsp;</td>
 </tr>
  <tr>
    <td width="21" height="19" nowrap="nowrap" bgcolor="#FF9933"><center><strong>&nbsp;N&ordm;</strong></center></td>
    <td width="195" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>PRODUCTO</strong></td>
    <td width="89" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="155" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CAMBIO ESTADO</strong></td>
    <td width="96" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="161" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;<? if($id_ce == 1){?>F/MP -&gt; PT<? }else{?>REPROCESO -> PT<? }?></strong></td>
    <td width="117" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;</strong><strong>&nbsp;F/ANULACION</strong></td>
    <td width="142" colspan="3" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ENCARGADO</strong></td>
  </tr>
 
     <?
	
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_c_es_so=$row[id_c_es_so];
	//$id_ldp =$row[id_origen];
	$id_procedencia=$row[id_producto];
	$username=$row[username];
	$id_ce=$row[id_ce];
	$id_origen=$row[id_origen];
	$id_procedencia=$row[id_procedencia];
	$id_producto=$row[id_producto];
	$cambio_estado=$row[cambio_estado];
	$unidadessolicitadas=$row[unidadessolicitadas];
	$fechaces=format_fecha_sin_hora($row[fechaces]);   
	$fecha_mp_pt=format_fecha_sin_hora($row[fecha_mp_pt]);   
	$fechaanulacion=format_fecha_sin_hora($row[fechaanulacion]);
	$totaluni+=$unidadessolicitadas;
  ?>
  <tr>
    <td height="19" align="center" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $id_c_es_so?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=solicitudcdetalle.php&id_ce=<? echo $id_ce ?>&tic=<? echo $tic?>&id_c_es_so=<? echo $id_c_es_so?>&id_procedencia=<? echo $id_procedencia?>&fecha_anulacion=<? echo $fecha_anulacion?>"><? echo $row[producto]?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[origen]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $row[cambio_estado]?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaces ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_mp_pt?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fechaanulacion?></td>
    <td colspan="3" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $username?></td>
    <? } ?>
    <? 
	
	}?>
  </tr>
<?if ($id_ce == 3) {?>
  <tr>
    <div>
          <a href="codphp/informes_pdf_excel/excel_cambio_estado.php"><img src="../jpg/icono-excel.gif"></a>
          <!-- <strong><h2>Solicita informe completo excel al administrador del sistema.</h2></strong> -->
      </div>
  </tr><?}?>
  <br> 
  <? }?>
</table>
