<?

if(!$op) $op=0;
if($id_f2){
$sql="SELECT * FROM fajapallet  where id_fajapallet  ='$id_f2' and id_estado_pallet != 2 and id_estado_pallet != 0 ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM fajapallet where id_fajapallet=id_fajapallet and id_estado_pallet != 2 and id_estado_pallet != 0 order by id_fajapallet desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
$sql="SELECT * FROM fajapallet WHERE id_fajapallet=id_fajapallet and id_estado_pallet != 2 and id_estado_pallet != 0 order by id_fajapallet desc LIMIT $op , 1";
$result=mysql_query($sql);
}
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;

$fecha=date("Y-m-d");
$ano_fajapallet=date("Y");

 


  if($grabar_x)
  {

    $sqlul="SELECT * FROM fajapallet where id_fajapallet=id_fajapallet and id_estado_pallet != 2 and id_estado_pallet != 0 order by id_fajapallet desc";
$resultul=mysql_query($sqlul);

 if ($rowul=mysql_fetch_array($resultul))
 { 
 $id_fajapallet=$rowul[id_fajapallet];
 $id_fajapallet_siguiente=$id_fajapallet+1;
 //echo "$id_fajapallet_siguiente";
 }
  
  
  $sql_nuevo="insert into fajapallet  (id_fajapallet,ano_fajapallet,fpallet,id_bodegas,glosa,id_estado_pallet,marca_fajapallet) values ('$id_fajapallet_siguiente','$ano_fajapallet','$fecha',$id_bodegas,'$glosa','1','1')";
  //echo "--->$sql_nuevo<br>";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  $id_fajapallet=mysql_insert_id();
  
     if ($id_faja) 
  foreach($id_faja as $key => $value){
            
     		 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$key";
			 $rest=mysql_query($sq);
			  //echo "$sq -------- KEY -> $key<br>";
	    }
  
    if ($folios)
      {
	  //echo "VALOR FOLIOS $folios <br>";
	  $dat=split("\n",$folios);
	  $c=count($dat);
	  //echo "son $c datos<br>";
	  for ($i=0; $i<$c;$i++){ 
	    if ($dat[$i] != "") {
	    $id_f=$dat[$i];
		$largo=strlen($id_f);
		if($largo != 1){
		  $id_f=substr($id_f, 0, $largo);
		}
		 $sql="select * from fajas where id_faja=$id_f and id_fajapallet=0";
		 //echo "SQL $sql";
		 $rest=mysql_query($sql);
		 $c1=mysql_num_rows($rest);
		 if ($c1)
		    {
			 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$id_f";
			 $rest=mysql_query($sq);
			}// FIN IF
		}  //FIN $DAT
	  }//FIN FOR
    
  }//FIN FOLIOS
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=pallets_faja_ejemplo.php\">";
  exit;

 }//FIN GRABAR

  if($modificar_x){
  
  $dat2=split(" ",$fpallet);
  $dat=split("-",$dat2[0]);
  $fpallet2="$dat[2]-$dat[1]-$dat[0]";
  
  $sql_modificar="UPDATE  fajapallet set fpallet='$fpallet2',id_bodegas='$id_bodegas',glosa='$glosa',id_estado_pallet='$id_estado_pallet' where id_fajapallet =$id_fajapallet";
 //echo "$sql_modificar";
$rest=mysql_query($sql_modificar);

$sql2="update fajas set id_fajapallet=0 where id_fajapallet=$id_fajapallet";
$rest2=mysql_query($sql2);
 
if ($id_faja) {
  foreach($id_faja as $key => $value)
  {
  $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$key";
  $rest=mysql_query($sq);
  //echo "$sq -------- KEY -> $key<br>";
  }
}
 
	  
  if ($folios)
      {
	  //echo "VALOR FOLIOS $folios <br>";
	 $dat=split("\n",$folios);
	  $c=count($dat);
	  //echo "son $c datos<br>";
	  for ($i=0; $i<$c;$i++) 
	    {
	    if ($dat[$i] != "") {
	    $id_f=$dat[$i];
		
		$largo=strlen($id_f);
		if($largo != 1){
		  $id_f=substr($id_f, 0, $largo);
		}
		
		 $sql="select * from fajas where id_faja=$id_f and id_fajapallet=0";
		 //echo "SQL $sql<br>";
		 $rest=mysql_query($sql);
		 $c1=mysql_num_rows($rest);
		 if ($c1)
		    {
			 $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$id_f";
			 //echo "SQL $sq<br>";
			 $rest=mysql_query($sq);
			}
		 //else 
		  //  echo "el valor $id_f esta asignado o no existe<br>";
			
		}  
	  }
	  }
 if($id_f2){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pallets_faja_ejemplo.php&id_f2=$id_f2\">";
 exit;
 }else{
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pallets_faja_ejemplo.php&op=$op\">";
 exit;
 }


  }

