<? 
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

$id_producto_antes=$id_producto2;

if(!$id_destinos){
$id_destinos=0;
}
if(!$glosa){
$glosa='';
}
if(!$factura){
$factura=0;
}

$fhoy=date("Y"); 
$femitido = date("Y-m-d"); 
 if($grabar_x){
	//sigpallet (siguiente pallet)
	
	if(!$cantidad_foliosgenerar)
	{
	$generarsi=1;
	}else{
	$generarsi=$cantidad_foliosgenerar;
	$sql_cu="SELECT * FROM pallet  where fecha_cierre_pallet = '0000-00-00 00:00:00' group by id_cruce_tablas ";
	$result_cu=mysql_query($sql_cu);
	$cuantos_folios_pallet=mysql_num_rows($result_cu);
	
//	echo "cuantos_folios_pallet $cuantos_folios_pallet<br>";
	
		if($cuantos_folios_pallet){
			while ($rid=mysql_fetch_array($result_cu))
			{ 
				$idpallet=$rid[pallet];
				$id_cruce_tablassf=$rid[id_cruce_tablas];
				if($id_cruce_tablassf == $codigonuevo)
				   {
				   $id_cruce_tablasesh = $id_cruce_tablassf;
				   $palletes = $idpallet;
				   }
			}//while ($rid=mysql_fetch_array($result_cu))
		}else{
			
			$sql_as="SELECT * FROM pallet where id_pallet = id_pallet order by pallet desc LIMIT 0 , 1";
			$result_as=mysql_query($sql_as);
			$as=mysql_num_rows($result_as);
	
	if ($ras=mysql_fetch_array($result_as))
		{ 
		$idpallet=$ras[pallet];
		}
	
	$palletes=$idpallet + 1;
	$id_cruce_tablasesh=$id_cruce_tablasesh;
		}
		
		
	}//if(!$cantidad_foliosgenerar)
	

	
	for ($j=1;$j <= $generarsi;$j++)
    {

    
	$sqlultimafecha="SELECT * FROM etiquetados_folios where id_etiquetados_folios=id_etiquetados_folios ORDER BY id_etiquetados_folios desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);
if ($rowultimafecha=mysql_fetch_array($resulultimafecha)){ 
 $id_etiquetados_folios=$rowultimafecha[id_etiquetados_folios];
 $ultimoanorescatado=$rowultimafecha[ano];
}//if ($rowultimafecha=mysql_fetch_array($resulultimafecha)){ 
if($ultimoanorescatado == $fhoy){
$id_etiquetados_folios=$rowultimafecha[id_etiquetados_folios];
$id_etiquetados_folios_siguiente=$id_etiquetados_folios+1;
}else{
$id_etiquetados_folios=$rowul[id_etiquetados_folios];
$id_etiquetados_folios_siguiente=$id_etiquetados_folios - $id_etiquetados_folios;
$id_etiquetados_folios_siguiente++;
$id_etiquetados_folios_siguiente_contar=strlen($id_etiquetados_folios_siguiente);
if($id_etiquetados_folios_siguiente_contar == 1) $id_etiquetados_folios_siguiente="00000$id_etiquetados_folios_siguiente";
if($id_etiquetados_folios_siguiente_contar == 2) $id_etiquetados_folios_siguiente="0000$id_etiquetados_folios_siguiente";
if($id_etiquetados_folios_siguiente_contar == 3) $id_etiquetados_folios_siguiente="000$id_etiquetados_folios_siguiente";
if($id_etiquetados_folios_siguiente_contar == 4) $id_etiquetados_folios_siguiente="00$id_etiquetados_folios_siguiente";
if($id_etiquetados_folios_siguiente_contar == 5) $id_etiquetados_folios_siguiente="0$id_etiquetados_folios_siguiente";
if($id_etiquetados_folios_siguiente_contar == 6) $id_etiquetados_folios_siguiente="$id_etiquetados_folios_siguiente";
$anook=substr($fhoy,2,4);
$id_etiquetados_folios_siguiente=$anook.$id_etiquetados_folios_siguiente;
}

  $dat2=split(" ",$f_elaboracion);  $dat=split("-",$dat2[0]);  $f_elaboracion1="$dat[2]-$dat[1]-$dat[0]";        $f_elaboracionmes="$dat[1]";

  $dat3=split(" ",$f_inicio);  $dat1=split("-",$dat3[0]);  $f_inicio1="$dat1[2]-$dat1[1]-$dat1[0]";

  $dat4=split(" ",$f_termino);  $dat6=split("-",$dat4[0]);  $f_termino1="$dat6[2]-$dat6[1]-$dat6[0]";

  $dat5=split(" ",$fecha_ven);  $dat7=split("-",$dat5[0]);  $f_vencimiento1="$dat7[2]-$dat7[1]-$dat7[0]";
$fech_generada_inicio  = date("Y-m-d H:i:s");
$sql_nuevo="insert into etiquetados_folios  (id_etiquetados_folios,id_producto,ano,pallet,id_calibre,id_cruce_tablas,id_especie,id_unidad_medida,id_caract_producto,id_caract_envases,id_medidas_productos,id_envases,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_estado_folio,marca,id_procedencia,fech_generada_inicio) values ($id_etiquetados_folios_siguiente,$id_producto_antes,'$fhoy','$palletes',$id_calibre,$codigonuevo,$id_especie,$id_unidad_medida,$id_caract_producto,$id_caract_envases,$id_medidas_productos,$id_envases,'$f_elaboracion1','$f_inicio1','$f_termino1','$f_vencimiento1',$id_operarios,'$contenido_unidades',1,1,'N','$fech_generada_inicio')";
$result_nuevo=mysql_query($sql_nuevo,$link);
$id_etiquetas=mysql_insert_id();
$fecha_ingreso_pallet  = date("Y-m-d H:i:s");
//echo "sql_nuevo $sql_nuevo<br>";
/*  	$palletes = $rowcu[pallet];
			$id_cruce_tablases = $rowcu[pallet];*/

  if($palletes){
  $sqlpallet="insert into pallet (pallet,id_etiquetados_folios,id_cruce_tablas,fecha_ingreso_pallet) values ('$palletes','$id_etiquetados_folios_siguiente','$id_cruce_tablasesh','$fecha_ingreso_pallet')";
  $res=mysql_query($sqlpallet);
  //echo "sqlpallet";
  }
foreach ($_POST as $key => $value)
{ 

 $dat=split("-",$key); 

   if ($dat[0] == 'id_mat')
   {$id=$dat[1];
   	$id_mat=$_POST["id_mat-$id"];    
	$id_origen=$_POST["id_origen-$id"]; 
	$id_producto=$_POST["id_producto-$id"];
	$sql2="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat";
	$result2=mysql_query($sql2);
	if ($row2=mysql_fetch_array($result2)) { 
        $contenido=$row2[contenido];
		$total_contenido+=$contenido;
	}
   }
 }
//echo "mat_prima_nacional $total_contenido<br>";
foreach ($_POST as $key3 => $value3)
{ 

 $dat3=split("-",$key3); 

   if ($dat3[0] == 'id_mat3')
   {
	$id3=$dat3[1];
   	$id_mat3=$_POST["id_mat3-$id3"];    
	$id_origen3=$_POST["id_origen3-$id3"]; 
	$id_producto3=$_POST["id_producto3-$id3"];
	$sql3="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat3";
	$result3=mysql_query($sql3);
	if ($row3=mysql_fetch_array($result3)) { 
        $contenido3=$row3[contenido];
	 $total_contenido3+=$contenido3;
	}
   }
 }
 //echo "mat_prima_importada $total_contenido3<br>";

	
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'id_mat')
   {
	$id=$dat[1];
   	$id_mat=$_POST["id_mat-$id"];    
	$id_origen=$_POST["id_origen-$id"]; 
	$id_producto=$_POST["id_producto-$id"]; 
	$sql3="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat";
	$result3=mysql_query($sql3);
	while ($row3=mysql_fetch_array($result3)) { 
          $contenido=$row3[contenido];
		  $valor_cmp=$row3[valor_cmp];
		  $aporte_por_material = $contenido / $total_contenido;
		  $ponderado =$valor_cmp *  $aporte_por_material;
  		  $sql_mod="insert folios_mat (id_etiquetados_folios,id_mat,contenido,valor_cmp,aporte_por_material,ponderado) values ($id_etiquetados_folios_siguiente,$id_mat,$contenido,$valor_cmp,$aporte_por_material,$ponderado)";
		  $result_cruce=mysql_query($sql_mod,$link);
		   //echo "sql_mod $sql_mod<br>";
     	  $total_ponderado+=$ponderado;
	}//while ($row3=mysql_fetch_array($result3)) { 
   }//if ($dat[0] == 'id_mat')
}//foreach ($_POST as $key => $value)


