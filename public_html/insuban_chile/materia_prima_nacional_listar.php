      <?
	if($id_estado_material){	
	$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p, origenes AS org where mpn.id_estado_material=$id_estado_material and mpn.ano between '$entreano1' and '$entreano2' and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = org.id_origen order by mpn.id_mat_prima_nacional desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);

	}
	if(!$id_estado_material){
$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p, origenes AS org where mpn.id_estado_material=1 and mpn.ano >= 2009 and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = org.id_origen order by mpn.id_mat_prima_nacional desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
;
	}
  
    if($id_estado_material and $ano){	
	$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p, origenes AS org where mpn.id_estado_material=$id_estado_material and mpn.ano between '$entreano1' and '$entreano2' and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = org.id_origen order by mpn.id_mat_prima_nacional desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);

	}

if($dato){

     $largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $dato=substr($dato, 0, $largo);

$sql="SELECT * FROM mat_prima_nacional As mpn, estado_material AS em, producto AS p, origenes AS org where mpn.id_mat_prima_nacional = mpn.id_mat_prima_nacional and mpn.id_estado_material = em.id_estado_material and mpn.id_producto=p.id_producto and mpn.id_mat_prima_nacional != 0 and mpn.id_origen = org.id_origen  and mpn.id_mat_prima_nacional = '$dato'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

}
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.estilo_cajon_buscar_contacto {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="486" height="187" border="0" align="center">
  <tr>
    <td width="586" height="16" valign="top"><span class="titulo">Listar Materia Prima Nacional </span></td>
    <td width="42" valign="middle" class="cajas"><a href="?modulo=materia_prima_nacional.php">Volver</a></td>
  </tr>
  <tr>
    <td height="30" colspan="2" valign="top"><table width="632" border="0">
        <tr>
          <td width="210" bgcolor="#CCCCCC"><span class="titulo">A&Ntilde;O</span>            <span class="cajas">
	 				<? 
					if(!$entreano1){
					$entreano1=$fhoy=date("Y");
					$entreano1=$entreano1-1;
					}
					if(!$entreano2){
					$entreano2=$fhoy=date("Y");
					}
					?>
	 					<input name="entreano1" type="text" class="cajas" id="entreano1" value="<? echo $entreano1 ?>" size="4" maxlength="4" />
                        <input name="entreano2" type="text" class="cajas" id="entreano2" value="<? echo $entreano2 ?>" size="4" maxlength="4" />
            </span></td>
          <td width="195" bgcolor="#CCCCCC" class="titulo">ESTADO<span class="cajas">
            <? 
	$estado_material= crea_estado_material_select($link,$id_estado_material);
	echo $estado_material;
	?>
          </span></td>
          <td width="213" bgcolor="#CCCCCC"><span class="titulo">FOLIO</span>
            <input name="dato" type="text" class="cajas" size="15" maxlength="50"/>
            <input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
          </tr>
      </table>      </td>
    </tr>
  <tr>
    <td height="11" colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="11" colspan="2" valign="top"><? if($cuantos and $buscar){?><span class="numero"><? echo " Cantidad $cuantos";?></span><? }?></td>
  </tr>
    <tr>
    <td height="78" colspan="2" valign="top">
	<? if($cuantos and $buscar){?>
	<table width="631" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="58" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">Numero</div></td>
        <td width="85" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
        <td width="57" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon </td>
        <td width="129" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
        <td width="71" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Comprob </td>
        <td width="62" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Ingreso </td>
        <td width="74" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
        <td width="77" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Alerta</td>
      </tr>





<?

	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$i++;
	?>
	
      <tr>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center" class="cajas"><? //echo substr($row[ano],2,4);?><? echo $id_mat_prima_nacional; ?></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[producto]?></a>&nbsp;</td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center"><a href="?modulo=salida_materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[bidon_num]?></a>&nbsp;</div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[origen]?></a>&nbsp;</td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[comprobante_num]?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $fecha_ingreso?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center">&nbsp;<a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?echo $row[estado_material]?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas">
		
		<? 
		if($row[alerta] == 1){
		?>
		<a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>">Alerta</a>
		<?
		}else{
		echo " &nbsp;";
		}
		?>		&nbsp;</td>
      </tr>
      <? }?>
    </table>
	<? }?>
	</td>
  </tr>
</table>
</form>