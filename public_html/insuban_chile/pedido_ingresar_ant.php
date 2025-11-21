<?
$apiUrl = 'http://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
if ( ini_get('allow_url_fopen') ) {
    $json = file_get_contents($apiUrl);
} else {
    //De otra forma utilizamos cURL
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
}
 
$dailyIndicators = json_decode($json);
echo 'Dolar $ ' . $dailyIndicators->dolar->valor;
echo '&nbsp; - &nbsp;Euro $ ' . $dailyIndicators->euro->valor;

$dolar=$dailyIndicators->dolar->valor;
$euro=$dailyIndicators->euro->valor;


$fech_ingreso_pedido = date("Y-m-d H:i:s"); 
$ftp=format_fecha_sin_hora($fech_termino_pedido);
$year=date("Y"); //año

if($agregar_pedido and $cantidadb){
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
 
  $fecha_prioridad = explode(" ",$fecha_prioridad);
  $fecha_prioridad =  $fecha_prioridad[0];
  $fecha_prioridad=date("$fecha_prioridad-H:i:s");
  $dat4=split(" ",$fecha_prioridad);
  $dat=split("-",$dat4[0]);
  $a=$dat[3];
  $b=$dat[2];
  $c=$dat[1];
  $d=$dat[0];
  
$fec="$b-$c-$d $a";
 
$sql_p="insert into pedido (id_pedidos,id_usuario,year,id_destinos,fecha_prioridad,fech_ingreso_pedido) values ('$id_pedidos_siguiente','$id_insuban','$year','$id_destinos','$fec','$fech_ingreso_pedido')";
$result_p=mysql_query($sql_p,$link);
$id = mysql_insert_id();

//echo "<br>sql_p $sql_p";

$fecha_ingreso_producto_pedido =date("Y-m-d"); 	  
$sql_pp="INSERT into pedido_tabla (id_pedidos,id_cruce_tablas,cantidadb,fecha_ingreso_producto_pedido,costo,venta,dolar,euro,nota) values ('$id','$codigo','$cantidadb','$fecha_ingreso_producto_pedido','$costo','$venta','$dolar','$euro','$nota')";
$result_pp=mysql_query($sql_pp,$link);

//echo "<br>sql_pp $sql_pp";

echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pedido_modificar.php&id_ped=$id\">";
exit;

}
?>

<script language="javascript" type="text/javascript">
function Verifica_datos(){
var codigo = 1;
codigo=document.getElementById("codigo");
frm=document.getElementById("form1");
frm.action="?modulo=pedido_ingresar.php&codigo=" + codigo.value;
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
.alarma {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;  color: #FF0000;}
-->
</style>
<form name="form1" id="form1" method="post" action="">
  <table width="625" border="0">
    <tr>
      <td width="619"><table width="619" border="1" align="center">
            <tr>
              <td colspan="2" nowrap class="titulo">Ingresar Pedido</td>
              <td nowrap><div align="center" class="titulo14">Folio Pedido</div></td>
            </tr>
            <tr>
              <td colspan="2" nowrap>&nbsp;</td>
              <td nowrap class="titulo"><div align="center" class="titulo14">Folio Sin Asignar</div></td>
            </tr>
            <tr>
              <td width="222" nowrap class="titulo">&nbsp;Cliente</td>
              <td width="245" nowrap class="titulo">&nbsp;Fecha Despacho </td>
              <td width="130" nowrap class="titulo">&nbsp;</td>
            </tr>
            <tr>
              <td nowrap class="cajas">&nbsp;
              <? 
				$destinos= crea_destinos($link,$id_destinos);
				echo $destinos;
	  	   	  ?>			 </td>
              <td nowrap class="cajas">&nbsp;
                <input name="fecha_prioridad" type="text" class="cajas" value="<? echo $fecha_prioridad?>" size="17" maxlength="30" />
                <a href="javascript:show_Calendario('form1.fecha_prioridad');" >Ver</a></td>
              <td nowrap class="cajas">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" nowrap>&nbsp;</td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td nowrap>
	  <? if($crear and $id_ped or $codigo or !$grabarfilas){  ?>
          <table width="595" border="1" align="center">
            <tr>
              <td nowrap="nowrap" class="titulo">ID</td>
              <td width="247" nowrap="nowrap" class="titulo">Producto</td>
              <td width="54" nowrap="nowrap" class="titulo"><div align="center">Calibre</div></td>
              <td width="90" nowrap="nowrap" class="titulo"><div align="center">Unidad Medida </div></td>
              <td width="47" nowrap="nowrap" class="titulo"><div align="center">Medida</div></td>
              <td width="91" nowrap="nowrap" class="titulo"><div align="center">Cant. Bidones</div></td>
              <td width="40" nowrap="nowrap" class="titulo"><div align="center">Costo $</div></td>
              <td width="40" nowrap="nowrap" class="titulo"><div align="center">Venta $</div></td>
<!--              <td width="40" nowrap="nowrap" class="titulo"><div align="center">Agregar Obs.</div></td> -->
            </tr>
            <tr>
              <td width="26" nowrap="nowrap" class="cajas">
	 <?	
	  if (isset($codigo) or $variable_falsa) {
	  if($codigo){
$codigo_bd=$codigo;
$sqlb="SELECT *
FROM cruce_tablas AS ct
JOIN producto AS p ON ct.id_producto = p.id_producto
JOIN calibre AS c ON ct.id_calibre = c.id_calibre
JOIN unidad_medida AS um ON ct.id_unidad_medida = um.id_unidad_medida
JOIN medidas_productos AS mp ON ct.id_medidas_productos = mp.id_medidas_productos
WHERE ct.id_cruce_tablas = $codigo_bd";

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
$costounidad=$rowb[costounidad];


}
}
}
  ?>
                  <input name="codigo" type="text" id="codigo" onblur="Verifica_datos();" value="<? echo $codigo;?>" size="4" maxlength="5" onKeypress="solo_numeros()"/></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $productob?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $calibreb?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $unidad_medidab?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $medidas_productosb?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<input name="cantidadb" type="text" id="cantidadb" size="5" onkeypress="solo_numeros()"/>&nbsp;</td>
              
              <td nowrap="nowrap" class="cajas"><input name="costo" type="text" id="costo" size="4" value="<? echo $costounidad;?>"/>
                  &nbsp;</td>
              <td nowrap="nowrap" class="cajas"><input name="venta" type="text" id="venta" size="4" onkeypress="solo_numeros()"/>
                  &nbsp;</td>

              <input name="dolar" type="hidden" id="dolar" value="<? echo $dolar;?>"/>                
              <input name="euro" type="hidden" id="euro" value="<? echo $euro;?>"/>
            </tr>
            <tr>
              <td colspan="5" nowrap="nowrap" class="cajas">
                <div align="right">&nbsp;<span class="alarma"><?
			  if($cantidadb != '') {echo "Ingrese Cantidad";}
			   if(!$cuantosb and $codigo) { echo "El Codigo ingresado No Existe";}
			  ?>
              </span></div></td>
              <td></td><td></td>
              <td nowrap="nowrap" class="cajas"><input name="agregar_pedido" type="submit" class="cajas" id="agregar_pedido" value="Agregar Pedido" /></td>
            </tr>
          </table>
      </td>
    </tr>
  
    <? } ?>
  </table>
</form>