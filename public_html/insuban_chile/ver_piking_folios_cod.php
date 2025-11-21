<?
$sql2="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
		$rest2=mysql_query($sql2);
		$cuantos2=mysql_num_rows($rest2);

while ($r22=mysql_fetch_array($rest2)){ 
			$id_producto222 = $r22[id_producto];
}

if ($modificar_all)
  {
   if ($id_ef_mod) 
    foreach ($id_ef_mod as $key)
   {
    $sql="update  etiquetados_folios set calibre_alt='$calibre_alt', nombre_alt='$nombre_alt', contenido_alt='$contenido_alt' where id_etiquetados_folios=$key";
	$rest=mysql_query($sql);
	//echo "  $sql";
   }
   /*
    if ($id_etiquetados_folios) 
    foreach ($id_etiquetados_folios as $key)
   {    //$fecha="0000-00-00";
    //$sq_up_piking="update paking set  fdespacho_piking  ='$fecha' where id_etiquetados_folios =$key";
	//$rest_up_piking=mysql_query($sq_up_piking);
	
	$sq_up_etf="update etiquetados_folios set id_estado_folio = '$id_estado_folio', id_destinos='$id_destinos', factura='$factura_paking',guia='$guia', glosa='$glosa'  where id_etiquetados_folios =$key";
	//echo "$sq_up_etf<br>";
	$rest_up_etf=mysql_query($sq_up_etf);
	}
	*/
 }


if ($modificar_datos)
  {
  
   if ($id_etiquetados_folios) 
   foreach ($id_etiquetados_folios as $key)
   {   
   //echo "$id_estado_folio";
   if($id_estado_folio == 3){
   //echo "gggggggggggggggg";
    $fecha="0000-00-00";
	$id_estado_folio = 3;
    $sq_up_piking="update paking set fdespacho_piking = '$fecha' where id_etiquetados_folios =$key";
	$rest_up_piking=mysql_query($sq_up_piking);
	$sq_up_etf="update etiquetados_folios set id_estado_folio = '$id_estado_folio', fdespacho_piking='$fecha' where id_etiquetados_folios =$key";
	$rest_up_etf=mysql_query($sq_up_etf);
   }
   
   
   $dat2=split(" ",$f_despacho_picking);
   $dat=split("-",$dat2[0]);
   $f_despacho_picking1="$dat[2]-$dat[1]-$dat[0]";
   
   	$sq_up_etf="update etiquetados_folios set id_estado_folio = '$id_estado_folio', id_destinos='$id_destinos', factura='$factura_paking',guia='$guia',fdespacho_piking ='$f_despacho_picking1', glosa='$glosa'  where id_etiquetados_folios =$key";
	$rest_up_etf=mysql_query($sq_up_etf);
	
	}
 }
  
  
 if($despachar){
//echo "if($despachar_x and $id_estado_folio == 7 and $id_destinos){";
   if ($id_etiquetados_folios){ 
   
   if($f_despacho_picking != '00-00-0000'){
   $dat2=split(" ",$f_despacho_picking);
   $dat=split("-",$dat2[0]);
   $f_despacho_picking1="$dat[2]-$dat[1]-$dat[0]";
   }else{
   $f_despacho_picking1=date("Y-m-d");
   }
   
    foreach ($id_etiquetados_folios as $key)
   {
    $sq_up_piking="update paking set fdespacho_piking  = '$f_despacho_picking1' where id_etiquetados_folios =$key";
	$rest_up_piking=mysql_query($sq_up_piking);
    //$fechafolio=date("Y-m-d");
	$sq_up_etf=" update etiquetados_folios set id_estado_folio = '7', id_destinos='$id_destinos', factura='$factura_paking',guia='$guia',fdespacho_piking ='$f_despacho_picking1', glosa='$glosa'  where id_etiquetados_folios =$key ";
//echo "$sq_up_etf<br>";
	$rest_up_etf=mysql_query($sq_up_etf);
	}
  }
}

if($eliminar_nom_alter){
	
foreach ($_POST as $key => $value)
{ 

 $dat=split("-",$key); 

   if ($dat[0] == 'id_eti')
   {
	 $id=$dat[1];
   	$id_eti=$_POST["id_eti-$id"];    

	$sql="update etiquetados_folios set calibre_alt='',nombre_alt='', contenido_alt='' where id_etiquetados_folios=$id_eti";
    $rest=mysql_query($sql);
	//echo "SQL $sql<br>";

   }
 }
}

