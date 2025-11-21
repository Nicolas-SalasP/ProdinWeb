<?
error_reporting(0);


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql_xx="SELECT * FROM paking where id_paking = id_paking order by folio_piking desc LIMIT 0,1";
$result_xx=mysql_query($sql_xx);
$ultimo=mysql_fetch_array($result_xx);
$idxx=$ultimo[id_paking] + 1;

//echo "id $idxx";

$sql_id="SELECT * FROM paking where id_paking = id_paking order by folio_piking desc LIMIT 0,1";
$result_id=mysql_query($sql_id);


if ($r=mysql_fetch_array($result_id))
{ 
$cuantosfo=$r[folio_piking]; 
$id=$cuantosfo + 1;
}

$folio_pinking2=$cuantosfo+1;


if($id_ped){
				$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, estado_folio AS esf where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_estado_folio = esf.id_estado_folio and etiq.id_producto = pro.id_producto and etiq.id_pedidos = $id_ped and etiq.id_estado_folio = 2 order by etiq.id_cruce_tablas, etiq.id_producto desc";
				$result=mysql_query($sql);
				$cuantossi=mysql_num_rows($result);
		
				

if ($enpic){

	while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_folios=$row[id_etiquetados_folios];
    $sqlsulta="SELECT * FROM paking WHERE id_etiquetados_folios = $id_etiquetados_folios";
  	$result_consulta=mysql_query($sqlsulta);
  	$cuantos_consulta=mysql_num_rows($result_consulta);
	//echo "cuantos_consulta $cuantos_consulta";
      if(!$cuantos_consulta)
	  {
 		   $fecha_ingreso_paking  =date("Y-m-d");
   		   $sql="insert into paking (folio_piking,id_paking_relacion,id_etiquetados_folios,fecha_ingreso_paking) values ($folio_pinking2,$idxx,$id_etiquetados_folios,'$fecha_ingreso_paking')";
			//echo "sql $sql<br>";
			$res=mysql_query($sql);
	
		    $sq_up="update etiquetados_folios set id_estado_folio = '3', id_destinos='$id_destinos' where id_estado_folio != 3 and id_etiquetados_folios=$id_etiquetados_folios";
			$rest_up=mysql_query($sq_up);
			//echo "sql_up $sq_up<br>";
	  }//if(!$cuantos_consulta)
	}//while ($row=mysql_fetch_array($result))
		//$sqleb="delete from pedido where  id_pedidos = $id_ped";
		//$resulteb=mysql_query($sqleb); 
		
		$sq_ped="update pedido set folio_piking='$folio_pinking2', id_paking_relacion='$idxx' ,fech_envio_picking ='$fecha_ingreso_paking' where id_pedidos=$id_ped";
		$rest_ped=mysql_query($sq_ped);		
		
		$sqleb="delete from pedido_armado_automatico  where  id_pedidos = $id_ped";
		$resulteb=mysql_query($sqleb); 
		$sqleb="delete from pedido_tabla   where  id_pedidos = $id_ped";
		$resulteb=mysql_query($sqleb); 
		
		echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pedido_listar.php\">";
  }//if ($enpic){
  
	
		
  
  
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$fip=format_fecha_sin_hora($fech_ingreso_pedido);
$ftp=format_fecha_sin_hora($fech_termino_pedido);
$fdp=format_fecha_sin_hora($fech_despacho_pedido);
$year=date("Y"); //año
//$mysql_datetime = date("Y-m-d H:i:s"); 
//$mysql_date = date("Y-m-d"); 
//$mysql_time = date("H:i:s"); 


if($modificarp){

  if($fecha_prioridad){
  $fecha_prioridad = explode(" ",$fecha_prioridad);
  $fecha_prioridad =  $fecha_prioridad[0];
  $fecha_prioridad=date("$fecha_prioridad-H:i:s");
  $dat4=split(" ",$fecha_prioridad);
  $dat=split("-",$dat4[0]);
  $a=$dat[3];
  $b=$dat[2];
  $c=$dat[1];
  $d=$dat[0];
  
  $largo = strlen($c);

  $resul_c = $c - 1;
  //echo "<br>  $resul_c  <br>";
  $largo2 = strlen($resul_c);
  if($largo2 != 2)
  {
  $resul_c2="0$resul_c";
  }else{
  
  $resul_c2;
  }
  
   $fec_resok="$b-$resul_c2-$d";
 
  
  
  
$fec="$b-$c-$d $a";
//echo "fec $fec";
  }else{
  
  $fecha_prioridad;
  
  }
$sql_m="UPDATE  pedido set id_destinos='$id_destinos',fecha_prioridad ='$fec', notificacion_email='$notificacion_email2' where id_pedidos=$id_pedidos";
$rest=mysql_query($sql_m);
//echo $sql_m;

 foreach ($HTTP_POST_VARS as $key => $value)
               {
                $dat=split("-",$key);
                if ($dat[0] == 'cantidadb')
                  {
                   $id=$dat[1];
                   $cantidadb=$HTTP_POST_VARS["cantidadb-$id"];
                   $sql="UPDATE pedido_tabla SET  cantidadb='$cantidadb' where id_pedido_tablas = $id";

                   $rest=mysql_query($sql);
				   //echo "sql $sql";
                  }
				  }
//****************************************************************


}

