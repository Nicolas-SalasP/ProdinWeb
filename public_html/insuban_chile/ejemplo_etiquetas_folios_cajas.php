<? 



/*
if(!$op) $op=0;
if($buscar){

 //$largo=strlen($dato);
 //$newano=substr($dato, 0, 2);
 //$newano="20".$newano;
 //$dato=substr($dato, 2, $largo);
 $id_etf2=$dato;
}
*/
if($buscar){

 //$largo=strlen($dato);
	 //$newano=substr($dato, 0, 2);
	 //$newano="20".$newano;
	 //$dato=substr($dato, 2, $largo);

$id_etf2=$dato;


}
ini_set('memory_limit', '-1');
if($id_etf2){
$sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios ='$id_etf2' and id_estado_folio != 11";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios=id_etiquetados_folios and id_etiquetados_folios != 0  order by id_etiquetados_folios desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

if(!$op) $op=0; 
$sql="SELECT * FROM etiquetados_folios  WHERE id_etiquetados_folios=id_etiquetados_folios and id_etiquetados_folios != 0  and ano >= 2009 order by id_etiquetados_folios desc  LIMIT $op ,1";
$result=mysql_query($sql);
}


$sql_ultimo="SELECT * FROM etiquetados_folios AS ef WHERE ef.id_etiquetados_folios=ef.id_etiquetados_folios order by  ef.id_etiquetados_folios desc LIMIT 0,1";
$result_ultimo=mysql_query($sql_ultimo);

$fila=mysql_fetch_array($result_ultimo);
$s=$fila[id_etiquetados_folios] + 1;

 $ante=$op - 1;
 $next=$op + 1;
 $ultimo=$cuantos - 1;



 //$fhoy=date("Y"); 
 

if($modificar){

//echo "modificar";
  $dat2=split(" ",$f_elaboracion);
  $dat=split("-",$dat2[0]);
  $f_elaboracion="$dat[2]-$dat[1]-$dat[0]";
  
   $dat3=split(" ",$f_inicio);
  $dat1=split("-",$dat3[0]);
  $f_inicio="$dat1[2]-$dat1[1]-$dat1[0]";
  
  $dat4=split(" ",$f_termino);
  $dat6=split("-",$dat4[0]);
  $f_termino="$dat6[2]-$dat6[1]-$dat6[0]";
  
   $dat8=split(" ",$f_vencimiento);
   $dat7=split("-",$dat8[0]);
   $f_vencimiento="$dat7[2]-$dat7[1]-$dat7[0]";
 
    
	if($codigo)	   
	{
	$sql_busca_codigo="SELECT * FROM cruce_tablas where id_cruce_tablas  ='$codigo'";
	$result_busca_codigo=mysql_query($sql_busca_codigo);
	$cuantos_busca_codigo=mysql_num_rows($result_busca_codigo);
	if($cuantos_busca_codigo != 0){
	 if ($rowbc=mysql_fetch_array($result_busca_codigo))
      { 
	  $codigo = $rowbc[id_cruce_tablas];
	  $id_especie = $rowbc[id_especie];
	  $id_producto = $rowbc[id_producto];
	  $id_calibre = $rowbc[id_calibre];
	  $id_unidad_medida = $rowbc[id_unidad_medida];
	  $id_medidas_productos = $rowbc[id_medidas_productos];
	  $id_caract_producto = $rowbc[id_caract_producto];
	  $id_caract_envases= $rowbc[id_caract_envases];
	  }
	}
	
	}
					   
$sql_modificar="UPDATE  etiquetados_folios set id_producto=$id_producto,id_calibre=$id_calibre,id_medidas_productos=$id_medidas_productos,id_caract_envases=$id_caract_envases,id_caract_producto=$id_caract_producto,id_especie=$id_especie,id_unidad_medida=$id_unidad_medida,id_cruce_tablas=$codigo,id_envases=$id_envases,id_origen=$id_origen,id_operarios=$id_operarios,compro_nro='$compro_nro', id_estado_folio='$id_estado_folio', id_etiquetas1='$id_etiquetas1', id_etiquetas2='$id_etiquetas2', id_etiquetas3='$id_etiquetas3',id_etiquetas4='$id_etiquetas4', contenido_unidades='$contenido_unidades', bidon_muestra_pt='$bidon_muestra_pt',f_elaboracion='$f_elaboracion', f_inicio='$f_inicio',f_termino='$f_termino', f_vencimiento='$f_vencimiento', id_procedencia = '$id_procedencia', notas='$notas', bidon_importado='$bidon_importado', guia_despacho_trazab = '$guia_despacho_trazab2', factura_trazab = '$factura_trazab', factura_importada = '$factura_importada' where id_etiquetados_folios=$id_etiquetados_folios";
//echo "MODIFICAR -> $sql_modificar";
$rest=mysql_query($sql_modificar);


 if($id_etf2){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=ejemplo_etiquetas_folios.php&id_etf2=$id_etf2\">";
 exit;
}else{
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=ejemplo_etiquetas_folios.php&op=$op\">";
exit;
 }

}// fin modificar_x


if($borrar){
$sql_modificar="UPDATE  etiquetados_folios set borrado=1, id_estado_folio = 5 where id_etiquetados_folios=$borrar";
$rest=mysql_query($sql_modificar);
$id_etf2=$borrar;
if($id_etf2){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=ejemplo_etiquetas_folios.php&id_etf2=$id_etf2\">";
 exit;
 }else{
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=ejemplo_etiquetas_folios.php&op=$op\">";
 exit;
 }

}// fin borrar

/*****************************************************

if($borrar_no){

$sql="delete from etiquetados_folios where  id_etiquetados_folios = $borrar";
$res=mysql_query($sql);
//echo $sql;

$sql="delete from folios_mat where  id_etiquetados_folios = $borrar";
$res=mysql_query($sql);

if ($id_mat) { 
 foreach ($id_mat as $key)
 {
 $sql="insert into folios_mat (id_etiquetados_folios,id_mat) values ($id_etiquetados_folios,$key)";
 $res=mysql_query($sql);
 }//fin for
}// if ($id_mat)

if($op == -1){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=ejemplo_etiquetas_folios.php&op=0\">";
 exit;
}


}
*/



