<?

require "../../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "../../lib/funciones.php";

if($id_procedencia == "N"){
$sql="SELECT mpn.id_mat_prima_nacional AS id_mat_prima_nacional, mpn.id_c_es_so AS id_c_es_so, mpn.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto,pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpn.contenido AS contenido, mpn.comprobante_num AS comprobante_num, mpn.bidon_num AS bidon_num, mpn.fecha_ingreso AS fecha_ingreso, mpn.fecha_faena AS fecha_faena, mpn.fecha_termino AS fecha_termino, est.estado_material AS estado_material FROM mat_prima_nacional AS mpn, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpn.id_producto = pro.id_producto and mpn.id_calibre = c.id_calibre and mpn.id_origen = org.id_origen and mpn.id_estado_material = est.id_estado_material and mpn.id_estado_material = 1 ";

if($id_mat_prima_nacional){ $sql.= " and mpn.id_mat_prima_nacional = '$id_mat_prima_nacional' "; }
if($id_origen){ $sql.= " and mpn.id_origen = '$id_origen' "; }
if($id_producto){ $sql.= " and mpn.id_producto = '$id_producto' "; } 
if($id_calibre){ $sql.= " and mpi.id_calibre = '$id_calibre' "; }
if($factura_mp){ $sql.= " and mpn.factura_mp = '$factura_mp' "; }
if($comprobante_num){ $sql.= " and mpn.comprobante_num = '$comprobante_num' "; }
if($bidon_num){ $sql.= " and mpn.bidon_num = '$bidon_num' "; }
if($year){ $sql.= " and mpn.ano = $year "; }
if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";}
if($fidfaenadok or $fidfaenahok){ $sql.= " and mpn.fecha_faena between '$fidfaenadok' and '$fidfaenahok' ";}
if(!$sibidones){ $sql.= " and mpn.id_solicitud_mp = 0 and mpn.id_c_es_so = 0"; }
$sql.= " order by mpn.id_mat_prima_nacional asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=excel_solicitudmp.csv");
echo "FOLIO;PRODUCTO;CALIBRE;ORIGEN;CONTENIDO;GUIA;N BIDON;F/INGRESO;F/FAENA;F/VENCIMIENTO;ESTADO\n";
 while ($row=mysql_fetch_array($result))
    {
	$i++;
	$id_mat_prima_nacional=$row[id_mat_prima_nacional];
	$producto=$row[producto];
	$calibre=$row[calibre];
	$origen=$row[origen];
	$contenido=$row[contenido];
	$comprobante_num=$row[comprobante_num];
	$bidon_num=$row[bidon_num];
	$fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);
	$fecha_faena=format_fecha_sin_hora($row[fecha_faena]);   
	$fecha_termino=format_fecha_sin_hora($row[fecha_termino]);
	$estado_material=$row[estado_material];
	
	 if(!$id_calibre){ $calibre="Original"; }else{echo "$row[calibre]";}
	
 echo "$id_mat_prima_nacional;$producto;$calibre;$origen;$contenido;$comprobante_num;$bidon_num;$fecha_ingreso;$fecha_faena;$fecha_termino;$estado_material;\n";
	}
}//if($id_procedencia){ NACIONAL
	
	if($id_procedencia == "I"){
	$sqli="SELECT mpi.id_mat_prima_importada AS id_mat_prima_importada, mpi.etiquetados_folios_id AS etiquetados_folios_id,mpi.cruce_tablas_id as codigo, mpi.id_c_es_so AS id_c_es_so,  mpi.id_solicitud_mp AS id_solicitud_mp, pro.producto AS producto, pro.id_producto AS id_producto, c.calibre AS calibre, c.id_calibre AS id_calibre, org.origen AS origen, org.id_origen AS id_origen, mpi.contenido AS contenido, mpi.comprobante_num AS comprobante_num, mpi.bidon_num AS bidon_num, mpi.fecha_elaboracion AS fecha_elaboracion, mpi.fecha_vencimiento AS fecha_vencimiento, mpi.fecha_ingreso AS fecha_ingreso, est.estado_material AS estado_material, c.calibre AS calibre FROM mat_prima_importada AS mpi, producto AS pro,calibre AS c, origenes AS org, estado_material AS est WHERE mpi.id_producto = pro.id_producto and mpi.id_calibre = c.id_calibre and mpi.id_origen = org.id_origen and mpi.id_estado_material = est.id_estado_material and mpi.id_estado_material != 0  and   mpi.id_estado_material = 1 ";
if($id_mat_prima_nacional){ $sqli.= " and mpi.id_mat_prima_importada = '$daton' "; }
if($id_mat_prima_nacional_antiguo){ $sqli.= " and mpi.etiquetados_folios_id = '$datoi' "; }
if($id_origen){ $sqli.= " and mpi.id_origen = '$id_origen' "; }
if($id_producto){ $sqli.= " and mpi.id_producto = '$id_producto' "; }
if($id_calibre){ $sqli.= " and mpi.id_calibre = '$id_calibre' "; }
if($comprobante_num){ $sqli.= " and mpi.comprobante_num = '$comprobante_num' "; }
if($guia_imp){ $sqli.= " and mpi.guia_imp = '$guia_imp' "; }
if($bidon_num){ $sqli.= " and mpi.bidon_num = '$bidon_num' "; }
//if($fidok or $fihok){ $sql.= " and mpn.fecha_ingreso between '$fidok' and '$fihok' ";
//if($year){ $y=$year-1;	$sqli.= " and mpi.ano between '$y' and '$year'"; }
if($year){ $sqli.= " and mpi.ano ='$year'"; }
if($fidok or $fihok){ $sqli.= " and mpi.fecha_ingreso between '$fidok' and '$fihok' ";}
if($fidfaenadok or $fidfaenahok){ $sqli.= " and mpn.fecha_elaboracion between '$fidfaenadok' and '$fidfaenahok' ";}
if(!$sibidones){ $sqli.= " and mpi.id_solicitud_mp = 0 and mpi.id_c_es_so = 0"; }
$sqli.= " order by mpi.id_mat_prima_importada asc";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=excel_solicitudmp.csv");
echo "FOLIO PT; FOLIO ANTIGUO;CODIGO;PRODUCTO;CALIBRE;ORIGEN;CONTENIDO;FACTURA;N BIDON;F/INGRESO;F/FAENA;F/VENCIMIENTO;ESTADO\n";

 while ($rowi=mysql_fetch_array($resulti))
    {
	$i++;
	$id_mat_prima_importada=$rowi[id_mat_prima_importada];
	$etiquetados_folios_id=$rowi[etiquetados_folios_id];
	$cruce_tablas_id=$rowi[codigo];
	$producto=$rowi[producto];
	$calibre=$rowi[calibre];
	$origen=$rowi[origen];
	$contenido=$rowi[contenido];
	$comprobante_num=$rowi[comprobante_num];
	$bidon_num=$rowi[bidon_num];
	$fecha_ingreso=format_fecha_sin_hora($rowi[fecha_ingreso]);
	$fecha_faena=format_fecha_sin_hora($rowi[fecha_elaboracion]);   
	$fecha_vencimiento=format_fecha_sin_hora($rowi[fecha_vencimiento]);
	$estado_material=$rowi[estado_material];
	
	
	 $largo=strlen($id_mat_prima_importada);
	 if($largo == 9){
	 $id_mat_prima_importada=substr($id_mat_prima_importada,1,9);
	 }
	// echo $id_mat_prima_importada;
	//if($etiquetados_folios_id)
	
	if(!$id_calibre){ $calibre="Original"; }else{echo "$rowi[calibre]";}
	
 echo "$id_mat_prima_importada;$etiquetados_folios_id;$cruce_tablas_id;$producto;$calibre;$origen;$contenido;$comprobante_num;$bidon_num;$fecha_ingreso;$fecha_faena;$fecha_vencimiento;$estado_material;\n";
	}


}//if($id_procedencia == "I"){ importada
?>
