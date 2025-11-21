<?php
$servername = "190.107.176.73:3306";
$username = "prodinwe_stgo391";
$password = "391stgo.*.";
$dbname = "prodinwe_insubanchile";
$url="http://190.107.176.73/~prodinwe/insuban_chile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql= "INSERT INTO temp_pt_diario
(pt_diario_codigo,
pt_diario_folio,
pt_diario_estado,
pt_diario_producto,
pt_diario_calibre,
pt_diario_umedida,
pt_diario_medida,
pt_diario_cproducto,
pt_diario_cenvase,
pt_diario_contenido)
SELECT ef.id_cruce_tablas,ef.id_etiquetados_folios,est.estado_folio, prd.producto, clb.calibre,um.unidad_medida,mp.medidas_productos,cp.caract_producto,ce.caract_envases,ef.contenido_unidades
FROM etiquetados_folios as ef, estado_folio as est , producto as prd, calibre as clb, unidad_medida as um, medidas_productos as mp, caract_producto as cp, caract_envases as ce
where ef.id_estado_folio=est.id_estado_folio 
and ef.id_producto=prd.id_producto
and ef.id_calibre=clb.id_calibre
and ef.id_unidad_medida=um.id_unidad_medida
and ef.id_medidas_productos=mp.id_medidas_productos
and ef.id_caract_producto=cp.id_caract_producto
and ef.id_caract_envases=ce.id_caract_envases
and ef.ano between 2015 and 2017";
/*
if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>