if($grabarfilas and $cantidadb){
$sqlsino="SELECT * FROM pedido_tabla where id_pedidos=$id_pedidos and id_cruce_tablas=$codigo";
$resultsino=mysql_query($sqlsino);
$cuantossino=mysql_num_rows($resultsino);
if(!$cuantossino and $cantidadb){	 
$fecha_ingreso_producto_pedido =date("Y-m-d"); 	  
$sql_p="insert into pedido_tabla (id_pedidos,id_cruce_tablas,cantidadb,fecha_ingreso_producto_pedido) values ('$id_pedidos','$codigo','$cantidadb','$fecha_ingreso_producto_pedido')";
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
 
 $sql2="select * from pedido_armado_automatico  where  id_pedido_tablas = $key";
 $res2=mysql_query($sql2);
 
 while ($row2=mysql_fetch_array($res2)){
 $id_etiquetados_folios =$row2[id_etiquetados_folios];
 $sql3="update etiquetados_folios set id_pedidos='0' where id_etiquetados_folios = $id_etiquetados_folios";
 $res3=mysql_query($sql3);
 }
 $sql4="delete from pedido_armado_automatico where  id_pedido_tablas = $key";
 $res4=mysql_query($sql4);
 }

 
}//if($eliminar) {



if($generar){
$fecha_prioridad = explode(" ",$fecha_prioridad);
  $fecha_prioridad =  $fecha_prioridad[0];
  $fecha_prioridad=date("$fecha_prioridad-H:i:s");
  $dat4=split(" ",$fecha_prioridad);
  $dat=split("-",$dat4[0]);
  $a=$dat[3];
  $b=$dat[2];
  $c=$dat[1];
  $d=$dat[0];
  
  $largo = strlen($c);

  $resul_c = $c - 1;
  //echo "<br>  $resul_c  <br>";
  $largo2 = strlen($resul_c);
  if($largo2 != 2)
  {
  $resul_c2="0$resul_c";
  }else{
  
  $resul_c2;
  }
  
   $fec_resok="$b-$resul_c2-$d";
//echo "rr $restricfec2";
if($restricfec2){


$sql2222="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, cruce_tablas AS cr where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio != 3 and etiq.id_estado_folio != 3 and etiq.id_estado_folio != 7 and etiq.id_estado_folio != 5 and etiq.id_estado_folio != 6 and etiq.id_estado_folio != 0 and etiq.id_estado_folio != 0 and etiq.id_producto = pro.id_producto and etiq.id_cruce_tablas = cr.id_cruce_tablas and etiq.id_pedidos = 0 and etiq.ano >= 2009 and etiq.f_elaboracion  <= '$fec_resok' order by etiq.f_elaboracion asc";
//echo "ssssssssssssss1<br>";
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pedido_modificar.php&id_ped=$id_ped\">";

}else{

$sql2222="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, cruce_tablas AS cr where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio != 3 and etiq.id_estado_folio != 3 and etiq.id_estado_folio != 7 and etiq.id_estado_folio != 5 and etiq.id_estado_folio != 6 and etiq.id_estado_folio != 0 and etiq.id_estado_folio != 0 and etiq.id_producto = pro.id_producto and etiq.id_cruce_tablas = cr.id_cruce_tablas and etiq.id_pedidos = 0 and etiq.ano >= 2009 order by etiq.f_elaboracion asc";
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=pedido_modificar.php&id_ped=$id_ped\">";

//echo "sssssss2<br>";
}
$result2222=mysql_query($sql2222);
$cuantos=mysql_num_rows($result2222);


//echo "sql2222 $sql2222";
//echo "cuantos $cuantos";

while ($row222=mysql_fetch_array($result2222))
    { 
	$id_etiquetados_foliosposible=$row222[id_etiquetados_folios];
	$id_cruce_tablasposible=$row222[id_cruce_tablas];
	 //echo "id_pedidos $id_pedidos2<br>";
	$sql_consul="SELECT * FROM pedido_tabla WHERE id_pedidos = $id_ped";	
	$result_consul=mysql_query($sql_consul);
 	while ($rowp=mysql_fetch_array($result_consul))
    {
	 $id_pedido_tablas=$rowp[id_pedido_tablas];
	 $id_pedidos=$rowp[id_pedidos];
	 $id_cruce_tablas1=$rowp[id_cruce_tablas];
	 $cantidadb=$rowp[cantidadb];
	 
 	 $sql_consul2="SELECT * FROM pedido_armado_automatico  WHERE id_pedidos = $id_pedidos and id_cruce_tablas = $id_cruce_tablas1";
	 $result_consul2=mysql_query($sql_consul2);
	 $cant_resgistros=mysql_num_rows($result_consul2);
 
     //echo " <br>cantidadb $cantidadb - cant_resgistros $cant_resgistros<br>";
    // echo "id_cruce_tablas1 $id_cruce_tablas1  - codigonuevo $codigonuevo";
     if($cantidadb != $cant_resgistros){
	// echo "paso<br>";
	    if($id_cruce_tablas1 == $id_cruce_tablasposible){
		//echo "hola";
	  	 $id_pedido_tablasw=$rowcant[id_pedido_tablas];
	 	 $id_cruce_tablas2=$rowcant[id_cruce_tablas];
	 	 $sql_autom="insert into pedido_armado_automatico  (id_pedidos,id_pedido_tablas,id_cruce_tablas,id_etiquetados_folios) values ('$id_pedidos','$id_pedido_tablas','$id_cruce_tablasposible','$id_etiquetados_foliosposible')";
		// echo "<br>$sql_autom<br>";
		 $result_autom=mysql_query($sql_autom,$link);
	  	 $sql="UPDATE  etiquetados_folios set  id_pedidos='$id_ped' where id_etiquetados_folios=$id_etiquetados_foliosposible";
		 $result=mysql_query($sql);
		// echo "<br>$sql<br>";
	  	//}//if($rowcant=mysql_fetch_array($result_consul2))
		}//if($id_cruce_tablas1 == $codigonuevo){
	  }//if($cant_resgistros != $cantidadb){
	 // $contador_vueltas++;
	 }//while ($rowp=mysql_fetch_array($result_consul))
	// echo "<br>contador de vueltas $contador_vueltas<br>";
 }


}