//echo " id_paking_relacion   $id_paking_relacion";

$sql1="SELECT * from paking AS p, etiquetados_folios AS ef where p.id_paking_relacion = $id_paking_relacion and p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_caract_producto != 25 order by p.id_paking desc";
$rest1=mysql_query($sql1);
$cuantos1=mysql_num_rows($rest1);
//echo "cuantos1 $cuantos1";

$sql2="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
		and	ef.id_caract_producto = 25
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios group by ef.pallet order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
		$rest2=mysql_query($sql2);
		$cuantos2=mysql_num_rows($rest2);

//echo "cuantos2 $cuantos2";
$ccccc = $cuantos1 + $cuantos2;


?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-align: left;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.titulo_grande {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
.titulo_color {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #0000FF; }
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #0000FF; }
-->
</style>

<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=yes,location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=yes, width=480, height=401, top=100, left=100"; 
window.open(pagina,"",opciones); 
} 
</script>

<script language="javascript">
function solo_numeros(){
var key=window.event.keyCode;



if (key < 48 || key > 57){
window.event.keyCode=0;
}}
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

<script language="JavaScript"> 
function seleccionar_todor(){ 
   for (ir=0;ir<document.form1.elements.length;ir++) 
      if(document.form1.elements[ir].type == "radio") 
         document.form1.elements[ir].radio=1
} 

function deseleccionar_todor(){ 
   for (ir=0;ir<document.form1.elements.length;ir++) 
      if(document.form1.elements[ir].type == "radio") 
         document.form1.elements[ir].radio=0
} 
</script>

<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<table width="874" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="769" height="6" class="titulo">&nbsp;</td>
    <td width="105" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="11" class="titulo">Despacho Picking </td>
    <td width="105" class="cajas">
      <? if($id_destinos){ ?>
      <a href="?modulo=picking_folios_despachados.php&id_destinos=<? echo $id_destinos?>">Volver</a>
      <? }else{?>
<a href="?modulo=picking_folios.php">Volver</a>
<? }?>
</td>
  </tr>
  <tr>
    <td height="12" class="titulo">&nbsp;</td>
    <td width="105" class="cajas">&nbsp;</td>
  </tr>
  <tr>
    <td height="13" colspan="2" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" colspan="2">
	<form id="form1" name="form1" method="post" action="">
<? if($ccccc){?>
<? if ($row=mysql_fetch_array($rest1)){ 
$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
$f_despacho_picking =format_fecha_sin_hora($row[fdespacho_piking]);
$id_estado_folio=$row[id_estado_folio];
//echo "id_estado_folio $id_estado_folio";
?>
<table width="623" border="0" align="center">
  <tr>
    <td colspan="2" nowrap="nowrap" class="titulo"><span class="titulo_grande">N&deg; Picking</span> <span class="titulo_grande"><? echo $row[folio_piking]?></span></td>
    </tr>
  <tr>
    <td colspan="2" nowrap="nowrap" class="titulo"><hr /></td>
  </tr>
  <tr>
    <td width="307" nowrap="nowrap" class="titulo"><table width="306" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td height="185"><table width="295" border="0" align="center">
            <tr>
              <td width="85" class="titulo">Estado </td>
              <td colspan="2"><span class="cajas">
                <input name="id_pak" type="hidden" id="id_pak" value="<?echo $id_pak?>" />
				
                <? //echo $row[id_estado_folio];
				//echo "->$id_estado_folio";
			    if($row[id_estado_folio] == 7){
				$e= crea_estado_folio_insuban($link,$row[id_estado_folio],0);
				echo $e;
				}else{
				echo "Picking";
				?>
				<input name="id_estado_folio" type="hidden" id="id_estado_folio" value="<?echo $id_estado_folio?>" />
				<?
				$id_estado_folio=3;
				}
				
	  			?>
				
				</span></td>
            </tr>
            <tr>
              <td class="titulo">Destino</td>
              <td colspan="2"><span class="cajas">
                <? 
			        $destinos= crea_destinos($link,$row[id_destinos]);
					echo $destinos;
					
				   //$id_destinos=$row[id_destinos];
				?>
              </span></td>
            </tr>
            <tr>
              <td height="22" class="titulo">Factura</td>
              <td width="86" class="titulo">Gu&iacute;a</td>
              <td width="110" class="titulo">Fecha Despacho</td>
            </tr>
            <tr>
              <td class="titulo"><span class="cajas">
                <input name="factura_paking" type="text" id="factura_paking" onkeypress="solo_numeros()" value="<? echo $row[factura]?>" size="8" maxlength="10"/>
              </span></td>
              <td><span class="cajas">
                <input name="guia" type="text" id="guia" onkeypress="solo_numeros()" value="<? echo $row[guia]?>" size="8" maxlength="10" />
              </span></td>
              <td><input name="f_despacho_picking" type="text" class="cajas"   id="f_despacho_picking"  value="<?echo $f_despacho_picking?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.f_despacho_picking');" class="cajas" >Ver</a></td>
            </tr>
            <tr>
              <td colspan="3" class="titulo">Glosa</td>
              </tr>
            <tr>
              <td colspan="3" class="titulo"><span class="cajas">
                <input name="glosa" type="text" id="glosa" value="<? echo $row[glosa]?>" size="43" maxlength="30" />
              </span></td>
              </tr>
            <tr>
              <td colspan="3" class="titulo">
			  
                  <? if($permiso38 == 1){?>
                  <? //if($row[id_estado_folio] != 7){?>
             
              <div align="center">
                   <? 
				  // }
				
				   ?>
              
                    <input name="modificar_datos" type="submit" class="cajas" id="modificar_datos" value="Modificar Datos" />
                	
					<?
					}
					   ?>
                </div></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="306" valign="top" class="cajas"><? if($permiso38 == 1 and $nivel_usua == 2 or $nivel_usua == 1){?>
      <table width="306" height="188" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="186"><table width="237" border="0" align="center">
              <tr>
                <td width="231" class="titulo"><label class="titulo">Modificar   listado de
                  Productos  y Calibres </label></td>
              </tr>
              <tr>
                <td class="cajas">Nombre Asociado </td>
              </tr>
              <tr>
                <td class="cajas"><input name="nombre_alt" type="text" class="cajas" id="nombre_alt2" size="45" maxlength="50" /></td>
              </tr>
              <tr>
                <td class="cajas">Calibre Asociado</td>
              </tr>
              <tr>
                <td class="cajas"><label>
                  <input name="calibre_alt" type="text" class="cajas" id="nombre_alt" size="45" maxlength="30" />
                </label></td>
              </tr>
              <tr>
                <td class="cajas">Cantidad Asociada
                  <label></label></td>
              </tr>
              <tr>
                <td class="cajas"><input name="contenido_alt" type="text" class="cajas" id="contenido_alt" size="45" maxlength="30" /></td>
              </tr>
              <tr>
                <td class="cajas"><div align="center">
                   <? if($permiso38 == 1  and $nivel_usua == 1){?> <input name="modificar_all" type="submit" class="cajas" id="modificar_all" value="Modificar Producto" /><? }?>
                </div></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap"><span class="titulo">Nota:</span> <span class="cajas">Para poder Despachar el Picking debe estar ingresado el N&deg; de Factura. </span></td>
    </tr>
   <? 	
    //echo "id_estado_folio $id_estado_folio  factura_paking $factura_paking nivel_usua $nivel_usua";
	if($id_estado_folio == 3 and $row[factura] and $permiso38 == 1){?>
  <tr>
    <td height="25" colspan="2" bgcolor="#CCCCCC" class="titulo">
	<hr />
	<div align="center">
	<input name="despachar" type="submit" class="cajas" id="despachar" value="Despachar Picking" />
    </div>
    <hr />	</td>
  </tr>
   <? }else{?>
   <tr>
    <td height="25" colspan="2" bgcolor="#CCCCCC" class="titulo">
	<hr />
	<div align="center">
	<input name="despachar" type="button" class="cajas" id="despachar" value="Despachar Picking" disabled="disabled"/>
    </div>
    <hr />	</td>
  </tr>
   
   
   <? }?>
  <tr>
    <td height="25" colspan="2" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="titulo"><div align="center"><span class="cajas">Correlativo: 
            <input name="otro" type="text" id="otro" onkeypress="solo_numeros()" value="<? echo $otro?>" size="5" maxlength="5" />&nbsp;&nbsp;
    </span>Desde: <span class="cajas">
      <? if($ini == '')
	        $ini=1;
		 if($fin == '')
	        $fin=$ccccc;
			//echo "cccccccccc $ccccc<br>";
	  ?>
      <input name="ini" type="text" id="ini" onkeypress="solo_numeros()" value="<? echo $ini?>" size="5" maxlength="5" />&nbsp;&nbsp;
      </span>
	     Hasta:<span class="cajas">
        <input name="fin" type="text" id="fin" onkeypress="solo_numeros()" value="<? echo $fin?>" size="5" maxlength="5" />
        </span><br><br>
      <? $etiqueta_idioma= crea_etiqueta_idioma($link,$id_etiqueta_idioma,1);
	echo $etiqueta_idioma;
	
	if($id_etiqueta_idioma){
	
	$clientes= crea_cliente($link,$id_destinosotro,$id_etiqueta_idioma,1);
	echo $clientes;
	}
	?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" class="titulo">
	
      <? //if($id_etiquetas == 15 or $id_etiquetas == 7){
		if($id_destinosotro and $id_etiqueta_idioma == 1){?>

      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_espanol.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="jpg/impresora.jpg" alt="Etiquetas" width="35" height="39" border="0" /><br />
        Imprimir Etiquetas</a></div>
				
		
      <? }?>
      <? if($id_destinosotro and $id_etiqueta_idioma == 2){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ingles.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&id_us=<? echo $id_insuban?>')"><img src="jpg/impresora.jpg" alt="Etiquetas" width="35" height="39" border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>
      <? if($id_destinosotro and $id_etiqueta_idioma == 3){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_portugues.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas" width="35" height="39" border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?></td>
  </tr>
  <tr>
    <td colspan="2">
	<? //if($id_destinosotro and $id_estado_folio == 7 and $factura_paking or $muestra){
	   if($id_destinosotro){
	?>
	<table width="180" height="25" border="0" align="right">
      <tr>
        <td width="205"><div align="right" class="cajas">
            <div align="center">
			<? $id=$_SESSION['id_insuban']?>
            <? if($id_producto222 != 88){?>
            <a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Imprimir Informes de Trazabilidad</a><? } ?></div>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" class="cajas">Imprimir Aprobaci&oacute;n de Partida </a></div></td>
      </tr>
      <tr>
        <td align="center" class="cajas">
        <? if($id_producto222 == 88){?>
        <a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_mucosa.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Trazabilidad Mucosa</a> <a href="informes_pdf/imprimir_informes_trazabilidad_mucosa_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;id=<? echo $id?>" target="_blank"><img src="jpg/icono-excel.gif" width="19" height="19" border="0" /></a>        <? }?></td>
      </tr>
    </table>
	<? }?></td>
  </tr>
</table>
<? }?>
<table width="899" border="0" align="center">
<tr>
<td width="893">
 <div align="left" class="cajas"><a href="javascript:seleccionar_todor()">Seleccionar Todo</a> / <a href="javascript:deseleccionar_todor()">Deseleccionar Todo</a></div>
</td>
</tr>
  <tr>
     <td><table width="882" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="20" colspan="3" nowrap="nowrap" bgcolor="#E7E4E4" class="cajas">&nbsp;N&deg; Picking </td>
        <td width="6%" bgcolor="#E7E4E4" class="titulo_grande">&nbsp;<span class="titulo"><? echo $row[folio_piking]?></span> <input name="folio_piking" type="hidden" id="folio_piking" value="<?echo $row[folio_piking]?>" /></td>
        <td width="5%" bgcolor="#E7E4E4" class="titulo_grande">&nbsp;</td>
        <td bgcolor="#E7E4E4" ><div align="right" class="cajas">&nbsp;Cantidad de Folios&nbsp;</div></td>
        <td colspan="6" bgcolor="#E7E4E4" class="titulo_grande">&nbsp;<span class="titulo"><? echo $cantifo;?></span></td>
        </tr>
      <tr>
        <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Contador</td>
        <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Cod</td>
        <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">
          <div align="center">N&deg; Folio </div></td>
        <td bgcolor="#CCCCCC" class="titulo">
          <div align="center">F/Elaboraci&oacute;n</div></td>
        <td bgcolor="#CCCCCC" class="titulo">Especie</td>
        <td width="27%" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto <a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></td>
        <td width="9%" bgcolor="#CCCCCC" class="titulo"><div align="center">Calibre</div></td>
        <td width="7%" bgcolor="#CCCCCC" class="titulo"><div align="center">Medida</div></td>
        <td width="8%" bgcolor="#CCCCCC" class="titulo"><div align="center">Carac/Prod</div></td>
        <td width="5%" bgcolor="#CCCCCC" class="titulo"><div align="center">Cant.</div></td>
        <td width="6%" bgcolor="#CCCCCC" class="titulo"><div align="center">Proced.</div></td>
        <td width="8%" bgcolor="#CCCCCC" class="titulo">&nbsp;<div align="center"><input name="eliminar_nom_alter" type="submit" class="cajas" id="eliminar_nom_alter" value="X" /></div>	
        </td>
      </tr>
      <? 
	
		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
		and	ef.id_caract_producto != 25
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios  order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc	";
		$rest=mysql_query($sql);
		//echo "sql $sql<br>";
		$cuantos=mysql_num_rows($rest);
 
     	 if($cuantos){
		    $color = "#000000";$i = 0;
		    while ($r=mysql_fetch_array($rest)){ 
			$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
			$cont++;
	$id_cruce_tablas = $r[id_cruce_tablas];
	   		$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
			$fdespacho_piking =format_fecha_sin_hora($r[fdespacho_piking]);
	        $i=0;
			
		?>
      <tr>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $cont?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $id_cruce_tablas?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <input name="id_etiquetados_folios[]" type="hidden" id="id_etiquetados_folios" value="<?echo $r[id_etiquetados_folios]?>" />
          <a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $r[id_etiquetados_folios]?>"><?echo $r[id_etiquetados_folios]?></a></div> </td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?
		$sqlesp="SELECT * FROM cruce_plant_especie AS cpe, especie e where cpe.id_producto = $r[id_producto] and cpe.id_especie = e.id_especie";
		$restesp=mysql_query($sqlesp);
		$cuantosesp=mysql_num_rows($restesp);
 
     	 if($cuantosesp){
		    if ($resp=mysql_fetch_array($restesp)){ 
			echo "$resp[especie]";
			}
			}
		?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
          
          <input name="id_ef_mod[]" type="checkbox" id="id_ef_mod[]" value="<?echo $r[id_etiquetados_folios]?>" />
          <? 
		if ($r[nombre_alt] != '') {
		  $i++;
		  $producto=$r[nombre_alt];
		  }
		else
		  $producto=$r[producto];
		echo $producto;
		?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;
		<?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>		</td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $r[medidas_productos]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $r[caract_producto]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?
      if($r[contenido_alt]){
		echo  $contenido_alt=$r[contenido_alt];
	  }else{
		echo  $contenido_unidades=$r[contenido_unidades];
	  }
	
		//echo $r[contenido_unidades]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
          <div align="center">
            <? if($r[id_procedencia] == 'I'){
          echo "Importado";
         }
		  if($r[id_procedencia] == 'N'){
         echo "Nacional";
		 }?>
          </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
		<div align="center">&nbsp;
		<? if ($r[nombre_alt] != '' or $r[nombre_alt] != '') { ?>
<!--        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->		<!--<? //if($permiso38 == 1 and $nivel_usua == 1){?>
        <a href="?modulo=ver_piking_folios_nombre.php&eliminar=1&id_etiquetados_folios=<?echo $r[id_etiquetados_folios]?>&id_paking_relacion=<? //echo $id_paking_relacion?>"><img src="jpg/eliminar_click.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" /></a>
		<? //}else{
			?>
		<img src="jpg/eliminar_click_gris.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" />
		<? //}?>
        <? //}else{ ?>
  		<img src="jpg/eliminar_click_gris.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" />
        <!--       
        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<input name="id_eti-<? echo $r[id_etiquetados_folios] ?>" type="radio" value="<? echo $r[id_etiquetados_folios]?>" >
<? } ?>
		</div>
		</td>
      </tr>
        <?
	 }//while ($r=mysql_fetch_array($rest)){ 
	}// if($cuantos){
	
?>
<?
$sqlv="SELECT SUM(ef.contenido_unidades) AS sumcon, SUM(ef.contenido_alt) AS contenido_alt, ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_cruce_tablas AS id_cruce_tablasv, ef.nombre_alt AS nombre_alt, ef.id_producto AS id_producto, pro.producto AS producto, ef.calibre_alt AS calibre_alt, c.calibre AS calibre, mp.medidas_productos AS medidas_productos, cpro.caract_producto AS caract_producto, ef.id_procedencia AS id_procedencia, ef.pallet AS pallet  FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
		and	ef.id_caract_producto = 25
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios group by ef.pallet order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc";
		$restv=mysql_query($sqlv);
		$cuantosv=mysql_num_rows($restv);
		//echo "sqlv $sqlv<br>";
?>
   <?
   	$contv=$cont++;
      if($cuantosv){
		  
		    $color = "#000000";$i = 0;
		    while ($rv=mysql_fetch_array($restv)){ 
			$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
			//$cont++;
	$id_cruce_tablasv = $rv[id_cruce_tablasv];
	   		$f_elaboracionv=format_fecha_sin_hora($rv[f_elaboracion]);
			$fdespacho_pikingv =format_fecha_sin_hora($rv[fdespacho_piking]);
	        $i=0;
			$contv=$contv + 1;
			
	  
	  ?>
      <tr>
   
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $contv?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $id_cruce_tablasv?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
        <a href="?modulo=modificar_pallet.php&amp;pallet=<?echo $rv[pallet]?>&id_cruce_tablasok=<? echo $id_cruce_tablasv?>"><? echo $r[cf]?>P/<?echo $rv[pallet]?> 
          
          <?
                $sqlss="SELECT *  from  pallet AS pal where pallet = $rv[pallet] ";
$restss=mysql_query($sqlss);
$cuantosss=mysql_num_rows($restss);
				echo "[$cuantosss]";
				?>
         <!-- <input name="id_etiquetados_folios[]" type="hidden" id="id_etiquetados_folios" value="<?echo $rv[id_etiquetados_folios]?>" /><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $rv[id_etiquetados_folios]?>">--></a></div> </td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?
		$sqlespv="SELECT * FROM cruce_plant_especie AS cpe, especie e where cpe.id_producto = $rv[id_producto] and cpe.id_especie = e.id_especie";
		$restespv=mysql_query($sqlespv);
		$cuantosespv=mysql_num_rows($restespv);
 
     	 if($cuantosespv){
		    if ($respv=mysql_fetch_array($restespv)){ 
			echo "$respv[especie]";
			}
			}
		?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><input name="id_ef_mod[]" type="checkbox" id="id_ef_mod[]" value="<?echo $r[id_etiquetados_folios]?>" />
          <? 
		if ($rv[nombre_alt] != '') {
		  $i++;
		  $producto=$rv[nombre_alt];
		  }
		else
		  $producto=$rv[producto];
		echo $producto;
		?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;
          <?
		if ($rv[calibre_alt] != '') 
		  $calibre=$rv[calibre_alt];
		else
		  $calibre=$rv[calibre];
		echo $calibre;
		?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $rv[medidas_productos]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $rv[caract_producto]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;
          <?
      if($rv[contenido_alt]){
		echo  $contenido_alt=$rv[contenido_alt];
	  }else{
		echo  $contenido_unidades=$rv[sumcon];
	  }
	
		//echo $r[contenido_unidades]?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <? if($rv[id_procedencia] == 'I'){
          echo "Importado";
         }
		  if($rv[id_procedencia] == 'N'){
         echo "Nacional";
		 }?>
        </div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">&nbsp;
          <? if ($rv[nombre_alt] != '' or $rv[nombre_alt] != '') { ?>
          <!--        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->
          <!--<? //if($permiso38 == 1 and $nivel_usua == 1){?>
        <a href="?modulo=ver_piking_folios_nombre.php&eliminar=1&id_etiquetados_folios=<?echo $r[id_etiquetados_folios]?>&id_paking_relacion=<? //echo $id_paking_relacion?>"><img src="jpg/eliminar_click.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" /></a>
		<? //}else{
			?>
		<img src="jpg/eliminar_click_gris.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" />
		<? //}?>
        <? //}else{ ?>
  		<img src="jpg/eliminar_click_gris.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" />
        <!--       
        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->
          <input name="pallet-<? echo $rv[pallet] ?>" type="radio" value="<? echo $rv[pallet]?>" />
          <? } ?>
        </div></td>
        </tr>
     <?
        }
		
	  }
		?>
    </table></td>
  </tr>
  
  <tr>
    <td>
	  
   
   <a href="javascript: document.form1.submit();">
        <label></label>
      </a></td>
  </tr>
  <tr>
    <td><? //echo $fdespacho_piking;?></td>
  </tr>
  <tr>
    <td height="22">&nbsp;	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<? } // fin if cuantos?>
    </form></td>
  </tr>
</table>
