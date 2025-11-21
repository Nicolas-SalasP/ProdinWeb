<?

$fip=format_fecha_sin_hora($fech_ingreso_pedido);
$ftp=format_fecha_sin_hora($fech_termino_pedido);
$fdp=format_fecha_sin_hora($fech_despacho_pedido);
$year=date("Y"); //año

if($agregarp){
echo "estoy dentro de agregar";
$sql_ultimo_pedido="SELECT * FROM pedido where id_pedidos=id_pedidos ORDER BY id_pedidos desc LIMIT 1";
$result_ultimo_pedido=mysql_query($sql_ultimo_pedido);
$cuanto_ultimo_pedido=mysql_num_rows($result_ultimo_pedido);
 if ($row_ultimo_pedido=mysql_fetch_array($result_ultimo_pedido))
 { 
 $id_pedidos=$row_ultimo_pedido[id_pedidos];
 $ultimoanorescatado=$row_ultimo_pedido[year];
 }
 if($ultimoanorescatado == $year){
 $id_pedidos=$row_ultimo_pedido[id_pedidos];
 $id_pedidos_siguiente=$id_pedidos+1;
}else{
 $id_pedidos=$rowul[id_pedidos];
 $id_pedidos_siguiente=$id_pedidos - $id_pedidos;
 $id_pedidos_siguiente++;
 $id_pedidos_siguiente_contar=strlen($id_pedidos_siguiente);
 
 if($id_pedidos_siguiente_contar == 1) $id_pedidos_siguiente="00000$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 2) $id_pedidos_siguiente="0000$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 3) $id_pedidos_siguiente="000$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 4) $id_pedidos_siguiente="00$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 5) $id_pedidos_siguiente="0$id_pedidos_siguiente";
 if($id_pedidos_siguiente_contar == 6) $id_pedidos_siguiente="$id_pedidos_siguiente";
 $anook=substr($year,2,4);
 $id_pedidos_siguiente=$anook.$id_pedidos_siguiente;
}
 
$sql_p="insert into pedido (id_pedidos,year,id_destinos,fech_ingreso_pedido,fech_despacho_pedido) values ('$id_pedidos_siguiente','$year','$id_destinos','$fip','$fdp')";
$result_p=mysql_query($sql_p,$link);

echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pedido_ingresar_modificar.php&id_ped=$id_pedidos_siguiente\">";
  exit;

}//if($agregarp){

if($modificarp){
$sql_m="UPDATE  pedido set id_destinos='$id_destinos',fech_ingreso_pedido='$fip',fech_termino_pedido='$ftp',fech_despacho_pedido='$fdp', id_tipo_prioridad = '$tipo_prioridad' where id_pedidos=$id_pedidos";
$rest=mysql_query($sql_m);
//echo $sql_m;
}//if($modificarp){

if($grabarfilas and $cantidadb){
$sqlsino="SELECT * FROM pedido_tabla where id_pedidos=$id_pedidos and id_cruce_tablasb=$codigo";
$resultsino=mysql_query($sqlsino);
$cuantossino=mysql_num_rows($resultsino);
if(!$cuantossino and $cantidadb){	 
$fecha_ingreso_producto_pedido =date("Y-m-d"); 	  
$sql_p="insert into pedido_tabla (id_pedidos,id_cruce_tablasb,cantidadb,fecha_ingreso_producto_pedido) values ('$id_pedidos','$codigo','$cantidadb','$fecha_ingreso_producto_pedido')";
$result_p=mysql_query($sql_p,$link);
}else{
$mensajesino=1;
}//if(!$cuantossino){	
}//if($grabarfilas){

if($eliminar and $id_pedido_tablas != 0) {
 foreach ($id_pedido_tablas as $key)
 {
$sql="delete from pedido_tabla where  id_pedido_tablas = $key";
 $res=mysql_query($sql);
  }
}//if($eliminar) {