if($id_ped){
$sql="SELECT * FROM pedido where id_pedidos=$id_ped ORDER BY id_pedidos desc LIMIT 1";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

}else{
$sql="SELECT * FROM pedido where id_pedidos=id_pedidos ORDER BY id_pedidos desc LIMIT 1";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}


?>

<script language="javascript" type="text/javascript">
function Verifica_datos(){
var codigo = 1;
codigo=document.getElementById("codigo");
frm=document.getElementById("form1");
frm.action="?modulo=pedido_modificar.php&id_ped=<?echo $id_ped?>&sumfila=1&codigo=" + codigo.value;
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
.rojo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
-->
</style>
<form name="form1" id="form1" method="post" action="">
<? if(!$nuevo){?>
<table width="200" height="272" border="0">
  <tr>
    <td width="509"><div align="right"></div>
    </td>
    <td width="153"><div align="right"><a href="?modulo=pedido_historial_listar.php" class="cajas">Volver Listado de Pedidos</a></div></td>
  </tr>
  <tr>
    <td colspan="2"><table width="625" border="0">
      <tr>
        <td><?
	while ($row=mysql_fetch_array($result))
        { 
	    $id_pedidos=$row[id_pedidos];
		$fech_ingreso_pedido=format_fecha2($row[fech_ingreso_pedido]);
		$fecha_prioridad=format_fecha2($row[fecha_prioridad]);
		$fech_despacho_pedido=format_fecha_sin_hora($row[fech_despacho_pedido]);
    	$fech_envio_picking=format_fecha_sin_hora($row[fech_envio_picking]);
		 
		$id_usuario=$row[id_usuario];
		$id_destinos=$row[id_destinos];
?>
          <table width="658" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3" nowrap="nowrap" class="titulo">&nbsp;&nbsp;CLIENTE:<span class="cajas">
                <? 
				  //echo "destinos del while $id_destinos";
	
				  list ($id_destinos2, $destinos, $restricfec2, $nombredest) = crea_destinos2222($link,$id_destinos,$restricfec,1);
				  //echo "$destinos<br>";
				
				   echo $nombredest;
				  //echo "$restricfec2";
			      //$destinos= crea_destinos2222($link,$row[id_destinos],$restricfec);
			      //echo $destinos;
				  //$id_destinos=$row[id_destinos];
			   ?>
                <input name="restricfec2" type="hidden" value="<?echo $restricfec2?>" />
              </span></td>
              <td nowrap="nowrap" class="titulo"><div align="center" class="titulo14">N&deg; Folio Pedido</div></td>
            </tr>
            <tr>
              <td colspan="3" nowrap="nowrap"><div align="left"><a href="?modulo=pedido_historial_folios_listar.php&amp;id_ped=<? echo $id_pedidos?>&amp;id_destinosv=<? echo $id_destinos;?>&amp;fecha_prioridad=<? echo $fecha_prioridad?>" class="cajas" >LISTAR DETALLE DE FOLIOS</a></div></td>
              <td nowrap="nowrap" class="titulo"><div align="center"><span class="titulo14"><? echo $id_pedidos?></span></div></td>
            </tr>
            <tr>
              <td width="181" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Fecha Ingreso Pedido </td>
              <td width="142" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Fecha Envio Picking </td>
              <td width="159" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Fecha Posible Despacho </td>
              <td width="166" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo"><div align="center"><span class="cajas">&nbsp;N&deg; Picking Asignado </span></div></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fech_ingreso_pedido;?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fech_envio_picking?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $fecha_prioridad?></td>
              <td nowrap="nowrap" class="cajas"><div align="center"><? echo $row[folio_piking]?></div></td>
            </tr>
          </table>
          <table width="660" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="53" bgcolor="#CCCCCC" class="titulo"><div align="center">ID</div></td>
              <td width="265" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
              <td width="62" bgcolor="#CCCCCC" class="titulo">&nbsp;Calibre</td>
              <td width="75" bgcolor="#CCCCCC" class="titulo">&nbsp;Unid./Med.</td>
              <td width="61" bgcolor="#CCCCCC" class="titulo">&nbsp;Medida</td>
              <td width="130" bgcolor="#CCCCCC" class="titulo"><div align="center"> Bidones </div> </td>
              </tr>
			  
	  
      <?
	  $sqlp="SELECT * FROM etiquetados_folios AS ef, producto AS pro, calibre AS c, unidad_medida AS um, medidas_productos AS mp WHERE ef.id_pedidos ='$id_ped' and ef.id_producto = pro.id_producto and ef.id_calibre = c.id_calibre and ef.id_unidad_medida = um.id_unidad_medida and ef.id_medidas_productos = mp.id_medidas_productos GROUP BY ef.id_cruce_tablas";
	  $resultp=mysql_query($sqlp);
	  $cuantosp=mysql_num_rows($resultp);

	  while ($rowp=mysql_fetch_array($resultp))
      { 
	  $id_cruce_tablas=$rowp[id_cruce_tablas];
	  $id_pedidos=$rowp[id_pedidos];
	  $id_etiquetados_folios=$rowp[id_etiquetados_folios];
	  ?>
            <tr>
              <td class="cajas"><div align="center"><? echo $rowp[id_cruce_tablas];?></div></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $rowp[producto];?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $rowp[calibre];?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $rowp[unidad_medida];?></td>
              <td nowrap="nowrap" class="cajas">&nbsp;<? echo $rowp[medidas_productos];?></td>
              <td nowrap="nowrap" class="titulo14">
			  <div align="center">
			  <? 
			  $sqlf="SELECT * FROM etiquetados_folios WHERE id_pedidos = $id_pedidos and id_cruce_tablas=$id_cruce_tablas";
	  		  $resultf=mysql_query($sqlf);
	  		  $cuantosf=mysql_num_rows($resultf);
			  echo $cuantosf;
			  ?>
			  </div>
			  </td>
              </tr>
            <? } ?>
            <tr>
              <td height="23" colspan="3" nowrap="nowrap"><div align="left"><a href="?modulo=pedido_historial_folios_listar.php&amp;id_ped=<? echo $id_pedidos?>&amp;id_destinosv=<? echo $id_destinos;?>&amp;fecha_prioridad=<? echo $fecha_prioridad?>" class="cajas" >LISTAR DETALLE DE FOLIOS</a></div></td>
              <td height="23" colspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="titulo14"><strong>&nbsp;Totales</strong></span></td>
              <td height="23" nowrap="nowrap" bgcolor="#CCCCCC" class="cajas"><div align="center" class="titulo14"> <? 
			  $sqlf="SELECT * FROM etiquetados_folios WHERE id_pedidos = $id_pedidos";
	  		  $resultf=mysql_query($sqlf);
	  		  $cuantosp=mysql_num_rows($resultf);
			  echo $cuantosp;
			  ?></div>               </td>              </tr>
          </table>
          <? }} ?></td>
      </tr>
      
    </table></td>
  </tr>
</table>

</form>