foreach ($_POST as $key3 => $value3)
{ 
 $dat3=split("-",$key3); 
   if ($dat3[0] == 'id_mat3')
   {
	$id3=$dat3[1];
   	$id_mat3=$_POST["id_mat3-$id3"];    
	$id_origen3=$_POST["id_origen3-$id3"]; 
	$id_producto3=$_POST["id_producto3-$id3"]; 
	$sql3="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat3";
	$result3=mysql_query($sql3);
	while ($row3=mysql_fetch_array($result3)) { 
          $contenido3=$row3[contenido];
		  $valor_cmpi3=$row3[valor_cmpi];
		  $aporte_por_material3 = $contenido3 / $total_contenido3;
		  $ponderado3 =$valor_cmpi3 *  $aporte_por_material3;
		 $sql_mod="insert folios_mat (id_etiquetados_folios,id_mat,contenido,valor_cmp,aporte_por_material,ponderado) values ($id_etiquetados_folios_siguiente,$id_mat3,$contenido3,$valor_cmpi3,$aporte_por_material3,$ponderado3)";
    	 $result_cruce=mysql_query($sql_mod,$link);
		 //echo "sql_mod $sql_mod<br>";
  	     $total_ponderado3+=$ponderado3;
	}//while ($row3=mysql_fetch_array($result3)) { 
  }//if ($dat[0] == 'id_mat')
}//foreach ($_POST as $key => $value)
//echo "total_ponderado_importado $total_ponderado3<br>";



	
	}//for ($sd=1;$sd <= $generarsi;$sd++)