if($borrar){
  $sql_borrar="delete from fajapallet where id_fajapallet = $borrar";
  $r=mysql_query($sql_borrar,$link);
 //echo "$sql_borrar";
  $sql2="update fajas set id_fajapallet=0 where id_fajapallet=$borrar";
  $rest2=mysql_query($sql2);
 
if ($id_faja) {
  foreach($id_faja as $key => $value)
  {
  $sq="update fajas set id_fajapallet ='$id_fajapallet' where id_faja=$key";
  $rest=mysql_query($sq);
  //echo "$sq -------- KEY -> $key<br>";
  }
}
   
  
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=pallets_faja_ejemplo.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=pallets_faja_ejemplo.php&op=1\">";
   exit;
   }
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=?modulo=pallets_faja_ejemplo.php&op=$op\">";
   exit;
  }//fin borrar
    
  
  
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
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
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
<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function numeros(evt){ 
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 
var key = nav4 ? evt.which : evt.keyCode; 
return (key <= 32 || (key >= 48 && key <= 59) || (key >= 45 && key <= 47 ));
}
//-->
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<form id="form1" name="form1" method="post" action="">
  <table width="600" border="0" align="center">
    <tr>
      <td width="565" height="30" class="titulo">Pallets con Fajas </td>
    </tr>
    <tr>
      <td>
	  
	    <? if(!$nuevo){?>
	    <?
	 $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	    $id_fajapallet=$row[id_fajapallet];
	   	$fpallet =format_fecha_sin_hora($row[fpallet]);
	?>
	    <input name="id_fajapallet" type="hidden" value="<?echo $row[id_fajapallet]?>" />
	    <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td width="562"><table width="482" border="0" align="center">
              <tr>
                <td width="110" class="titulo">Pallet Nro </td>
                <td width="256" class="numero">N<? echo substr($row[ano_fajapallet],2,4);?><? echo $row[id_fajapallet];?></td>
                <td width="102" class="cajas">
				<? $id_fajapallet=$row[id_fajapallet];
				   if(!$id_f2){?>
				<a href="?modulo=pallets_faja_ejemplo.php&amp;op=<? echo $op?>&amp;buscar=1">Buscar Fajas</a>
				<? }else{?>
				<a href="?modulo=pallets_faja_ejemplo.php&id_f2=<? echo $row[id_fajapallet] ?>&amp;buscar=1">Buscar Fajas</a>
				<? }?>				</td>
              </tr>
              <tr>
                <td class="titulo">Bodega</td>
                <td><? 
		 	$bodegas= crea_bodegas($link,$row[id_bodegas],0);
			echo $bodegas;
			?></td>
                <td>
				<? if(!$id_f2){?>
				<a href="?modulo=pallets_faja_ejemplo.php&amp;op=<? echo $op?>&amp;capturar=1" class="cajas">Capturar Folios </a>
				<? }else{?>
				<a href="?modulo=pallets_faja_ejemplo.php&id_f2=<? echo $row[id_fajapallet] ?>&amp;capturar=1" class="cajas">Capturar Folios </a>
				<? }?>				</td>
              </tr>
              <tr>
                <td class="titulo">Fecha </td>
                <td colspan="2"><input name="fpallet" type="text" class="cajas"   id="fpallet"  value="<?echo $fpallet?>" size="10" maxlength="10" />
                  <a href="javascript:show_Calendario('form1.fpallet');" class="cajas"  >Ver</a></td>
              </tr>
              <tr>
                <td class="titulo">Estado</td>
                <td colspan="2"><? 
		 	$estado_pallets= crea_estado_pallets($link,$row[id_estado_pallet],0);
			echo $estado_pallets;
			?></td>
              </tr>
              <tr>
                <td class="titulo">Glosa</td>
                <td colspan="2"><input name="glosa" type="text" class="cajas" id="glosa" size="50"  value="<?echo $row[glosa]?>"/></td>
              </tr>
              <tr>
                <td class="titulo">Unidades</td>
                <td colspan="2">
			<?
			if($id_fajapallet){
			$sql="select * from fajas AS f, producto AS p where f.id_fajapallet = $id_fajapallet and f.id_producto=p.id_producto";
			$result_buscar=mysql_query($sql);
			$unidad=mysql_num_rows($result_buscar);
			 ?>
                  <input name="unidad" type="text" class="cajas" id="unidad" size="5"  value="<?echo $unidad?>"/> </td></tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="2"><? $id_bode=$row[id_fajapallet];?></td>
              </tr>
          </table>
		    <table width="595" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="20" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;</td>
                <td width="55" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Faja</td>
                <td width="48" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Lote</td>
                <td width="238" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
                <td width="61" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Emisi&oacute;n </td>
                <td width="56" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">F. Venc</td>
                <td width="34" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Neto</td>
                <td width="30" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Tara</td>
                <td width="33" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Est.</td>
              </tr>
              <?
				  while ($row_b=mysql_fetch_array($result_buscar))
      			  { 
	    		  $id_faja=$row_b[id_faja];
				  $femision=format_fecha_sin_hora($row_b[femision]);
				   $fvencimiento=format_fecha_sin_hora($row_b[fvencimiento]);
				  ?>
              <tr>
                <td nowrap="nowrap" class="cajas">
				<? if(!$id_fajapallet){?>
                        <input name="id_faja[<?echo $row_b[id_faja]?>]" type="checkbox" class="cajas" id="id_faja[<?echo $row_b[id_faja]?>]" value="checkbox" />
                        <? }else{?>
                        <input name="id_faja[<?echo $row_b[id_faja]?>]" type="checkbox" class="caja_texto" value="1" checked="checked"/>
                  <? }?>                </td>
                <td nowrap="nowrap" class="cajas"><? echo substr($row_b[ano],2,2);?><?echo $row_b[id_faja]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $row_b[loten]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $row_b[producto]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $femision?></td>
                <td nowrap="nowrap" class="cajas"><?echo $fvencimiento?></td>
                <td nowrap="nowrap" class="cajas"><?echo $row_b[neto]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $row_b[tara]?></td>
                <td nowrap="nowrap" class="cajas"><?echo $row_b[estado]?></td>
              </tr>
              <? }?>
            </table>
            <? } ?></td>
        </tr>
      </table>
	  <? }}?>
        <? if($nuevo){?>
        <table width="600" border="1" align="center" bordercolor="#CCCCCC">
          <tr>
            <td><table width="482" border="0" align="center">
                <tr>
                  <td width="110" class="titulo">Bodega</td>
                  <td width="253"><? 
		 	$bodegas= crea_bodegas($link,$row[id_bodegas],0);
			echo $bodegas;
			?></td>
                  <td width="105" class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&nuevo=1&buscar=1">Buscar Fajas</a> </td>
                </tr>
                <tr>
                  <td class="titulo">Fecha </td>
                  <td><?  
			   $fecha=format_fecha_sin_hora($fecha);
			   ?>
                      <input name="fpallet" type="text" class="cajas" id="fpallet" value="<?echo $fecha?>" size="10" maxlength="10" /></td>
                  <td><a href="?modulo=pallets_faja_ejemplo.php&amp;nuevo=1&capturar=1" class="cajas">Capturar Folios</a></td>
                </tr>
                <tr>
                  <td class="titulo">Estado</td>
                  <td colspan="2" class="titulo">Bodega</td>
                </tr>
                <tr>
                  <td class="titulo">Glosa</td>
                  <td colspan="2"><input name="glosa" type="hidden" value="<?echo $glosa?>"/>
				  <input name="glosa" type="text" class="cajas" id="glosa" size="50" value="<?echo $glosa?>"/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
            </table>            </td>
          </tr>
        </table>
        <? }?>
		
        <?
		
			
		 if($buscar) {?>
        <table width="600" border="0" align="center">
          <tr>
            <td width="194"><div align="center" class="titulo">Desde la Faja </div></td>
            <td><div align="center" class="titulo">Hasta la Faja </div></td>
            <td width="213" rowspan="2"><input name="buscar_faja" type="submit" class="cajas" value="Buscar" /></td>
          </tr>
          <tr>
            <td><div align="center">
			    <input name="desde" type="text" class="cajas" id="desde" size="10" />
            </div></td>
            <td width="142"><div align="center">
                <input name="hasta" type="text" class="cajas" id="hasta" size="10" />
            </div></td>
          </tr>
          <tr>
            <td colspan="3"><?
		
			 $largo=strlen($desde);
	  		 $newano=substr($desde, 0, 2);
	  		 $newano="20".$newano;
	  		 $desde=substr($desde, 2, $largo);
			 
			  $largo2=strlen($hasta);
	  		 $newano2=substr($hasta, 0, 2);
	  		 $newano2="20".$newano2;
	  		 $hasta=substr($hasta, 2, $largo2);
	
			  if($buscar_faja){
				  if($hasta){
				  $sql_buscar="SELECT * FROM fajas AS f, producto AS p where f.id_faja between $desde and $hasta and f.id_producto=p.id_producto";
				  $result_buscar=mysql_query($sql_buscar);
			      $cuantos_buscar=mysql_num_rows($result_buscar);
				  }else{
				  $sql_buscar="SELECT * FROM fajas AS f, producto AS p where f.id_faja=f.id_faja and f.id_fajapallet = 0 and f.id_producto = p.id_producto";
				  $result_buscar=mysql_query($sql_buscar);
			      $cuantos_buscar=mysql_num_rows($result_buscar);
				  }
				  ?>
                <table width="595" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="30" bgcolor="#CCCCCC" class="titulo">
					<a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a>  
			        <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a>					</td>
                    <td width="25" bgcolor="#CCCCCC" class="titulo">Faja</td>
                    <td width="41" bgcolor="#CCCCCC" class="titulo">Lote</td>
                    <td width="197" bgcolor="#CCCCCC" class="titulo">Producto</td>
                    <td width="58" bgcolor="#CCCCCC" class="titulo">F. Emisi&oacute;n </td>
                    <td width="88" bgcolor="#CCCCCC" class="titulo">F. Vencimiento </td>
                    <td width="33" bgcolor="#CCCCCC" class="titulo">Neto</td>
                    <td width="31" bgcolor="#CCCCCC" class="titulo">Tara</td>
                    <td width="31" bgcolor="#CCCCCC" class="titulo">Est.</td>
                  </tr>
                  <?
				  while ($row_b=mysql_fetch_array($result_buscar))
      			  { 
	    		  $id_faja=$row_b[id_faja];
				  ?>
                  <tr>
                    <td class="cajas"><input name="id_faja[<?echo $row_b[id_faja]?>]" type="checkbox" class="cajas" id="id_faja[<?echo $row_b[id_faja]?>]" value="checkbox" />                    </td>
                    <td class="cajas"><? echo substr($row_b[ano],2,2);?><?echo $id_faja?></td>
                    <td class="cajas"><?echo $row_b[loten]?></td>
                    <td class="cajas"><?echo $row_b[producto]?></td>
                    <td class="cajas"><?echo $row_b[femision]?></td>
                    <td class="cajas"><?echo $row_b[fvencimiento]?></td>
                    <td class="cajas"><?echo $row_b[neto]?></td>
                    <td class="cajas"><?echo $row_b[tara]?></td>
                    <td class="cajas"><?echo $row_b[estado]?></td>
                  </tr>
                  <? }?>
                </table>
              <? } ?>            </td>
          </tr>
        </table>
        <? }?>
		
		<? if ($capturar)
		     { ?>
			    <span class="titulo">CAPTURAR FOLIOS</span><br />
   <textarea name="folios" cols="30" rows="10" id="folios" onKeyPress="return numeros(event)"></textarea>
		<? } ?>	
        <table width="564" border="0" align="center">
          <tr>
            <td width="54" class="style2">
			<? if (!$nuevo and $cuantos){ ?>
			<a href="?modulo=pallets_faja_ejemplo.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a><? }?></td>
            <td width="54" class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=pallets_faja_ejemplo.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
&nbsp;
<? }?></td>
            <td width="58" class="style2">
              <? if($ante >= 0){ ?>
              <a href="?modulo=pallets_faja_ejemplo.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
              <? }else{?>
&nbsp;
<? }?>
            </td>
            <td width="47"><? if ($cuantos and !$nuevo){ ?>
                <a href="?modulo=pallets_faja_ejemplo.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
                <? }?>            </td>
            <td width="47"><a href="?modulo=pallets_faja_ejemplo.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a></td>
            <td width="55"><a href="?modulo=pallets_faja_ejemplo.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
            <td width="62">
			<? if(!$nuevo){?>
			  <a href="javascript: document.form1.submit();">
                <label>
                <input type="image" name="modificar" src="jpg/modificar.jpg" />
                </label>
              </a>
			  <? }?>		    </td>
            <td width="55"><? if(!$cuantos or $nuevo or $mantsec){?>
                <a href="javascript: document.form1.submit();">
                <label>
                <input type="image" name="grabar" src="jpg/guardar.jpg" />
                </label>
                </a>
                <? }?>            </td>
            <td width="45"><? if(!$nuevo and $cuantos){?>
                <a href="?modulo=pallets_faja_ejemplo.php&amp;borrar=<?=$id_bode?>&amp;op=<? echo "$ante"?>" > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
                <? }?>            </td>
            <td width="45"><? if(!$nuevo and $cuantos){?>
                <a href="?modulo=pallets_faja_ejemplo_listar.php" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
                <? }?>            </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
 

    
</form>