?>
<? if($trazabilidad_x){?>
<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function acceptNum(evt){	
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
var key = nav4 ? evt.which : evt.keyCode;	
return (key >= 48 && key <= 57);
}

function fixElement(element, message) {
alert(message);
element.focus();
}

function isMailReady(form1) {
var passed = false;

if (document.form1.f_elaboracion.value > document.form1.f_inicio.value) {     
    alert('Fecha de Elaboracion debe ser menor a la Fecha de Inicio ');
    document.form1.f_elaboracion.onfocus;
    return false;
}

if (document.form1.f_elaboracion.value > document.form1.f_termino.value) {     
    alert('Fecha de Termino debe ser Mayor a la Fecha de Inicio ');
    document.form1.f_inicio.onfocus;
    return false;
}

if (document.form1.f_inicio.value > document.form1.f_termino.value) {     
    alert('Fecha de Termino debe ser Mayor a la Fecha de Inicio ');
    document.form1.f_termino.onfocus;
    return false;
}


if (document.form1.id_producto.value == '0') {     
    alert('Seleccione Producto');
    document.form1.id_producto.onfocus;
    return false;
}
if (document.form1.id_calibre.value == '0') {     
    alert('Seleccione Calibre');
    document.form1.id_calibre.onfocus;
    return false;
}
if (document.form1.id_medidas_productos.value == '0') {     
    alert('Seleccione Medidas');
    document.form1.id_medidas_productos.onfocus;
    return false;
}
if (document.form1.id_envases.value == '0') {     
    alert('Seleccione Envases');
    document.form1.id_envases.onfocus;
    return false;
}
if (document.form1.id_unidad_produccion.value == '0') {     
    alert('Seleccione Origen');
    document.form1.id_unidad_produccion.onfocus;
    return false;
}
if (document.form1.id_operarios.value == '0') {     
    alert('Seleccione Operarios');
    document.form1.id_operarios.onfocus;
    return false;
}
if (document.form1.id_etiquetas1.value == '0') {     
    alert('Seleccione Etiquetas');
    document.form1.id_etiquetas1.onfocus;
    return false;
}

if (document.form1.compro_nro.value == "") {     
    alert('Ingresar Nro Comprobante');
    document.form1.compro_nro.onfocus;
    return false;
}
if (document.form1.contenido_unidades.value == "") {     
    alert('Ingresar Contenido Unidades');
    document.form1.contenido_unidades.onfocus;
    return false;
}
if (document.form1.id_procedencia.value == '0') {     
    alert('Seleccione Procedencia');
    document.form1.id_procedencia.onfocus;
    return false;
}

if (document.form1.f_elaboracion.value == "") {     
    alert('Ingresar Fecha Elaboración');
    document.form1.f_elaboracion.onfocus;
    return false;
}
if (document.form1.f_inicio.value == "") {     
    alert('Ingresar Fecha Inicio');
    document.form1.f_inicio.onfocus;
    return false;
}
if (document.form1.f_termino.value == "") {     
    alert('Ingresar Fecha Termino');
    document.form1.f_termino.onfocus;
    return false;
}
if (document.form1.f_vencimiento.value == "") {     
    alert('Ingresar Fecha Vencimiento');
    document.form1.f_vencimiento.onfocus;
    return false;
}



else {
getInfo(form1);
passed = true;
}
return passed;
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</SCRIPT>
<? }?>
<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=yes,location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=yes, width=900, height=900, top=100, left=100"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript"> 
function Abrir_ventana_importada (pagina) { 
var opciones="toolbar=yes,location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=yes, width=500, height=200, top=100, left=100"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript"> 
function Abrir_ventana_alternativo (pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=500, height=200, top=100, left=100"; 
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
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style5 {color: #339933}
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.style11 {	color: #FF6600;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
window.onerror = null;
var bName = navigator.appName;
var bVer = parseInt(navigator.appVersion);
var NS4 = (bName == "Netscape" && bVer >= 4);
var IE4 = (bName == "Microsoft Internet Explorer"
&& bVer >= 4);
var NS3 = (bName == "Netscape" && bVer < 4);
var IE3 = (bName == "Microsoft Internet Explorer"
&& bVer < 4);
var blink_speed=100;
var i=0;
if (NS4 || IE4) {
if (navigator.appName == "Netscape") {
layerStyleRef="layer.";
layerRef="document.layers";
styleSwitch="";
}else{
layerStyleRef="layer.style.";
layerRef="document.all";
styleSwitch=".style";
}
}
//BLINKING
function Blink(layerName){
if (NS4 || IE4) {
if(i%2==0)
{
eval(layerRef+'["'+layerName+'"]'+
styleSwitch+'.visibility="visible"');
}
else
{
eval(layerRef+'["'+layerName+'"]'+
styleSwitch+'.visibility="hidden"');
}
}
if(i<1)
{
i++;
}
else
{
i--
}
setTimeout("Blink('"+layerName+"')",blink_speed);
}
//  End -->
</script>

<script language="JavaScript" type="text/javascript"> 
<!-- 
function Confirmar(form1) { 

var borrar = confirm("Estás seguro/a de que desea eliminar el registro?"); 

return borrar; //true o false 

} 
//--> 
</script> 

<form onSubmit = "return isMailReady(this);" id="form1folios" name="form1" method="post" action="">
  <table width="570" height="36" border="0" align="center">
    <tr>
      <td width="564" height="30"><span class="titulo Estilo1"> Etiquetado de Folios.</span></td>
    </tr>
    <tr>
      <td height="14"><div align="right"><span class="titulo">
        <? if($cuantos){?>
        Buscar Etiquetado Folios 
  <? }?>
  <? if($cuantos){?>
        <input name="dato" type="text" class="cajas" size="15" maxlength="50" />
        <? }?>
        <? if($cuantos){?>
        <input name="buscar" type="submit" class="cajas" value="Buscar" />
        <? }?>
      </span></div></td>
    </tr>
    <tr>
      <td valign="top"><? if(!$nuevo ){?>
       <?
	  while ($row=mysql_fetch_array($result))
      { 
	  $id_etiquetados_folios=$row[id_etiquetados_folios];
	  $id_origenn=$row[id_origen];
	  //echo " id_etiquetados_folios $id_etiquetados_folios";
	  $f_elaboracion=format_fecha_sin_hora($row[f_elaboracion]);
	  $fdespacho_piking=format_fecha_sin_hora($row[fdespacho_piking]);
	  $f_inicio=format_fecha_sin_hora($row[f_inicio]);
	  $f_termino =format_fecha_sin_hora($row[f_termino]);
	  $f_vencimiento=format_fecha_sin_hora($row[f_vencimiento]);
	  $codigo=$row[id_cruce_tablas];
	  $bidon_muestra_pt=$row[bidon_muestra_pt];
	  //$id_especie=$row[id_especie];
	  $valor_indice=$rowb[valor_indice];
      $id_tipo_calculo=$rowb[id_tipo_calculo];
	  $fbodega_mpi=format_fecha_sin_hora($row[fbodega_mpi]);
	  $freprocesado=format_fecha_sin_hora($row[freprocesado]);
	  $folioptnew_reproceso=$row[folioptnew_reproceso];
	  $folio_pt_antiguo=$row[folio_pt_antiguo];
	  //$id_calibre=$row[id_calibre];
	  //$id_unidad_medida=$row[id_unidad_medida];
	  //$id_medidas_productos=$row[id_medidas_productos];
	  //$id_caract_producto=$row[id_caract_producto];
	 // $id_caract_envases=$row[id_caract_envases];
	  $id_pedidos=$row[id_pedidos];
	  $id_estado_folio2=$row[id_estado_folio];
	   //$id_destinosv=$row[id_destinosv];
	  
	  
	  //echo "Codigo $codigo";
      $i++;
	  
      ?>
        <span class="titulo">
        <input name="id_etiquetados_folios" type="hidden" value="<?echo $row[id_etiquetados_folios]?>" />
		<? //echo "ief $id_etiquetados_folios";?>
        </span>
        <table width="600" border="1" align="center" bordercolor="#CCCCCC">
          <tr>
            <td><table border="0" align="center">
              <tr>
                <td width="144" rowspan="2" valign="top" class="titulo">
				<?
				 $sql="SELECT * FROM paking  where id_etiquetados_folios = $id_etiquetados_folios";
         			 $restsi=mysql_query($sql);
		 			 $cuantos_si=mysql_num_rows($restsi);
					  if($cuantos_si)
					 {
				?>
				<table width="131" height="38" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="36" class="style3"><div align="center">
                        <span class="titulo">Asignado al Picking N&deg;</span>
                        <span class="style5"><?
				
					
					 while ($rowbs=mysql_fetch_array($restsi))
					{ 
					 echo "$rowbs[folio_piking]";
					 }
					
					 
				?></span></div></td>
                    </tr>
                  </table><?  }?></td>
                <td><div align="center"><span class="numero">A&Ntilde;O <? echo substr($row[ano],0,4); ?> FOLIO <?echo $row[id_etiquetados_folios]?>
                      <? if($row[id_estado_folio] == 5){?>
                      <span class="style2">Folio Anulado </span>
                      <? }?>
                      <? 
					  if($folioptnew_reproceso and $freprocesado != '00-00-0000'){?>
                      <br><span class="style2">Folio Nuevo PT <? echo $folioptnew_reproceso?> </span>
                       <? 
					  //}else{?>
                      <!--<br><span class="style2">Folio antiguo Reprocesado <? //echo $folioptnew_reproceso?> </span>-->
                      <? }?>
                      <br>
                      </span><span class="cajas"><? if($folio_pt_antiguo){
						  //$largo=strlen($folio_pt_antiguo);
						 echo "Folio de Salado $folio_pt_antiguo"; 
					     }
						?>
                      
                </span></div></td>
                <td rowspan="2" valign="top">
				<? if($row[id_pedidos]){?>
				<table width="131" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="127"><div align="center"><span class="titulo">Asignado al Pedido N&deg;</span>
                    </div>
                      <div align="center" class="style3 style5">
					  <? 
					     $id_pedi=$row[id_pedidos];
					  if(($id_estado_folio2 != 3 and $id_estado_folio2 != 7) and ($permiso47 == 1 or $permiso47 == 2)) {?>
					  <a href="?modulo=etiquetados_folios_listar.php&id_ped=<?echo $id_pedi?>&id_destinosv=<? echo $id_destinosv?>&fecha_prioridad=<? echo $fecha_prioridad?>"><? echo "$row[id_pedidos]"?></a>
					  <? }else{?>
					  <? echo "$row[id_pedidos]";  ?></div>
					  <? }?>					  </td>
                  </tr>
                </table>
				<? }?>				</td>
              </tr>
              <tr>
                <td>&nbsp;<? $fecha_prioridad?></td>
                </tr>
              <tr>
                <td class="titulo">Codigo Interno </td>
                <td width="301">
				
				<input name="codigo" type="text" class="cajas" value="<?echo $codigo?>" size="8" maxlength="6" /><? //echo "$codigo";?>
				<? if($permiso34 == 1 and $nivel_usua == 1){?>
				<input name="vercod" type="submit" class="cajas" id="vercod" value="Modificar Codigo" />				
                <? }?>
                </td>
				
				<?
				
				if($vercod or $codigo)
				{
				//echo "toy dentro";
				$sqlb="SELECT  * from cruce_tablas where id_cruce_tablas = $codigo";
			    $resulbt=mysql_query($sqlb);
				$cuantosb=mysql_num_rows($resulbt);
				//echo "$sqlb";
				//echo "Cuantos $cuantosb";
				if($cuantosb){
				while ($rowb=mysql_fetch_array($resulbt))
				{ 
				$id_cruce_tablasb=$rowb[id_cruce_tablas];
				$id_especieb=$rowb[id_especie];
				$id_productob=$rowb[id_producto];
				$id_calibreb=$rowb[id_calibre];
				$id_unidad_medidab=$rowb[id_unidad_medida];
				$id_medidas_productosb=$rowb[id_medidas_productos];
				$id_caract_productob=$rowb[id_caract_producto];
				$id_caract_envasesb=$rowb[id_caract_envases];
				$id_estado_folio=$row[id_estado_folio];		
				$factura_trazab=$row[factura_trazab];		
				$guia_despacho_trazab=$row[guia_despacho_trazab];		
				$valor_indice=$rowb[valor_indice];
				$id_tipo_calculo=$rowb[id_tipo_calculo];
				}//echo "$id_especie - $id_producto - $id_calibre - $id_unidad_medida - $id_medidas_productos - $id_caract_producto - $id_caract_envases";
				}
				
				
				}
               				?>
				
                <td width="134" rowspan="3">
                 <? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197 and $codigo != 205){?>
                <div align="center">
				<? // original etiquetas_folios_print2.php?>
				<a href="javascript:Abrir_ventana('etiquetas_folios_print22222.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>')"><img src="jpg/impresora.jpg" width="35" height="39" border="0" /></a><span class="titulo"><br />
                  Imprimir Folios</span> </div>
                  <? } ?>
                  </td>
              </tr>
              
              <tr>
                <td height="9" class="titulo">Especie</td>
                <td>
		  <?
		  
		  $especie= crea_especie_codificacion($link,$id_especieb,1,1);
		  echo $especie;
		 
		  ?></td>
              </tr>
              <tr>
                <td height="9" class="titulo">Producto </td>
                <td><?
				  //$producto= crea_producto_onChange($link,$row[id_producto]);
		         // echo $producto;
				
				  ?>
                  <?  //echo "id producto $row[id_producto]";
		  //if($id_especie){
		  //$id_producto = $row[id_producto];
		  //echo "idproducto $id_producto";
		 // echo "idproducto $id_producto";
		// $calibre= crea_cruce_plant_calibre($link,$row[id_producto],$row[id_calibre]);
		// if($codigo){
		 //echo $id_productob;
		 $producto_especie= crea_producto_especie_codificacion($link,$id_especieb,$id_productob,1,1);
		 echo $producto_especie;	
		//}else{
		//$producto= crea_producto_onChange($link,$row[id_producto]);
		// echo $producto;
		// }
		 
		  //}
		  ?></td>
              </tr>
              <tr>
                <td class="titulo">Calibre</td>
                <td>
				<? 
	   // if($row[id_producto]){
		//$calibre=crea_calibre2($link,$row[id_calibre],$row[id_producto]);
		//echo $calibre;}?>
				<? 
		  //if($id_producto){
		  //echo "id_calibre $id_calibre";
		   //if($codigo){
		  // echo $id_calibreb;
		   $producto_calibre= crea_producto_calibre_codificacion($link,$id_productob,$id_calibreb,1,1);
		  echo $producto_calibre;
		  //}else{
		//$calibre=crea_calibre($link,$row[id_calibre],0);
		//echo $calibre;
		 //  }
		  ?></td>
                <td align="center" class="titulo">
                               <a href="javascript:Abrir_ventana_alternativo('nombre_alternativo_productos.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>')">Nombre Alternativo</a>
                
                </td>
              </tr>
              <tr>
                <td class="titulo">Unidad de Medida</td>
                <td><? //$medidas_productos=crea_medidas_productos($link,$row[id_medidas_productos]);
		//echo $medidas_productos;?> <?
		 // if($id_calibre){
		  //echo "id_unidad_medida $id_unidad_medida";
		  // if($codigo){
		 //echo $id_unidad_medidab;
		 $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_productob,$id_unidad_medidab,1,1);
		 echo $producto_unidad_medida;
		//  }else{
		   //$medidas_productos=crea_medidas_productos($link,$row[id_medidas_productos],0);
		//echo $medidas_productos;
		 
		 //}
		 // }
		  ?></td>
                <td class="titulo"><!--Cond: <? 
	    //if($row[id_producto]){
		//$calibre=crea_calibre_condicion($link,$row[id_calibre],$row[id_producto]);
		//echo $calibre;}?>-->
                  Notas</td>
              </tr>
              <tr>
                <td class="titulo"> Medida </td>
                <td><? 
				
				 //echo "id_medidas_productos $id_medidas_productos";
		  //if($id_unidad_medida){
		  //echo $id_medidas_productosb;
		 $producto_medida= crea_producto_medida_codificacion($link,$id_productob,$id_medidas_productosb,1,1);
		 echo $producto_medida;
		  //}
		  ?></td>
                <td rowspan="4" class="titulo"><textarea name="notas" cols="20" rows="6" class="cajas" id="notas"><? echo $row[notas];?></textarea></td>
              </tr>
              <tr>
                <td class="titulo">Caract. Producto </td>
                <td><? 
		 // if($id_medidas_productos){
		  //echo $id_caract_productob;
		  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_productob,$id_caract_productob,1,1);
		  echo $producto_caract_producto;
		  //}
		  ?></td>
                </tr>
              <tr>
                <td class="titulo">Caract. Envase </td>
                <td><? 
		  //if($id_caract_producto){
		   //echo $id_caract_envasesb;
		  $producto_caract_producto= crea_producto_caract_envases($link,$id_productob,$id_caract_envasesb,1,1);
		  echo $producto_caract_producto;
		 // }
		  ?></td>
                </tr>
              <tr>
                <td colspan="2" class="titulo">&nbsp;</td>
                </tr>
              <tr>
                <td class="titulo">Envase</td>
                <td colspan="2"><? $envases=crea_envases($link,$row[id_envases]);
		echo $envases;?> <? //echo "$id_estado_folio=$row[id_estado_folio];"?></td>
              </tr>
              <tr>
                <td class="titulo">Origen</td>
                <td colspan="2">
				<? 
			$origen=crea_origenes($link,$row[id_origen]);
		echo $origen;
				?></td>
              </tr>
              <tr>
                <td colspan="3" class="titulo">
                <? if($codigo != 181 and $codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205 and $codigo != 220){?>
                <table width="584" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="148" class="titulo">N&deg; Factura Importada</td>
                    <td width="136"><input name="factura_importada" type="text" class="cajas" value="<?echo $row[factura_importada]?>" /></td>
                    <td width="138"><div align="center"><span class="titulo">N&ordm; Bidon Importado</span></div></td>
                    <td width="162"><input name="bidon_importado" type="text" class="cajas" id="bidon_importado" value="<?echo $row[bidon_importado]?>" /></td>
                  </tr>
                </table>
                <? } ?>
                <? if($codigo == '181' or $codigo =='220'){ ?>
                  <table width="584" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="149" class="titulo">N&deg; Factura </td>
                      <td width="148"><input name="factura_trazab" type="text" class="cajas" id="factura_trazab" value="<?echo $row[factura_trazab]?>" /></td>
                      <td width="125"><div align="center" class="titulo">N&deg; Guia Despacho</div></td>
                      <td width="162"><input name="guia_despacho_trazab2" type="text" class="cajas" id="guia_despacho_trazab2" value="<?echo $row[guia_despacho_trazab]?>" /></td>
                    </tr>
                  </table>
                  <? }?>
                   <? if($codigo == 201 or $codigo == 202 or $codigo == 203 or $codigo == 204 or $codigo == 197  or $codigo == 205){?>
                  <table width="584" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="149" class="titulo">N&deg; Guia Despacho</td>
                      <td width="148"><input name="guia_despacho" type="text" class="cajas" id="guia_despacho" value="<?echo $row[guia_despacho]?>" /></td>
                      <td width="125"><div align="center" class="titulo">Cantidad Envase</div></td>
                      <td width="162"><input name="n_bandeja" type="text" class="cajas" id="n_bandeja" value="<?echo $row[n_bandeja]?>" /></td>
                    </tr>
                  </table>
                  <? }?>
                  </td>
                </tr>
              <tr>
                <td colspan="3"><table width="587" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="148" class="titulo">
					
					  <? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>
Fecha de Elab.
  <? }else{?>
Fecha de Recepci&oacute;n.
<? }

					   ?></td>
                      <td width="164">
                      
                      <input name="f_elaboracion" type="text" class="cajas"   id="f_elaboracion"  value="<?echo $f_elaboracion?>" size="10" maxlength="10" />
                        <a href="javascript:show_Calendario('form1.f_elaboracion');" class="cajas" >Ver</a>
						</td>
                      <td width="187">&nbsp;</td>
                      <td width="88" rowspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="titulo"><? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>Fecha Inicio <? }?></td>
                      <td>
                      <? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>
                      <input name="f_inicio" type="text" class="cajas"   id="f_inicio"  value="<?echo $f_inicio?>" size="10" maxlength="10" />
                        <a href="javascript:show_Calendario('form1.f_inicio');" class="cajas" >Ver</a>
                        <? }?>
                        </td>
                      <td width="187"><div align="center">
                        <? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205 and $codigo != 220){?>
                        <span class="titulo">Contenido (Unidades) </span>
                        <? }else{?>
                        <span class="titulo">Contenido (Kilos) </span>
                        <? } ?>
                      </div></td>
                      </tr>
                    <tr>
                      <td class="titulo"><? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205 ){?>Fecha Termino<? }?> </td>
                      <td>
                      <? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>
                      <input name="f_termino" type="text" class="cajas"   id="f_termino"  value="<?echo $f_termino?>" size="10" maxlength="10" />
                        <a href="javascript:show_Calendario('form1.f_termino');" class="cajas">Ver
                        <? }?>
                        </a></td>
                      <td width="187"><div align="center">
                        <input name="contenido_unidades" type="text" class="cajas" value="<?echo $row[contenido_unidades]?>"  size="10" />
                      </div></td>
                      <td width="88">
                 
					  <? if($row[id_procedencia] == 'N' and $codigo != 181 and $codigo != 220 and $codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>
                        <div align="center"> <a href="javascript:Abrir_ventana('ver_trazabilidad.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;f_termino=<? echo $f_termino?>&amp;id_producto=<? echo $row[id_producto]?>&valor_indice=<? echo $valor_indice?>&id_tipo_calculo=<? echo $id_tipo_calculo?>')"><img src="jpg/trazabalidad.jpg" width="62" height="36" border="0" /></a></div>
                       <? } ?>
                      <? if($row[id_procedencia] == 'N' and $codigo == 181 or $codigo == 220){?>
                            <div align="center"> <a href="javascript:Abrir_ventana('ver_trazabilidad_mucosa.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;f_termino=<? echo $f_termino?>&amp;id_producto=<? echo $row[id_producto]?>&valor_indice=<? echo $valor_indice?>&id_tipo_calculo=<? echo $id_tipo_calculo?>&factura_trazab=<? echo $factura_trazab?>&guia_despacho_trazab=<? echo $guia_despacho_trazab?>')"><img src="jpg/trazabalidad.jpg" width="62" height="36" border="0" /></a></div>
                       <? } ?>
                        <? if($row[id_procedencia] == 'N' and $codigo == 201 or $codigo == 202 or $codigo == 203 or $codigo == 204 or $codigo == 197  or $codigo == 205){?>
                            <div align="center"> <a href="javascript:Abrir_ventana('ver_trazabilidad_grasa.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;id_producto=<? echo $row[id_producto]?>&valor_indice=<? echo $valor_indice?>&id_tipo_calculo=<? echo $id_tipo_calculo?>&guia_despacho=<? echo $guia_despacho?>')"><img src="jpg/trazabalidad.jpg" width="62" height="36" border="0" /></a></div>
                       <? } ?>
                       <?
					  if($row[id_procedencia] == 'I'){
					  ?>
                        <div align="center"> <a href="javascript:Abrir_ventana_importada('ver_trazabilidad_importada.php?id_etiquetados_folios=<?echo $row[id_etiquetados_folios]?>')"><img src="jpg/trazabalidad.jpg" width="62" height="36" border="0" /></a></div	
					  >
                        <? }?></td>
                    </tr>
                    <tr>
                      <td class="titulo"><? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>Fecha Vencimiento<? }?></td>
                      <td>
                      
                  	  <? if($codigo != 201 and $codigo != 202 and $codigo != 203 and $codigo != 204 and $codigo != 197  and $codigo != 205){?>
                      <input name="f_vencimiento" type="text" class="cajas"   id="f_vencimiento"  value="<?echo $f_vencimiento?>" size="10" maxlength="10" />
					  <? }?>
                      </td>
                      <td width="187">&nbsp;</td>
                      <td width="88">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td class="titulo">Responsable</td>
                <td colspan="2"><? $operarios=crea_operarios($link,$row[id_operarios]);
		echo $operarios;?></td>
              </tr>
              <? if($id_caract_productob == 25){?>
              <tr>
                <td class="cajas"><span class="titulo">Asociado al Pallet N&ordm;</span></td>
                <td colspan="2" class="titulo">
                <? 
				$pat=$row[pallet];
				if($pat){
					
				if(!$id_estado_folio == 7){
				?>
                
                <a href="?modulo=modificar_pallet.php&amp;pallet=<?echo $row[pallet]?>"><? echo $row[pallet]; ?></a>
                <? }else{ ?>
                <? echo "Asignado al Pallet Nº $row[pallet]"; ?>
                <? }?>
                
                <? }else{?>
                   <span class="style11">Sin Asignar a Pallet</span><? }?>
                </td>
              </tr>
              <? } ?>
              <tr>
                <td colspan="3"><table width="587" border="0" align="center">
                  <tr>
                    <td width="141"><span class="titulo">Estado del Folio </span></td>
                    <td colspan="6" class="cajas"><?
						  $id_estado_folio=$row[id_estado_folio];
						   if($row[id_estado_folio] == 1){
						  echo "Emitido";
						  ?>
                      <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($row[id_estado_folio] == 2){
						  echo "Bodega"; 
						  ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($row[id_estado_folio] == 3){
						  echo "Picking";
						  ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
					      if($row[id_estado_folio] == 5){
						  echo "Anulado";
						   ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($row[id_estado_folio] == 6){
						  echo "Reprocesado - $freprocesado";
						   ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($id_estado_folio == 7){
						  echo "Despachado";
						  ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($row[id_estado_folio] == 9){
						  echo "Revisión";
						   ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($row[id_estado_folio] == 10){
						  echo "Asigando pedido";
						  ?>
						  <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						  if($row[id_estado_folio] == 4){
						  echo "Bodega MPI - $fbodega_mpi ";
						  
						  ?>
                          <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						   if($row[id_estado_folio] == 8){
						  echo "Bodega Traspaso";
						  ?>
                            <input name="id_estado_folio" type="hidden" value="<?echo $row[id_estado_folio]?>" />
						  <?
						  }
						 /* if($permiso34 == 1 and $nivel_usua == 1){
						  $estado_folio=crea_estado_folio($link,$row[id_estado_folio],0);
						  echo $estado_folio;
						  }*/
						?></td>
                    </tr>
					<?
						//verificamos si el folio se encuentra en la tabla folios_mat
						//$sqlsino="SELECT * FROM folios_mat where id_etiquetados_folios = $id_etiquetados_folios";
						//$resultsino=mysql_query($sqlsino);
						//$cuantossino=mysql_num_rows($resultsino);
						
						$sqlfacimp="SELECT * FROM etiquetados_folios where factura_importada ='' or factura_importada = 0 and id_etiquetados_folios = $id_etiquetados_folios";
						$resultimp=mysql_query($sqlfacimp);
						$cuantosimp=mysql_num_rows($resultimp);
						//echo "cuantos $cuantossino / cuantosimp $cuantosimp";
						?>
					<? if($cuantosimp){?>
                  <tr>
                    <td width="141" rowspan="2"><span class="titulo">Procedencia</span></td>
                    <td colspan="4" rowspan="2" align="left">
                      <? 
					
		 					$procedencia= crea_procedencia222222($link,$row[id_procedencia],1);


							echo $procedencia;
							
						?></td>
                    <td colspan="2" align="left" class="titulo">Producto de Muestra</td>
                    </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulo"><? if($bidon_muestra_pt){?>
SI
  <input name="bidon_muestra_pt" type="radio" id="radio" value="1" checked="checked" />
NO
<input type="radio" name="bidon_muestra_pt" id="radio" value="0" />
<? }else{ ?>
SI
<input type="radio" name="bidon_muestra_pt" id="radio" value="1" />
NO
<input name="bidon_muestra_pt" type="radio" id="radio" value="0" checked="checked" />
<? } ?></td>
                  </tr>
				  <? }?>
                  <? if($row[factura]){?>
                  <tr>
                    <td colspan="2" bgcolor="#666666"><span class="style9">Destino</span></td>
                    <td width="41" bgcolor="#666666"><span class="style9">Picking</span></td>
                    <td width="94" bgcolor="#666666"><span class="style9">F/Despacho </span></td>
                    <td width="50" bgcolor="#666666"><span class="style9">Factura</span></td>
                    <td width="31" bgcolor="#666666"><span class="style9">Guia</span></td>
                    <td width="203" bgcolor="#666666"><span class="style9">Glosa</span></td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#CCCCCC"><span class="cajas">
                      <?
						
						$sql3="SELECT d.destinos AS nombre_destinos  FROM etiquetados_folios AS ef, destinos AS d where ef.id_etiquetados_folios =$row[id_etiquetados_folios] and ef.id_destinos=d.id_destinos ";
						$result3=mysql_query($sql3);
						$cuantos3=mysql_num_rows($result3);
						if($cuantos3){
						while ($row3=mysql_fetch_array($result3))
      					{ 
						
						 echo "$row3[nombre_destinos]";
						 
						}
						}//fincuantos3
						 ?>
                    </span></td>
                    <td bgcolor="#CCCCCC"><span class="cajas">
                      <?
					 $sql="SELECT * FROM paking  where id_etiquetados_folios = $id_etiquetados_folios";
         			 $restsi=mysql_query($sql);
		 			 $cuantos_si=mysql_num_rows($restsi);
					 if($cuantos_si)
					 {
					 while ($rowbs=mysql_fetch_array($restsi))
					{ 
					 echo "$rowbs[folio_piking]";
					 }
					 }
					 
					 
					?>
                    </span></td>
                    <td bgcolor="#CCCCCC">&nbsp;<span class="cajas"><?echo $fdespacho_piking ?></span></td>
                    <td bgcolor="#CCCCCC"><span class="cajas"><?echo $row[factura]?></span></td>
                    <td bgcolor="#CCCCCC"><span class="cajas"><?echo $row[guia]?></span></td>
                    <td bgcolor="#CCCCCC"><span class="cajas"><?echo $row[glosa]?></span></td>
                  </tr><? }?>
                </table></td>
              </tr>
              <tr>
                <td colspan="3"><? $id_bode=$row[id_etiquetados_folios];?></td>
              </tr>
            </table></td>
          </tr>
        </table>
		<? } }//if(!$nuevo) ?>
		<? if($nuevo){?>
		<table width="600" border="1" align="center" bordercolor="#CCCCCC">
          <tr>
            <td height="543" valign="top"><table width="587" border="0" align="center">
              <tr>
                <td colspan="2" class="titulo Estilo1">&nbsp;</td>
              </tr>
              <tr>
                <td width="136" class="titulo Estilo1">&nbsp;</td>
                <td width="444"><span class="numero">A&Ntilde;O <?php echo substr($fhoy,2,4); ?> FOLIO <?echo $row[id_etiquetados_folios]?></span></td>
              </tr>
              <tr>
                <td class="titulo">Codigo Interno </td>
				
				
                <td width="444"><input name="codigonuevo" type="text" class="cajas" id="codigonuevo" value="<?echo $codigonuevo?>" />
                  <input name="vercodnuevo" type="submit" id="vercodnuevo" value="ver Codigo" />
				  <?
				
				if($vercodnuevo)
				{
				$sqlb="SELECT  * from cruce_tablas where id_cruce_tablas = $codigonuevo";
			    $resulbt=mysql_query($sqlb);
				$cuantosb=mysql_num_rows($resulbt);
				//echo "$sqlb";
				//echo "Cuantos $cuantosb";
				if($cuantosb != 0){
				while ($rowb=mysql_fetch_array($resulbt))
				{ 
				$id_cruce_tablas=$rowb[id_cruce_tablas];
				$id_especie=$rowb[id_especie];
				$id_producto=$rowb[id_producto];
				$id_calibre=$rowb[id_calibre];
				$id_unidad_medida=$rowb[id_unidad_medida];
				$id_medidas_productos=$rowb[id_medidas_productos];
				$id_caract_producto=$rowb[id_caract_producto];
				$id_caract_envases=$rowb[id_caract_envases];
				$valor_indice_tabla=$rowb[valor_indice];
				$id_tipo_calculo_tabla=$rowb[id_tipo_calculo];
								
				}//echo "$id_especie - $id_producto - $id_calibre - $id_unidad_medida - $id_medidas_productos - $id_caract_producto - $id_caract_envases";
				?>
                <input type="hidden" name="valor_indice_tabla" value="<? echo $valor_indice_tabla?>" />
				<input type="hidden" name="id_tipo_calculo_tabla" value="<? echo $id_tipo_calculo_tabla?>" />
                <?
						
				}
				
				
				}
				
				?>				  </td>
              </tr>
              <tr>
                <td class="titulo">Codigo de Barra</td>
                <td width="444"><input name="codigobarra" type="text" class="cajas" id="codigobarra" value="<?echo $codigobarra?>" />
                    <input name="vercodigobarra" type="submit" id="vercodigobarra" value="Codigo Barra" />
                    <?
				
				if($vercodigobarra)
				{
				
				$extractoid_especie = substr($codigobarra,0,3);
				$extractoid_producto = substr($codigobarra,3,3);
				$extractoid_calibre = substr($codigobarra,6,3);
				$extractoid_unidad_medida = substr($codigobarra,9,3);
				$extractoid_medidas_productos = substr($codigobarra,12,3);
				$extractoid_caract_producto = substr($codigobarra,15,3);
				$extractoid_caract_envases = substr($codigobarra,18,3);
				
				
				
				$sqlb="SELECT *  FROM cruce_tablas WHERE id_especie = $extractoid_especie AND id_producto = $extractoid_producto AND id_calibre = $extractoid_calibre AND id_unidad_medida = $extractoid_unidad_medida AND id_medidas_productos = $extractoid_medidas_productos AND id_caract_producto = $extractoid_caract_producto AND id_caract_envases = $extractoid_caract_envases";
				
			    $resulbt=mysql_query($sqlb);
				$cuantosb=mysql_num_rows($resulbt);
				//echo "$sqlb";
				//echo "Cuantos $cuantosb";
				if($cuantosb){
				while ($rowb=mysql_fetch_array($resulbt))
				{
				$id_cruce_tablas=$rowb[id_cruce_tablas];
				$id_especie=$rowb[id_especie];
				$id_producto=$rowb[id_producto];
				$id_calibre=$rowb[id_calibre];
				$id_unidad_medida=$rowb[id_unidad_medida];
				$id_medidas_productos=$rowb[id_medidas_productos];
				$id_caract_producto=$rowb[id_caract_producto];
				$id_caract_envases=$rowb[id_caract_envases];
				$valor_indice_tabla=$rowb[valor_indice];
				$id_tipo_calculo_tabla=$rowb[id_tipo_calculo];
											
				}echo "$id_cruce_tablas";
				
				?>
				<input type="hidden" name="valor_indice_tabla" value="<? echo $valor_indice_tabla?>" />
				<input type="hidden" name="id_tipo_calculo_tabla" value="<? echo $id_tipo_calculo_tabla?>" />
				<?
				}
				

				
				}
	
				?>                </td>
              </tr>
              <tr>
                <td height="21" class="titulo">Especie</td>
                <td><?
				
			
				
			if($codigonuevo or $codigobarra){	
		  $especie= crea_especie_codificacion($link,$id_especie,1,1);
		  echo $especie;
		}
		
			
		 $valor_indice2=$rowb[valor_indice];
		 $id_tipo_calculo2=$rowb[id_tipo_calculo];
		  ?></td>
              </tr>
              <tr>
                <td height="22" class="titulo">Producto</td>
                <td width="444"><? //$producto= crea_producto_onChange($link,$id_producto);
		 //echo $producto;?>
                  <? 
		  if($id_especie){
		  $producto_especie= crea_producto_especie_codificacion($link,$id_especie,$id_producto,1,1);
		  echo $producto_especie;
		  }
		  ?></td>
              </tr>
              <tr>
                <td class="titulo">Calibre</td>
                <td><? 
	  // if ($id_producto) {
		//$calibre=crea_calibre2($link,$id_calibre,$id_producto);
		//echo $calibre;
		//}
		?>
                  <? 
		  if($id_producto){
		  $producto_calibre= crea_producto_calibre_codificacion($link,$id_producto,$id_calibre,1,1);
		  echo $producto_calibre;
		 }
		  ?></td>
              </tr>
              <tr>
                <td height="21" class="titulo">Unidad de Medida </td>
                <td><? //$medidas_productos=crea_medidas_productos($link,$id_medidas_productos);
		//echo $medidas_productos;?>
                  <?
		  if($id_calibre){
		  $producto_unidad_medida= crea_producto_unidad_medida_codificacion($link,$id_producto,$id_unidad_medida,1,1);
		  echo $producto_unidad_medida;
		 }
		  ?></td>
              </tr>
              <tr>
                <td class="titulo">Medida</td>
                <td><? 
		  if($id_unidad_medida){
		  $producto_medida= crea_producto_medida_codificacion($link,$id_producto,$id_medidas_productos,1,1);
		  echo $producto_medida;
		  }
		  ?></td>
              </tr>
              <tr>
                <td class="titulo">Caract. Producto </td>
                <td><? 
		 if($id_medidas_productos){
		  $producto_caract_producto= crea_producto_caract_codificacion($link,$id_producto,$id_caract_producto,1,1);
		  echo $producto_caract_producto;
		  }
		  ?></td>
              </tr>
              <tr>
                <td class="titulo">Caract. Envase </td>
                <td><? 
		 if($id_caract_producto){
		  $producto_caract_producto= crea_producto_caract_envases($link,$id_producto,$id_caract_envases,1,1);
		  echo $producto_caract_producto;
		 }
	
		 
		  ?></td>
              </tr>
              <tr>
                <td class="titulo">Envase</td>
                <td><? $envases=crea_envases_uno($link,$id_envases);
		echo $envases;?></td>
              </tr>
              <tr>
                <td class="titulo">Origen</td>
                <td><? $origen=crea_origenes($link,$id_origen);
		echo $origen;
				?></td>
              </tr>
              <tr>
                <td colspan="2" class="titulo">
                <? if($codigonuevo != 181 and $codigonuevo != 201 and $codigonuevo != 202 and $codigonuevo != 203 and $codigonuevo != 204 and $codigonuevo != 197  and $codigonuevo != 205 and $codigonuevo != '220'){?>
                <table width="584" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="141" class="titulo">N&deg; Factura Importada</td>
                    <td width="156"><input name="factura_importada" type="text" class="cajas" id="factura_importada" value="<?echo $factura_importada?>" /></td>
                    <td width="125"><div align="center" class="titulo">N&deg; Bidon Importado</div></td>
                    <td width="162"><input name="bidon_importado" type="text" class="cajas" id="bidon_importado" value="<?echo $bidon_importado?>" size="20" maxlength="20" /></td>
                  </tr>
                </table>
                <? } ?>
                <? if($codigonuevo == '181' or $codigonuevo == '220'){ ?>
                 <table width="584" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="141" class="titulo">N&deg; Factura </td>
                    <td width="156"><input name="factura_trazab" type="text" class="cajas" id="factura_trazab" value="<?echo $factura_trazab?>" /></td>
                    <td width="125"><div align="center" class="titulo">N&deg; Guia Despacho</div></td>
                    <td width="162"><input name="guia_despacho_trazab" type="text" class="cajas" id="guia_despacho_trazab" value="<?echo $guia_despacho_trazab?>" size="20" maxlength="20" /></td>
                  </tr>
                </table>               
                <? }?>
                <? if($codigonuevo == 201 or $codigonuevo == 202 or $codigonuevo == 203 or $codigonuevo == 204 or $codigonuevo == 197or $codigonuevo == 205){?>
                <table width="584" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="141" class="titulo">N&deg; Guia Despacho</td>
                    <td width="156"><input name="guia_despacho" type="text" class="cajas" id="guia_despacho" value="<?echo $guia_despacho?>" /></td>
                    <td width="125"><div align="center" class="titulo">Cantidad Envase</div></td>
                    <td width="162"><input name="n_bandeja" type="text" class="cajas" id="n_bandeja" value="<?echo $n_bandeja?>" size="20" maxlength="20" /></td>
                    </tr>
                </table>
                <? }?></td>
                </tr>
              <tr>
                <td colspan="2"><table width="582" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="141" class="titulo">
                     
                       <? if($codigonuevo != 201 and $codigonuevo != 202 and $codigonuevo != 203 and $codigonuevo != 204 and $codigonuevo != 197 and $codigonuevo != 205){?>
                      Fecha de Elab. 
                      <? }else{?>
                      Fecha de Recepción. 
                      <? }
						
					  ?>
                      </td>
                      <td width="152">
					
					   <?
					   if(!$f_elaboracion){ 
					    $fecha=date("Y-m-d"); 
					    $fecha=format_fecha_sin_hora($fecha);
			   			$fecha_ven=$fecha;
						
						?>
                        
                        <input name="f_elaboracion" type="text" class="cajas" value="<?echo $fecha_ven?>" size="10" maxlength="10" />
						<? }else{?>
						<input name="f_elaboracion" type="text" class="cajas" value="<?echo $f_elaboracion?>" size="10" maxlength="10" />
						<? }?>
                       
                        <a href="javascript:show_Calendario('form1.f_elaboracion');" class="cajas" >Ver</a></td>
                      <td><!--<div align="right">
					  
					  
					  <a href="javascript: document.form1.submit();">
                          <label>
                          <input type="image" name="trazabilidad" src="jpg/trazabalidad.jpg" />
                          </label>
                      </a> </div>-->
                      <? if($codigonuevo != 201 and $codigonuevo != 202 and $codigonuevo != 203 and $codigonuevo != 204 and $codigonuevo != 197 and $codigonuevo != 205 and $codigonuevo != 220){?>
                        <span class="titulo">Contenido (Unidades) </span>
                      <? }else{?>
                        <span class="titulo">Contenido (Kilos) </span>
                      <? } ?>
                        </td>
                      <td><input name="contenido_unidades" type="text" class="cajas" id="contenido_unidades" value="<?echo $contenido_unidades?>"  size="20" maxlength="20" /></td>
                      </tr>
                    <tr>
                      <? if($codigonuevo != 201 and $codigonuevo != 202 and $codigonuevo != 203 and $codigonuevo != 204 and $codigonuevo != 197 and $codigonuevo != 205){?>
                      <td class="titulo">Fecha Inicio </td>
                      <td>
					  <input name="f_inicio" type="text" value="<?echo $f_inicio?>" class="cajas"  size="10" maxlength="10" />
                        <a href="javascript:show_Calendario('form1.f_inicio');" class="cajas" >Ver</a>						</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      </tr>
                    <tr>
                      <td class="titulo">Fecha Termino </td>
                      <td><input name="f_termino" type="text" class="cajas" value="<?echo $f_termino?>" size="10" maxlength="10" />
                        <a href="javascript:show_Calendario('form1.f_termino');" class="cajas" >Ver</a></td>
                      <td><div align="center">
                        <div align="center" class="titulo"></div>
                      </div></td>
                      <td>&nbsp;</td>
                      <? }?>
                      </tr>
                    <tr>
                      <td class="titulo">&nbsp;</td>
                      <td>
                      
                      
                      
                                           <? //echo "$fecd-$fecha_ven-$fech";?>                       </td>
                      <td width="131"></td>
                      <td width="158">
					  <? if($id_procedencia == "N" and $id_especie and $id_operarios != 0 and $id_producto != 0 and  $id_calibre != 0 and $id_medidas_productos != 0 and $id_envases != 0 and $contenido_unidades and $codigonuevo != 181 and $codigonuevo != 220 and $codigonuevo != 201 and $codigonuevo != 202 and $codigonuevo != 203 and $codigonuevo != 204 and $codigonuevo != 197 and $codigonuevo != 205){?>
                        <div align="center"><a href="javascript:Abrir_ventana('insertar_trazabilidad.php?id_etiquetados_folios=<?echo $s?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;f_termino=<? echo $f_termino;?>&amp;codigonuevo=<? echo $codigonuevo?>&amp;id_especie=<? echo $id_especie?>&amp;id_unidad_medida=<? echo $id_unidad_medida?>&amp;id_caract_producto=<? echo $id_caract_producto?>&amp;id_caract_envases=<? echo $id_caract_envases?>&amp;id_producto2=<? echo $id_producto?>&amp;id_calibre=<? echo $id_calibre?>&amp;id_medidas_productos=<? echo $id_medidas_productos?>&amp;id_envases=<? echo $id_envases?>&amp;f_inicio=<?echo $f_inicio?>&amp;fecha_ven=<? echo "$fecd-$fecha_ven-$fech";?>&amp;id_operarios=<? echo $id_operarios?>&amp;contenido_unidades=<? echo $contenido_unidades?>&amp;id_procedencia=<? echo $id_procedencia?>&amp;valor_indice2=<? echo $valor_indice_tabla?>&amp;id_tipo_calculo2=<? echo $id_tipo_calculo_tabla?>&factura_trazab=<? echo $factura_trazab?>&guia_despacho_trazab=<? echo $guia_despacho_trazab?>&gpallet=<? echo $gpallet?>&cantidad_foliosgenerar=<? echo $cantidad_foliosgenerar?>')" class="titulo"><img src="jpg/trazabalidad.jpg" border="0" /></a></div>
                        <? } ?>
                       
                        <? if($id_procedencia == "N" and $id_especie and $id_operarios != 0 and $id_producto != 0 and  $id_calibre != 0 and $id_medidas_productos != 0 and $id_envases != 0 and $contenido_unidades and $codigonuevo == 181 or $codigonuevo == 220){?>
                        <div align="center"><a href="javascript:Abrir_ventana('insertar_trazabilidad_mucosa.php?id_etiquetados_folios=<?echo $s?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;f_termino=<? echo $f_termino;?>&amp;codigonuevo=<? echo $codigonuevo?>&amp;id_especie=<? echo $id_especie?>&amp;id_unidad_medida=<? echo $id_unidad_medida?>&amp;id_caract_producto=<? echo $id_caract_producto?>&amp;id_caract_envases=<? echo $id_caract_envases?>&amp;id_producto2=<? echo $id_producto?>&amp;id_calibre=<? echo $id_calibre?>&amp;id_medidas_productos=<? echo $id_medidas_productos?>&amp;id_envases=<? echo $id_envases?>&amp;f_inicio=<?echo $f_inicio?>&amp;fecha_ven=<? echo "$fecd-$fecha_ven-$fech";?>&amp;id_operarios=<? echo $id_operarios?>&amp;contenido_unidades=<? echo $contenido_unidades?>&amp;id_procedencia=<? echo $id_procedencia?>&amp;valor_indice2=<? echo $valor_indice_tabla?>&amp;id_tipo_calculo2=<? echo $id_tipo_calculo_tabla?>&factura_trazab=<? echo $factura_trazab?>&guia_despacho_trazab=<? echo $guia_despacho_trazab?>&id_origen=<? echo $id_origen?>')" class="titulo"><img src="jpg/trazabalidad.jpg" border="0" /></a></div>
                        <? } ?>
                        
                              <? if($id_procedencia == "N" and $id_especie and $id_operarios and $id_producto and  $id_calibre and $id_medidas_productos and $id_envases and $n_bandeja and $guia_despacho and $contenido_unidades){?>
                        <div align="center"><a href="javascript:Abrir_ventana('insertar_trazabilidad_grasa.php?id_etiquetados_folios=<?echo $s?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;codigonuevo=<? echo $codigonuevo?>&amp;id_especie=<? echo $id_especie?>&amp;id_unidad_medida=<? echo $id_unidad_medida?>&amp;id_caract_producto=<? echo $id_caract_producto?>&amp;id_caract_envases=<? echo $id_caract_envases?>&amp;id_producto2=<? echo $id_producto?>&amp;id_calibre=<? echo $id_calibre?>&amp;id_medidas_productos=<? echo $id_medidas_productos?>&amp;id_envases=<? echo $id_envases?>&amp;id_operarios=<? echo $id_operarios?>&amp;contenido_unidades=<? echo $contenido_unidades?>&amp;id_procedencia=<? echo $id_procedencia?>&amp;valor_indice2=<? echo $valor_indice_tabla?>&amp;id_tipo_calculo2=<? echo $id_tipo_calculo_tabla?>&n_bandeja=<? echo $n_bandeja?>&guia_despacho=<? echo $guia_despacho?>&id_origen=<? echo $id_origen?>')" class="titulo"><img src="jpg/trazabalidad.jpg" border="0" /></a></div>
                        <? } ?>
                        
                        <? 
						//if($trazabilidad_x and $id_procedencia == "I" ){
						if($id_procedencia == "I" and $id_especie and $id_operarios != 0 and $id_producto != 0 and  $id_calibre != 0 and $id_medidas_productos != 0 and $id_envases != 0 and $contenido_unidades ){?>
                        <div align="center"><a href="javascript:Abrir_ventana('insertar_trazabilidad_importada.php?id_etiquetados_folios=<?echo $s?>&amp;f_elaboracion=<? echo $f_elaboracion?>&amp;f_termino=<? echo $f_termino;?>&amp;codigonuevo=<? echo $codigonuevo?>&amp;id_producto2=<? echo $id_producto?>&amp;id_calibre=<? echo $id_calibre?>&amp;id_medidas_productos=<? echo $id_medidas_productos?>&amp;id_especie=<? echo $id_especie?>&amp;id_unidad_medida=<? echo $id_unidad_medida?>&amp;id_caract_producto=<? echo $id_caract_producto?>&amp;id_caract_envases=<? echo $id_caract_envases?>&amp;id_envases=<? echo $id_envases?>&amp;id_origen=<? echo $id_origen?>&amp;compro_nro=<? echo $compro_nro?>&amp;f_inicio=<?echo $f_inicio?>&amp;fecha_ven=<? echo "$fecd-$fecha_ven-$fech";?>&amp;id_operarios=<? echo $id_operarios?>&amp;contenido_unidades=<? echo $contenido_unidades?>&amp;factura_importada=<? echo $factura_importada?>&amp;id_procedencia=<? echo $id_procedencia?>&amp;bidon_importado=<? echo $bidon_importado;?>')" class="titulo"><img src="jpg/trazabalidad.jpg" border="0" /></a></div>
                        <? }?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td class="titulo">Responsable</td>
                <td><? $operarios=crea_operarios($link,$id_operarios);
		echo $operarios;?></td>
              </tr>
              <tr>
                <td colspan="2" class="titulo"><table width="582" border="0" cellpadding="0" cellspacing="0">
             <? if($id_caract_producto == 25 and $codigonuevo){?>
                  <tr>
                    <td width="138"><span class="numero"><span class="numero"><span class="titulo">Generar Pallet</span></span></span></td>
                    <td width="28">
                    <input type="checkbox" value="1" name="gpallet" onclick="document.form1.cantidad_foliosgenerar.disabled=!document.form1.cantidad_foliosgenerar.disabled">
                          </td>
                    <td width="165" class="titulo">Indicar Cantidad de Folios </td>
                    <td width="251"><input name="cantidad_foliosgenerar" type="text" disabled id="cantidad_foliosgenerar" value="<?echo $cantidad_foliosgenerar?>" size="5" maxlength="5"/><? //echo "gpallet $gpallet - cantidad_folios $cantidad_foliosgenerar";?></td>
                  </tr>
                  
                  <? }?>
                  
                </table></td>
                </tr>
              <tr>
                <td class="titulo">Procedencia
                  <input name="id_estado_folio" type="hidden" id="id_estado_folio" value="1" /></td>
                <td><? 
		 	$procedencia= crea_procedencia222222($link,$id_procedencia,1);
			echo $procedencia;
			?></td>
              </tr>
            </table></td>
          </tr>
        </table>
        <? }?>
        <table width="335" border="0" align="center">
          <tr>
            <td class="style3"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
            <td class="style3"><? if ($cuantos > $next and !$nuevo){ ?>
                <a href="?modulo=ejemplo_etiquetas_folios.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
                <? }else{?>
              &nbsp;
              <? }?></td>
            <td><span class="style3">
              <? if($ante >= 0){ ?>
              <a href="?modulo=ejemplo_etiquetas_folios.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
              <? }else{?>
              &nbsp;
              <? }?>
            </span></td>
            <td><? if ($cuantos){ ?>
                <a href="?modulo=ejemplo_etiquetas_folios.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
                <? }?>
            </td>
            <td width="47">
			<? if($permiso34 == 1){?>
			<a href="?modulo=ejemplo_etiquetas_folios.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
            <td width="55"><a href="?modulo=ejemplo_etiquetas_folios.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
            <td width="62">
			<? if($permiso34 == 1 and $nivel_usua == 2 and $id_estado_folio != 3 and $id_estado_folio != 7){?>
			<? if(!$nuevo and $cuantos and !$mantsec){?>
                <a href="javascript: document.form1.submit();">
                <input type="hidden" name="modificar" value="modificar" />
                <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
                <? }?>
				<? }
				if($permiso34 == 1 and $nivel_usua == 1){
				if(!$nuevo and $cuantos and !$mantsec){
				?>
				 <a href="javascript: document.form1.submit();">
                <input type="hidden" name="modificar" value="modificar" />
                <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
				<?
				}
				}
				?>
            </td>
            <td width="55">
			 <? if($permiso34 == 1){?>
			<? $hola=0; if($hola){ //if($cuantos or !$nuevo or !$mantsec){?>
                <a href="javascript: document.form1.submit();">
                <label>
                <input type="image" name="grabar" src="jpg/guardar.jpg" />
                </label>
                </a>
                <? }?>
				 <? }?>
            </td>
            <td width="45">
			<? if($permiso34 == 1 and $nivel_usua == 2 and $id_estado_folio != 3 and $id_estado_folio != 7 and $id_estado_folio != 5  and $id_estado_folio != 2){?>
			<? if(!$nuevo and $cuantos){?>
                <a href="?modulo=ejemplo_etiquetas_folios.php&amp;borrar=<? echo $id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
                <? }?>
				<? }
				if($permiso34 == 1 and $nivel_usua == 1 and $id_estado_folio != 7){
				if(!$nuevo and $cuantos){
				?>
				<a href="?modulo=ejemplo_etiquetas_folios.php&amp;borrar=<? echo $id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
				<?
				}
				}
				?>
            </td>
            <td width="45"><? if(!$nuevo and $cuantos){?>
                <a href="?modulo=etiquetas_folios_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
                <? }?>
            </td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>