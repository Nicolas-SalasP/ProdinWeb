<?php
$sql2="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc	";
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
    $sql="UPDATE etiquetados_folios set calibre_alt='$calibre_alt', nombre_alt='$nombre_alt', contenido_alt='$contenido_alt', peso1_alt='$peso1_alt', peso2_alt='$peso2_alt' where id_etiquetados_folios=$key";
	$rest=mysql_query($sql);
	//echo "  $sql"; se agrega peso_alternativo a la base de datos.
   } 
       foreach ($pallet as $keyp)
   {
    $sqlp="UPDATE etiquetados_folios set calibre_alt='$calibre_alt', nombre_alt='$nombre_alt', contenido_alt='$contenido_alt' where pallet=$keyp";
	$restp=mysql_query($sqlp);
	//echo "  $sql";
   }
 }


if ($modificar_datos)
  {
  
      if($f_despacho_picking){
   $dat2=split(" ",$f_despacho_picking);
   $dat=split("-",$dat2[0]);
   $f_despacho_picking1="$dat[2]-$dat[1]-$dat[0]";
   }else{
    $f_despacho_picking1="0000-00-00";
   }

      if($f_facturacion_picking){
   $dat2=split(" ",$f_facturacion_picking);
   $dat=split("-",$dat2[0]);
   $f_facturacion_picking1="$dat[2]-$dat[1]-$dat[0]";
   }else{
    $f_facturacion_picking1="0000-00-00";
   }

	//echo "f_despacho_picking1 $f_despacho_picking1<br>";
	$sqldespacho="SELECT * from paking where id_paking_relacion = $id_paking_relacion";
    $resultdespacho=mysql_query($sqldespacho);
	//$cuantosdespacho=mysql_num_rows($resultdespacho);
	//echo "cuantosdespacho $cuantosdespacho";
      
	
   while ($rowdespacho=mysql_fetch_array($resultdespacho))
	{ 
	 $id_etiquetados_foliospicking = $rowdespacho[id_etiquetados_folios];
     $sq_up_piking="update paking set fdespacho_piking  = '$f_despacho_picking1', ffacturacion_piking  = '$f_facturacion_picking1' where id_paking_relacion = $id_paking_relacion";
	 $rest_up_piking=mysql_query($sq_up_piking);
	 //echo "sq_up_piking $sq_up_piking<br>";
     $sq_up_etf=" update etiquetados_folios set id_destinos='$id_destinos', factura='$factura', guia='$guia', fdespacho_piking ='$f_despacho_picking1', ffacturacion_piking ='$f_facturacion_picking1', glosa='$glosa', id_estado_folio='$id_estado_folio' where id_etiquetados_folios = $id_etiquetados_foliospicking ";
	 $rest_up_etf=mysql_query($sq_up_etf);
	 //echo "<br>sq_up_etf $sq_up_etf";
    }// while ($rowdespacho=mysql_fetch_array($resultdespacho)){
		

		
   }//if($id_estado_folio == 3){
   
 if($despachar){
//echo "if($despachar_x and $id_estado_folio == 7 and $id_destinos){";
     
   if($f_despacho_picking){
   $dat2=split(" ",$f_despacho_picking);
   $dat=split("-",$dat2[0]);
   $f_despacho_picking1="$dat[2]-$dat[1]-$dat[0]";
   }else{
    $f_despacho_picking1="0000-00-00";
   }

   if($f_facturacion_picking){
   $dat2=split(" ",$f_facturacion_picking);
   $dat=split("-",$dat2[0]);
   $f_facturacion_picking1="$dat[2]-$dat[1]-$dat[0]";
   }else{
    $f_facturacion_picking1="0000-00-00";
   }
   
   
  
   $sqldespacho="SELECT * from paking where folio_piking = $folio_piking and id_paking_relacion = $id_paking_relacion";
   $resultdespacho=mysql_query($sqldespacho);
      
    while ($rowdespacho=mysql_fetch_array($resultdespacho)){ 
	$id_etiquetados_foliospicking = $rowdespacho[id_etiquetados_folios];
 
    $sq_up_piking="update paking set fdespacho_piking  = '$f_despacho_picking1', ffacturacion_piking  = '$f_facturacion_picking1' where id_paking_relacion = $id_paking_relacion";
	$rest_up_piking=mysql_query($sq_up_piking);
    
if ($f_facturacion_picking1 == "0000-00-00" ) {
   
  $sq_up_etf=" update etiquetados_folios set id_estado_folio = '7', id_destinos='$id_destinos', factura='$factura',guia='$guia',fdespacho_piking ='$f_despacho_picking1', ffacturacion_piking ='$f_facturacion_picking1', glosa='$glosa' where id_etiquetados_folios =$id_etiquetados_foliospicking ";
}else{
  $sq_up_etf=" update etiquetados_folios set id_estado_folio = '12', id_destinos='$id_destinos', factura='$factura',guia='$guia',fdespacho_piking ='$f_despacho_picking1', ffacturacion_piking ='$f_facturacion_picking1', glosa='$glosa' where id_etiquetados_folios =$id_etiquetados_foliospicking ";
}

	$rest_up_etf=mysql_query($sq_up_etf);
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

	$sql="update etiquetados_folios set calibre_alt='',nombre_alt='', contenido_alt='', peso1_alt='', peso2_alt='' where id_etiquetados_folios=$id_eti";
    $rest=mysql_query($sql);
	//echo "SQL $sql<br>";

   }
   
      if ($dat[0] == 'pallet')
   {
	 $id=$dat[1];
   	$pallet=$_POST["pallet-$id"];    

	$sql="update etiquetados_folios set calibre_alt='', nombre_alt='', contenido_alt='', peso1_alt='', peso2_alt='' where pallet=$pallet";
    $rest=mysql_query($sql);
	//echo "SQL $sql<br>";

   }
  }
}


