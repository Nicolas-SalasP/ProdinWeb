<?
error_reporting(0);

	$sql_consul="SELECT * FROM pedido_tabla WHERE id_pedidos = $id_ped";	
	$result_consul=mysql_query($sql_consul);
 	while ($rowp=mysql_fetch_array($result_consul))
    {
	 $id_pedido_tablas=$rowp[id_pedido_tablas];
	 $id_pedidos=$rowp[id_pedidos];
	 $id_cruce_tablas1=$rowp[id_cruce_tablas];
	 $cantidadb=$rowp[cantidadb];

	//echo "id_pedido $id_ped   -    id_cruce_tablas1 $id_cruce_tablas1<br>";	 
	 
	 $sql_consul2="SELECT * FROM pedido_armado_automatico  WHERE id_pedidos = $id_ped and id_cruce_tablas = $id_cruce_tablas1";
	 $result_consul2=mysql_query($sql_consul2);
	 $cant_resgistros222=mysql_num_rows($result_consul2);
	 //echo "sql_consul2 $sql_consul2<br>";
	 
	if($cantidadb != $cant_resgistros){
	//echo "cantidad BD $cantidadb    -  cant_resgistrossss  $cant_resgistros ";
	  
	if($asignar_pedido){
	 foreach ($HTTP_POST_VARS as $key => $value)
     {
                $dat=split("-",$key);
                if ($dat[0] == 'id_etiquetados_folios2')
                {
                   $id=$dat[1];
                   $id_etiquetados_folios2=$HTTP_POST_VARS["id_etiquetados_folios2-$id"];
				   //$id_cruce_tablas2=$HTTP_POST_VARS["id_cruce_tablas2-$id"];
				   $id_pedidos2=$id_ped;
				    //echo "<br>id_etiquetados_folios2: $id_etiquetados_folios2 - id_cruce_tablas2: $id_cruce_tablas2<br>";
					$sqla="SELECT * FROM  pedido_armado_automatico  where id_etiquetados_folios=$id_etiquetados_folios2";
 					$resulta=mysql_query($sqla);
  					$existe=mysql_num_rows($resulta);
					
				   if($id_cruce_tablas1 == $id_cruce_tablas2 and !$existe){
		
	  				//echo "El codigo es igual";
					$sql_autom="insert into pedido_armado_automatico  (id_pedidos,id_pedido_tablas,id_cruce_tablas,id_etiquetados_folios) values ('$id_pedidos2','$id_pedido_tablas','$id_cruce_tablas2','$id_etiquetados_folios2')";
				    //echo "sql $sql_autom<br>";
					$result_autom=mysql_query($sql_autom,$link);
	  	 			$sql="UPDATE  etiquetados_folios set  id_pedidos='$id_pedidos2' where id_etiquetados_folios=$id_etiquetados_folios2";
		 			$result=mysql_query($sql);
					 //echo "sql $sql<br>";
	  			   } //if($id_cruce_tablas1 == $id_cruce_tablas2){
				   
				  
                }//fin asignar pedido
	 } //fin del foreach
         }
	    
	}//if($cantidadb != $cant_resgistros){
	$cant_resgistros222+=$cant_resgistros222;
	  $cantidadb2+=$cantidadb;
	  $cant_resgistros+=$cant_resgistros;
    }//while
 

if($eliminar and $id_etiquetados_folios) {
//echo "dddddddd";
 	foreach ($id_etiquetados_folios as $key)
     {
    	//**************************limpiar etiquetados_folios
		$sqlb="UPDATE  etiquetados_folios  set id_pedidos='0' where id_etiquetados_folios=$key";
 		$resultb=mysql_query($sqlb);
		//echo "$sqlb $sqlb <BR>";
  		$sqleb="delete from pedido_armado_automatico  where  id_etiquetados_folios = $key";
		$resulteb=mysql_query($sqleb);
		//echo "$sqleb $sqleb <BR>";
		//**************************limpiar etiquetados_folios
		
		$sqlf="SELECT * FROM etiquetados_folios WHERE id_etiquetados_folios = $key";	
		$resultf=mysql_query($sqlf);
		$cuantosf=mysql_num_rows($resultf);
		while ($rowf=mysql_fetch_array($resultf))
		{ 
			$id_etiquetados_folios3=$rowf[id_etiquetados_folios];
			$id_cruce_tablasver=$rowf[id_cruce_tablas];
		}
		
		
		
 		$sql="SELECT * FROM pedido WHERE id_pedidos = id_pedidos order by fecha_prioridad asc";	
		$result=mysql_query($sql);
		$cuantos=mysql_num_rows($result);
		

		while ($row=mysql_fetch_array($result))
		{ 

		 	$id_pedidos3=$row[id_pedidos];
			$sql_consul="SELECT * FROM pedido_tabla WHERE id_pedidos = $id_pedidos3";	
			$result_consul=mysql_query($sql_consul);
			 	while ($rowp=mysql_fetch_array($result_consul))
			    {
					 $id_pedido_tablas=$rowp[id_pedido_tablas];
					 $id_pedidos=$rowp[id_pedidos];
					 $id_cruce_tablas1=$rowp[id_cruce_tablas];
					 $cantidadb=$rowp[cantidadb];
	 
				 	 $sql_consul2="SELECT * FROM pedido_armado_automatico  WHERE id_pedidos = $id_pedidos3 and id_cruce_tablas = $id_cruce_tablasver";
					 $result_consul2=mysql_query($sql_consul2);
					 $cant_resgistros=mysql_num_rows($result_consul2);

					
				     if($cantidadb != $cant_resgistros and $id_pedidos3 != $id_ped)
					  //if($cantidadb != $cant_resgistros)
					 {
					    if($id_cruce_tablas1 == $id_cruce_tablasver)
						{
						  	 $id_pedido_tablasw=$rowcant[id_pedido_tablas];
						 	 $id_cruce_tablas2=$rowcant[id_cruce_tablas];
						 	 $sql_autom2="insert into pedido_armado_automatico  (id_pedidos,id_pedido_tablas,id_cruce_tablas,id_etiquetados_folios) values ('$id_pedidos','$id_pedido_tablas','$id_cruce_tablasver','$id_etiquetados_folios3')";
							 $result_autom=mysql_query($sql_autom2,$link);
						  	 $sql="UPDATE  etiquetados_folios set  id_pedidos='$id_pedidos3' where id_etiquetados_folios='$id_etiquetados_folios3'";
							 $result=mysql_query($sql);
			   		     }//if($id_cruce_tablas1 == $id_cruce_tablasver)
	  				 //if($cantidadb != $cant_resgistros){
					 
					 }
					
					 
				 }//while ($rowp=mysql_fetch_array($result_consul))

 		}//while ($row=mysql_fetch_array($result))

		}//foreach ($id_etiquetados_folios as $key)

} //if($eliminar and $id_etiquetados_folios) {





