<? 
ini_set('memory_limit', '-1');
//foreach ($_POST as $key => $value)
//echo "KEY $key -> $valuez<br>";



 if ($id_eti)
   {
 $sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios='$id_eti'";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);
    }
 else
    {
 $sql="SELECT * FROM etiquetados_folios";
 $result=mysql_query($sql);
 $cuantos=mysql_num_rows($result);
 
 if(!$op) $op=0;
 $sql="SELECT * FROM etiquetados_folios WHERE id_etiquetados_folios=id_etiquetados_folios LIMIT $op ,       1";
 $result=mysql_query($sql);
 $ante=$op - 1;
 $next=$op + 1;
 $ultimo=$cuantos - 1;
   }
 
 $fhoy=date("Y"); 
 
// echo "Cuantos $cuantos";
 
 if($grabar_x){
 echo "ENTRE<br>";
  if ($f_elaboracion != "") {
  $dat2=split(" ",$f_elaboracion);
  $dat=split("-",$dat2[0]);
  $f_elaboracion1="$dat[2]-$dat[1]-$dat[0]";
  }
  else
  $f_elaboracion1="0000-00-00";

  if ($f_inicio != "") {
  $dat3=split(" ",$f_inicio);
  $dat1=split("-",$dat3[0]);
  $f_inicio1="$dat1[2]-$dat1[1]-$dat1[0]";
  }
  else
  $f_inicio1="0000-00-00";

  if ($f_termino != "") {
  $dat4=split(" ",$f_termino);
  $dat6=split("-",$dat4[0]);
  $f_termino1="$dat6[2]-$dat6[1]-$dat6[0]";
  }
  else
  $f_termino1="0000-00-00";

  if ($f_vencimiento != "") {
  $dat5=split(" ",$f_vencimiento);
  $dat7=split("-",$dat5[0]);
  $f_vencimiento1="$dat7[2]-$dat7[1]-$dat7[0]";
    }
  else
  $f_vencimiento1="0000-00-00";

  $sql_nuevo="insert into etiquetados_folios  (id_producto,id_calibre,id_medidas_productos,id_envases,id_unidad_produccion,compro_nro,f_elaboracion,f_inicio,f_termino,f_vencimiento,id_operarios,contenido_unidades,id_etiquetas1,id_etiquetas2,id_etiquetas3,id_etiquetas4,id_estado_folio,id_destinos,glosa) values ($id_producto,$id_calibre,$id_medidas_productos,$id_envases,$id_unidad_produccion,'$compro_nro','$f_elaboracion1','$f_inicio1','$f_termino1','$f_vencimiento1',$id_operarios,'$contenido_unidades',$id_etiquetas1,$id_etiquetas2,$id_etiquetas3,$id_etiquetas4,$id_estado_folio,$id_destinos,'$glosa')";
  //echo "--->$sql_nuevo<br>";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  
  
  $id_etiquetas=mysql_insert_id();
  
  // INSERTAMOS TRASABILIDAD.
  // Primero Eliminamos posibles inserciones , luego procedemos a insertar 
   if ($id_mat)  
  foreach ($id_mat as $key)
         {
	$sql="insert into folios_mat (id_etiquetados_folios,id_mat) values ($id_etiquetas,$key)";
		  $res=mysql_query($sql);
		 
         }

  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas_folios.php&op=$cuantos\">";
  exit;
  }
  
   if($borrar){
   $sql_borrar="delete from etiquetados_folios where id_etiquetados_folios = $borrar";
   $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetados_folios.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetados_folios.php&op=1\">";
   exit;
   }
  //op para dejar el paginador en 0 si es -1
   //echo "estoy dentro de borrar";
   //header( 'Location: index.php?modulo=calibres.php');
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetados_folios.php&op=$op\">";
   exit;
  }//fin borrar

  if($modificar_x){
  if ($f_elaboracion != "") {
  $dat2=split(" ",$f_elaboracion);
  $dat=split("-",$dat2[0]);
  $f_elaboracion="$dat[2]-$dat[1]-$dat[0]";
  }
  else
  $f_elaboracion="0000-00-00";

  if ($f_inicio != "") {
  $dat3=split(" ",$f_inicio);
  $dat1=split("-",$dat3[0]);
  $f_inicio="$dat1[2]-$dat1[1]-$dat1[0]";
  }
  else
  $f_inicio="0000-00-00";
  
  if ($f_termino != "") {
  $dat4=split(" ",$f_termino);
  $dat6=split("-",$dat4[0]);
  $f_termino="$dat6[2]-$dat6[1]-$dat6[0]";
  }
  else
  $f_termino="0000-00-00";
  
  if ($f_vencimiento != "") {
  $dat5=split(" ",$f_vencimiento);
  $dat7=split("-",$dat5[0]);
  $f_vencimiento="$dat7[2]-$dat7[1]-$dat7[0]";
  }
  else
  $f_vencimiento="0000-00-00";
 
 if($id_lineas_procesos=='')
    $id_lineas_procesos=0;
 
 $sql_modificar="UPDATE  etiquetados_folios set id_producto ='$id_producto',id_calibre='$id_calibre',id_medidas_productos='$id_medidas_productos',id_envases='$id_envases',id_unidad_produccion='$id_unidad_produccion', compro_nro='$compro_nro', f_elaboracion='$f_elaboracion', f_inicio='$f_inicio',f_termino='$f_termino',f_vencimiento='$f_vencimiento', id_operarios='$id_operarios', contenido_unidades='$contenido_unidades', id_etiquetas1='$id_etiquetas1', id_etiquetas2='$id_etiquetas2', id_etiquetas3='$id_etiquetas3',id_etiquetas4='$id_etiquetas4',id_estado_folio='$id_estado_folio',id_destinos='$id_destinos',glosa='$glosa' where id_etiquetados_folios=$id_etiquetados_folios";
 //echo "MODIFICAR -> $sql_modificar";
$rest=mysql_query($sql_modificar);

  // MOFICAMOS TRASABILIDAD.
  // Primero Eliminamos posibles inserciones ,
  	  $sql="delete from folios_mat where  id_etiquetados_folios = $id_etiquetados_folios";
	  $res=mysql_query($sql);
  //  luego procedemos a insertar 	
  if ($id_mat)  
  foreach ($id_mat as $key)
         {
		  $sql="insert into folios_mat (id_etiquetados_folios,id_mat) values ($id_etiquetados_folios,$key)";
		  $res=mysql_query($sql);
		 
         }

 if($id_eti){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas_folios.php&id_eti=$id_eti\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas_folios.php&op=$op\">";
 exit;
 }

}