$sql1="SELECT p.folio_piking AS folio_piking, p.fdespacho_piking  AS fdespacho_piking, p.ffacturacion_piking  AS ffacturacion_piking, p.pt_muestras AS pt_muestras, ef.factura AS factura, ef.guia AS guia, ef.glosa AS glosa, ef.id_estado_folio AS id_estado_folio, ef.id_destinos AS id_destinos, ef.id_pedidos as pedido from paking AS p, etiquetados_folios AS ef where p.id_paking_relacion = $id_paking_relacion and p.id_etiquetados_folios = ef.id_etiquetados_folios order by p.id_paking desc";
$rest1=mysql_query($sql1);
$cuantos1=mysql_num_rows($rest1);
//echo "cuantos1 $cuantos1<br>";


$sql2="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
		and	ef.id_caract_producto in (30) and ef.pallet != 0   
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios group by ef.pallet order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc ";
		$rest2=mysql_query($sql2);
		$cuantos2=mysql_num_rows($rest2);
//echo "cuantos2 $cuantos2<br>";

$sql33="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
		and	ef.id_caract_producto not in (30) 
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc ";
		$rest33=mysql_query($sql33);
		$cuantos33=mysql_num_rows($rest33);
//echo "cuantos33 $cuantos33<br>";

$ccccc = $cuantos2 + $cuantos33;

?>

<style type="text/css">
<!--

