<form id="form1" name="form1" method="post" action="">
<table width="486" height="142" border="0" align="center">
  <tr>
    <td width="439" height="30" valign="top"><span class="titulo">Listar Materia Prima Nacional </span></td>
    <td width="157" valign="top" class="cajas"><a href="?modulo=materia_prima_nacional.php">Volver a Materia Prima Nacional </a></td>
  </tr>
  <tr>
    <td height="-1" colspan="2" valign="top"><table width="632" border="0">
        <tr>
          <td width="31"><span class="titulo">ANO</span></td>
          <td width="85"><span class="cajas">
		   <input name="ano" type="text" id="ano" value="<? echo $ano?>" size="10" maxlength="10" />
          </span></td>
          <td width="502"><span class="cajas">
            <? 
	$estado_material= crea_estado_material_select($link,$id_estado_material);
	echo $estado_material;
	?>
          </span></td>
        </tr>
      </table></td>
    </tr>
  <tr>
    <td height="-1" colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="1" colspan="2" valign="top"><input name="dato" type="text" size="15" maxlength="50"/>
      <input name="buscar" type="submit" value="Buscar" /></td>
  </tr>
    <tr>
    <td height="78" colspan="2" valign="top">
	
	
	<table width="631" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="60" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">Numero</div></td>
        <td width="235" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
        <td width="97" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Comprobante </td>
        <td width="62" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Ingreso </td>
        <td width="91" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado Material </td>
        <td width="72" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Alerta</td>
      </tr>
      <?
/*
$sql="SELECT * FROM mat_prima_nacional AS mpn, estado_material AS em, producto AS p where mpn.id_estado_material=$id_estado_material and mpn.ano >= $ano and mpn.id_estado_material = em.id_estado_material and mpn.id_producto = p.id_producto and mpn.id_mat_prima_nacional != 0";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
*/
	if($id_estado_material){	
	$sql="SELECT ano  FROM mat_prima_nacional where id_estado_material=$id_estado_material and ano >= $ano";
	$result=mysql_query($sql);
	
	}
	

	//$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	//$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	//$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas"><div align="center" class="cajas"><? echo $ano;?><? echo $id_mat_prima_nacional; ?></div></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>"><?//echo $row[nombre]?></a></td>
        <td nowrap="nowrap" class="cajas"><a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?//echo $row[comprobante_num]?></a></td>
        <td nowrap="nowrap" class="cajas"><a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?//echo $fecha_ingreso?></a></td>
        <td nowrap="nowrap" class="cajas"><a href="?modulo=materia_prima_nacional.php&id_mat=<?echo $row[id_mat_prima_nacional]?>"><?//echo $row[estado_material]?></a></td>
        <td nowrap="nowrap" class="cajas">
	
				</td>
      </tr>
      <? }?>
    </table>	</td>
  </tr>
</table>
</form>