if($id_ped){
$sql="SELECT * FROM pedido where id_pedidos=$id_ped ORDER BY id_pedidos desc LIMIT 1";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM pedido where id_pedidos=id_pedidos ORDER BY id_pedidos desc LIMIT 1";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}
//echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pedido_ingresar_modificar.php&id_ped=$id_ped\">";


?>

<script language="javascript" type="text/javascript">
function Verifica_datos(){
var codigo = 1;
codigo=document.getElementById("codigo");
frm=document.getElementById("form1");
frm.action="?modulo=pedido_ingresar_modificar.php&id_ped=<?echo $id_ped?>&codigo=" + codigo.value;
frm.submit();
return true;
}
</script>
<script language="javascript">
function solo_numeros(){
var key=window.event.keyCode;
if (key < 48 || key > 57){
window.event.keyCode=0;
}}
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

<style type="text/css">
<!--
.cajas {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.titulo14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }

-->
</style>
<form name="form1" id="form1" method="post" action="">
  <table width="625" border="0">
    <tr>
      <td width="619">
<?
if(!$nuevo){
	while ($row=mysql_fetch_array($result))
        { 
	    $id_pedidos=$row[id_pedidos];
		$fech_ingreso_pedido=format_fecha_sin_hora($row[fech_ingreso_pedido]);
		$fech_termino_pedido=format_fecha_sin_hora($row[fech_termino_pedido]);
		$fech_despacho_pedido=format_fecha_sin_hora($row[fech_despacho_pedido]);
?>
          <table width="619" border="1" align="center">
            <tr>
              <td colspan="3" nowrap>&nbsp;<input name="id_pedidos" type="hidden" value="<?echo $row[id_pedidos]?>" /></td>
              <td nowrap><div align="center" class="titulo">Folio Pedido</div></td>
            </tr>
            <tr>
              <td nowrap class="titulo">&nbsp;Prioridad
                <input name="tipo_prioridad" type="text" class="cajas" value="<? echo $row[id_tipo_prioridad]; ?>" size="2" maxlength="1" /></td>
              <td colspan="2" nowrap>&nbsp;</td>
              <td nowrap><div align="center" class="titulo14"><? echo $id_pedidos?></div></td>
            </tr>
            <tr>
              <td width="231" nowrap class="titulo">&nbsp;Cliente</td>
              <td width="133" nowrap class="titulo">&nbsp;Fecha  Inicio </td>
              <td width="97" nowrap class="titulo">&nbsp;Fecha Termino </td>
              <td width="130" nowrap class="titulo">&nbsp;Fecha  Despacho </td>
            </tr>
            <tr>
              <td nowrap class="cajas">&nbsp;
               <? 
			      $destinos= crea_destinos($link,$row[id_destinos]);
			      echo $destinos;
			   ?>
			  </td>
              <td nowrap class="cajas"><input name="fech_ingreso_pedido" type="text" class="cajas" value="<? echo $fech_ingreso_pedido?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fech_ingreso_pedido');" >Ver</a></td>
              <td nowrap class="cajas"><input name="fech_termino_pedido" type="text" class="cajas" value="<? echo $fech_termino_pedido?>"  size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fech_termino_pedido');" >Ver</a></td>
              <td nowrap class="cajas"><input name="fech_despacho_pedido" type="text" class="cajas" value="<? echo $fech_despacho_pedido?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fech_despacho_pedido');" >Ver</a></td>
            </tr>
          </table>
        <table width="619" border="1" align="center">
            <tr>
              <td width="29" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center">X</div></td>
              <td width="25" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">ID</td>
              <td width="171" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Producto</td>
              <td width="39" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Calibre</td>
              <td width="82" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Unidad Medida</td>
              <td width="40" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Medida</td>
              <td width="88" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Cant. Producto </td>
              <td width="93" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Cant. Contenido </td>
            </tr>
<?
      $sqlp="SELECT * FROM pedido_tabla AS pt, cruce_tablas AS ct, producto AS p, calibre AS c, unidad_medida AS um, medidas_productos AS mp where pt.id_pedidos = $id_pedidos and pt.id_cruce_tablasb = ct.id_cruce_tablas and ct.id_producto = p.id_producto and ct.id_calibre = c.id_calibre and ct.id_unidad_medida = um.id_unidad_medida and ct.id_medidas_productos = mp.id_medidas_productos ";
	  $resultp=mysql_query($sqlp);
	  $cuantosp=mysql_num_rows($resultp);
	  
	  while ($rowp=mysql_fetch_array($resultp))
      { 
	  $id_pedido_tablas=$rowp[id_pedido_tablas];
	  $id_pedidos=$rowp[id_pedidos];
	  $cantidad=$rowp[cantidadb];
?>
            <tr>
              <td nowrap="nowrap" class="cajas">&nbsp;<input name="id_pedido_tablas[]" type="checkbox" class="cajas"  value="<?echo $rowp[id_pedido_tablas];?>" /></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $rowp[id_cruce_tablasb];?></td>
              <td nowrap="nowrap" class="cajas"><? echo $rowp[producto];?></td>
              <td nowrap="nowrap" class="cajas"><? echo $rowp[calibre];?></td>
              <td nowrap="nowrap" class="cajas"><? echo $rowp[unidad_medida];?></td>
              <td nowrap="nowrap" class="cajas"><? echo $rowp[medidas_productos];?></td>
              <td nowrap="nowrap" class="titulo14"><div align="center"><? echo $rowp[cantidadb];?></div></td>
              <td nowrap="nowrap" class="titulo14"><div align="center">definir</div></td>
            </tr>
<? } ?>
          </table>
        <? }
  }
  
  if($nuevo){
  
?>
          <table width="619" border="1" align="center">
            <tr>
              <td colspan="3" nowrap class="titulo">Ingresar Pedido </td>
              <td nowrap><div align="center" class="titulo">Folio Pedido</div></td>
            </tr>
            <tr>
              <td nowrap>&nbsp;</td>
              <td colspan="2" nowrap>&nbsp;</td>
              <td nowrap class="titulo"><div align="center">Folio Sin Asignar</div></td>
            </tr>
            <tr>
              <td width="234" nowrap class="titulo">&nbsp;Cliente</td>
              <td width="116" nowrap class="titulo">&nbsp;Fecha Inicio </td>
              <td width="117" nowrap class="titulo">&nbsp;Fecha Termino</td>
              <td width="128" nowrap class="titulo">&nbsp;Fecha Despacho </td>
            </tr>
            <tr>
              <td nowrap class="cajas">&nbsp;
              <? 
				$destinos= crea_destinos($link,$row[id_destinos]);
				echo $destinos;
	  	   	  ?>
			 </td>
              <td nowrap class="cajas"><input name="fech_ingreso_pedido" type="text" class="cajas"  size="10" value="<? echo $fech_ingreso_pedido?>" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fech_ingreso_pedido');" >Ver</a></td>
              <td nowrap class="cajas">&nbsp;Sin Asignar </td>
              <td nowrap class="cajas"><input name="fech_despacho_pedido" type="text" class="cajas"  size="10" value="<? echo $fech_despacho_pedido?>" maxlength="10" />
                <a href="javascript:show_Calendario('form1.fech_despacho_pedido');" >Ver</a></td>
            </tr>
            <tr>
              <td colspan="4" nowrap><div align="center">
                  <input name="agregarp" type="submit" class="cajas" id="agregarp" value="Agregar Pedido" />
                  <input name="crear" type="submit" class="cajas" id="crear" value="Agregar Fila" />
              </div></td>
            </tr>
          </table>
        <? }?>
          <?
if(!$nuevo and $cuantos){
?>
      </td>
    </tr>
    <tr>
      <td nowrap>
	  <? if($crear and $id_ped or $codigo or !$grabarfilas){  ?>
          <table width="619" border="1" align="center">
            <tr>
              <td nowrap="nowrap" class="titulo">ID</td>
              <td nowrap="nowrap" class="titulo">Producto</td>
              <td nowrap="nowrap" class="titulo">Calibre</td>
              <td nowrap="nowrap" class="titulo">Unidad Medida </td>
              <td nowrap="nowrap" class="titulo">Medida</td>
              <td nowrap="nowrap" class="titulo">Cant. Producto </td>
              <td nowrap="nowrap" class="titulo">Cant. Contenido </td>
            </tr>
            <tr>
              <td width="25" nowrap="nowrap" class="cajas">
	 <?	
	  if (isset($codigo) or $variable_falsa) {
	  if($codigo){
$codigo_bd=$codigo;
$sqlb="SELECT  * from cruce_tablas AS ct, producto AS p, calibre AS c, unidad_medida AS um, medidas_productos AS mp where ct.id_cruce_tablas = $codigo_bd and ct.id_producto = p.id_producto and ct.id_calibre = c.id_calibre and ct.id_unidad_medida = um.id_unidad_medida and ct.id_medidas_productos = mp.id_medidas_productos";

$resulbt=mysql_query($sqlb);
$cuantosb=mysql_num_rows($resulbt);

while ($rowb=mysql_fetch_array($resulbt))
{ 
$id_cruce_tablasb=$rowb[id_cruce_tablas];
$id_especieb=$rowb[id_especie];
$id_productob=$rowb[id_producto];
$productob=$rowb[producto];
$calibreb=$rowb[calibre];
$unidad_medidab=$rowb[unidad_medida];
$medidas_productosb=$rowb[medidas_productos];
}
}
}
	  ?>
                  <input name="codigo" type="text" id="codigo" onblur="Verifica_datos();" value="<? echo $codigo;?>" size="4" maxlength="5" onKeypress="solo_numeros()"/></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $productob?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $calibreb?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $unidad_medidab?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $medidas_productosb?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;
                  <input name="cantidadb" type="text" id="cantidadb" size="5" onKeypress="solo_numeros()"/></td>
              <td nowrap="nowrap" class="cajas">&nbsp;
                  <input name="contenidob" type="text" id="contenidob" value="<? echo $contenidob?>" size="5" onKeypress="solo_numeros()"/></td>
            </tr>
          </table>
        <div align="right">
            <? if($mensajesino) {echo "El producto ya se encuentra ingresado en el pedido"; }
						     if($cantidadb =='' and $grabarfilas) {echo "Ingrese Cantidad";}
						  ?>
            <?
		  }
		  ?>
            <? if($codigo){?>
            <input name="grabarfilas" type="submit" class="cajas" id="grabarfilas" value="Agregar Producto" />
            <input name="eliminar" type="submit" class="cajas" id="eliminar" value="Eliminar Producto" />
            <? }?>
        </div></td>
    </tr>
  
    <? } ?>
  </table>
  <input name="nuevo" type="submit" class="cajas" id="nuevo" value="Nuevo Pedido" /> <? if(!$crear){?>
      <? }?>
        
          <input name="modificarp" type="submit" class="cajas" id="modificarp" value="Modificar Pedido">&nbsp;<a href="?modulo=pedido_listar.php">Listar Pedidos</a>
</form>