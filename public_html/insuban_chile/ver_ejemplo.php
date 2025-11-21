<?
$sql="SELECT * FROM etiquetados_folios AS etiq, producto AS pro, cruce_tablas AS cr where etiq.id_etiquetados_folios = etiq.id_etiquetados_folios and etiq.id_estado_folio != 3 and etiq.id_estado_folio != 3 and etiq.id_estado_folio != 7 and etiq.id_estado_folio != 5 and etiq.id_estado_folio != 6 and etiq.id_estado_folio != 0 and etiq.id_estado_folio != 0 and etiq.id_producto = pro.id_producto and etiq.id_cruce_tablas = cr.id_cruce_tablas and etiq.id_pedidos = 0 order by etiq.f_elaboracion asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

echo "cuantos $cuantos";

while ($row=mysql_fetch_array($result))
    { 
	$id_etiquetados_foliosposible=$row[id_etiquetados_folios];
	$id_cruce_tablas=$row[id_cruce_tablas];
	



$sql="SELECT * FROM pedido WHERE id_pedidos = id_pedidos order by fecha_prioridad asc";	
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
while ($row=mysql_fetch_array($result))
{ 
 	$id_pedidos2=$row[id_pedidos];
	//echo "id_pedidos $id_pedidos2<br>";
	$sql_consul="SELECT * FROM pedido_tabla WHERE id_pedidos = $id_pedidos2";	
	$result_consul=mysql_query($sql_consul);
 	while ($rowp=mysql_fetch_array($result_consul))
    {
	 $id_pedido_tablas=$rowp[id_pedido_tablas];
	 $id_pedidos=$rowp[id_pedidos];
	 $id_cruce_tablas1=$rowp[id_cruce_tablas];
	 $cantidadb=$rowp[cantidadb];
	 
 	 $sql_consul2="SELECT * FROM pedido_armado_automatico  WHERE id_pedidos = $id_pedidos2 and id_cruce_tablas = $id_cruce_tablas1";
	 $result_consul2=mysql_query($sql_consul2);
	 $cant_resgistros=mysql_num_rows($result_consul2);
 
     //echo " <br>cantidadb $cantidadb - cant_resgistros $cant_resgistros<br>";
    // echo "id_cruce_tablas1 $id_cruce_tablas1  - codigonuevo $codigonuevo";
     if($cantidadb != $cant_resgistros){
	// echo "paso<br>";
	    if($id_cruce_tablas1 == $codigonuevo){
		//echo "hola";
	  	 $id_pedido_tablasw=$rowcant[id_pedido_tablas];
	 	 $id_cruce_tablas2=$rowcant[id_cruce_tablas];
	 	 $sql_autom="insert into pedido_armado_automatico  (id_pedidos,id_pedido_tablas,id_cruce_tablas,id_etiquetados_folios) values ('$id_pedidos','$id_pedido_tablas','$codigonuevo','$id_etiquetados_foliosposible')";
		// echo "<br>$sql_autom<br>";
		 $result_autom=mysql_query($sql_autom,$link);
	  	 $sql="UPDATE  etiquetados_folios set  id_pedidos='$id_pedidos2' where id_etiquetados_folios=$id_etiquetados_foliosposible";
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
?>
