<? 
if($buscar){
//echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbb";
	 $largo=strlen($dato);
			  
	 if($largo == 7){ 
	 $agr=2;
	 $dato=$agr.$dato;
	 }
  	 if($largo == 8){
		 $agr=2;
	 $dato=$agr.$dato;
	 }
	 

$id_mpi=$dato;
}
if($id_imp){
$id_mpi=$id_imp;	
}

//echo "id_mpi $id_mpi ---- $dato";
if($id_mpi){
$sql="SELECT * FROM mat_prima_importada where id_mat_prima_importada='$id_mpi'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM mat_prima_importada where id_mat_prima_importada != 0 order by id_mat_prima_importada desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada=id_mat_prima_importada and id_mat_prima_importada != 0 order by id_mat_prima_importada desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

$fhoy=date("Y"); 
  
  if($despachar_x){
  $dat2=split(" ",$fecha_ingreso);
  $dat=split("-",$dat2[0]);
  $fecha_ingreso2="$dat[2]-$dat[1]-$dat[0]";
 
  if($id_estado_material == 2 or $id_estado_material == 3 or $id_estado_material == 4){
  $fecha=date("Y-m-d");
  //echo "$fecha";
  }else{
  $fecha='00-00-0000';
  }
 
 
 $sql_modificar="UPDATE  mat_prima_importada set id_estado_material='$id_estado_material', fecha_salida='$fecha' where id_mat_prima_importada=$id_mat_prima_importada";
 //echo "$sql_modificar";
$rest=mysql_query($sql_modificar);

 if($id_mpi){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=salida_materia_prima_importada.php&id_mpi=$id_mpi\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=salida_materia_prima_importada.php&op=$op\">";
 exit;
 }
 
}
 


?>
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
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
-->
</style>

<form id="form1" name="form1" method="post" action="">
<table width="508" border="0" align="center">
  <tr>
    <td width="314" height="10"><span class="titulo">Salida Materia Prima Importada </span></td>
    <td width="282"><div align="right"><span class="cajas">Ej: 10001417</span>
        <? if($cuantos){?>
<input name="dato" type="text" class="cajas" size="15" maxlength="50"/>
        <? }?>
        <? if($cuantos){?>
        <input name="buscar" type="submit" class="cajas" value="Buscar" />
        <? }?>
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	   $i=$op;
      while ($row=mysql_fetch_array($result))
      { $id_mat_prima_importada=$row[id_mat_prima_importada];
	  	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
		$fecha_salida=format_fecha_sin_hora($row[fecha_salida]);
	 ?>
      <span class="titulo">
      <input name="id_mat_prima_importada" type="hidden" value="<?echo $row[id_mat_prima_importada]?>" />
      </span>
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
            <tr>
              <td width="123" class="titulo" >N&uacute;mero</td>
              <td><span class="numero">I
                  <? 
		      
			   $largo=strlen($row[id_mat_prima_importada]);
			  
			   if($largo == 8){ 
			   $id_mat_prima_importada=substr($id_mat_prima_importada,1,8);
			   }
  			   if($largo == 9){
			   $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
			   }
			  ?>
                  <?
			   echo $id_mat_prima_importada;
			   ?>
                  <? if($row[borrari]){?>
                  <span class="style3">Folio Anulado </span>
                  <? }?>
              </span></td>
            </tr>
            <tr>
              <td class="titulo" >Fecha Ingreso </td>
              <td><input name="fecha_ingreso" type="text" class="cajas"  value="<?echo $fecha_ingreso?>" size="8" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fecha_ingreso');" class="cajas">Ver</a></td>
            </tr>
            <tr>
              <td class="titulo"  >Comprobante Num </td>
              <td><input name="comprobante_num" type="text" class="cajas" value="<?echo $row[comprobante_num]?>" size="44" /></td>
            </tr>
            <tr>
              <td class="titulo">Origen</td>
              <td>
			 <? 
			//$lineas_procesos= crea_lineas_procesos($link,$row[id_lineas_procesos]);
			//echo $lineas_procesos;
			
			$origen= crea_origenes($link,$row[id_origen]);
			echo $origen;
			
			?></td>
            </tr>
            <tr>
              <td class="titulo">Bidon N&uacute;mero</td>
              <td><input name="bidon_num" type="text" class="cajas" value="<?echo $row[bidon_num]?>" size="44" /></td>
            </tr>
            <tr>
              <td class="titulo">Producto</td>
              <td><? 
		 	$producto= crea_producto($link,$row[id_producto]);
		 echo $producto;
			?></td>
            </tr>
            <tr>
              <td class="titulo">Cod. Contenido (Unid./Kgs.) . </td>
              <td><input name="contenido" type="text" class="cajas" value="<?echo $row[contenido]?>" size="44" /></td>
            </tr>
            <tr>
              <td class="titulo">Glosa</td>
              <td><input name="glosa" type="text" class="cajas" value="<?echo $row[glosa]?>" size="44" /></td>
            </tr>
            <tr>
              <td class="titulo">Estado Material</td>
              <td><? 
			 $id_estado_material=$row[id_estado_material];
			 if($row[id_estado_material] == 2){ ?>
			 <span class="cajas">Despachado</span>
			 <?
			  }
			  if($row[id_estado_material] == 4){
			  ?>
			  <span class="cajas">Decomiso</span>
			  <?
			  }
			  if($row[id_estado_material] == 3){
			  ?>
			  <span class="cajas">Anulado</span>			  <?
			  }
			  if($row[id_estado_material] != 2 and $row[id_estado_material] != 3 and $row[id_estado_material] != 4){
			  $estado_material= crea_estado_material($link,$row[id_estado_material]);
			  echo $estado_material;
			  }
			?></td>
            </tr>
            <tr>
              <td class="titulo">Rcp</td>
              <td><input name="rcpi" type="text" class="cajas" id="rcpi" value="<?echo $row[rcpi]?>" size="10" maxlength="10" /></td>
            </tr><? if($brasil != 0){?>
            <tr>
              <td class="titulo">Medidas</td>
              <td><span class="cajas">
                <? 
				if($row[id_producto]){
					$medidas_productos= crea_cruce_plant_medidas_productos($link,$row[id_producto],$row[id_medidas_productos]);
					echo $medidas_productos;
					}
					?>
              </span></td>
            </tr><? }?>
            <tr>
              <td class="titulo">Unidad</td>
              <td><span class="cajas">
                <? 
					if($row[id_producto]){
					$id_producto=$row[id_producto];
					
		 			$unidad_medida= crea_unidad_medida_producto($link,$id_producto);
					echo $unidad_medida;
				
					}
					?>
              </span></td>
            </tr>
			<? if($brasil != 0){?>
            <tr>
              <td class="titulo">Calibre</td>
              <td><span class="cajas">
                <? 
					if($row[id_producto]){
					$calibre= crea_cruce_plant_calibre($link,$row[id_producto],$row[id_calibre]);
					echo $calibre;
					}
					?>
              </span></td>
            </tr>
			<? }?>
            <tr>
              <td class="titulo">Fecha Salida</td>
              <td><input name="fecha_salida" type="text" class="cajas"   id="fecha_salida"  value="<?echo $fecha_salida?>" size="10" maxlength="10" /></td>
            </tr>
            <tr>
              <td colspan="2" ><? $id_bode=$row[id_mat_prima_importada];?></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
      <table width="564" border="0" align="center">
        <tr>
          <td width="54" class="style2"><a href="?modulo=salida_materia_prima_importada.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td width="54" class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=salida_materia_prima_importada.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td width="58"><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=salida_materia_prima_importada.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td width="47"><? if ($cuantos){ ?>
              <a href="?modulo=salida_materia_prima_importada.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47">&nbsp;</td>
          <td width="55">&nbsp;</td>
          <td width="62">
		  <? if($permiso33 == 1){?>
		  <?  if($id_estado_material != 2){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="despachar" src="jpg/despacho.jpg" />
              </label>
              <? }?>
		  </a>
		  <? }?>
		  </td>
          <td width="55">&nbsp;</td>
          <td width="45">&nbsp;</td>
          <td width="45"><? if(!$id_mat) {?>
              <a href="?modulo=salida_materia_prima_importada_listar.php&amp;op=<? echo $next?>" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