.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('jpg/cargando.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
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

<script type="text/javascript">
function apply()
{
document.form1.despachar.disabled=true;
if(document.form1.chk.checked==true)
{
document.form1.despachar.disabled=false;
}
if(document.form1.chk.checked==false)
{
document.form1.despachar.enabled=false;
}
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>

<div class="loader"></div>


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
    <td height="11" class="titulo">Despacho Picking</td>
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

<? if ($row=mysql_fetch_array($rest1)){ 
$f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
$f_despacho_picking =format_fecha_sin_hora($row[fdespacho_piking]);
$f_facturacion_picking =format_fecha_sin_hora($row[ffacturacion_piking]);
$id_estado_folio=$row[id_estado_folio];
$id_destinos=$row[id_destinos];
$pedido=$row[pedido];
//echo "id_estado_folio $id_estado_folio";
?>
<table width="623" border="0" align="center">
  <tr>
    <td colspan="2" nowrap="nowrap" class="titulo"><span class="titulo_grande">N&deg; Picking</span> <span class="titulo_grande"><? echo $row[folio_piking]?></span>,&nbsp;<span class="titulo_grande">asociado al Pedido</span><span class="titulo_grande"><a href="?modulo=pedido_modificar.php&id_ped=<?echo $pedido?>"><? echo $row[pedido]?></a></span></td>
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
               
                				
                <? //echo $row[id_estado_folio];
				//echo "->$id_estado_folio";
			    if($row[id_estado_folio] == 7 or $row[id_estado_folio] == 12){
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
                <?  // echo "id_destinos $id_destinos<br>";
                
              $cod_destino= $id_destinos;
              //echo "id_destinos $cod_destino<br>";  
			        $destinos= crea_destinos($link,$row[id_destinos]);
					echo $destinos;
					
				   //$id_destinos=$row[id_destinos];
				?>
              </span></td>
            </tr>
            <tr>
              <td height="22" class="titulo">Factura</td>
              <td width="86" class="titulo">Gu&iacute;a</td>
              </tr>
            <tr>
              <td class="titulo"><span class="cajas">
                <input name="factura" type="text" id="factura" onkeypress="solo_numeros()" value="<? echo $row[factura]?>" size="8" maxlength="10"/>
              </span></td>
              <td><span class="cajas">
                <input name="guia" type="text" id="guia" onkeypress="solo_numeros()" value="<? echo $row[guia]?>" size="8" maxlength="10" />
              </span></td>
              </tr>
              <tr>
              <td width="20" class="titulo">Fecha Despacho</td>
              <td><input name="f_despacho_picking" type="text" class="cajas" id="f_despacho_picking" value="<?echo $f_despacho_picking?>" size="10" maxlength="10" /> <a href="javascript:show_Calendario('form1.f_despacho_picking');" class="cajas" >Ver</a></td>
              <td width="6" class="titulo">Fecha Facturacion</td>
             <td><input name="f_facturacion_picking" type="text" class="cajas" id="f_facturacion_picking" value="<?echo $f_facturacion_picking?>" size="10" maxlength="10" /> <a href="javascript:show_Calendario('form1.f_facturacion_picking');" class="cajas" > Ver</a></td>
            </tr>
            <tr>
              <td colspan="3" class="titulo">Nota de Venta M3</td>
            </tr>
            <tr>
              <td colspan="4" class="titulo"><span class="cajas">
                <input name="glosa" type="text" id="glosa" value="<? echo $row[glosa]?>" size="43" maxlength="30" />
                </span></td>
            </tr>
            <tr>
              <td colspan="4" class="titulo">
                
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
            <tr>
              <td colspan="4" align="center" class="titulo"><input type="checkbox" name="chk" onClick="apply()">Muestras Sin Valor Comercial</td>
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
              <? if($id_etiqueta_idioma == 1){?>
               <tr>
                <td class="cajas">Peso Alt.
                  <label></label></td>
              </tr>
              <tr>
                <td class="cajas">Bruto<input name="peso1_alt" type="text" class="cajas" id="peso1_alt" size="3" maxlength="3" /> Neto<input name="peso2_alt" type="text" class="cajas" id="peso2_alt" size="3" maxlength="3" /></td>
              </tr>
              <?}?>
              <tr>
                <td class="cajas"><div align="center">
                   <? if($permiso38 == 1 and $nivel_usua == 2 or $nivel_usua == 1){?> <input name="modificar_all" type="submit" class="cajas" id="modificar_all" value="Modificar Producto" /><? }?>
                </div></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap"><span class="titulo">Nota:</span> <span class="cajas">Para poder Despachar el Picking debe estar ingresado el N&deg; de Factura, Fecha de Despacho y Fecha de Facturacion.</span></td>
    </tr>
 
<? if($id_estado_folio == 3 and $row[factura] and $f_despacho_picking != "00-00-0000" and $permiso38 == 1){?>


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
   
   
   <? } ?>
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

</br></br>

                                                                        <!-- iconos -->

                                                              <!-- ********** idioma 1  *******  -->

<table align="center" border="0">
  <tr align="center">

<? if($id_destinosotro ==3 or $id_destinosotro ==64 or $id_destinosotro ==210) {?>    
    
<td><a href="javascript:Abrir_ventana('etiqueta_espanol_2.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>

<td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>

<td><img src="ico/excel.png" width="80%" border="0" /></td>

<?if ($id_destinosotro ==3) {?>
   <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_agrimares.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}elseif ($id_destinosotro ==64) {?>
  <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_blancasing.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}elseif ($id_destinosotro ==210) {?>
  <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_delorenzi.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}?>
  <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
  
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
  <?if ($id_destinosotro ==3 or $id_destinosotro ==64 or $id_destinosotro ==210) {?>  
  <td>Adicional</td> <?}?>
  <td>IAP</td>
</tr>
</table>

<?}elseif($id_destinosotro ==104){?>

<table align="center" border="0">
  <tr align="center">
    
    <td><a href="javascript:Abrir_ventana('etiqueta_espanol.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>
    
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_4.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
    
    <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>    

    <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
  <td>IAP</td>
</tr>
</table>

<?}elseif($id_destinosotro ==324){?>

<table align="center" border="0">
  <tr align="center">
    
    <td><a href="javascript:Abrir_ventana('etiqueta_espanol.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>
    
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
    
    <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>    

    <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
  <td>IAP</td>
</tr>
</table>

<?}elseif($id_destinosotro ==314 or $id_destinosotro ==428 or $id_destinosotro ==358 or $id_destinosotro ==364 or $id_destinosotro ==361 or $id_destinosotro ==178 or $id_destinosotro==452 or $id_destinosotro ==368 or $id_destinosotro ==310 or $id_destinosotro ==341 or $id_destinosotro ==439){?>

<table align="center" border="0">
  <tr align="center">
    
    <td><a href="javascript:Abrir_ventana('etiqueta_espanol2.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>

    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_1.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>

    <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>

<?if ($id_destinosotro!=452) {?>
 <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_agrosuper.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}?>
    <td><a href="?modulo=informes_folios_aprobacion_partida_html2.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
<?if ($id_destinosotro!=452) {?>
  <td>Adicional</td>  
<?}?>  
  <td>IAP</td>
</tr>
</table>

<?}elseif ($id_etiqueta_idioma ==1 && $id_destinosotro) {?>

<table align="center" border="0">
  <tr align="center">
    
    <td><a href="javascript:Abrir_ventana('etiqueta_espanol_1.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>

<?if ($id_destinosotro ==276 or $id_destinosotro ==372 or $id_destinosotro ==176 or $id_destinosotro ==189 or $id_destinosotro ==453 or $id_destinosotro ==446) {?>
    
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
<?}else{?>    
    
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_1.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
<?}?>    
    <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>    

<?if ($id_destinosotro ==453) {?>
   <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_agrimares.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}?>

    <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
<?if ($id_destinosotro ==453) {?>
  <td>Adicional</td>  
<?}?>  
  <td>IAP</td>
</tr>
</table>
<?}?>




                                                    <!-- ********** idioma 3  *******  -->


                                                    

<? if($id_destinosotro ==253){?>

<table align="center" border="0">
  <tr align="center">
    
    <td><a href="javascript:Abrir_ventana('etiqueta_portugues1.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
    <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>
    
    <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_brc.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
    
    <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
  <td>Adicional</td> 
  <td>IAP</td>
</tr>
</table>

<?}elseif ($id_etiqueta_idioma ==3 && $id_destinosotro ){?>

<table align="center" border="0">
  <tr align="center">
    
    <td><a href="javascript:Abrir_ventana('etiqueta_portugues.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>

<?if ($id_destinosotro ==14 or $id_destinosotro ==331) {?>
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
<?}else{?>
    <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>
<?}?>
    <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>

<?if ($id_destinosotro ==14) {?>
    <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_frimesa.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?>')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}elseif ($id_destinosotro ==331){?>
    <td><a href="javascript:Abrir_ventana('informes_pdf/etiqueta_pamplona.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?>')"><img src="ico/adic.png" width="80%" border="0" /></a></td>
<?}?>

    <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a></td>        
  </tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiquetas</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
<?if ($id_destinosotro ==14 or $id_destinosotro ==331) {?>  <td>Adicional</td> <?}?>  
  <td>IAP</td>
</tr>
</table>
<?}?>


<tr>
<td colspan="2" class="titulo">
<!--
<? if(($id_destinosotro == 178 or $id_destinosotro == 372 or $id_destinosotro == 358 or $id_destinosotro == 341) and $id_etiqueta_idioma == 1){?>  
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_espanol2.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;bultos=<? echo $ccccc ?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;desde=<? echo $desde?>&amp;hasta=<? echo $hasta?>&amp;id_etiqueta_idioma=<? echo $id_etiqueta_idioma?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas Agrosuper</a></div>          
      <? }?>           

 <? if($id_destinosotro and $id_etiqueta_idioma == 2){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ingles.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&id_us=<? echo $id_insuban?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

<? if($id_destinosotro and $id_etiqueta_idioma == 3){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_portugues.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

<? if($id_destinosotro == 253 and $id_etiqueta_idioma == 3){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_portugues1.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiqueta_BRC_1</a></div>
      <? }?>

<? if($id_destinosotro == 253 and $id_etiqueta_idioma == 3){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_portugues2.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiqueta_BRC_2</a></div>
      <? }?>      

      <? if($id_destinosotro == 311 and $id_etiqueta_idioma == 3){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_portugues311.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

      <? if($id_destinosotro == 312 and $id_etiqueta_idioma == 3){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_portugues312.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas" width="35" height="39" border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>
-->

      <? if($id_destinosotro==207 or $id_destinosotro==305 or $id_destinosotro==247 and $id_etiqueta_idioma == 4){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ruso_207.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

      <? if($id_destinosotro==249 and $id_etiqueta_idioma == 4){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ruso_249.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

       <? if($id_destinosotro==190 and $id_etiqueta_idioma == 4){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ruso_190.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

       <? if($id_destinosotro==265 and $id_etiqueta_idioma == 4){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ruso_265.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

       <? if($id_destinosotro==267 and $id_etiqueta_idioma == 4){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ruso_267.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>

<? if($id_destinosotro==445 and $id_etiqueta_idioma == 4){?>

<div> 
<table>
  <tr align="center">
     <td> <a href="javascript:Abrir_ventana('etiqueta_ruso_445.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="ico/imprimir.png" width="80%" border="0" /></a></td>
                                    
      <td><a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')"><img src="ico/pdf.png" width="80%" border="0" /></a></td>

      <td><a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')"><img src="ico/excel.png" width="80%" border="0" /></a></td>      
                   
      <td><a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas"><img src="ico/iap.png" width="80%" border="0" /></a><td>
</tr>
<tr align="center" style="font-family: Helvetica; font-size:10px ;" >
  <td>Etiqueta</td>
  <td>Trazabilidad</td>
  <td>Excel</td>
  <td>IAP</td>  
</tr>
</table>
</div>
      <?}?>


       <? if($id_destinosotro==275 and $id_etiqueta_idioma == 4){?>
      <div align="center"> <a href="javascript:Abrir_ventana('etiqueta_ruso_275.php?id_paking_relacion=<? echo $id_paking_relacion ?>&amp;bultos=<? echo $ccccc ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;folio_piking=<? echo $row[folio_piking]?>&amp;ini=<? echo $ini?>&amp;fin=<? echo $fin?>&otro=<? echo $otro?>')"><img src="jpg/impresora.jpg" alt="Etiquetas"  border="0" /><br />
        Imprimir Etiquetas</a></div>
      <? }?>
      </td>
  </tr>

<!--
  <tr>
    <td colspan="2">
	<? if($id_destinosotro) {?>
    <table width="180" height="25" border="0" align="right">
      <tr>
        <td width="205"><div align="right" class="cajas">
            <div align="center">
      <? $id=$_SESSION['id_insuban']?>
            <? if($id_producto222 != 88 and ($id_destinosotro == 132 or $id_destinosotro <> 372 or $id_destinosotro == 178 or $id_destinosotro == 253 or $id_destinosotro == 331 )){?>   
            
            Informes de Trazabilidad
            <br>
            <a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad2.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">PDF_BRC_Pamplona</a>
            <br> 
             <a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')">Excel</a><? } ?>
            </div>
        </div></td>
      </tr>
      <tr>
        <td width="205"><div align="right" class="cajas">
            <div align="center">
			<? $id=$_SESSION['id_insuban']?>
            <? if($id_producto222 != 88 and $id_destinosotro <> 132 or $id_destinosotro == 372 or $id_destinosotro <> 178 or $id_destinosotro <> 253 or $id_destinosotro <> 331 or $id_destinosotro == 351){?>
            
            Informes de Trazabilidad  
            <br>            
            <a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">PDF</a>
            <br>
             <a href="javascript:Abrir_ventana('informes_excel/imprimir_informes_trazabilidad_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;id_destinos=<? echo $id_destinosotro?>')">Excel</a><? } ?>
            </div>
        </div></td>
      </tr>
<tr>
  <td><div align="center" >
    Reporte Packing List
    <br>
    <a href="javascript:Abrir_ventana('informes_pdf/imprimir_packinglist.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Packing List</a>             
  </div></td>
</tr>

<?if ($id_destinosotro == 351 or $id_destinosotro == 253 ) {?>
<tr>
  <td><div align="center">
    Etiqueta Adicional
    <br>
    <a href="javascript:Abrir_ventana('informes_pdf/etiqueta_brc.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Etiqueta Adicional</a>             
  </div></td>
</tr> 
<?}?>
<?if ($id_destinosotro == 331) {?>
<tr>
  <td><div align="center">
    Etiqueta Adicional
    <br>    
    <a href="javascript:Abrir_ventana('informes_pdf/etiqueta_pamplona.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Etiqueta Adicional</a>             
  </div></td>
</tr> 
<?}?>
<?if ($id_destinosotro == 3) {?>
<tr>
  <td><div align="center">
    Etiqueta Adicional
    <br>    
    <a href="javascript:Abrir_ventana('informes_pdf/etiqueta_agrimares.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Etiqueta Adicional</a>             
  </div></td>
</tr> 
<?}?>
<?if ($id_destinosotro == 210) {?>
<tr>
  <td><div align="center">
    Etiqueta Adicional
    <br>    
    <a href="javascript:Abrir_ventana('informes_pdf/etiqueta_delorenzi.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Etiqueta Adicional</a>             
  </div></td>
</tr> 
<?}?>
<?if ($id_destinosotro == 64) {?>
<tr>
  <td><div align="center">
    Etiqueta Adicional
    <br>    
    <a href="javascript:Abrir_ventana('informes_pdf/etiqueta_blancasing.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Etiqueta Adicional</a>             
  </div></td>
</tr> 
<?}?>
<?if ($id_destinosotro == 14) {?>
<tr>
  <td><div align="center">
    Etiqueta Adicional
    <br>    
    <a href="javascript:Abrir_ventana('informes_pdf/etiqueta_frimesa.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Etiqueta Adicional</a>             
  </div></td>
</tr> 
<?}?>

<? if($id_destinosotro == 253 or $id_destinosotro == 372 or $id_destinosotro == 178 or $id_destinosotro == 396){?>
    <tr>
        <td><div align="center">
          IAP
          <br>
          <a href="?modulo=informes_folios_aprobacion_partida_html2.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas">Imprimir Aprobaci&oacute;n de Partida_Especial </a></div></td>
      </tr>
<?}else{?>
<tr>
        <td><div align="center">
          IAP
          <br>
          <a href="?modulo=informes_folios_aprobacion_partida_html.php&id_etiqueta_idioma=<?echo $id_etiqueta_idioma?>&cantifo=<? echo $ccccc?>&id_destinos=<? echo $id_destinosotro?>&amp;id_paking_relacion=<?echo $id_paking_relacion?>&fdespacho_piking=<?echo $fdespacho_piking?>&cantidad_kilos=<? echo $cantidad_kilos?>&folio_piking=<? echo $row[folio_piking]?>&id_producto222=<? echo $id_producto222?>" target="_blank" class="cajas">Imprimir Aprobaci&oacute;n de Partida </a></div></td>
      </tr>
<?}?>
  
  <tr>
        <td align="center" class="cajas">
        <? if($id_producto222 == 88){?>
        <a href="javascript:Abrir_ventana('informes_pdf/imprimir_informes_trazabilidad_mucosa.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&id=<? echo $id?> ')">Trazabilidad Mucosa</a> <a href="informes_pdf/imprimir_informes_trazabilidad_mucosa_excel.php?id_paking_relacion=<?echo $id_paking_relacion?>&amp;cantifo=<? echo $ccccc?>&amp;factura=<? echo $row[factura] ?>&amp;id_destinos=<? echo $id_destinosotro?>&amp;id=<? echo $id?>" target="_blank"><img src="jpg/icono-excel.gif" width="19" height="19" border="0" /></a><? }?></td>
      </tr>
    </table>
	<? } ?></td>
  </tr>
</table>
<? } ?>
-->

<br>
<table width="899" border="0" align="center">
<tr>
<td width="893">
 <div align="left" class="cajas"><a href="javascript:seleccionar_todor()">Seleccionar Todo</a> / <a href="javascript:deseleccionar_todor()">Deseleccionar Todo</a></div>
</td>
</tr>
  <tr>
     <td><table width="882" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="20" nowrap="nowrap" bgcolor="#E7E4E4" class="cajas">&nbsp;N&deg; Picking </td>
        <td height="20" nowrap="nowrap" bgcolor="#E7E4E4" class="cajas">&nbsp;</td>
        <td height="20" nowrap="nowrap" bgcolor="#E7E4E4" class="cajas">&nbsp;</td>
        <td height="20" nowrap="nowrap" bgcolor="#E7E4E4" class="cajas">&nbsp;</td>
        <td width="6%" bgcolor="#E7E4E4" class="titulo_grande">&nbsp;<span class="titulo"><? echo $row[folio_piking]?></span> <input name="folio_piking" type="hidden" id="folio_piking" value="<?echo $row[folio_piking]?>" /></td>
        <td width="5%" bgcolor="#E7E4E4" class="titulo_grande">&nbsp;</td>
        <td bgcolor="#E7E4E4" ><div align="right" class="cajas">&nbsp;Cantidad de Folios&nbsp;</div></td>
        <td colspan="6" bgcolor="#E7E4E4" class="titulo_grande">&nbsp;<span class="titulo"><? echo $cantifo;?></span></td>
        </tr>
      <tr>
        <td width="6%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Contador</td>
        <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Cod</td>
        <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center"> Folio PT</div></td>
        <td width="5%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio Antiguo</td>
        <td bgcolor="#CCCCCC" class="titulo"><div align="center">F/Elaboraci&oacute;n</div></td>
        <td bgcolor="#CCCCCC" class="titulo"><div align="center">F/T&eacute;rmino</div></td>        
        <td bgcolor="#CCCCCC" class="titulo">Especie</td>
        <td width="27%" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto <a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a></td>
        <td width="9%" bgcolor="#CCCCCC" class="titulo"><div align="center">Calibre</div></td>
        <td width="7%" bgcolor="#CCCCCC" class="titulo"><div align="center">Medida</div></td>
        <td width="8%" bgcolor="#CCCCCC" class="titulo"><div align="center">Carac/Prod</div></td>
        <td width="5%" bgcolor="#CCCCCC" class="titulo"><div align="center">Cant.</div></td>
<!--        <td width="6%" bgcolor="#CCCCCC" class="titulo"><div align="center">Proced.</div></td> -->
        <td width="8%" bgcolor="#CCCCCC" class="titulo">&nbsp;<div align="center"><input name="eliminar_nom_alter" type="submit" class="cajas" id="eliminar_nom_alter" value="X" /></div>	
        </td>
      </tr>
      <? 

/*  list */
	
		$sql="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
/*		and	ef.id_caract_producto not in (25,30)  **MODIFICACION PALLET ** */
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios  
/*  order by ef.nombre_alt, ef.calibre_alt, ef.id_cruce_tablas, ef.id_etiquetados_folios asc	*/
order by ef.nombre_alt, ef.calibre_alt, ef.id_etiquetados_folios asc";
//order by ef.nombre_alt, ef.calibre_alt, ef.id_cruce_tablas asc   

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
        $f_termino=format_fecha_sin_hora($r[f_termino]);        
			$fdespacho_piking =format_fecha_sin_hora($r[fdespacho_piking]);
			$id_etiquetados_folios = $r[id_etiquetados_folios];
			$folio_m3 = $r[folio_m3];
			$folio_pt_antiguo = $r[folio_pt_antiguo];
	   $i=0; 
			
			
		?>
      <tr>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $cont?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $id_cruce_tablas?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
          <input name="id_etiquetados_folios[]" type="hidden" id="id_etiquetados_folios" value="<?echo $r[id_etiquetados_folios]?>" /><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $r[folio_m3]?>"><?echo $folio_m3?></a></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $id_etiquetados_folios?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $f_elaboracion?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $f_termino?></td>        
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
<!--        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
          <div align="center">
            <? if($r[id_procedencia] == 'I'){
          echo "Importado";
         }
		  if($r[id_procedencia] == 'N'){
         echo "Nacional";
		 }?>
          </div></td> -->
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">
		<div align="center">&nbsp;
		<? if ($r[nombre_alt] != '' or $r[nombre_alt] != '') { ?>
<!--        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->		
<!--<? //if($permiso38 == 1 and $nivel_usua == 1){?>
        <a href="?modulo=ver_piking_folios_nombre.php&eliminar=1&id_etiquetados_folios=<?echo $r[id_etiquetados_folios]?>&id_paking_relacion=<? //echo $id_paking_relacion?>"><img src="jpg/eliminar_click.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" /></a>
		<? //}else{
			?>
		<img src="jpg/eliminar_click_gris.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" />
		<? //}?>
        <? //}else{ ?>
  		<img src="jpg/eliminar_click_gris.png" alt="Eliminar Nombre Alternativo" width="20" height="21" border="0" />
-->         
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

<!--     modificacion pallet ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
<?
$sqlv="SELECT SUM(ef.contenido_unidades) AS contenido_unidadesp, SUM(ef.contenido_alt) AS contenido_altp,ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_cruce_tablas AS id_cruce_tablasv, ef.nombre_alt AS nombre_alt, ef.id_producto AS id_producto, pro.producto AS producto, ef.calibre_alt AS calibre_alt, c.calibre AS calibre, mp.medidas_productos AS medidas_productos, cpro.caract_producto AS caract_producto, ef.id_procedencia AS id_procedencia, ef.pallet AS pallet, ef.id_pedidos AS id_pedidos FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto AS cpro where 
		p.id_paking_relacion=$id_paking_relacion
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
	and	ef.id_caract_producto not in (25,30)   modificacion pallet 
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios group by ef.pallet order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc";
		$restv=mysql_query($sqlv);
		$cuantosv=mysql_num_rows($restv);
		//echo "sqlv $sqlv<br>";
?>
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
   <?
   	$contv=$cont++;
      if($cuantosv){
		  
		    $color = "#000000";$i = 0;
		    while ($rv=mysql_fetch_array($restv)){ 
			$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
			//$cont++;
			$id_cruce_tablasv = $rv[id_cruce_tablasv];
			$id_pedidosv = $rv[id_pedidos];
	   	$f_elaboracionv=format_fecha_sin_hora($rv[f_elaboracion]);
			$fdespacho_pikingv =format_fecha_sin_hora($rv[fdespacho_piking]);
	        $i=0;
			$contv=$contv + 1;
			
	  
	  ?>
      <tr>
   
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $contv?></div></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;<? echo $id_cruce_tablasv?></td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><div align="center">
        <a href="?modulo=modificar_pallet.php&amp;pallet=<?echo $rv[pallet]?>&id_cruce_tablasok=<? echo $id_cruce_tablasv?>&viene=22&id_pedidosvv=<? echo $id_pedidosv?>"><? echo $r[cf]?>P/<?echo $rv[pallet]?> 
          
          <?
           $sqlss="SELECT *  from  pallet where pallet = $rv[pallet] ";
		   $restss=mysql_query($sqlss);
		   $cuantosss=mysql_num_rows($restss);
		   echo "[$cuantosss]";
		   ?>
        <input name="id_etiquetados_folios[]" type="hidden" id="id_etiquetados_folios" value="<?echo $rv[id_etiquetados_folios]?>" /><a href="?modulo=ejemplo_etiquetas_folios.php&id_etf2=<?echo $rv[id_etiquetados_folios]?>"></a></div> </td>
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas">&nbsp;</td>
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
        <td nowrap="nowrap" bgcolor="<? echo $color?>" class="cajas"><input name="pallet[]" type="checkbox" id="pallet[]" value="<?echo $rv[pallet]?>" />
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
			if ($rv[contenido_altp] == 0) {
				$contenido_unidadesp=$rv[contenido_unidadesp];
				echo "$contenido_unidadesp";
			}else{
				$contenido_altp=$rv[contenido_altp];
				echo "$contenido_altp";
				
			}
			?></td>
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
      
     +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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

    </form></td>
  </tr>
</table>
<!-- <table width="30" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td> -->
    <a href="folios_piking_excel.php?id_paking_relacion=<? echo $id_paking_relacion?>" target="_blank"><img src="jpg/icono-excel.gif" width="30" height="30" border="0" align="center"/></a></td>
<!--   </tr>
</table> -->