if($id_ped){
$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf, calibre AS c, unidad_medida AS um, medidas_productos AS mp where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_producto = pro.id_producto and etiq.id_calibre = c.id_calibre and etiq.id_unidad_medida = um.id_unidad_medida and etiq.id_medidas_productos = mp.id_medidas_productos and etiq.id_pedidos = $id_ped order by pro.producto,um.unidad_medida, mp.medidas_productos,c.calibre asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}



?>
<script language="JavaScript"> 
function cambiar(esto)
{
	vista=document.getElementById(esto).style.display;
	if (vista=='none')
		vista='block';
	else
		vista='none';

	document.getElementById(esto).style.display = vista;
}
</script>
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
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.texto13gris {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #333333;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="700" height="201" border="0" align="center">
  <tr>
    <td width="492" height="3" valign="top" bgcolor="#CCCCCC">&nbsp;<span class="numero">Pedido:</span> <span class="texto13gris"><? echo $id_ped?></span></td>
    <td valign="top" nowrap="nowrap" bgcolor="#CCCCCC"><span class="numero">&nbsp;Fecha de Despacho:</span> <span class="texto13gris"><? echo $fecha_prioridad;?></span></td>
  </tr>
  <tr>
    <td height="4" colspan="2" valign="top" bgcolor="#CCCCCC"><span class="texto13gris"><span class="numero">&nbsp;</span></span><span class="numero">Cliente:</span><span class="texto13gris">
        <? 
		$sqldes="select * from destinos where id_destinos =$id_destinosv";
		$resultdes=mysql_query($sqldes,$link);
		if ($rowdes=mysql_fetch_array($resultdes))
		{ 
		echo "$rowdes[destinos]"; 
		}
		?>
    </span></td>
  </tr>
  <tr>
    <td height="4" colspan="2" valign="top" class="cajas"><div align="right"><a href="?modulo=pedido_modificar.php&id_ped=<? echo $id_ped?>">Volver</a></div></td>
  </tr>
  <tr>
    <td height="4" colspan="2" valign="top" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="2" valign="top">
	<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td height="14" nowrap bgcolor="#CCCCCC" class="titulo"> <div align="center">N&deg; </div></td>
        <td width="57" height="14" nowrap bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Folio </td>
        <td width="133" height="14" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
        <td width="47" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Calibre</td>
        <td width="49" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Unid./Med.</td>
        <td width="54" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Medida</td>
        <td width="91" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
          <div align="center">F. Elaboraci&oacute;n </div></td>
        <td width="90" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
          <div align="center">Est. Material </div></td>
        <td width="70" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
          <div align="center">Procedencia</div></td>
        <td width="57" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">Contenido</div></td>
      </tr>
      <? 
	if($cuantos){
	
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$i++;
	$sum_contenidos_unidades+=$row[contenido_unidades];
	$id_cruce_tablasok=$row[id_cruce_tablas];
	?>
      <tr>
        <td height="20" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $i?></div>          <div align="center"></div></td>
        <td bgcolor="<? echo $color?>" nowrap="nowrap" class="cajas"><div align="center"><?echo $row[id_etiquetados_folios]?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[id_etiquetados_folios]?>&id_pedi=<? echo $id_ped?>&id_destinosv=<? echo $id_destinosv?>&fecha_prioridad=<? echo $fecha_prioridad?>"><? echo $row[producto];?></a><? echo $id_cruce_tablasok?>
          <input name="id_cruce_tablasok" type="hidden" value="<?echo $id_cruce_tablasok?>" /></td>
        <td bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[calibre];?></td>
        <td bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[unidad_medida];?></td>
        <td bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[medidas_productos];?></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $row[estado_folio]; ?></div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <? 
		  //echo $row[id_procedencia];
		  
		  if($row[id_procedencia] == 'I'){
          echo "Importado";
         }
		  if($row[id_procedencia] == 'N'){
         echo "Nacional";
		 }
		 ?>
        </div></td>
        <td bgcolor="<? echo $color?>" class="cajas"><div align="center"><?echo $row[contenido_unidades]?></div></td>
      </tr><? }?>
      <tr>
        <td height="10" colspan="7" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;</td>
        <td colspan="2" bgcolor="#CCCCCC" class="cajas"><div align="right"><span class="titulo">Total Contenido&nbsp;</span></div></td>
        <td bgcolor="#CCCCCC" class="cajas"><div align="center"><? echo $sum_contenidos_unidades;?></div></td>
      </tr>
      <? 
	  
	  
	  }//fin if
	  
	  ?>
    </table>	</td>
  </tr>
  
  </tr>
</table>
</form>