?>
<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=800, height=600, top=300, left=450"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
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

<? if($imprimir){?>
<form name="form1" method="post" action="etiquetas_folios_print2.php" target="popup"
	onsubmit="window.open('', 'popup', 'width = 800, height = 600, top=0, left=0, scrollbars=yes')">
<? }else{?>
<form id="form1" name="form1" method="post" action="">
<? }?>
  <table width="647" height="36" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><? if(!$nuevo){?>
        <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $f_termino =format_fecha_sin_hora($row[f_termino ]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
      $i++;
	  
      ?>
        <span class="titulo">
        <input name="id_etiquetados_folios" type="hidden" value="<?echo $row[id_etiquetados_folios]?>" />
        </span>
        <table width="550" border="0" align="center">
        <tr>
          <td colspan="3" class="titulo"><div align="center"><span class="titulo Estilo1">Ver / Modificar Etiquetado de Folios </span></div></td>
          </tr>
        <tr>
          <td width="144" class="titulo">&nbsp;</td>
          <td colspan="2"><span class="numero">A&Ntilde;O <?php echo substr($fhoy,2,4); ?> FOLIO <?echo $row[id_etiquetados_folios]?></span></td>
        </tr>
        <tr>
          <td class="titulo">Producto</td>
          <td width="211"><? $producto= crea_producto_onChange($link,$row[id_producto]);
		 echo $producto;?></td>
          <td width="126"><div align="center"><a href="javascript:Abrir_ventana('etiquetas_folios_print2.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>')"><img src="jpg/impresora.jpg" width="35" height="39" border="0" /></a><span class="titulo"><br>Imprimir Folios</span> </div></td>
        </tr>
        <tr>
          <td class="titulo">Calibre</td>
          <td colspan="2"><? 
	    if($row[id_producto]){
		$calibre=crea_calibre2($link,$row[id_calibre],$row[id_producto]);
		echo $calibre;}?></td>
        </tr>
        <tr>
          <td class="titulo">Medida</td>
          <td colspan="2"><? $medidas_productos=crea_medidas_productos($link,$row[id_medidas_productos]);
		echo $medidas_productos;?></td>
        </tr>
        <tr>
          <td class="titulo">Envase</td>
          <td colspan="2"><? $envases=crea_envases($link,$row[id_envases]);
		echo $envases;?></td>
        </tr>
        <tr>
          <td class="titulo">Origen</td>
          <td colspan="2">
		  <? 
		$unidad_produccion=crea_unidad_produccion($link,$row[id_unidad_produccion]);
		echo $unidad_produccion;
		?></td>
        </tr>
        <tr>
          <td class="titulo">Comprob. Nro</td>
          <td colspan="2"><input name="compro_nro" type="text" class="cajas" value="<?echo $row[compro_nro]?>" /></td>
        </tr>
        <tr>
          <td colspan="3"><table width="444" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="143" class="titulo">Fecha de Elab. </td>
                <td width="174"><input name="f_elaboracion" type="text" class="cajas"   id="f_elaboracion"  value="<?echo $f_elaboracion?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_elaboracion');" class="cajas" >Ver</a></td>
                <td width="127">&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo">Fecha Inicio </td>
                <td><input name="f_inicio" type="text" class="cajas"   id="f_inicio"  value="<?echo $f_inicio?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_inicio');" class="cajas" >Ver</a></td>
                <td width="127"><div align="center" class="titulo">Contenido (Unidades) </div></td>
              </tr>
              <tr>
                <td class="titulo">Fecha Termino </td>
                <td><input name="f_termino" type="text" class="cajas"   id="f_termino"  value="<?echo $f_termino?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_termino');" class="cajas" >Ver</a></td>
                <td width="127"><div align="center">
                    <input name="contenido_unidades" type="text" class="cajas" id="contenido_unidades" value="<?echo $row[contenido_unidades]?>" size="10" />
                </div></td>
              </tr>
              <tr>
                <td class="titulo">Fecha Vencimiento </td>
                <td><input name="f_vencimiento" type="text" class="cajas"   id="f_vencimiento"  value="<?echo $f_vencimiento?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_vencimiento');" class="cajas" >Ver</a></td>
                <td width="127">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="titulo"> Responsable</td>
          <td colspan="2"><? $operarios=crea_operarios($link,$row[id_operarios]);
		echo $operarios;?></td>
        </tr>
        <tr>
          <td colspan="3"><table width="520" border="0" align="center">
              <tr>
                <td class="titulo">Formatos de Etiquetas </td>
                <td width="136" class="titulo">Estado del Folio </td>
                <td width="158" class="titulo">Destino</td>
              </tr>
              <tr>
                <td width="123"><? $etiquetas=crea_etiquetas($link,$row[id_etiquetas1],"1");
		echo $etiquetas;?></td>
                <td><? $estado_folio=crea_estado_folio($link,$row[id_estado_folio]);
		echo $estado_folio;?></td>
                <td><? $destinos=crea_destinos($link,$row[id_destinos]);
		echo $destinos;?></td>
              </tr>
              <tr>
                <td><? $etiquetas=crea_etiquetas($link,$row[id_etiquetas2],"2");
		echo $etiquetas;?></td>
                <td colspan="2" rowspan="2" class="titulo">Glosa
                  <input name="glosa" type="text" class="cajas" id="glosa" value="<?echo $row[glosa]?>" size="63" /></td>
              </tr>
              <tr>
                <td><? $etiquetas=crea_etiquetas($link,$row[id_etiquetas3],"3");
		echo $etiquetas;?></td>
                </tr>
              <tr>
                <td><? $etiquetas=crea_etiquetas($link,$row[id_etiquetas4],"4");
		echo $etiquetas;?></td>
                <td colspan="2">&nbsp;</td>
              </tr>

              <tr>
                <td colspan="3"><div align="center" class="numero">Trazabilidad<span class="titulo">
                  <input name="buscar" type="submit" id="buscar" value="Buscar!" />
                </span></div></td>
                </tr>
         <? if ($row[id_producto] and $row[f_elaboracion]) { 
			  
			  $sql1="select * from mat_prima_nacional as mpn, unidad_produccion as up where mpn.id_producto=$row[id_producto] and mpn.id_unidad_produccion=up.id_unidad_produccion and 
mpn.fecha_ingreso >= '$row[f_inicio]' and mpn.fecha_termino<= '$row[f_termino]' ";

			 // echo "SQL $sql1<br>";
			  $rest1=mysql_query($sql1);
			  $cuantos1=mysql_num_rows($rest1);
			  ?>
              <tr>
                <td colspan="3" class="titulo">
				
				<? if ($cuantos1) { ?>
				
				<table width="100%" border="0">
                  <tr>
                    <td class="titulo">&nbsp;</td>
                    <td class="titulo">Codigo</td>
                    <td class="titulo">F.Ingreso</td>
                    <td class="titulo">Origen</td>
                    <td class="titulo">Bidon Nro </td>
                    <td class="titulo">Cant Und </td>
                    <td class="titulo">F.Faena</td>
                  </tr>
				  <? while ($r=mysql_fetch_array($rest1)) { 
				  $ano=substr($r[ano], 2, 3);
				  $base="N".$ano.$r[id_mat_prima_nacional];
				  
              $check=check_id_mat($link, $row[id_etiquetados_folios], $r[id_mat_prima_nacional]);
				  if ($check)
				    $vcheck="checked";
				  else
				    $vcheck="";
				  ?>
                  <tr>
                    <td class="cajas"><label>
                      <input name="id_mat[]" type="checkbox" id="id_mat[]" value="<?echo $r[id_mat_prima_nacional]?>" <?echo $vcheck?> >
                    </label></td>
                    <td class="cajas"><?echo $base;?></td>
                    <td class="cajas"><?echo format_fecha($r[fecha_ingreso]);?></td>
                    <td class="cajas"><?echo $r[nombre]?></td>
                    <td class="cajas"><?echo $r[bidon_num]?></td>
                    <td class="cajas"><?echo $r[contenido]?></td>
                    <td class="cajas"><?echo format_fecha($r[fecha_faena]);?></td>
                  </tr>
				  <? } ?>
                </table> 
				<? } // Vemos si contiene datos la busqueda ?>
                  <label></label></td>
                </tr>
				<? } ?>
          </table></td>
        </tr>
        <tr>
          <td colspan="3"><? $id_bode=$row[id_etiquetados_folios];?></td>
        </tr>
      </table>
      <? }}?>
      <? if($nuevo){?>
      <table width="550" border="0" align="center">
        <tr>
          <td colspan="2" class="titulo Estilo1"><div align="center">Agregar Etiquetado de Folios </div></td>
          </tr>
        <tr>
          <td width="171" class="titulo Estilo1">&nbsp;</td>
          <td width="367"><span class="numero">A&Ntilde;O <?php echo substr($fhoy,2,4); ?> FOLIO <?echo $row[id_etiquetados_folios]?></span></td>
        </tr>
        <tr>
          <td class="titulo">Producto</td>
          <td width="367"><? $producto= crea_producto_onChange($link,$id_producto);
		 echo $producto;?>
            <input name="nuevo" type="hidden" id="nuevo" value="<?echo $nuevo?>" /></td>
        </tr>
        <tr>
          <td class="titulo">Calibre</td>
          <td><? 
	   if ($id_producto) {
		$calibre=crea_calibre2($link,$id_calibre,$id_producto);
		echo $calibre;
		}
		?>          </td>
        </tr>
        <tr>
          <td class="titulo">Medida</td>
          <td><? $medidas_productos=crea_medidas_productos($link,$id_medidas_productos);
		echo $medidas_productos;?></td>
        </tr>
        <tr>
          <td class="titulo">Envase</td>
          <td><? $envases=crea_envases($link,$id_envases);
		echo $envases;?></td>
        </tr>
        <tr>
          <td class="titulo">Origen</td>
          <td><? $unidad_produccion=crea_unidad_produccion($link,$id_unidad_produccion);
		echo $unidad_produccion;?></td>
        </tr>
        <tr>
          <td class="titulo">Comprob. Nro</td>
          <td><input name="compro_nro" type="text" class="cajas" value="<?echo $compro_nro?>"/></td>
        </tr>
        <tr>
          <td colspan="2"><table width="444" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="143" class="titulo">Fecha de Elab. </td>
                <td width="174">
				     <? $fecha=date("Y-m-d"); 
					    $fecha=format_fecha_sin_hora($fecha);
			   			$fecha_ven=$fecha;
			   		 ?>
                  <input name="f_elaboracion" type="text" class="cajas" value="<?echo $fecha?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_elaboracion');" class="cajas" >Ver</a></td><td width="127">&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo">Fecha Inicio </td>
                <td><input name="f_inicio" type="text" class="cajas" value="<?echo $f_inicio?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_inicio');" class="cajas" >Ver</a></td>
                <td width="127"><div align="center" class="titulo">Contenido (Unidades) </div></td>
              </tr>
              <tr>
                <td class="titulo">Fecha Termino </td>
                <td><input name="f_termino" type="text" class="cajas" value="<?echo $f_termino?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_termino');" class="cajas" >Ver</a></td>
                <td width="127"><div align="center">
                    <input name="contenido_unidades" type="text" class="cajas" value="<?echo $contenido_unidades?>"  size="10" />
                </div></td>
              </tr>
              <tr>
                <td class="titulo">Fecha Vencimiento </td>
                <td><? 
					   
					   $dat1ven=split(" ",$fecha_ven);
 					   $datven=split("-",$dat1ven[0]);
					   $fech_an="$datven[2]";
					   $fech=$fech_an+2;
  					   $fecha_ven="$datven[0]-$datven[1]";
					  ?>
                  <input name="f_vencimiento" type="text" class="cajas" value="<? echo "$fecha_ven-$fech";?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.f_vencimiento');" class="cajas" >Ver</a></td><td width="127">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="titulo"> Responsable</td>
          <td><? $operarios=crea_operarios($link,$row[id_operarios]);
		echo $operarios;?></td>
        </tr>
        <tr>
          <td colspan="2"><table width="520" border="0" align="center">
              <tr>
                <td class="titulo">Formatos de Etiquetas </td>
                <td width="136" class="titulo">Estado del Folio </td>
                <td width="220" class="titulo">Destino</td>
              </tr>
              <tr>
                <td width="131"><? $etiquetas=crea_etiquetas($link,$id_etiquetas1,"1");
		echo $etiquetas;?></td>
                <td>
		  <span class="numero">EMITIDO</span>	
		  <input name="id_estado_folio" type="hidden" id="id_estado_folio" value="1" />
		  <label></label></td>
                <td><? $destinos=crea_destinos($link,$id_destinos);
		echo $destinos;?></td>
              </tr>
              <tr>
                <td><? $etiquetas=crea_etiquetas($link,$id_etiquetas2,"2");
		echo $etiquetas;?></td>
                <td colspan="2" rowspan="2" class="titulo">Glosa
                  <input name="glosa" type="text" class="cajas" value="<?echo $glosa?>" size="55" /></td>
              </tr>
              <tr>
                <td><? $etiquetas=crea_etiquetas($link,$id_etiquetas3,"3");
		echo $etiquetas;?></td>
                </tr>
              <tr>
                <td><? $etiquetas=crea_etiquetas($link,$id_etiquetas4,"4");
		echo $etiquetas;?></td>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="3"><div align="center" class="numero">Trazabilidad<span class="titulo">
                  <input name="buscar" type="submit" id="buscar" value="Buscar!" />
                </span></div></td>
                </tr>
			  <? if ($id_producto and $f_elaboracion) { 
			  $f_inicio2=format_fecha($f_inicio);
			  $f_termino2=format_fecha($f_termino);
			  $sql1="select * from mat_prima_nacional as mpn, unidad_produccion as up where mpn.id_producto=$id_producto and mpn.id_unidad_produccion=up.id_unidad_produccion and mpn.fecha_ingreso >= '$f_inicio2' and mpn.fecha_termino<= '$f_termino2' ";
			  //echo "SQL $sql1<br>";
			  $rest1=mysql_query($sql1);
			  $cuantos1=mysql_num_rows($rest1);
			  ?>

              <tr>
                <td colspan="3" class="titulo">
				
				<? if ($cuantos1) { ?>
				
				<table width="100%" border="0">
                  <tr>
                    <td class="titulo">&nbsp;</td>
                    <td class="titulo">Codigo</td>
                    <td class="titulo">F.Ingreso</td>
                    <td class="titulo">Origen</td>
                    <td class="titulo">Bidon Nro </td>
                    <td class="titulo">Cant Und </td>
                    <td class="titulo">F.Faena</td>
                  </tr>
				  <? while ($r=mysql_fetch_array($rest1)) { 
				  $ano=substr($r[ano], 2, 3);
				  $base="N".$ano.$r[id_mat_prima_nacional];
				  ?>
                  <tr>
                    <td class="cajas"><label>
                      <input name="id_mat[]" type="checkbox" id="id_mat[]" value="<?echo $r[id_mat_prima_nacional]?>" />
                    </label></td>
                    <td class="cajas"><?echo $base;?></td>
                    <td class="cajas"><?echo format_fecha($r[fecha_ingreso]);?></td>
                    <td class="cajas"><?echo $r[nombre]?></td>
                    <td class="cajas"><?echo $r[bidon_num]?></td>
                    <td class="cajas"><?echo $r[contenido]?></td>
                    <td class="cajas"><?echo format_fecha($r[fecha_faena]);?></td>
                  </tr>
				  <? } ?>
                </table> 
				<? } // Vemos si contiene datos la busqueda ?>
                  </td>
                </tr>
				<? } ?>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="564" border="0" align="center">
        <tr>
          <td width="54" class="style2"><a href="?modulo=etiquetas_folios.php&amp;cancelar=1" ><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td width="54" class="style2"><? if($ante >= 0){ ?>
              <a href="?modulo=etiquetas_folios.php&amp;op=<? echo $ante?>" ><img src="jpg/anterior.jpg" width="54" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?>
          </td>
          <td width="58"><? if ($cuantos > $next){ ?>
              <a href="?modulo=etiquetas_folios.php&amp;op=<? echo $next?>" ><img src="jpg/siguiente.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?>
          </td>
          <td width="47"><? if ($cuantos){ ?>
              <a href="?modulo=etiquetas_folios.php&amp;op=<? echo $ultimo?>" ><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>
          </td>
          <td width="47"><a href="?modulo=etiquetas_folios.php&amp;nuevo=1"><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a></td>
          <td width="55"><a href="?modulo=etiquetas_folios.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62">
            
			<a href="javascript: document.form1.submit();">
            <label>
			<input type="image" name="modificar" src="jpg/modificar.jpg" />
			</label>
            </a>			
			
			</td>
          <td width="55">
		    <? if ($nuevo or !$cuantos){ ?>
			<a href="javascript: document.form1.submit();">
            <label>
            <input type="image" name="grabar" src="jpg/guardar.jpg" />
            </label>
            </a>
              <? }else{?>
            &nbsp;
            <? }?>          </td>
          <td width="45"><p> <a href="?modulo=etiquetas_folios.php&amp;borrar=<?=$id_bode?>&amp;op=<? echo "$ante"?>" ><img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a><a href="javascript: document.form1.submit();"></a></p></td>
          <td width="45"><a href="?modulo=etiquetas_folios_listar.php" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>