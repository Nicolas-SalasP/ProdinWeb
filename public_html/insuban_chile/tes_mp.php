<?
require "lib/conexion.php";
require( 'lib/session_admin.php');
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

$fhoy=date("Y");

$sql33="SELECT * FROM etiquetados_folios AS ef, origenes AS org WHERE ef.id_estado_folio = 4 and ef.id_origen = org.id_origen";
$result33=mysql_query($sql33);
$cuantos33=mysql_num_rows($result33);

	while($row33=mysql_fetch_array($result33))
   		{ 
	  	$etiquetados_folios_id=$row33[id_etiquetados_folios];
		$sqlultimafecha="SELECT * FROM mat_prima_importada where etiquetados_folios_id = $etiquetados_folios_id";
	    $resulultimafecha=mysql_query($sqlultimafecha);
        $cuantosultimafecha=mysql_num_rows($resulultimafecha);
		if(!$cuantosultimafecha){
     		$id_etiquetados_foliosggg=$row33[id_etiquetados_folios];
			$fbodega_mpi333=$row33[fbodega_mpi];

			$sql="SELECT * FROM etiquetados_folios where id_etiquetados_folios ='$id_etiquetados_foliosggg'";
  			$result=mysql_query($sql);
  
   if ($row=mysql_fetch_array($result))
   { 
	 
	  $cruce_tablas_id=$row[id_cruce_tablas];
	  $bidon_importado=$row[bidon_importado];
      $comprobante_num=$row[factura_importada];
	  
	  $id_producto=$row[id_producto];
	  $id_estado_material=$row[id_estado_folio];
	  $id_unidad_medida=$row[id_unidad_medida];
	  $fecha_elaboracion=$row[f_elaboracion];
	  $valor_unitario=$row[total_ponderado];
	
	  $id_origen=$row[id_origen];
	  $contenido=$row[contenido_unidades];
	  $id_procedencia=$row[id_procedencia];
	
   
   }//if($cuantosultimafecha){
  

    $sqlultimafecha="SELECT * FROM mat_prima_importada where id_mat_prima_importada=id_mat_prima_importada ORDER BY id_mat_prima_importada desc LIMIT 1";
$resulultimafecha=mysql_query($sqlultimafecha);
$cuantosultimafecha=mysql_num_rows($resulultimafecha);

 if ($rowultimafecha=mysql_fetch_array($resulultimafecha))
 { 
 $id_mat_prima_importada2=$rowultimafecha[id_mat_prima_importada];
 $ultimoanorescatado=$rowultimafecha[ano]; 

	 $id_mat_prima_importada2++;
		//echo "id_mat_prima_importada2 $id_mat_prima_importada2<br>";

 $sql_nuevo="insert into mat_prima_importada (id_mat_prima_importada,id_origen,ano,id_producto,id_estado_material,comprobante_num,etiquetados_folios_id,cruce_tablas_id,bidon_num,contenido,fecha_ingreso,fecha_elaboracion,fecha_salida,id_unidad_medida,valor_cmpi) values ($id_mat_prima_importada2,$id_origen,$fhoy,$id_producto,2,'$comprobante_num','$id_etiquetados_foliosggg','$cruce_tablas_id','$bidon_importado','$contenido','$fbodega_mpi333','$fecha_elaboracion','$fbodega_mpi333','$id_unidad_medida','$valor_unitario')";
 $result_nuevo=mysql_query($sql_nuevo,$link);
//echo "sql_nuevo $sql_nuevo<br>";
   
   
   }
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	
		}//	if(!$cuantosultimafecha){

  
 }// Fin while ($row=mysql_fetch_array($result))
 

?>