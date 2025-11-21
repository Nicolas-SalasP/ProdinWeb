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
	
	foreach ($id_etiquetados_folios2 as $key2)
     {
    	
	
	 //foreach ($HTTP_POST_VARS as $key => $value)
     //{
                //$dat=split("-",$key);
               // if ($dat[0] == 'id_etiquetados_folios2')
                //{
                  // $id=$dat[1];
                   //$id_etiquetados_folios2=$HTTP_POST_VARS["id_etiquetados_folios2-$id"];
				   //$id_cruce_tablas2=$HTTP_POST_VARS["id_cruce_tablas2-$id"];
				   $id_pedidos2=$id_ped;
				   //echo "<br>id_etiquetados_folios2: $id_etiquetados_folios2 - id_cruce_tablas2: $id_cruce_tablas2<br>";
				   $sqla="SELECT * FROM  pedido_armado_automatico  where id_etiquetados_folios=$key2";
 				   $resulta=mysql_query($sqla);
  				   $existe=mysql_num_rows($resulta);
				   
				   if($id_cruce_tablas1 == $id_cruce_tablas2 and !$existe)
				   {
	  				//echo "El codigo es igual";
					$sql_autom="insert into pedido_armado_automatico  (id_pedidos,id_pedido_tablas,id_cruce_tablas,id_etiquetados_folios) values ('$id_pedidos2','$id_pedido_tablas','$id_cruce_tablas2','$key2')";
				    //echo "sql $sql_autom<br>";
					$result_autom=mysql_query($sql_autom,$link);
	  	 			$sql="UPDATE  etiquetados_folios set  id_pedidos='$id_pedidos2' where id_etiquetados_folios=$key2";
		 			$result=mysql_query($sql);
					 //echo "sql $sql<br>";
	  			   } //if($id_cruce_tablas1 == $id_cruce_tablas2){
				  
                //}//fin asignar pedido
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
		$sqlb="UPDATE  etiquetados_folios  set id_pedidos='0' and fpicking='0000-00-00'  where id_etiquetados_folios=$key";
 		$resultb=mysql_query($sqlb);
		//echo "$sqlb $sqlb <BR>";
  		$sqleb="delete from pedido_armado_automatico  where  id_pedidos = $id_ped and id_etiquetados_folios = $key";
		$resulteb=mysql_query($sqleb);
		//echo "$sqleb $sqleb <BR>";
		//**************************limpiar etiquetados_folios
		
		/*
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
		
		*/

		}//foreach ($id_etiquetados_folios as $key)

} //if($eliminar and $id_etiquetados_folios) {