?>
<script languaje="javascript">
window.opener.document.location.replace('<? echo $url;?>/sistema.php?modulo=ejemplo_etiquetas_folios.php');
</script>
<script language="javascript">
window.close();
</script>
<?

}
		 if($id_etiquetados_folios){
		    $sql_buscar="SELECT * from folios_mat AS fm, mat_prima_nacional AS mpn, origenes as orig where fm.id_etiquetados_folios=$id_etiquetados_folios and fm.id_mat = mpn.id_mat_prima_nacional and mpn.id_origen=orig.id_origen";
			$result_buscar=mysql_query($sql_buscar);
			$cuantos_buscar2=mysql_num_rows($result_buscar);
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
.Estilo1 {font-size: 12px}
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

<body>
<input type="hidden" name="valor_indice2" value="<? echo $valor_indice2?>" />
<input type="hidden" name="id_tipo_calculo2" value="<? echo $id_tipo_calculo2?>" />
<input type="hidden" name="gpallet" value="<? echo $gpallet?>" />
<input type="hidden" name="cantidad_foliosgenerar" value="<? echo $cantidad_foliosgenerar?>" />
<form id="form1" name="form1" method="post" action="">


  <? if($f_termino){?>
  <table width="790" border="0" align="center">
    <tr>
      <td width="174"><div align="center" class="titulo">Desde </div></td>
      <td><div align="center" class="titulo">Hasta</div></td>
      <td width="185">&nbsp;</td>
      <td width="260">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center">
           <input name="desde" type="text" class="cajas" value="<?echo $desde?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.desde');" class="cajas" >Ver</a> </div></td>
      <td width="153"><div align="center">
          <? 
					  if($f_termino){
					   //$dat1ven=split(" ",$f_termino);
 					   //$datven=split("-",$dat1ven[0]);
					   //$fech_dia="$datven[0]";
					   //$fech=$fech_dia-1;
  					   //$f_termino="$fech-$datven[1]-$datven[2]";
					   }
					  ?>
          <input name="hasta" type="text" class="cajas" value="<?echo $hasta?>" size="10" maxlength="10" />
      <a href="javascript:show_Calendario('form1.hasta');" class="cajas" >Ver</a> </div></td>
      <td width="185">
	  <? 
	  $producto= crea_producto_onChange($link,$id_producto_antes);
	  echo $producto;
	  ?>      </td>
      <td width="260"><input name="buscar_faja" type="submit" class="cajas" value="Buscar" /></td>
    </tr>
    <tr>
      <td colspan="4"><? if($buscar_faja or $id_producto and $desde){
		    $desde=format_fecha_sin_hora($desde);
			$hasta=format_fecha_sin_hora($hasta);
			$sql_buscar="SELECT * from mat_prima_nacional AS mpn, origenes AS orig, producto AS p WHERE mpn.fecha_salida BETWEEN '$desde' AND '$hasta' and mpn.id_origen =orig.id_origen and p.id_producto = $id_producto and mpn.id_producto = p.id_producto and mpn.id_estado_material = 2 order by mpn.id_mat_prima_nacional desc";
			//consulta que muestra datos si existe valor costo
			//$sql_buscar="SELECT * from mat_prima_nacional AS mpn, origenes AS orig, producto AS p WHERE mpn.fecha_salida BETWEEN '$desde' AND '$hasta' and mpn.id_origen =orig.id_origen and p.id_producto = $id_producto and mpn.id_producto = p.id_producto and mpn.id_estado_material = 2 and mpn.valor_cmp != 0.00 order by mpn.id_mat_prima_nacional desc";
			
			$result_buscar=mysql_query($sql_buscar);
			$cuantos_buscar=mysql_num_rows($result_buscar);
			echo "Materia Prima Nacional $cuantos_buscar<BR>";
			
		  ?>
          <? if ($hasta and $cuantos_buscar) { ?>
          <table width="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="3%" bgcolor="#CCCCCC" class="titulo">
			  <a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> 
			  <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a>			  </td>
              <td width="9%" bgcolor="#CCCCCC" class="titulo">&nbsp;Codigo</td>
              <td width="10%" bgcolor="#CCCCCC" class="titulo">&nbsp;F. Salida </td>
              <td width="20%" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
              <td width="20%" bgcolor="#CCCCCC" class="titulo">&nbsp;Origen</td>
              <td width="10%" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Bidon </td>
              <td width="9%" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido</td>
              <td width="9%" bgcolor="#CCCCCC" class="titulo">Costo MPN</td>
              <td width="10%" bgcolor="#CCCCCC" class="titulo">&nbsp;F.Faena</td>
            </tr>
            <? while ($r=mysql_fetch_array($result_buscar)) { 
				  $ano=substr($r[ano], 2, 3);
				  $id_mat_prima_nacional2=$r[id_mat_prima_nacional];
				  $id_origen2=$r[id_origen];
				  $id_producto2=$r[id_producto];
				  $contenido2=$r[contenido];
				  $valor_cmp2=$r[valor_cmp];
				  
				  $base="N".$ano.$r[id_mat_prima_nacional];
				  
			
			?>
            <tr>
              <td class="cajas"><!--<label>
                <input name="id_mat[]" type="checkbox" id="id_mat[]" value="<?echo $r[id_mat_prima_nacional]?>" />
              </label>-->
              
               <input type="checkbox" name="id_mat-<? echo $id_mat_prima_nacional2?>" id="id_mat" value="<? echo $id_mat_prima_nacional2?>" />
              
              </td>
              <td class="cajas">N&nbsp;<?echo $r[id_mat_prima_nacional];?></td>
              <td class="cajas">&nbsp;<?echo format_fecha($r[fecha_salida]);?>&nbsp;</td>
              <td class="cajas">&nbsp;<?echo $r[producto]?>&nbsp;
               <input type="hidden" name="id_producto-<? echo $id_mat_prima_nacional2?>" id="id_producto" value="<? echo $id_producto2?>" />
              </td>
              <td class="cajas">&nbsp;<?echo $r[origen]?><?echo $id_origen2?>
            
                         
               <input type="hidden" name="id_origen-<? echo $id_mat_prima_nacional2?>" id="id_origen" value="<? echo $id_origen2?>" />
               
              </td>
              <td class="cajas">&nbsp;<?echo $r[bidon_num]?>&nbsp;</td>
              <td class="cajas">&nbsp;<? echo $r[contenido]?>&nbsp;</td>
              <td class="cajas">&nbsp;<?echo $r[valor_cmp]?>&nbsp;</td>
              <td class="cajas">&nbsp;<?echo format_fecha($r[fecha_faena]);?>&nbsp;</td>
            </tr>
            <? } 		?>
           
                      </table>
        <? } // Vemos si contiene datos la busqueda ?>
          <?
		  
		  $sql_buscarimp="SELECT * from mat_prima_importada AS mpi, origenes AS orig, producto AS p WHERE mpi.fecha_salida BETWEEN '$desde' AND '$hasta' and mpi.id_origen =orig.id_origen and mpi.id_producto = $id_producto and mpi.id_producto = p.id_producto and mpi.id_estado_material = 2 order by mpi.id_mat_prima_importada desc";
		     
			 //consulta que muestra datos si existe valor costo
		    //$sql_buscarimp="SELECT * from mat_prima_importada AS mpi, origenes AS orig, producto AS p WHERE mpi.fecha_salida BETWEEN '$desde' AND '$hasta' and mpi.id_origen =orig.id_origen and mpi.id_producto = $id_producto and mpi.id_producto = p.id_producto and mpi.id_estado_material = 2 and mpi.valor_cmpi != 0.00 order by mpi.id_mat_prima_importada desc";
		  
			$result_buscarimpo=mysql_query($sql_buscarimp);
			//echo $sql_buscar;
			$cuantos_buscarimportada=mysql_num_rows($result_buscarimpo);
			echo "Materia Prima Importada $cuantos_buscarimportada<BR>";
		  
		  if ($hasta and $cuantos_buscarimportada) { ?>
          <table width="100%" border="1" cellpadding="0" cellspacing="0">

            <? while ($rimp=mysql_fetch_array($result_buscarimpo)) { 
				  	 //$ano3=substr($rimp[ano], 2, 3);
				  	 $id_mat_prima_importa3=$rimp[id_mat_prima_importada];
				  	 $id_origen3=$rimp[id_origen];
				  	 $id_producto3=$rimp[id_producto];
				  	 $contenido3=$rimp[contenido];
				 	 $valor_cmpi3=$rimp[valor_cmpi];
				  
				  	 //$base="N".$ano.$rimp[id_mat_prima_nacional];
				  
			?>
            <tr>
              <td width="3%" class="cajas"><!--<label>
                <input name="id_mat[]" type="checkbox" id="id_mat[]" value="<?echo $r[id_mat_prima_nacional]?>" />
              </label>-->
              
               <input type="checkbox" name="id_mat3-<? echo $id_mat_prima_importa3?>" id="id_mat3" value="<? echo $id_mat_prima_importa3?>" />
               
              
              </td>
              <td width="9%" class="cajas">I&nbsp;<?
                 $largo=strlen($rimp[id_mat_prima_importada]);
			

			   if($largo == 8){ 
			   $id_mat_prima_importa3=substr($id_mat_prima_importa3,1,7);
			
			   }
  			   if($largo == 9){
			   $id_mat_prima_importa3=substr($id_mat_prima_importa3,1,8);
			    
			   }
			   
			   echo $id_mat_prima_importa3;
			  
			  
			?></td>
              <td width="10%" class="cajas">&nbsp;<?echo format_fecha($rimp[fecha_salida]);?>&nbsp;</td>
              <td width="20%" class="cajas">&nbsp;<?echo $rimp[producto]?>&nbsp;
               <input type="hidden" name="id_producto3-<? echo $id_mat_prima_importa3?>" id="id_producto" value="<? echo $id_producto3?>" />
              </td>
              <td width="20%" class="cajas">&nbsp;<?echo $rimp[origen]?><?echo $id_origen2?>
            
                         
               <input type="hidden" name="id_origen3-<? echo $id_mat_prima_importa3?>" id="id_origen3" value="<? echo $id_origen3?>" />
               
              </td>
              <td width="10%" class="cajas">&nbsp;<?echo $rimp[bidon_num]?>&nbsp;</td>
              <td width="9%" class="cajas">&nbsp;<? echo $contenido3?>&nbsp;</td>
              <td width="9%" class="cajas">&nbsp;<?echo $rimp[valor_cmpi]?>&nbsp;</td>
              <td width="10%" class="cajas">&nbsp;<?echo format_fecha($rimp[fecha_elaboracion]);?>&nbsp;</td>
            </tr>
            <? } 		?>
           
                      </table>
        <? } // Vemos si contiene datos la busqueda ?>
          <? }?></td>
    </tr>
  </table>
  <? } // fin trazabilidad?>
  
  <? if($cuantos_buscar2){?>
  
  <table width="87%" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="6%" class="cajas">&nbsp;</td>
            <td width="13%" class="titulo">Codigo</td>
            <td width="13%" class="titulo">F. ingreso </td>
            <td width="11%" class="titulo">Origen</td>
            <td width="14%" class="titulo">N&ordm; Bidon </td>
            <td width="9%" class="titulo">Contenido</td>
            <td width="9%" class="titulo">Precio</td>
            <td width="13%" class="titulo">F. Faena </td>
          </tr>
		  <? 
		  while ($r=mysql_fetch_array($result_buscar)) { 
		$ano=substr($r[ano], 2, 3);
		 $base="N".$ano.$r[id_mat_prima_nacional];
		  			$id_mat_prima_nacional2=$r[id_mat_prima_nacional];
				  $id_origen2=$r[id_origen];
				   $id_producto2=$r[id_producto];
				   $contenido2=$r[contenido];
				   $valor_cmp2=$r[valor_cmp];
		 
		 
		  ?>
          <tr>
            <td class="cajas"><? if($id_mat and !$buscar_faja){?>
               <input type="checkbox" name="id_mat-<? echo $id_mat_prima_nacional2?>" id="id_mat" value="<? echo $id_mat_prima_nacional2?>" >
              <? }else{?>
             <!-- <input type="checkbox" name="id_mat[]" value="<?echo $r[id_mat]?>" checked="checked"/>-->
               <input type="checkbox" name="id_mat-<? echo $id_mat_prima_nacional2?>" id="id_mat" value="<? echo $id_mat_prima_nacional2?>" checked="checked">
              <? }?></td>
            <td class="cajas"><?echo $base;?></td>
            <td class="cajas"><?echo format_fecha($r[fecha_ingreso]);?>&nbsp;</td>
            <td class="cajas"><?echo $r[nombre]?>&nbsp;</td>
            <td class="cajas"><?echo $r[bidon_num]?>&nbsp;</td>
            <td class="cajas"><?echo $r[contenido]?>&nbsp;</td>
            <td class="cajas"><?echo $row[valor_cmp]?></td>
            <td class="cajas"><?echo format_fecha($r[fecha_faena]);?>&nbsp;</td>
          </tr><? } //while ($row=mysql_fetch_array($result))?>
  </table>
  <? } //  while ($r=mysql_fetch_array($result_buscar)) 
		 
		?>
  <? }?>
  <? if($cuantos_buscar or $cuantos_buscarimportada){?>
  <table width="61" border="0" align="center">
    <tr>
      <td width="55">
	  <input type="image" src="jpg/guardar.jpg" name="grabar" onClick="document.forms['form1'].submit">	  </td>
    </tr>
  </table>
  <? }?>
  <br>
</form>	
</body>