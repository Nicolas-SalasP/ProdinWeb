<?

if($id_estado_material){	
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p where mpi.id_estado_material=$id_estado_material and mpi.id_estado_material = em.id_estado_material and mpi.id_producto = p.id_producto and mpi.id_mat_prima_importada != 0 order by mpi.id_mat_prima_importada desc";
	$result=mysql_query($sql);
	//$cuantos=mysql_num_rows($result);
	//echo "Cuantos1 $cuantos";
	}
	
if($id_estado_material and $entreano1){	
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p, origenes AS orig where mpi.id_estado_material=$id_estado_material and mpi.ano between '$entreano1' and '$entreano2' and mpi.id_estado_material = em.id_estado_material and mpi.id_producto = p.id_producto and mpi.id_mat_prima_importada != 0 and mpi.id_origen=orig.id_origen order by mpi.id_mat_prima_importada desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "Cuantos1 $cuantos";
	}

	if(!$id_estado_material){
$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p, origenes AS orig where mpi.id_estado_material=1 and mpi.id_estado_material = em.id_estado_material and mpi.id_producto = p.id_producto and mpi.id_mat_prima_importada != 0 and mpi.id_origen=orig.id_origen order by mpi.id_mat_prima_importada desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "Cuantos $cuantos";
	}

	
	if($dato){
		//echo "dato $dato";
	 $largo=strlen($dato);
			  
	 if($largo == 7){ 
	 $agr=2;
	 $dato=$agr.$dato;
	 }
  	 if($largo == 8){
		 $agr=2;
	 $dato=$agr.$dato;
	 }
	 
	
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p where mpi.id_mat_prima_importada = mpi.id_mat_prima_importada and mpi.id_estado_material = em.id_estado_material and mpi.id_producto=p.id_producto and mpi.id_estado_material != 0  and mpi.id_mat_prima_importada = '$dato'";
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
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="486" height="173" border="0" align="center">
  <tr>
    <td width="591" height="16" valign="top"><span class="titulo">Listar Materia Prima Importada</span></td>
    <td width="37" valign="middle" class="cajas"><a href="?modulo=materia_prima_importada.php">Volver</a></td>
  </tr>
  <tr>
    <td height="30" colspan="2" valign="top"><table width="632" border="0">
        <tr>
          <td width="217" bgcolor="#CCCCCC"><span class="titulo">A&Ntilde;O</span>            <span class="cajas">
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
          <td width="188" bgcolor="#CCCCCC"><span class="titulo">ESTADO</span><span class="cajas">
            <? 
	$estado_material= crea_estado_material_select($link,$id_estado_material);
	echo $estado_material;
	?>
          </span></td>
          <td width="213" bgcolor="#CCCCCC"><span class="titulo">FOLIO</span>
            <input name="dato" type="text" class="cajas" size="15" maxlength="50"/>
            <input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
          </tr>
      </table></td>
    </tr>
  <tr>
    <td height="1" colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="1" colspan="2" valign="top"><span class="numero"><? if($cuantos and $buscar){?><? echo " Cantidad $cuantos";?><? }?></span></td>
  </tr>
  <tr>
    <td height="69" colspan="2" valign="top">
	<? if($cuantos and $buscar){?>
	<table width="631" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="60" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Numero</td>
        <td width="127" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
        <td width="96" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Origen</td>
        <td width="99" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"> N&ordm; Comprobante</td>
        <td width="70" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Ingreso </td>
        <td width="91" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Estado Material </td>
        <td nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Alerta</td>
      </tr>
 <?
	  
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$id_mat_prima_importada=$row[id_mat_prima_importada];
	
	 $largo=strlen($row[id_mat_prima_importada]);
			  
	 if($largo == 8){ 
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,8);
	 }
  	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	
	$i++;
	?>
      <tr>
        <td bgcolor="<? echo $color?>" height="20" nowrap="nowrap" class="cajas"><div align="center"><? //echo substr($row[ano],2,4);?><? echo "$id_mat_prima_importada";?></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=materia_prima_importada.php&amp;id_mpi=<?echo $row[id_mat_prima_importada]?>"><?echo $row[producto]?></a>&nbsp;</td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><a href="?modulo=materia_prima_importada.php&amp;id_mpi=<?echo $row[id_mat_prima_importada]?>"><?echo $row[origen]?></a>&nbsp;</td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center"><a href="?modulo=materia_prima_importada.php&id_mpi=<?echo $row[id_mat_prima_importada]?>"><?echo $row[comprobante_num]?></a></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center"><a href="?modulo=materia_prima_importada.php&id_mpi=<?echo $row[id_mat_prima_importada]?>"><?echo $fecha_ingreso?></a>&nbsp;</div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center"><a href="?modulo=materia_prima_importada.php&id_mpi=<?echo $row[id_mat_prima_importada]?>"><?echo $row[estado_material]?></a>&nbsp;</div></td>
        <td bgcolor="<? echo $color?>"width="72" nowrap="nowrap" class="cajas"><? 
		if($row[alerta] == 1){
		?>
          <a href="?modulo=materia_prima_nacional.php&amp;id_mat=<?echo $row[id_mat_prima_nacional]?>">Alerta</a>
          <?
		}else{
		echo " &nbsp;";
		}
		?>&nbsp;</td>
      </tr>
      <? }?>
    </table>
	<? }?>
	</td>
  </tr>
</table>
</form>