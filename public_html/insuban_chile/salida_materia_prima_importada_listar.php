<?

  
	if($id_estado_material){	
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p, origenes AS ori where mpi.id_estado_material=$id_estado_material and mpi.id_producto=p.id_producto and mpi.id_estado_material = em.id_estado_material and mpi.id_mat_prima_importada != 0 and mpi.id_origen = ori.id_origen order by mpi.id_mat_prima_importada desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	}
		if($id_estado_material and $entreano1){	
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p, origenes AS ori where mpi.id_estado_material=$id_estado_material and mpi.id_estado_material = em.id_estado_material  and mpi.id_producto=p.id_producto and mpi.id_mat_prima_importada != 0 and mpi.ano between '$entreano1' and '$entreano2' and mpi.id_origen = ori.id_origen order by mpi.id_mat_prima_importada desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	//echo "sql -> $sql";
	}
	
	if(!$id_estado_material){
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material AS em, producto AS p, origenes AS ori where mpi.id_estado_material=em.id_estado_material and mpi.id_producto=p.id_producto and mpi.id_estado_material = 1 and mpi.id_mat_prima_importada != 0 and mpi.id_origen = ori.id_origen order by mpi.id_mat_prima_importada desc";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	}
	if($dato){
	
	$largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $dato=substr($dato, 2, $largo);
	
	$sql="SELECT * FROM mat_prima_importada AS mpi, estado_material As em, producto AS p where mpi.id_estado_material = em.id_estado_material and mpi.id_producto=p.id_producto and mpi.id_mat_prima_importada = '$dato'";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	}
	  

if ($modificar_x and $id_estado_material_cambio) {

 if($id_estado_material_cambio == 2){
  $fecha=date("Y-m-d");
  //echo "$fecha";
  }
  
   if($fecha_despacho){
  $dat=split(" ",$fecha_despacho);
  $dat=split("-",$dat[0]);
  $fecha="$dat[2]-$dat[1]-$dat[0]";
 } 

 if($id_estado_material_cambio != 2 and $fecha_despacho ==''){
  $fecha='00-00-0000';
  }

 if ($id_mat_prima_importada)  
  foreach ($id_mat_prima_importada as $key)
 {
  $sql="update mat_prima_importada set id_estado_material=$id_estado_material_cambio,fecha_salida='$fecha' where id_mat_prima_importada = $key";
  //echo "SQL $sql<br>";
  $res=mysql_query($sql);
 }
}
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
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
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
  <table width="798" height="218" border="0" align="center">
    <tr>
      <td width="574" height="21" valign="top"><span class="titulo">Listar Salida Materia Prima Importada </span></td>
      <td width="214" valign="middle" class="cajas"><a href="?modulo=salida_materia_prima_importada.php">Volver</a></td>
    </tr>
    <tr>
      <td height="21" colspan="2" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td height="-2" colspan="2" valign="top"><table width="749" border="0" align="center">
        <tr>
          <td width="166" bgcolor="#CCCCCC"><span class="cajas"><span class="titulo">A&Ntilde;O</span></span><span class="cajas">
          <?   if(!$entreano1){
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
          <td width="155" bgcolor="#CCCCCC"><span class="cajas"><span class="titulo">ESTADO</span></span><span class="cajas">
            <? 
	$estado_material= crea_estado_material_select($link,$id_estado_material);
	echo $estado_material;
	?>
          </span></td>
          <td width="212" bgcolor="#CCCCCC"><span class="cajas"><span class="titulo">FOLIO</span></span>
            <input name="dato" type="text" class="cajas" size="15" maxlength="50"/>
            <input name="buscar" type="submit" class="cajas" value="Buscar" /></td>
          <td width="198" bgcolor="#CCCCCC"><span class="titulo">F. Despacho</span>
            <input name="fecha_despacho" type="text" class="cajas"   id="fecha_despacho"  value="<?echo $fecha_despacho?>" size="10" maxlength="10" />
            <a href="javascript:show_Calendario('form1.fecha_despacho');" class="cajas"  >Ver </a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="1" valign="top"><? if($buscar){?><span class="numero"><? echo " Cantidad $cuantos";?></span><? }?></td>
      <td height="1" valign="top"><? if($buscar and $cuantos){?><div align="right"><span class="titulo"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></span></div><? }?></td>
    </tr>
    <tr>
      <td height="64" colspan="2" valign="top">
	  <? if($buscar and $cuantos){?>
	  <table width="783" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="63" height="14" bgcolor="#CCCCCC" class="titulo">Numero</td>
            <td width="180" height="14" bgcolor="#CCCCCC" class="titulo">Producto</td>
            <td width="100" bgcolor="#CCCCCC" class="titulo">Origen</td>
            <td width="53" bgcolor="#CCCCCC" class="titulo">N&ordm; Bidon</td>
            <td width="72" bgcolor="#CCCCCC" class="titulo">N&ordm; Comprob. </td>
            <td width="63" bgcolor="#CCCCCC" class="titulo">F. Ingreso </td>
            <td width="62" bgcolor="#CCCCCC" class="titulo">F. Salida </td>
            <td width="88" bgcolor="#CCCCCC" class="titulo">Est. Material </td>
            <td width="82" bgcolor="#CCCCCC" class="titulo"><select name="id_estado_material_cambio" class="cajas">
                <option value="0">Estado</option>
                <option value="1">Bodega</option>
                <option value="2">Despacho</option>
                <option value="3">Anulado</option>
            </select></td>
          </tr>
          <?
	//$largo=strlen($dato);
	 //$newano=substr($dato, 0, 2);
	 //$newano="20".$newano;
	 //$newdato=substr($dato, 2, $largo);
	 
	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    {
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
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
            <td bgcolor="<? echo $color?>" height="22" class="cajas"><div align="center"><? //echo substr($row[ano],2,4);?><? echo $id_mat_prima_importada;?></div></td>
            <td bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=salida_materia_prima_importada.php&amp;id_imp=<?echo $row[id_mat_prima_importada]?>"><?echo $row[producto]?></a></td>
            <td bgcolor="<? echo $color?>" class="cajas"><a href="?modulo=salida_materia_prima_importada.php&amp;id_imp=<?echo $row[id_mat_prima_importada]?>"><?echo $row[origen]?></a></td>
            <td bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_importada.php&amp;id_imp=<?echo $row[id_mat_prima_importada]?>"><?echo $row[bidon_num]?></a></div></td>
            <td bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_importada.php&id_imp=<?echo $row[id_mat_prima_importada]?>"><?echo $row[comprobante_num]?></a></div></td>
            <td bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_importada.php&amp;id_imp=<?echo $row[id_mat_prima_importada]?>"><?echo $fecha_ingreso?></a></div></td>
            <td bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_importada.php&amp;id_imp=<?echo $row[id_mat_prima_importada]?>"><?echo $fecha_salida?></a></div></td>
            <td bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<a href="?modulo=salida_materia_prima_importada.php&amp;id_imp=<?echo $row[id_mat_prima_importada]?>"><? echo $row[estado_material]?></a></div></td>
            <td bgcolor="<? echo $color?>" class="cajas"><div align="center">
                <input name="id_mat_prima_importada[]" type="checkbox" class="cajas" id="id_mat_prima_importada[]" value="<?echo $row[id_mat_prima_importada];?>" />
            </div></td>
          </tr>
          <? }?>
      </table>
	  <? }?>
	  </td>
    </tr>
    <tr>
      <td colspan="2" valign="top"><? if($buscar and $cuantos){?><center>
          <a href="javascript: document.form1.submit();">
          <label>
          <input type="image" name="modificar" src="jpg/modificar.jpg" />
          </label>
          </a>
      </center><? }?></td>
    </tr>
  </table>
</form>