if($id_ped){

$sql="SELECT * ";
$sql .=" FROM etiquetados_folios AS etiq ";
$sql .=" left outer join producto AS pro on etiq.id_producto = pro.id_producto";
$sql .=" left outer join estado_folio AS esf on etiq.id_estado_folio = esf.id_estado_folio";
$sql .=" left outer join calibre AS c on etiq.id_calibre = c.id_calibre";
$sql .=" left outer join unidad_medida AS um on etiq.id_unidad_medida = um.id_unidad_medida";
$sql .=" left outer join medidas_productos AS mp on etiq.id_medidas_productos = mp.id_medidas_productos";
$sql .=" left outer join operarios As ope on etiq.id_operarios = ope.id_operarios";
$sql .=" left outer join origenes AS orig on etiq.id_origen = orig.id_origen";
$sql .=" left outer join procedencia AS proce on etiq.id_procedencia = proce.id_procedencia";
$sql .=" where etiq.id_pedidos = $id_ped";
$sql .=" order by etiq.id_cruce_tablas, pro.producto, etiq.calibre_alt,mp.medidas_productos asc";
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
<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-align: center;
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
<div id="caja_fija">
<form id="form1" name="form1" method="post" action="">
<table width="901" height="201" border="0" align="center">
  <tr>
    <td width="561" height="3" valign="top" bgcolor="#CCCCCC">&nbsp;<span class="numero">Pedido:</span> <span class="texto13gris"><? echo $id_ped?></span></td>
    <td width="330" valign="top" nowrap="nowrap" bgcolor="#CCCCCC"><div align="right"><span class="numero">&nbsp;Fecha de Despacho:</span> <span class="texto13gris"><? echo $fecha_prioridad;?></span></div></td>
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
    <td height="4" colspan="2" align="left" valign="top" class="cajas">&nbsp;
	<? 
	if($permiso47 == 1 and $nivel_usua == 1){
	?>
      <div align="left" class="cajas"><a href="javascript:seleccionar_todo()">Seleccionar Todo</a> / <a href="javascript:deseleccionar_todo()">Deseleccionar Todo</a></div>			
	  <? }?>
	  </td>
  </tr>
  <tr>
    <td height="20" colspan="2" valign="top">
	<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
	
      <tr>
        <td width="17" height="14" nowrap bgcolor="#CCCCCC" class="titulo"> <div align="center">N&deg; </div></td>
		<? if($permiso47 == 1 and $nivel_usua == 1){?>
        <td width="23" nowrap bgcolor="#CCCCCC" class="titulo">
		<div align="center"><input name="eliminar" type="submit" class="cajas" id="eliminar" value="X" /></div>		</td>
		<? } ?>
        <td width="24" height="14" nowrap bgcolor="#CCCCCC" class="titulo"><div align="center">N/I </div></td>
        <td width="25" nowrap bgcolor="#CCCCCC" class="titulo">ID</td>
        <td width="44" nowrap bgcolor="#CCCCCC" class="titulo"><div align="left">N&ordm; Folio</div></td>
        <td width="53" nowrap bgcolor="#CCCCCC" class="titulo">N&ordm; Pallet
          <div align="left"></div></td>
        <td width="52" height="14" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Producto</div></td>
        <td width="39" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Calibre</div></td>
        <td width="55" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Unid/Med</div></td>
        <td width="40" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Medida</div></td>
        <td width="83" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">F/Elaboraci&oacute;n </div></td>
        <td width="76" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Est/Material </div></td>
        <td width="70" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">F/Termino</div></td>
        <td width="61" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Contenido</div></td>
        <td width="40" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Origen</div></td>
        <td width="76" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">N&deg; Comprob. </div></td>
        <td width="81" nowrap="NOWRAP" bgcolor="#CCCCCC" class="titulo"><div align="left">Responsable</div></td>
      </tr>
      <? 
	if($cuantos){
	$color = "#000000";$i = 0;
	while ($row=mysql_fetch_array($result))
    { 
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	$f_termino=format_fecha_sin_hora($row[f_termino]);	
	$id_etiquetados_folios=$row[id_etiquetados_folios];
	$id_folio_m3=$row[folio_m3];
	$i++;
	$sum_contenidos_unidades+=$row[contenido_unidades];
	$id_cruce_tablasok=$row[id_cruce_tablas];
	$id_pedidos=$row[id_pedidos];
	$pallet=$row[pallet];
	?>
      <tr>
        <td height="20" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $i?></div></td>
		<? if($permiso47 == 1 and $nivel_usua == 1){?>
        <td height="20" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
		<div align="center"><input name="id_etiquetados_folios[]" type="checkbox" class="cajas" id="id_etiquetados_folios[]" value="<?echo $row[id_etiquetados_folios];?>" />        </div>		</td>
		<? }?>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo "$row[id_procedencia]";?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><? echo "$id_cruce_tablasok";?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&amp;id_etf2=<?echo $row[folio_m3]?>&amp;id_pedi=<? echo $id_ped?>&amp;id_destinosv=<? echo $id_destinosv?>&amp;fecha_prioridad=<? echo $fecha_prioridad?>"><?echo $row[folio_m3]?></a></div></td>
        <td align="center" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? 
echo "$pallet";
 
?>
          <div align="center"></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $row[folio_m3]?>&id_pedi=<? echo $id_ped?>&id_destinosv=<? echo $id_destinosv?>&fecha_prioridad=<? echo $fecha_prioridad?>"><? echo $row[producto];?></a>
          <input name="id_cruce_tablasok" type="hidden" value="<?echo $id_cruce_tablasok?>" /></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[calibre];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[unidad_medida];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $row[medidas_productos];?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $f_elaboracion ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $row[estado_folio]; ?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
        
          <? 
/*		  $id_procedencia=$row[id_procedencia];
		  
		  if($id_procedencia == 'I'){
          echo "Importado";
         }
		  if($id_procedencia == 'N'){
         echo "Nacional";
		 }
*/
		 echo $f_termino;
		 ?>
        </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $row[contenido_unidades]?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
		<div align="center">&nbsp;
		<?
		echo $row[origen];

		?>
		</div>		</td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;<?echo $row[compro_nro]?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?
		$nom =strtoupper("$row[nombreop]"); # HOLA TíO
		$apel =strtoupper("echo $row[apellido]"); # HOLA TíO
		echo $nom?> <?echo $apel?></td>
      </tr><? }?>
      <tr>
        <td height="21" colspan="13" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="right"><span class="titulo">Total Contenido&nbsp;</span></div>          <div align="center"></div></td>
        <td height="21" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><? echo $sum_contenidos_unidades;?></td>
        <td height="21" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;</td>
        <td height="21" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;</td>
        <td height="21" nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;</td>
        </tr>
      <? 
	  
	  
	  }//fin if
	  
	  ?>
    </table>	</td>
  </tr>
  <? 
  //echo "cantidad BD $cantidadb2  -  cant_resgistros  $cuantos ";
  //$hola=1;
  if($cantidadb2 != $cuantos){?>
  <? if($permiso47 == 1 and $nivel_usua == 1){?>
  <tr>
  <td height="9" colspan="2" valign="top">&nbsp;<a href="#" onclick="cambiar('error'); return false;"  class="titulo">Agregar Folios al Pedido</a></td>
  </tr>
  <tr>
    <td height="9" colspan="2" valign="top">&nbsp;<div id="error" style="display: none;"></div>
	<textarea name="folios" cols="30" rows="3" id="folios" onKeyPress="return numeros(event)"></textarea>
    <input name="buscar" type="submit" class="cajas" id="buscar" value="Buscar" /></td>
  </tr>
  <? }?>
  <tr>
    <td height="42" colspan="2" valign="top"><? if($buscar){?>
      <div align="left" class="cajas"><a href="javascript:seleccionar_todo()">Seleccionar Todo</a> / <a href="javascript:deseleccionar_todo()">Deseleccionar Todo</a></div>
	<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="2%" bgcolor="#CCCCCC" class="titulo">N&ordm;</td>
      <td width="9%" align="center" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
      <td width="4%" align="center" bgcolor="#CCCCCC" class="titulo">&nbsp;N/I</td>
      <td width="6%" align="center" bgcolor="#CCCCCC"><div align="left"><span class="titulo">&nbsp;N&deg; Folio</span></div></td>
      <td width="3%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;ID</div></td>
      <td width="14%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Producto</div></td>
      <td width="9%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Calibre</div></td>
      <td width="8%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Unid/Med</div></td>
      <td width="7%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Medida </div></td>
      <td width="10%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;F/Elaboraci&oacute;n </div></td>
      <td width="12%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Est/Material </div></td>
      <td width="9%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Procedencia</div></td>
      <td width="7%" bgcolor="#CCCCCC" class="titulo"><div align="left">&nbsp;Contenido</div></td>
      </tr>
	<?
	 if($folios){
		$dat=split("\n",$folios);
	    $c=count($dat);
	
	 for ($i=0; $i<=$c;$i++)
	  { 
	   if ($dat[$i] != "")
	   {
	    $id_f=$dat[$i];
		$largo=strlen($id_f);
		if($largo != 1){
		  $id_f=substr($id_f, 0, $largo);
		}

		 $sql="SELECT *
		 FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mp, unidad_medida AS um, estado_folio AS est, origenes AS orig, procedencia AS proc
		 where ef.id_etiquetados_folios = ef.id_etiquetados_folios 
		 and ef.id_producto = p.id_producto 
		 and ef.id_calibre=c.id_calibre 
		 and ef.id_medidas_productos = mp.id_medidas_productos 
		 and ef.id_estado_folio = est.id_estado_folio
		 and ef.id_unidad_medida = um.id_unidad_medida
		 and ef.id_origen = orig.id_origen
		 and ef.id_procedencia = proc.id_procedencia
		 and ef.id_estado_folio != 3
		 and ef.id_estado_folio != 7
		 and ef.id_estado_folio != 5
		 and ef.id_estado_folio != 6
		 and ef.id_estado_folio != 9
		 and ef.id_estado_folio != 11
		 and ef.ocupado = 0
		 and ef.borrado != 1
		 and id_etiquetados_folios = $id_f
		 ";
	// echo "$sql<br>";
		 // 3 = Picking, 7 = despachado, 5 = Anulado, 6 = Reprocesado, 9 = Revisión, 1 = Emitido, 2 = Bodega, 
         $rest=mysql_query($sql);
		 $cuantos_folios=mysql_num_rows($rest);
				 
	?>
  	  <? 
	  if($cuantos_folios){
       while ($r=mysql_fetch_array($rest))
	  { 
	    $f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
		$f_termino=format_fecha_sin_hora($r[f_termino]);	    
	   	$id_pedidos2=$r[id_pedidos];
		$id_c_es_so2=$r[id_c_es_so];
		$folio_m3=$r[folio_m3];		
	   	$id_etiquetados_folios2=$r[id_etiquetados_folios];
	   	$id_cruce_tablas2=$r[id_cruce_tablas];
	   	$id_estado_folio2=$r[id_estado_folio];
		$j++;
	  ?>
       <tr>
	  <td align="center" nowrap="nowrap" class="cajas"><? echo $j;?><!--<input name="id_etiquetados_folios2-<? echo $id_etiquetados_folios2?>" type="checkbox" value="<?echo $id_etiquetados_folios2;?>">--></td>
	  <td align="center" nowrap="nowrap" class="cajas">
	  <? if($id_pedidos2 == 0 ){?>
	    <input name="id_etiquetados_folios2[]" type="checkbox" class="cajas" id="id_etiquetados_folios2[]" value="<?echo $id_etiquetados_folios2;?>" />
      <? }else{
		   
		   if(!$id_c_es_so2){
			echo "<b> Pedido: </b> $id_pedidos2";
			}else{
			echo "<b> Solicitud C/Estado: </b> $id_c_es_so2";
			}
	  }
		  
		  ?></td>
	  <td align="center" nowrap="nowrap" class="cajas"><? echo $r[id_procedencia]?></td>
      <td nowrap="nowrap" class="cajas">&nbsp;<? echo $folio_m3?>
        <input name="id_etiquetados_folios2-<?echo $id_etiquetados_folios2?>" type="hidden" value="<?echo $id_etiquetados_folios2?>" /></td>
      <td class="cajas"><div align="center"><? echo "$id_cruce_tablas2";?></div></td>
      <td bgcolor="<? echo $color2?>" class="cajas">&nbsp;<? echo $r[producto]?><input name="id_cruce_tablas2" type="hidden" value="<?echo $id_cruce_tablas2?>" /></td>
      <td class="cajas">&nbsp;<? echo $r[calibre]?></td>
      <td class="cajas">&nbsp;<? echo $r[unidad_medida];?></td>
      <td class="cajas">&nbsp;<? echo $r[medidas_productos]?></td>
      <td class="cajas">&nbsp;<? echo $f_elaboracion ?></td>
      <td class="cajas">&nbsp;<? echo $r[estado_folio]?></td>
      <td class="cajas">&nbsp;<? 
		  //echo $row[id_procedencia];
		  
		  if($r[id_procedencia] == 'I'){
          echo "Importado";
         }
		  if($r[id_procedencia] == 'N'){
         echo "Nacional";
		 }




		 ?></td>
      <td class="cajas" >&nbsp;<?echo $r[contenido_unidades]?>      &nbsp;</tr>
	  
	  <? 
	
	  } //while ($r=mysql_fetch_array($rest)){ 
	  }
	  ?>
	  <?
	  	 }//if ($dat[$i] != "")
	     }
 		 }
       ?>
  </table>
      <? if($buscar){?>
      <input name="asignar_pedido" type="submit" class="cajas" id="asignar_pedido" value="Asignar a Pedido" />
	  <? }?></td>
	<? }?>
  </tr>
</table>
<? }?>
</form>
  </div>
  <div id="contenedor_pagina">
  </div>